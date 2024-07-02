<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//======================================================================
// Management of Facebook Skins
//======================================================================
if ( !class_exists( 'EFBL_SKINS' ) ) {
    class EFBL_SKINS {
        function __construct() {
            add_action( 'init', array($this, 'efbl_skins_register'), 20 );
            //on plugin activation
            $this->efbl_default_skins();
            add_action( 'init', array($this, 'efbl_skins'), 30 );
        }

        /*
         * Register skins post type
         */
        public function efbl_skins_register() {
            $args = array(
                'public'              => false,
                'label'               => __( 'Facebook Skins', 'easy-facebook-likebox' ),
                'show_in_menu'        => false,
                'exclude_from_search' => true,
                'has_archive'         => false,
                'hierarchical'        => true,
                'menu_position'       => null,
            );
            register_post_type( 'efbl_skins', $args );
        }

        /*
         * Add default skins on install
         */
        public function efbl_default_skins() {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            if ( !isset( $fta_settings['plugins']['facebook']['default_skin_id'] ) && empty( $fta_settings['plugins']['facebook']['default_skin_id'] ) ) {
                $efbl_new_skins = array(
                    'post_title'   => __( 'Skin - Half Width', 'easy-facebook-likebox' ),
                    'post_content' => __( 'This is the half width demo skin created by plugin automatically with default values. You can edit it and change the look & feel of your Facebook Feeds.', 'easy-facebook-likebox' ),
                    'post_type'    => 'efbl_skins',
                    'post_status'  => 'publish',
                    'post_author'  => get_current_user_id(),
                );
                $efbl_new_skins = apply_filters( 'efbl_default_skin', $efbl_new_skins );
                $skin_id = wp_insert_post( $efbl_new_skins );
                $efbl_new_skin_full = array(
                    'post_title'   => __( 'Skin - Full Width', 'easy-facebook-likebox' ),
                    'post_content' => __( 'This is the Full width demo skin created by plugin automatically with default values. You can edit it and change the look & feel of your Facebook Feeds.', 'easy-facebook-likebox' ),
                    'post_type'    => 'efbl_skins',
                    'post_status'  => 'publish',
                    'post_author'  => get_current_user_id(),
                );
                $efbl_new_skin_full_id = wp_insert_post( $efbl_new_skin_full );
                $efbl_new_skin_thumbnail = array(
                    'post_title'   => __( 'Skin - Thumbnail', 'easy-facebook-likebox' ),
                    'post_content' => __( 'This is the Thumbnail demo skin created by plugin automatically with default values. You can edit it and change the look & feel of your Facebook Feeds.', 'easy-facebook-likebox' ),
                    'post_type'    => 'efbl_skins',
                    'post_status'  => 'publish',
                    'post_author'  => get_current_user_id(),
                );
                $efbl_new_skin_thumbnail_id = wp_insert_post( $efbl_new_skin_thumbnail );
                if ( isset( $skin_id ) ) {
                    update_post_meta( $skin_id, 'layout', 'half' );
                }
                if ( isset( $efbl_new_skin_thumbnail_id ) ) {
                    update_post_meta( $efbl_new_skin_thumbnail_id, 'layout', 'thumbnail' );
                }
                if ( isset( $efbl_new_skin_full_id ) ) {
                    update_post_meta( $efbl_new_skin_full_id, 'layout', 'full' );
                }
                $fta_settings['plugins']['facebook']['default_skin_id'] = $skin_id;
                update_option( 'fta_settings', $fta_settings );
            }
            if ( !isset( $fta_settings['plugins']['facebook']['row_default_skin_id'] ) && empty( $fta_settings['plugins']['facebook']['row_default_skin_id'] ) ) {
                $efbl_new_skin_row = array(
                    'post_title'   => __( 'Skin - Row', 'easy-facebook-likebox' ),
                    'post_content' => __( 'This is the Row demo skin created by the plugin automatically with default values. You can edit it and change the look & feel of your Facebook Feeds.', 'easy-facebook-likebox' ),
                    'post_type'    => 'efbl_skins',
                    'post_status'  => 'publish',
                    'post_author'  => get_current_user_id(),
                );
                // Insert the new post
                $efbl_new_skin_row_id = wp_insert_post( $efbl_new_skin_row );
                if ( isset( $efbl_new_skin_row_id ) ) {
                    update_post_meta( $efbl_new_skin_row_id, 'layout', 'row' );
                    if ( isset( $efbl_new_skin_row_id ) && !is_wp_error( $efbl_new_skin_row_id ) ) {
                        $fta_settings['plugins']['facebook']['row_default_skin_id'] = $efbl_new_skin_row_id;
                        update_option( 'fta_settings', $fta_settings );
                    }
                }
            }
            if ( !isset( $fta_settings['plugins']['facebook']['default_page_id'] ) && empty( $fta_settings['plugins']['facebook']['default_page_id'] ) ) {
                $skin_id = $fta_settings['plugins']['facebook']['default_skin_id'];
                $efbl_default_page = array(
                    'post_title'   => __( 'Facebook Demo - Customizer', 'easy-facebook-likebox' ),
                    'post_content' => __( '[efb_feed fanpage_id="106704037405386" words_limit="25" show_like_box="1" post_limit="10" cache_unit="5" cache_duration="days" skin_id=' . $skin_id . ' ]<br> This is a Facebook demo page created by plugin automatically. Please do not delete to make the plugin work properly.', 'easy-facebook-likebox' ),
                    'post_type'    => 'page',
                    'post_status'  => 'private',
                );
                $efbl_default_page = apply_filters( 'efbl_default_page', $efbl_default_page );
                $page_id = wp_insert_post( $efbl_default_page );
                $fta_settings['plugins']['facebook']['default_page_id'] = $page_id;
                update_option( 'fta_settings', $fta_settings );
            }
        }

        /*
         * Create skin object which will have all skin data
         */
        public function efbl_skins() {
            $efbl_skins = array(
                'posts_per_page' => 10,
                'post_type'      => 'efbl_skins',
                'post_status'    => array('publish', 'draft', 'pending'),
                'order'          => 'ASC',
            );
            $efbl_skins = get_posts( $efbl_skins );
            if ( isset( $efbl_skins ) && !empty( $efbl_skins ) ) {
                $efbl_skins_holder = array();
                foreach ( $efbl_skins as $skin ) {
                    $id = $skin->ID;
                    $design_arr = array();
                    $design_arr = get_option( 'efbl_skin_' . $id, false );
                    $layout = get_post_meta( $id, 'layout', true );
                    if ( !$layout ) {
                        $layout = $design_arr['layout_option'];
                        if ( isset( $design_arr['feed_background_color'] ) && $design_arr['feed_background_color'] == 'transparent' ) {
                            $design_arr['feed_background_color'] = '#fff';
                        }
                        if ( isset( $design_arr['feed_meta_data_color'] ) && $design_arr['feed_meta_data_color'] == '#fff' ) {
                            $design_arr['feed_meta_data_color'] = '#343a40';
                        }
                    }
                    $title = $skin->post_title;
                    if ( empty( $title ) ) {
                        $title = __( 'Skin', 'easy-facebook-likebox' );
                    }
                    $efbl_skins_holder[$id] = array(
                        'ID'          => $id,
                        'title'       => $title,
                        'description' => $skin->post_content,
                        'layout'      => $layout,
                    );
                    $efbl_skins_holder[$id]['design'] = wp_parse_args( $design_arr, $this->efbl_default_skin_settings() );
                }
            } else {
                return __( 'No skin found.', 'easy-facebook-likebox' );
            }
            $GLOBALS['efbl_skins'] = $efbl_skins_holder;
        }

        public function efbl_default_skin_settings() {
            return array(
                'number_of_cols'               => 3,
                'show_load_more_btn'           => true,
                'show_header'                  => false,
                'show_dp'                      => true,
                'show_next_prev_icon'          => true,
                'show_nav'                     => true,
                'loop'                         => true,
                'autoplay'                     => true,
                'show_page_category'           => true,
                'show_no_of_followers'         => true,
                'show_bio'                     => true,
                'feed_header'                  => true,
                'header_shadow_color'          => 'rgba(0,0,0,0.15)',
                'feed_shadow_color'            => 'rgba(0,0,0,0.15)',
                'show_comments'                => true,
                'feed_header_logo'             => true,
                'show_likes'                   => true,
                'show_shares'                  => true,
                'show_feed_caption'            => true,
                'show_feed_open_popup_icon'    => true,
                'show_feed_view_on_facebook'   => true,
                'show_feed_share_button'       => true,
                'popup_show_header'            => true,
                'feed_media_before_caption'    => false,
                'popup_show_header_logo'       => true,
                'popup_show_caption'           => true,
                'popup_show_meta'              => true,
                'popup_show_reactions_counter' => true,
                'popup_show_comments_counter'  => true,
                'popup_show_view_fb_link'      => true,
                'popup_show_comments'          => true,
            );
        }

    }

    $GLOBALS['EFBL_SKINS'] = new EFBL_SKINS();
}