<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//======================================================================
// Instagram Skins
//======================================================================
if ( !class_exists( 'ESF_Insta_Skins' ) ) {
    class ESF_Insta_Skins {
        function __construct() {
            add_action( 'init', array($this, 'mif_skins_register'), 20 );
            $this->mif_skins();
            $this->mif_default_skins();
        }

        /*
         * Register skins posttype.
         */
        public function mif_skins_register() {
            $args = array(
                'public'              => false,
                'label'               => __( 'MIF Skins', 'easy-facebook-likebox' ),
                'show_in_menu'        => false,
                'exclude_from_search' => true,
                'has_archive'         => false,
                'hierarchical'        => true,
                'menu_position'       => null,
            );
            register_post_type( 'mif_skins', $args );
        }

        /*
         * Register Default skins.
         */
        public function mif_default_skins() {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $pro_default_skins_added = '';
            $pro_default_skin_added = '';
            if ( !isset( $fta_settings['plugins']['instagram']['default_skin_id'] ) && empty( $fta_settings['plugins']['instagram']['default_skin_id'] ) ) {
                $mif_new_skins = array(
                    'post_title'   => __( 'Skin - Grid', 'easy-facebook-likebox' ),
                    'post_content' => __( 'This is the demo skin created by Easy Social Feed plugin automatically with default values. You can edit it and change the look & feel of your Feeds.', 'easy-facebook-likebox' ),
                    'post_type'    => 'mif_skins',
                    'post_status'  => 'publish',
                    'post_author'  => get_current_user_id(),
                );
                $mif_new_skins = apply_filters( 'mif_default_skin', $mif_new_skins );
                $skin_id = wp_insert_post( $mif_new_skins );
                if ( isset( $skin_id ) ) {
                    update_post_meta( $skin_id, 'layout', 'grid' );
                }
                $fta_settings['plugins']['instagram']['default_skin_id'] = $skin_id;
                update_option( 'fta_settings', $fta_settings );
            }
            if ( !isset( $fta_settings['plugins']['instagram']['row_default_skin_id'] ) && empty( $fta_settings['plugins']['instagram']['row_default_skin_id'] ) ) {
                $efbl_new_skin_row = array(
                    'post_title'   => __( 'Skin - Row', 'easy-facebook-likebox' ),
                    'post_content' => __( 'This is the Row demo skin created by the plugin automatically with default values. You can edit it and change the look & feel of your Feeds.', 'easy-facebook-likebox' ),
                    'post_type'    => 'mif_skins',
                    'post_status'  => 'publish',
                    'post_author'  => get_current_user_id(),
                );
                // Insert the new post
                $efbl_new_skin_row_id = wp_insert_post( $efbl_new_skin_row );
                if ( isset( $efbl_new_skin_row_id ) ) {
                    update_post_meta( $efbl_new_skin_row_id, 'layout', 'row' );
                    if ( isset( $efbl_new_skin_row_id ) && !is_wp_error( $efbl_new_skin_row_id ) ) {
                        $fta_settings['plugins']['instagram']['row_default_skin_id'] = $efbl_new_skin_row_id;
                        update_option( 'fta_settings', $fta_settings );
                    }
                }
            }
            if ( !isset( $fta_settings['plugins']['instagram']['default_page_id'] ) && empty( $fta_settings['plugins']['instagram']['default_page_id'] ) ) {
                $skin_id = $fta_settings['plugins']['instagram']['default_skin_id'];
                $user_id = null;
                $user_id = esf_insta_default_id();
                $mif_default_page = array(
                    'post_title'   => __( 'Instagram Demo - Customizer', 'easy-facebook-likebox' ),
                    'post_content' => __( "[my-instagram-feed user_id='{$user_id}' skin_id='{$skin_id}'] <br> This is a mif demo page created by plugin automatically. Please don't delete to make the plugin work properly.", 'easy-facebook-likebox' ),
                    'post_type'    => 'page',
                    'post_status'  => 'private',
                );
                $mif_default_page = apply_filters( 'mif_default_page', $mif_default_page );
                $page_id = wp_insert_post( $mif_default_page );
                $fta_settings['plugins']['instagram']['default_page_id'] = $page_id;
                update_option( 'fta_settings', $fta_settings );
            }
        }

        /*
         * Create skin object which will have all skin data
         */
        public function mif_skins() {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $fta_skins = array(
                'posts_per_page' => 1000,
                'post_type'      => 'mif_skins',
                'post_status'    => array('publish', 'draft', 'pending'),
                'order'          => 'ASC',
            );
            $fta_skins = get_posts( $fta_skins );
            /* If any fta_skins are in database. */
            if ( isset( $fta_skins ) && !empty( $fta_skins ) ) {
                $fta_skins_holder = array();
                foreach ( $fta_skins as $skin ) {
                    $id = $skin->ID;
                    $design_arr = array();
                    $design_arr = get_option( 'mif_skin_' . $id, false );
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
                    $fta_skins_holder[$id] = array(
                        'ID'          => $id,
                        'title'       => $title,
                        'description' => $skin->post_content,
                        'layout'      => $layout,
                    );
                    $fta_skins_holder[$id]['design'] = wp_parse_args( $design_arr, $this->esf_insta_default_skin_settings() );
                }
            } else {
                return __( 'No skins found.', 'easy-facebook-likebox' );
            }
            $GLOBALS['mif_skins'] = $fta_skins_holder;
        }

        public function esf_insta_default_skin_settings() {
            return array(
                'show_load_more_btn'           => true,
                'number_of_cols'               => 3,
                'show_header'                  => false,
                'header_round_dp'              => true,
                'show_dp'                      => true,
                'show_no_of_followers'         => true,
                'show_next_prev_icon'          => true,
                'show_nav'                     => true,
                'loop'                         => true,
                'autoplay'                     => true,
                'show_bio'                     => true,
                'feed_header'                  => true,
                'show_comments'                => true,
                'feed_header_logo'             => true,
                'header_shadow_color'          => 'rgba(0,0,0,0.15)',
                'feed_shadow_color'            => 'rgba(0,0,0,0.15)',
                'show_likes'                   => true,
                'show_feed_caption'            => true,
                'show_feed_open_popup_icon'    => true,
                'show_feed_view_on_instagram'  => true,
                'show_feed_share_button'       => true,
                'popup_show_header'            => true,
                'popup_show_header_logo'       => true,
                'popup_show_caption'           => true,
                'popup_show_meta'              => true,
                'popup_show_reactions_counter' => true,
                'popup_show_comments_counter'  => true,
                'popup_show_view_insta_link'   => true,
                'popup_show_comments'          => true,
            );
        }

    }

    $GLOBALS['ESF_Insta_Skins'] = new ESF_Insta_Skins();
}