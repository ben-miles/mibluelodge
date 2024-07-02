<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//======================================================================
// Code for the frontend funcionality of Instagram Module
//======================================================================
if ( !class_exists( 'ESF_Instagram_Frontend' ) ) {
    class ESF_Instagram_Frontend {
        public $instagram_url = 'https://www.instagram.com';

        function __construct() {
            add_action( 'wp_enqueue_scripts', array($this, 'esf_insta_style') );
            add_shortcode( 'my-instagram-feed', array($this, 'esf_insta_shortcode') );
            add_action( 'wp_ajax_esf-insta-customizer-style', array($this, 'esf_insta_load_customizer_css') );
            add_action( 'wp_ajax_nopriv_esf-insta-customizer-style', array($this, 'esf_insta_load_customizer_css') );
        }

        /*
         * esf_insta_style will enqueue style and js files.
         */
        public function esf_insta_style() {
            wp_enqueue_style( 'esf-custom-fonts', FTA_PLUGIN_URL . 'frontend/assets/css/esf-custom-fonts.css', array() );
            wp_enqueue_script( 'imagesloaded.pkgd.min', FTA_PLUGIN_URL . 'frontend/assets/js/imagesloaded.pkgd.min.js' );
            wp_enqueue_style( 'esf-insta-frontend', ESF_INSTA_PLUGIN_URL . 'frontend/assets/css/esf-insta-frontend.css' );
            wp_enqueue_style( 'esf-insta-customizer-style', admin_url( 'admin-ajax.php' ) . '?action=esf-insta-customizer-style', 'esf-insta-frontend' );
            $mif_ver = 'free';
            if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                $mif_ver = 'pro';
            }
            /*
             * Custom scripts file for frontend.
             */
            wp_enqueue_script(
                'esf-insta-public',
                ESF_INSTA_PLUGIN_URL . 'frontend/assets/js/esf-insta-public.js',
                array('jquery'),
                true
            );
            /*
             * Localizing file for getting the admin ajax url in js file.
             */
            wp_localize_script( 'esf-insta-public', 'esf_insta', array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'version'  => $mif_ver,
                'nonce'    => wp_create_nonce( 'esf-insta-public-ajax-nonce' ),
            ) );
        }

        /*
         * Include customizer style file
         */
        public function esf_insta_load_customizer_css() {
            header( 'Content-type: text/css; charset: UTF-8' );
            require ESF_INSTA_PLUGIN_DIR . 'frontend/assets/css/esf-insta-customizer-style.css.php';
            exit;
        }

        /*
         * esf_insta_shortcode is the callback func of add_shortcode.
         * Will add the shortcode in wp.
         */
        public function esf_insta_shortcode( $atts ) {
            $mif_skin_default_id = '';
            $Feed_Them_All = new Feed_Them_All();
            /*
             *  Getting the FTA Plugin settings.
             */
            $fta_settings = $Feed_Them_All->fta_get_settings();
            if ( isset( $fta_settings['plugins']['instagram']['default_skin_id'] ) ) {
                $mif_skin_default_id = $fta_settings['plugins']['instagram']['default_skin_id'];
            }
            $atts = shortcode_atts( array(
                'wrapper_class'   => null,
                'user_id'         => null,
                'hashtag'         => null,
                'skin_id'         => $mif_skin_default_id,
                'feeds_per_page'  => 9,
                'profile_picture' => null,
                'caption_words'   => 25,
                'links_new_tab'   => 1,
                'load_more'       => 1,
                'cache_unit'      => 1,
                'show_stories'    => 1,
                'cache_duration'  => 'days',
                'is_moderate'     => false,
                'is_shoppable'    => false,
            ), $atts, 'my-instagram-feed' );
            if ( isset( $atts ) ) {
                extract( $atts );
            }
            ob_start();
            include 'views/feed.php';
            $returner = ob_get_contents();
            ob_end_clean();
            return $returner;
        }

        /*
         * It will get the remote URL, Retreive it and return decoded data.
         */
        public function esf_insta_get_data( $url ) {
            /*
             * Getting the data from remote URL.
             */
            $json_data = wp_remote_retrieve_body( wp_remote_get( $url ) );
            /*
             * Decoding the data.
             */
            $decoded_data = json_decode( $json_data );
            /*
             * Returning it to back.
             */
            return $decoded_data;
        }

        /*
         * It will get current item number and feeds per page, Return the data accordingly.
         */
        public function esf_insta_get_feeds(
            $feeds_per_page = null,
            $current_item = null,
            $cache_seconds = null,
            $user_id = null,
            $hashtag = null,
            $test_mode = false,
            $duration = null
        ) {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $mif_instagram_type = esf_insta_instagram_type();
            $approved_pages = array();
            $decoded_data_pag = null;
            $test_mode = apply_filters( 'esf_insta_disable_cache', $test_mode );
            if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !empty( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {
                $approved_pages = $fta_settings['plugins']['facebook']['approved_pages'];
            }
            if ( $approved_pages ) {
                foreach ( $approved_pages as $key => $approved_page ) {
                    if ( isset( $approved_page['instagram_connected_account']->id ) ) {
                        if ( $approved_page['instagram_connected_account']->id == $user_id ) {
                            $access_token = $approved_page['access_token'];
                        }
                    }
                }
            }
            $self_decoded_data = $this->esf_insta_get_bio( $user_id );
            $mif_user_slug = "esf_insta_user_posts-{$user_id}-{$feeds_per_page}-{$mif_instagram_type}-{$duration}";
            $decoded_data = get_transient( $mif_user_slug );
            if ( $decoded_data ) {
                $decoded_data = json_decode( $decoded_data );
            }
            $mif_all_feeds = null;
            if ( isset( $self_decoded_data->media_count ) && !empty( $self_decoded_data->media_count ) ) {
                $mif_all_feeds = $self_decoded_data->media_count;
            }
            if ( !$decoded_data || '' == $decoded_data ) {
                $mif_personal_connected_accounts = $fta_settings['plugins']['instagram']['instagram_connected_account'];
                if ( esf_insta_instagram_type() == 'personal' && isset( $mif_personal_connected_accounts ) && !empty( $mif_personal_connected_accounts ) && is_array( $mif_personal_connected_accounts ) ) {
                    $access_token = $mif_personal_connected_accounts[$user_id]['access_token'];
                    $remote_url = "https://graph.instagram.com/{$user_id}/media?fields=media_url,thumbnail_url,caption,id,media_type,timestamp,username,permalink,children{media_url,id,media_type,timestamp,permalink,thumbnail_url}&limit={$feeds_per_page}&access_token=" . $access_token;
                } else {
                    $remote_url = "https://graph.facebook.com/v4.0/{$user_id}/media?fields=thumbnail_url,children{permalink,thumbnail_url,media_url,media_type},media_type,caption,comments_count,id,ig_id,like_count,is_comment_enabled,media_url,owner,permalink,shortcode,timestamp,username,comments{id,hidden,like_count,media,text,timestamp,user,username,replies{hidden,id,like_count,media,text,timestamp,user,username}}&limit=" . $feeds_per_page . '&access_token=' . $access_token;
                }
                $decoded_data = $this->esf_insta_get_data( $remote_url );
                if ( !isset( $decoded_data->error ) && !empty( $decoded_data->data ) ) {
                    $decoded_data = (object) array(
                        'pagination' => $decoded_data->paging->next,
                        'data'       => $decoded_data->data,
                    );
                    if ( !$test_mode ) {
                        set_transient( $mif_user_slug, wp_json_encode( $decoded_data ), $cache_seconds );
                    }
                }
            }
            if ( !empty( $current_item ) or !empty( $feeds_per_page ) ) {
                if ( isset( $decoded_data->pagination ) && !empty( $decoded_data->pagination ) ) {
                    $decoded_data_pag = $decoded_data->pagination;
                }
                if ( isset( $decoded_data->data ) && !empty( $decoded_data->data ) ) {
                    $decoded_data = array_slice( $decoded_data->data, $current_item, $feeds_per_page );
                }
                $decoded_data = (object) array(
                    'pagination' => $decoded_data_pag,
                    'data'       => $decoded_data,
                );
            }
            return $decoded_data;
        }

        /*
         *  Return the bio of Instagram user.
         */
        public function esf_insta_get_bio( $user_id = null ) {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $approved_pages = array();
            $mif_instagram_type = esf_insta_instagram_type();
            if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !empty( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {
                $approved_pages = $fta_settings['plugins']['facebook']['approved_pages'];
            }
            if ( $approved_pages ) {
                foreach ( $approved_pages as $key => $approved_page ) {
                    if ( isset( $approved_page['instagram_connected_account']->id ) ) {
                        if ( $approved_page['instagram_connected_account']->id == $user_id ) {
                            $access_token = $approved_page['access_token'];
                        }
                    }
                }
            }
            $mif_bio_slug = "esf_insta_user_bio_{$mif_instagram_type}-{$user_id}";
            $self_decoded_data = get_transient( $mif_bio_slug );
            $self_decoded_data = json_decode( $self_decoded_data );
            if ( !$self_decoded_data || '' == $self_decoded_data ) {
                $mif_personal_connected_accounts = $fta_settings['plugins']['instagram']['instagram_connected_account'];
                if ( esf_insta_instagram_type() == 'personal' && isset( $mif_personal_connected_accounts ) && !empty( $mif_personal_connected_accounts ) && is_array( $mif_personal_connected_accounts ) ) {
                    $access_token = $mif_personal_connected_accounts[$user_id]['access_token'];
                    $mif_bio_url = 'https://graph.instagram.com/me?fields=id,username,media_count,account_type&access_token=' . $access_token;
                } else {
                    $mif_bio_url = "https://graph.facebook.com/v4.0/{$user_id}/?fields=biography,followers_count,follows_count,id,ig_id,media_count,name,profile_picture_url,username,website&access_token=" . $access_token;
                }
                /*
                 * Getting the decoded data of authenticated user from instagram.
                 */
                $self_decoded_data = $this->esf_insta_get_data( $mif_bio_url );
                if ( 400 !== $self_decoded_data->meta->code && !isset( $self_decoded_data->error ) ) {
                }
                if ( 400 !== $self_decoded_data->meta->code && !isset( $self_decoded_data->error ) ) {
                    set_transient( $mif_bio_slug, wp_json_encode( $self_decoded_data ), $cache_seconds );
                }
            }
            return $self_decoded_data;
        }

    }

    $ESF_Instagram_Frontend = new ESF_Instagram_Frontend();
}