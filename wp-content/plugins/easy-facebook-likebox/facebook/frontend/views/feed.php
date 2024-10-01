<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Represents the view for the public-facing feed of the plugin.
 *
 * This typically includes any information, if any, that is rendered to the
 * frontend of the theme when the plugin is activated.
 *
 * @package   Easy Social Feed
 * @author    Danish Ali Malik
 * @link      https://easysocialfeed.com
 * @copyright 2020 MaltaThemes
 */
$instance = apply_filters( 'efbl_feed_shortcode_params', $instance );
global $post;
$efbl_demo_page_id = efbl_demo_page_id();
$is_public_page = '';
$is_multifeed = false;
// if "," exists in fanpage_id, then it's a multifeed
if ( isset( $instance['fanpage_id'] ) && !empty( $instance['fanpage_id'] ) && strpos( $instance['fanpage_id'], ',' ) !== false ) {
    $account_ids = explode( ',', $instance['fanpage_id'] );
    if ( is_array( $account_ids ) && count( $account_ids ) > 1 ) {
        $is_multifeed = true;
    }
}
if ( is_customize_preview() && isset( $post->ID ) && $post->ID == $efbl_demo_page_id ) {
    $fanpage_id = get_option( 'efbl_account_id', false );
    $page_id = $fanpage_id;
    $skin_id = get_option( 'efbl_skin_id', false );
    $instance['fanpage_id'] = $page_id;
    $instance['skin_id'] = $skin_id;
}
if ( class_exists( 'Esf_Multifeed_Facebook_Frontend' ) && isset( $type ) && $is_multifeed ) {
    $efbl_queried_data = apply_filters( 'efbl_filter_queried_data', $instance );
    $efbl_multifeed = true;
} else {
    $efbl_queried_data = $this->query_posts( sanitize_text_field( $fanpage_id ), $instance );
    $efbl_multifeed = false;
}
if ( isset( $efbl_queried_data['posts'] ) && !empty( $efbl_queried_data['posts'] ) ) {
    $efbl_posts = apply_filters( 'efbl_pre_feeds_show', $efbl_queried_data['posts'] );
} else {
    $efbl_posts = array();
}
if ( isset( $efbl_queried_data['transient_name'] ) && !empty( $efbl_queried_data['transient_name'] ) ) {
    $transient_name = $efbl_queried_data['transient_name'];
} else {
    $transient_name = null;
}
$cache_seconds = efbl_get_cache_seconds( $instance );
global $efbl_skins;
$selected_skin = $efbl_skins[$skin_id]['layout'];
if ( isset( $efbl_queried_data['public_page'] ) && !empty( $efbl_queried_data['public_page'] ) ) {
    $is_public_page = $efbl_queried_data['public_page'];
} else {
    $is_public_page = false;
}
if ( is_customize_preview() && isset( $post->ID ) && $post->ID == $efbl_demo_page_id ) {
    $skin_id = get_option( 'efbl_skin_id', false );
    $efbl_skin_settings = get_option( 'efbl_skin_' . $skin_id, false );
    $efbl_skin_values = $efbl_skins[$skin_id];
    $EFBL_SKINS = new EFBL_SKINS();
    $default_settings = $EFBL_SKINS->efbl_default_skin_settings();
    $efbl_skin_settings = wp_parse_args( $efbl_skin_settings, $default_settings );
    $efbl_skin_values['design'] = $efbl_skin_settings;
    $layout = get_post_meta( $skin_id, 'layout', true );
    if ( !$layout ) {
        $layout = $efbl_skin_values['design']['layout_option'];
    }
} else {
    $efbl_skin_values = $efbl_skins[$skin_id];
    $layout = $efbl_skin_values['layout'];
}
if ( $layout == 'half' ) {
    $layout = 'halfwidth';
}
if ( $layout == 'full' ) {
    $layout = 'fullwidth';
}
$FTA = new Feed_Them_All();
$fta_settings = $FTA->fta_get_settings();
$fb_settings = $fta_settings['plugins']['facebook'];
if ( isset( $fb_settings['approved_pages'] ) && !empty( $fb_settings['approved_pages'] ) ) {
    $approved_pages = $fb_settings['approved_pages'];
} else {
    $approved_pages = '';
}
$link_target = ( $links_new_tab ? '_blank' : '_self' );
if ( isset( $efbl_queried_data['efbl_queried_data'] ) ) {
    $is_valid_album_id = $efbl_queried_data['efbl_queried_data'];
} else {
    $is_valid_album_id = '';
}
$rand_id = wp_rand( 1, 10 );
// phpcs:ignore Squiz.PHP.DisallowInlineConditionals,Squiz.WhiteSpace.SeparatorSpacing
?>
<div class="efbl_feed_wraper efbl_skin_<?php 
esc_attr_e( $skin_id );
do_action( 'efbl_feed_wrapper_custom_class' );
?>" <?php 
do_action( 'efbl_feed_wrapper_custom_attrs' );
?>>

	<?php 
if ( !empty( $cache_seconds ) ) {
    $efbl_bio_data = efbl_get_page_bio( $fanpage_id, $cache_seconds );
}
$auth_img_src = efbl_get_page_logo( $fanpage_id );
// Load Header
if ( isset( $efbl_skin_values['design']['show_header'] ) && !empty( $efbl_skin_values['design']['show_header'] ) && !isset( $efbl_bio_data->error ) ) {
    if ( !$is_moderate ) {
        /*
         * Load header template if available in active theme
         * Header template can be override by "{your-theme}/easy-facebook-likebox/facebook/frontend/views/html-feed-header.php"
         */
        $esf_theme_header_url = locate_template( array('easy-facebook-likebox/facebook/frontend/views/html-feed-header.php') );
        if ( !$esf_theme_header_url ) {
            $esf_theme_header_url = EFBL_PLUGIN_DIR . 'frontend/views/html-feed-header.php';
        }
        include $esf_theme_header_url;
    }
}
// If posts found
if ( isset( $efbl_posts ) && !empty( $efbl_posts ) ) {
    $i = 0;
    $pi = 1;
    $carousel_class = null;
    $carousel_atts = null;
    if ( isset( $efbl_skin_values['design']['number_of_cols'] ) && !empty( $efbl_skin_values['design']['number_of_cols'] ) ) {
        $efbl_number_of_cols = $efbl_skin_values['design']['number_of_cols'];
    } else {
        $efbl_number_of_cols = 3;
    }
    ?>

	<div class="efbl_feeds_holder efbl_feeds_<?php 
    esc_attr_e( $layout );
    esc_attr_e( $carousel_class );
    do_action( 'efbl_feed_custom_class' );
    ?>" <?php 
    esc_attr_e( $carousel_atts );
    ?> <?php 
    do_action( 'efbl_feed_custom_attrs' );
    ?>
		    data-template="<?php 
    esc_attr_e( $layout );
    ?>">
		<?php 
    if ( isset( $efbl_queried_data['has_album_data'] ) && !empty( $efbl_queried_data['has_album_data'] ) ) {
        $is_album_feed = true;
    } else {
        $is_album_feed = false;
        if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
            if ( $is_moderate ) {
                ?>
						<div class="efbl-grid-skin">
							<div class="efbl-row e-outer">
								<?php 
            }
        }
        // Loop through each post
        foreach ( $efbl_posts as $story ) {
            $efbl_comments_count = 0;
            $post_text = null;
            $story_id = $story->id;
            if ( isset( $story->from->id ) && !empty( $story->from->id ) ) {
                $id_exploded = explode( '_', $story->from->id );
            } else {
                $id_exploded = explode( '_', $story_id );
            }
            $page_id = $id_exploded[0];
            if ( 'events' == $filter ) {
                $page_id = $story->owner->id;
            }
            $auth_img_src = efbl_get_page_logo( $page_id );
            if ( isset( $story->status_type ) ) {
                $feed_type = $story->status_type;
            } else {
                $feed_type = '';
            }
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                if ( !$is_moderate ) {
                    if ( isset( $story->story ) && strpos( $story->story, 'live' ) !== false ) {
                        continue;
                    }
                }
            }
            if ( isset( $story->title ) ) {
                $story_title = $story->title;
            } else {
                $story_title = '';
            }
            if ( class_exists( 'Esf_Multifeed_Facebook_Frontend' ) ) {
                $popup_id = $fanpage_id;
            } else {
                $popup_id = $page_id;
            }
            $efbl_bio_data = efbl_get_page_bio( $page_id, $cache_seconds );
            if ( isset( $story->attachments->data[0]->type ) ) {
                $feed_attachment_type = $story->attachments->data[0]->type;
            } else {
                $feed_attachment_type = null;
            }
            if ( isset( $story->from->name ) ) {
                $story_from_name = $story->from->name;
            } else {
                $story_from_name = '';
            }
            if ( 'events' == $filter ) {
                $story_from_name = $story->owner->name;
            }
            if ( isset( $story->like->summary->total_count ) ) {
                $likes_count = $story->like->summary->total_count;
            } else {
                $likes_count = 0;
            }
            if ( isset( $story->love->summary->total_count ) ) {
                $love_count = $story->love->summary->total_count;
            } else {
                $love_count = 0;
            }
            if ( isset( $story->haha->summary->total_count ) ) {
                $haha_count = $story->haha->summary->total_count;
            } else {
                $haha_count = 0;
            }
            if ( isset( $story->wow->summary->total_count ) ) {
                $wow_count = $story->wow->summary->total_count;
            } else {
                $wow_count = 0;
            }
            if ( isset( $story->sad->summary->total_count ) ) {
                $sad_count = $story->sad->summary->total_count;
            } else {
                $sad_count = 0;
            }
            if ( isset( $story->angry->summary->total_count ) ) {
                $angry_count = $story->angry->summary->total_count;
            } else {
                $angry_count = 0;
            }
            $efbl_likes_count = $likes_count + $love_count + $haha_count + $wow_count + $sad_count + $angry_count;
            if ( 'events' == $filter || 'albums' == $filter || 'videos' == $filter || 'images' == $filter || 'mentioned' == $filter ) {
                if ( isset( $story->reactions->data ) ) {
                    $efbl_likes_count = count( $story->reactions->data );
                }
            }
            if ( isset( $story->comments->data ) ) {
                if ( isset( $story->comments->data ) ) {
                    $efbl_comments_count = count( $story->comments->data );
                }
            }
            if ( !$efbl_comments_count ) {
                $efbl_comments_count = 0;
            }
            if ( isset( $shares ) && !empty( $shares ) ) {
                $shares = $shares;
            } else {
                $shares = '';
            }
            if ( isset( $story->created_time ) ) {
                $time = $story->created_time;
            } else {
                $time = '';
            }
            if ( 'events' == $filter ) {
                $time = $story->updated_time;
            }
            //convert time into minutes/days ago.
            $time = efbl_time_ago( $time );
            $story_link = esc_url( 'https://www.facebook.com/' . $story->id );
            $pic_class = 'efbl_no_image';
            if ( isset( $story->full_picture ) && $story->full_picture && 'shared_story' !== $feed_type ) {
                $pic_class = 'efbl_has_image';
            }
            if ( $feed_type == 'mobile_status_update' ) {
                if ( isset( $story->attachments->data['0']->description ) && !empty( $story->attachments->data['0']->description ) ) {
                    $post_text = $story->attachments->data['0']->description;
                }
                if ( isset( $story->attachments->data['0']->description_tags ) && !empty( $story->attachments->data['0']->description_tags ) ) {
                    $text_tags = $story->attachments->data['0']->description;
                }
            }
            if ( !$story_from_name ) {
                $efbl_no_story_name = 'efbl-empty-author-name';
            } else {
                $efbl_no_story_name = '';
            }
            $text_tags = '';
            if ( isset( $story->message_tags ) && !empty( $story->message_tags ) ) {
                $text_tags = $story->message_tags;
            }
            if ( !empty( $story->story ) && $filter !== 'mentioned' ) {
                $story_text = str_replace( $story_from_name, '', htmlspecialchars( $story->story ) );
            } else {
                $story_text = '';
            }
            //get mesasge
            if ( !empty( $story->message ) ) {
                $post_text = htmlspecialchars( $story->message );
            }
            $post_plain_text = $post_text;
            $html_check_array = array(
                '&lt;',
                '’',
                '“',
                '&quot;',
                '&amp;',
                '#',
                'http'
            );
            //Convert links url to html links
            $post_text = ecff_makeClickableLinks( $post_text, array('http', 'mail'), array(
                'target' => $link_target,
            ) );
            //convert hastags into links
            $post_text = ecff_hastags_to_link( $post_text );
            //always use the text replace method
            if ( ecff_stripos_arr( $post_text, $html_check_array ) !== false ) {
                //Loop through the tags
                if ( $text_tags ) {
                    foreach ( $text_tags as $message_tag ) {
                        $tag_name = $message_tag->name;
                        $tag_link = '<a href="https://facebook.com/' . $message_tag->id . '" target="' . $link_target . '">' . $tag_name . '</a>';
                        $post_text = str_replace( $tag_name, $tag_link, $post_text );
                    }
                }
            } else {
                //not html found now use manaul loop
                $message_tags_arr = array();
                $j = 0;
                if ( $text_tags ) {
                    foreach ( $text_tags as $message_tag ) {
                        $j++;
                        $tag_name = $message_tag->name;
                        $tag_link = '<a href="https://facebook.com/' . $message_tag->id . '" target="' . $link_target . '">' . $message_tag->name . '</a>';
                        $post_text = str_replace( $tag_name, $tag_link, $post_text );
                    }
                }
            }
            if ( isset( $story->full_picture ) ) {
                $feed_img = $story->full_picture;
            } else {
                $feed_img = '';
            }
            if ( !empty( $feed_img ) && 'shared_story' !== $feed_type ) {
                $pic_class = 'efbl_has_image';
            }
            if ( isset( $story->attachments->data['0']->media->source ) && !empty( $story->attachments->data['0']->media->source ) ) {
                $video_source = $story->attachments->data['0']->media->source;
            } else {
                $video_source = '';
            }
            $efbl_feed_popup_url = '';
            if ( $layout == 'grid' && empty( $feed_img ) && !$is_moderate ) {
                continue;
            }
            if ( $filter == 'albums' && $story->count == 0 ) {
                continue;
            }
            $video_iframe = null;
            if ( isset( $story->attachments->data['0']->type ) ) {
                $story_attach_type = $story->attachments->data['0']->type;
            } else {
                $story_attach_type = '';
            }
            if ( $story_attach_type == 'video_inline' && empty( $video_source ) ) {
                $video_iframe = '<iframe type="text/html" width="720"  height="512" src="https://www.facebook.com/v2.3/plugins/video.php?href=' . $story->attachments->data['0']->url . '?autoplay=1&amp;mute=0&width=720&height=512" allowfullscreen="" frameborder="0" webkitallowfullscreen="" mozallowfullscreen=""></iframe>';
            }
            if ( isset( $story->name ) && !empty( $story->name ) ) {
                $story_name = $story->name;
            } else {
                $story_name = '';
            }
            //get author image src
            $author_image = '<a href="https://facebook.com/' . $page_id . '" title="' . $story_name . '" target="' . $link_target . '"><img alt="' . $story_name . '" src="' . $auth_img_src . '" title="' . $story_from_name . '" width="40" height="40" /></a>';
            if ( $feed_type == 'mobile_status_update' && isset( $story->attachments->data[0]->media->image->src ) ) {
                $feed_img = $story->attachments->data[0]->media->image->src;
            }
            if ( isset( $words_limit ) && !empty( $words_limit ) ) {
                if ( str_word_count( $post_text ) <= $words_limit ) {
                    $efbl_words_trimmed = false;
                } else {
                    $post_text = wp_trim_words( $post_text, $words_limit, '' );
                    $efbl_words_trimmed = true;
                }
            }
            $post_text = ecff_hastags_to_link( $post_text );
            $post_text = ecff_makeClickableLinks( $post_text, array('http', 'mail', 'https'), array(
                'target' => $link_target,
            ) );
            $efbl_feed_comments_popup_url = '';
            $load_description_action = 'efbl_load_more_description';
            $efbl_reactions_modal = '';
            if ( isset( $story->reactions->data ) ) {
                $reactions_arr = $story->reactions->data;
            } else {
                $reactions_arr = '';
            }
            $efbl_love = efbl_check_reaction( 'LOVE', $reactions_arr );
            $efbl_wow = efbl_check_reaction( 'WOW', $reactions_arr );
            $efbl_angry = efbl_check_reaction( 'ANGRY', $reactions_arr );
            $efbl_haha = efbl_check_reaction( 'HAHA', $reactions_arr );
            $efbl_likes = efbl_check_reaction( 'LIKE', $reactions_arr );
            $efbl_reactions_class = '';
            if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
                if ( $is_moderate && $i == 0 ) {
                    $active_class = 'efbl-moderate-selected';
                } else {
                    $active_class = '';
                }
            }
            if ( empty( $layout ) ) {
                $layout = 'halfwidth';
            }
            if ( $is_moderate ) {
                $efbl_templateurl = EFBL_PLUGIN_DIR . 'admin/views/template-moderate.php';
            } else {
                $efbl_templateurl = locate_template( array('easy-facebook-likebox/facebook/frontend/views/templates/template-' . $layout . '.php') );
                if ( !$efbl_templateurl ) {
                    $efbl_templateurl = EFBL_PLUGIN_DIR . 'frontend/views/templates/template-' . $layout . '.php';
                }
            }
            require $efbl_templateurl;
            $i++;
            if ( 'added_photos' == $feed_type || 'added_video' == $feed_type ) {
                $pi++;
            }
            if ( $i == $post_limit ) {
                break;
            }
        }
        if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
            if ( $is_moderate ) {
                ?>
									</div>
									</div>
									<?php 
            }
        }
    }
    ?>
			</div>
			<?php 
    if ( !isset( $efbl_queried_data['is_live'] ) || !$live_stream_only ) {
        if ( !$is_moderate ) {
            //Load Footer
            $esf_theme_footer_url = locate_template( array('easy-facebook-likebox/facebook/frontend/views/html-feed-footer.php') );
            if ( !$esf_theme_footer_url ) {
                $esf_theme_footer_url = EFBL_PLUGIN_DIR . 'frontend/views/html-feed-footer.php';
            }
            include $esf_theme_footer_url;
        }
    }
    // Show likebox if enabled
    if ( $show_like_box ) {
        ?>

				<div class="efbl_custom_likebox"><?php 
        echo do_shortcode( '[efb_likebox fanpage_url="' . sanitize_text_field( $fanpage_id ) . '" box_width="" box_height="500" colorscheme="light" locale="en_US" responsive="1" show_faces="0" show_header="0" show_stream="0" show_border="0" ]' );
        ?></div>
				<?php 
    }
    // If no posts found
} else {
    if ( isset( $efbl_queried_data['error'] ) && !empty( $efbl_queried_data['error'] ) ) {
        ?>
					<p class="efbl_error_msg"> <?php 
        esc_html_e( $efbl_queried_data['error'] );
        ?> </p>
				<?php 
    } else {
        if ( $filter ) {
            if ( isset( $events_filter ) && $events_filter == 'upcoming' ) {
                $events_filter_name = __( 'upcoming', 'easy-facebook-likebox' );
            } else {
                $events_filter_name = '';
            }
            ?>

						<p class="efbl_error_msg"><?php 
            esc_html_e( "{$efbl_bio_data->name} don't have any {$events_filter_name} {$filter}.", 'easy-facebook-likebox' );
            ?> </p>

					<?php 
        } else {
            ?>

						<p class="efbl_error_msg"><?php 
            echo apply_filters( 'efbl_error_message', __( 'Whoops! Nothing found according to your query, Try changing fanpage ID.', 'easy-facebook-likebox' ) );
            ?> </p>

					<?php 
        }
    }
}
?>

		</div>
