<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( $is_album_feed ) {
} else {
    $efbl_ver = 'free';
    if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
        $efbl_ver = 'pro';
    }
    $efbl_free_popup_type = 'data-imagelink=' . $feed_img . '';
    $efbl_free_popup_class = null;
    if ( 'added_video' == $feed_type && !empty( $video_source ) ) {
        $efbl_free_popup_type = 'data-video=' . $video_source . '';
        $efbl_free_popup_class = 'efbl_popup_video';
    }
    if ( isset( $story->attachments->data[0]->type ) && $story->attachments->data[0]->type == 'video_inline' && isset( $story->attachments->data[0]->url ) && 'added_video' !== $feed_type ) {
        $video_source = 'https://www.facebook.com/v2.3/plugins/video.php?href=' . $story->attachments->data[0]->url;
        $efbl_free_popup_type = 'data-videolink=' . $video_source . '';
        $efbl_free_popup_class = 'efbl_popup_video';
    }
    if ( 'efbl_has_image' == $pic_class ) {
        $efb_col = 6;
    } else {
        $efb_col = 12;
    }
    ?>

<div class="efbl-halfwidth-skin <?php 
    echo esc_attr_e( $feed_type );
    ?> efbl-story-wrapper">
	<div class="efbl-thumbnail-wrapper">
		<div class="efbl-row efbl-content-wrapper">

			<?php 
    if ( $feed_type == 'mobile_status_update' ) {
        $efbl_status_col = 12;
        ?>

				<?php 
        if ( isset( $story->attachments->data[0]->media->image->src ) ) {
            $efbl_status_col = 6;
            ?>
					<div class="efbl-thumbnail-col efbl-col-sm-<?php 
            esc_attr_e( $efbl_status_col );
            ?> ">

						<?php 
            if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
                ?>

							<a href="<?php 
                echo admin_url( 'admin-ajax.php' );
                ?>?action=efbl_generate_popup_html" 
												<?php 
                esc_attr_e( $efbl_free_popup_type );
                ?>
							 data-storylink="
							<?php 
                echo esc_url( $story_link );
                ?>
							" data-linktext="
							<?php 
                echo __( 'Read full story', 'easy-facebook-likebox' );
                ?>
							" data-caption="
							<?php 
                echo htmlentities( $post_text );
                ?>
							" data-itemnumber="
							<?php 
                esc_attr_e( $pi );
                ?>
							" class="efbl_feed_popup 
							<?php 
                esc_attr_e( $efbl_free_popup_class );
                ?>
							 efbl-cff-item_number-
							<?php 
                esc_attr_e( $pi );
                ?>
							">
								<div class="efbl-overlay">

									<?php 
                if ( $efbl_skin_values['design']['show_feed_open_popup_icon'] ) {
                    ?>

										<i class="icon icon-esf-plus efbl-plus"
										   aria-hidden="true"></i>

									<?php 
                }
                ?>
									<?php 
                if ( $feed_type == 'added_video' || $feed_attachment_type == 'video_inline' ) {
                    ?>
										<i class="icon icon-esf-clone icon-esf-video-camera"
										   aria-hidden="true"></i>
										<?php 
                }
                if ( isset( $story->attachments->data['0']->subattachments->data ) && !empty( $story->attachments->data['0']->subattachments->data ) ) {
                    ?>
										<i class="icon icon-esf-clone efbl_multimedia"
										   aria-hidden="true"></i>
									<?php 
                }
                ?>
								</div>
								<img alt="<?php 
                esc_attr_e( $story_name );
                ?>"
									 src="<?php 
                echo esc_url( $story->attachments->data[0]->media->image->src );
                ?>"/>
								<div class="efbl-overlay">


									<?php 
                if ( $efbl_skin_values['design']['show_feed_open_popup_icon'] ) {
                    ?>

										<i class="icon icon-esf-plus efbl-plus"
										   aria-hidden="true"></i>

										<?php 
                }
                ?>
									<?php 
                if ( $feed_type == 'added_video' ) {
                    ?>
										<i class="icon icon-esf-clone icon-esf-video-camera"
										   aria-hidden="true"></i>
										<?php 
                }
                if ( isset( $story->attachments->data['0']->subattachments->data ) && !empty( $story->attachments->data['0']->subattachments->data ) ) {
                    ?>
										<i class="icon icon-esf-clone efbl_multimedia"
										   aria-hidden="true"></i>
										<?php 
                }
                ?>
								</div>
							</a>

						<?php 
            }
            ?>


					</div>
				<?php 
        }
        ?>


				<div class="efbl-feed-content efbl-col-sm-<?php 
        esc_attr_e( $efbl_status_col );
        ?>">

					<?php 
        if ( $efbl_skin_values['design']['feed_header'] ) {
            ?>

						<div class="efbl-d-flex">

							<?php 
            if ( $auth_img_src && $efbl_skin_values['design']['feed_header_logo'] ) {
                ?>

								<div class="efbl-profile-image">
									<a href="https://facebook.com/<?php 
                esc_attr_e( $page_id );
                ?>"
									   title="<?php 
                esc_attr_e( $story_name );
                ?>"
									   rel="nofollow"
									   target="<?php 
                esc_attr_e( $link_target );
                ?>">
										<img alt="<?php 
                esc_attr_e( $story_name );
                ?>"
											 src="<?php 
                echo esc_url( $auth_img_src );
                ?>"/></a>
								</div>

							<?php 
            }
            ?>

							<div class="efbl-profile-title">
								<div class="efbl-profile-title-wrap <?php 
            esc_attr_e( $efbl_no_story_name );
            ?>">
									<h2><?php 
            esc_html_e( $story_from_name );
            ?>
										<?php 
            if ( isset( $efbl_bio_data->verification_status ) && $efbl_bio_data->verification_status == 'blue_verified' ) {
                ?>
											<div class="efbl-verified-status">
												<i class="icon icon-esf-check"
												   aria-hidden="true"></i>
											</div>
										<?php 
            }
            ?>
										<span class="efbl-profile-story-text"><?php 
            esc_html_e( $story_text );
            ?> </span>
									</h2>
								</div>
								<span><?php 
            esc_html_e( $time );
            ?></span>
							</div>
						</div>

					<?php 
        }
        ?>


					<?php 
        if ( isset( $story->attachments->data[0] ) ) {
            ?>

						<div class="efbl_link_text">

							<p class="efbl_title_link">
								<a href="<?php 
            echo esc_url( $story_link );
            ?>"
								   rel="nofollow"
								   target="<?php 
            esc_attr_e( $link_target );
            ?>">
									<?php 
            if ( isset( $story->attachments->data['0']->title ) ) {
                esc_html_e( $story->attachments->data['0']->title );
            }
            ?>
								</a>
							</p>
						</div>

						<?php 
            if ( $post_text ) {
                if ( $efbl_skin_values['design']['show_feed_caption'] ) {
                    ?>
								<p class="description">
									<span class="efbl-description-wrap"><?php 
                    echo wp_kses_post( nl2br( $post_text ) );
                    ?></span>

									<?php 
                    ?>


								</p>
							<?php 
                }
            }
            ?>

					<?php 
        } else {
            ?>

						<?php 
            if ( $efbl_skin_values['design']['show_feed_caption'] ) {
                ?>

							<p class="description">
								<span class="efbl-description-wrap"><?php 
                echo wp_kses_post( nl2br( $post_text ) );
                ?></span>


								<?php 
                ?>


							</p>

						<?php 
            }
            ?>

					<?php 
        }
        ?>

				</div>

				<?php 
    }
    if ( $feed_type == 'shared_story' ) {
        $efbl_shared_img_col = 12;
        if ( !isset( $shared_src ) || empty( $shared_src ) ) {
            if ( isset( $story->full_picture ) ) {
                $shared_src = $story->full_picture;
            } else {
                $shared_src = '';
            }
        } else {
            $shared_src = '';
        }
        if ( isset( $story->attachments->data['0']->media->image->src ) ) {
            $shared_src = $story->attachments->data['0']->media->image->src;
        } else {
            $shared_src = '';
        }
        ?>
				<?php 
        if ( $shared_src ) {
            $efbl_shared_img_col = 6;
            ?>

				<div class="efbl-thumbnail-col efbl-col-sm-6">

					<?php 
            if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
                ?>

					<a href="<?php 
                echo esc_url( $story->attachments->data['0']->url );
                ?>"
					   class="efbl_link_image"
					   rel="nofollow"
					   target="<?php 
                esc_attr_e( $link_target );
                ?>"><img
								alt="<?php 
                esc_attr_e( $story_name );
                ?>"
								src="<?php 
                echo esc_url( $story->full_picture );
                ?>"/>

						<?php 
            }
            ?>

				</div>
			<?php 
        }
        ?>

				<div class="efbl-feed-content efbl-col-sm-<?php 
        esc_attr_e( $efbl_shared_img_col );
        ?> ">

					<?php 
        if ( $efbl_skin_values['design']['feed_header'] ) {
            ?>

						<div class="efbl-d-flex">

							<?php 
            if ( $auth_img_src && $efbl_skin_values['design']['feed_header_logo'] ) {
                ?>

								<div class="efbl-profile-image">
									<a href="https://facebook.com/<?php 
                esc_attr_e( $page_id );
                ?>"
									   title="<?php 
                esc_attr_e( $story_name );
                ?>"
									   rel="nofollow"
									   target="<?php 
                esc_attr_e( $link_target );
                ?>">
										<img alt="<?php 
                esc_attr_e( $story_name );
                ?>"
											 src="<?php 
                echo esc_url( $auth_img_src );
                ?>"/></a>
								</div>

							<?php 
            }
            ?>

							<div class="efbl-profile-title">
								<div class="efbl-profile-title-wrap <?php 
            esc_attr_e( $efbl_no_story_name );
            ?>">
									<h2><?php 
            esc_html_e( $story_from_name );
            ?>
										<?php 
            if ( isset( $efbl_bio_data->verification_status ) && $efbl_bio_data->verification_status == 'blue_verified' ) {
                ?>
											<div class="efbl-verified-status">
												<i class="icon icon-esf-check"
												   aria-hidden="true"></i>
											</div>
										<?php 
            }
            ?>
										<span
												class="efbl-profile-story-text"><?php 
            esc_html_e( $story_text );
            ?> </span>
									</h2>
								</div>
								<span><?php 
            esc_html_e( $time );
            ?></span>
							</div>
						</div>

					<?php 
        }
        ?>



					<?php 
        if ( $post_text ) {
            ?>

						<?php 
            if ( $efbl_skin_values['design']['show_feed_caption'] ) {
                ?>

							<p class="description">
								<span class="efbl-description-wrap"><?php 
                echo wp_kses_post( nl2br( $post_text ) );
                ?></span>


								<?php 
                ?>


							</p>

						<?php 
            }
            ?>

					<?php 
        }
        ?>

					<div class="efbl_link_text">

						<p class="efbl_title_link">
							<a href="<?php 
        echo esc_url( $story->attachments->data['0']->url );
        ?>"
							   rel="nofollow"
							   target="<?php 
        esc_attr_e( $link_target );
        ?>">
								<?php 
        esc_html_e( $story->attachments->data['0']->title );
        ?>
							</a>
						</p>

						<?php 
        if ( $efbl_skin_values['design']['show_feed_caption'] && isset( $story->attachments->data['0']->description ) ) {
            ?>

							<p class="efbl_link_description"><?php 
            esc_html_e( $story->attachments->data['0']->description );
            ?></p>

						<?php 
        }
        ?>
					</div>


				</div>

				<?php 
    }
    if ( $feed_type == 'added_photos' || $feed_type == 'added_video' || $filter == 'images' || $filter == 'albums' ) {
        ?>


				<div class="efbl-thumbnail-col efbl-col-sm-6">

					<?php 
        if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
            ?>

						<a href="<?php 
            echo admin_url( 'admin-ajax.php' );
            ?>?action=efbl_generate_popup_html" <?php 
            esc_attr_e( $efbl_free_popup_type );
            ?>
						   data-storylink="<?php 
            echo esc_url( $story_link );
            ?>"
						   data-linktext="<?php 
            echo __( 'Read full story', 'easy-facebook-likebox' );
            ?>"
						   data-caption="<?php 
            echo htmlentities( $post_text );
            ?>"
						   data-itemnumber="<?php 
            esc_attr_e( $pi );
            ?>"
						   class="efbl_feed_popup <?php 
            esc_attr_e( $efbl_free_popup_class );
            ?> efbl-cff-item_number-<?php 
            esc_attr_e( $pi );
            ?>">
							<img src="<?php 
            echo esc_url( $feed_img );
            ?>"
								 class="img-responsive"
								 alt="<?php 
            esc_attr_e( $story_from_name );
            ?>"/>
							<div class="efbl-overlay">


								<?php 
            if ( $efbl_skin_values['design']['show_feed_open_popup_icon'] ) {
                ?>

									<i class="icon icon-esf-plus efbl-plus"
									   aria-hidden="true"></i>

								<?php 
            }
            ?>
								<?php 
            if ( $feed_type == 'added_video' ) {
                ?>
									<i class="icon icon-esf-clone icon-esf-video-camera"
									   aria-hidden="true"></i>
									<?php 
            }
            if ( isset( $story->attachments->data['0']->subattachments->data ) && !empty( $story->attachments->data['0']->subattachments->data ) ) {
                ?>
									<i class="icon icon-esf-clone efbl_multimedia"
									   aria-hidden="true"></i>
								<?php 
            }
            ?>
							</div>
						</a>

					<?php 
        }
        ?>


				</div>

				<div class="efbl-feed-content efbl-col-sm-6 ">

					<?php 
        if ( $efbl_skin_values['design']['feed_header'] ) {
            ?>

						<div class="efbl-d-flex">

							<?php 
            if ( $auth_img_src && $efbl_skin_values['design']['feed_header_logo'] ) {
                ?>

								<div class="efbl-profile-image">
									<a href="https://facebook.com/<?php 
                esc_attr_e( $page_id );
                ?>"
									   title="<?php 
                esc_attr_e( $story_name );
                ?>"
									   rel="nofollow"
									   target="<?php 
                esc_attr_e( $link_target );
                ?>">
										<img alt="<?php 
                esc_attr_e( $story_name );
                ?>"
											 src="<?php 
                echo esc_url( $auth_img_src );
                ?>"/></a>
								</div>

							<?php 
            }
            ?>

							<div class="efbl-profile-title">
								<div class="efbl-profile-title-wrap <?php 
            esc_attr_e( $efbl_no_story_name );
            ?>">
									<h2><?php 
            esc_html_e( $story_from_name );
            ?>
										<?php 
            if ( isset( $efbl_bio_data->verification_status ) && $efbl_bio_data->verification_status == 'blue_verified' ) {
                ?>
											<div class="efbl-verified-status">
												<i class="icon icon-esf-check"
												   aria-hidden="true"></i>
											</div>
										<?php 
            }
            ?>
										<span class="efbl-profile-story-text"><?php 
            esc_html_e( $story_text );
            ?> </span>
									</h2>
								</div>
								<span><?php 
            esc_html_e( $time );
            ?></span>
							</div>
						</div>

					<?php 
        }
        ?>


					<?php 
        if ( $filter == 'videos' ) {
            ?>

						<div class="efbl_videos_data_holder">
							<h6 class="efbl_videos_title">
								<a href="https://www.facebook.com<?php 
            echo esc_url( $story->permalink_url );
            ?>"
								   rel="nofollow"
								   target="<?php 
            esc_attr_e( $link_target );
            ?>">
									<?php 
            esc_html_e( $story_title );
            ?>
								</a>
							</h6>
						</div>

					<?php 
        }
        ?>


					<?php 
        if ( $post_text ) {
            ?>

						<?php 
            if ( $efbl_skin_values['design']['show_feed_caption'] ) {
                ?>
							<p class="description">
								<span class="efbl-description-wrap"><?php 
                echo wp_kses_post( nl2br( $post_text ) );
                ?></span>


								<?php 
                ?>


							</p>

						<?php 
            }
            ?>

					<?php 
        }
        ?>

					<?php 
        if ( $filter == 'albums' ) {
            ?>

						<div class="efbl_albums_data_holder">
							<h6 class="efbl_albums_title">
								<a href="<?php 
            echo esc_url( $story->link );
            ?>"
								   rel="nofollow"
								   target="<?php 
            esc_attr_e( $link_target );
            ?>">
									<?php 
            esc_html_e( $story_name );
            ?>
								</a>
							</h6>
							<div class="efbl-total-album-images">
								<span class="efbl_albums_icon"><i
											class="icon icon-esf-picture-o"
											aria-hidden="true"></i></span>
								<span class="efbl_albums_count"><?php 
            esc_html_e( $story->count );
            ?> </span>
							</div>

						</div>

					<?php 
        }
        ?>

				</div>
				<?php 
    }
    if ( $feed_type == 'created_event' || $filter == 'events' ) {
        // premium codition
        ?>

				<?php 
        if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
            ?>

					<?php 
            if ( $story->attachments->data[0]->media->image->src ) {
                ?>
					<div class="efbl-col-6">

						<img src="<?php 
                echo esc_url( $story->attachments->data[0]->media->image->src );
                ?>"/></a>

					</div>
				<?php 
            }
            ?>

				<div class="efbl-feed-content efbl-col-sm-6 ">

					<?php 
            if ( $efbl_skin_values['design']['feed_header'] ) {
                ?>

						<div class="efbl-d-flex">

							<?php 
                if ( $auth_img_src && $efbl_skin_values['design']['feed_header_logo'] ) {
                    ?>

								<div class="efbl-profile-image">
									<a href="https://facebook.com/<?php 
                    esc_attr_e( $page_id );
                    ?>"
									   rel="nofollow"
									   title="<?php 
                    esc_attr_e( $story_name );
                    ?>"
									   target="<?php 
                    esc_attr_e( $link_target );
                    ?>">
										<img alt="<?php 
                    esc_attr_e( $story_name );
                    ?>"
											 src="<?php 
                    echo esc_url( $auth_img_src );
                    ?>"/></a>
								</div>

							<?php 
                }
                ?>

							<div class="efbl-profile-title">
								<div class="efbl-profile-title-wrap <?php 
                esc_attr_e( $efbl_no_story_name );
                ?>">
									<h2><?php 
                esc_html_e( $story_from_name );
                ?>
										<?php 
                if ( isset( $efbl_bio_data->verification_status ) && $efbl_bio_data->verification_status == 'blue_verified' ) {
                    ?>
											<div class="efbl-verified-status">
												<i class="icon icon-esf-check"
												   aria-hidden="true"></i>
											</div>
										<?php 
                }
                ?>
										<span class="efbl-profile-story-text"><?php 
                esc_html_e( $story_text );
                ?> </span>
									</h2>
								</div>
								<span><?php 
                esc_html_e( $time );
                ?></span>
							</div>
						</div>

					<?php 
            }
            ?>

					<?php 
            if ( $efbl_skin_values['design']['show_feed_caption'] ) {
                ?>

						<p class="efbl_link_description">
							<span class="efbl-description-wrap"><?php 
                echo wp_kses_post( nl2br( $post_text ) );
                ?></span>


							<?php 
                ?>


						</p>

					<?php 
            }
            ?>
				</div>

			<?php 
        }
        ?>


				<?php 
    }
    // events condition
    ?>
		</div>

		<?php 
    if ( $esf_feed_meta_url = locate_template( array('easy-facebook-likebox/html-feed-meta.php') ) ) {
        $esf_feed_meta_url = $esf_feed_meta_url;
    } else {
        $esf_feed_meta_url = EFBL_PLUGIN_DIR . 'frontend/views/html-feed-meta.php';
    }
    include $esf_feed_meta_url;
    ?>

	</div>

</div>

<?php 
}