<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//======================================================================
// Admin of Facebook Module
//======================================================================
if ( !class_exists( 'Easy_Facebook_Likebox_Admin' ) ) {
    class Easy_Facebook_Likebox_Admin {
        var $plugin_slug = 'easy-facebook-likebox';

        var $admin_page_id = 'easy-social-feed_page_easy-facebook-likebox';

        function __construct() {
            add_action( 'admin_menu', array($this, 'efbl_menu') );
            add_action( 'admin_enqueue_scripts', array($this, 'efbl_admin_style') );
            add_action( 'wp_ajax_efbl_create_skin_url', array($this, 'efbl_create_skin_url') );
            add_action( 'wp_ajax_efbl_get_albums_list', array($this, 'efbl_get_albums_list') );
            add_action( 'wp_ajax_efbl_del_trans', array($this, 'efbl_delete_transient') );
            add_action( 'wp_ajax_efbl_clear_all_cache', array($this, 'clear_all_cache') );
            add_action( 'wp_ajax_efbl_save_fb_access_token', array($this, 'efbl_save_facebook_access_token') );
            add_action( 'wp_ajax_efbl_get_moderate_feed', array($this, 'efbl_get_moderate_feed') );
            add_action( 'wp_ajax_efbl_preload_feed', array($this, 'preload_feed') );
        }

        /*
         * efbl_admin_style will enqueue style and js files.
         * Returns hook name of the current page in admin.
         * $hook will contain the hook name.
         */
        public function efbl_admin_style( $hook ) {
            if ( $this->admin_page_id !== $hook ) {
                return;
            }
            wp_enqueue_style( $this->plugin_slug . '-admin-styles', EFBL_PLUGIN_URL . 'admin/assets/css/admin.css', array() );
            wp_enqueue_script( $this->plugin_slug . '-admin-script', EFBL_PLUGIN_URL . 'admin/assets/js/admin.js', array('jquery', 'esf-admin') );
            wp_enqueue_style( 'easy-facebook-likebox-frontend', EFBL_PLUGIN_URL . 'frontend/assets/css/easy-facebook-likebox-frontend.css', array() );
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $default_skin_id = $fta_settings['plugins']['facebook']['default_skin_id'];
            $efbl_ver = 'free';
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                $efbl_ver = 'pro';
            }
            wp_localize_script( $this->plugin_slug . '-admin-script', 'efbl', array(
                'ajax_url'        => admin_url( 'admin-ajax.php' ),
                'nonce'           => wp_create_nonce( 'esf-ajax-nonce' ),
                'version'         => $efbl_ver,
                'copied'          => __( 'Copied', 'easy-facebook-likebox' ),
                'error'           => __( 'Something went wrong!', 'easy-facebook-likebox' ),
                'saving'          => __( 'Saving', 'easy-facebook-likebox' ),
                'deleting'        => __( 'Deleting', 'easy-facebook-likebox' ),
                'generating'      => __( 'Generating Shortcode', 'easy-facebook-likebox' ),
                'default_skin_id' => $default_skin_id,
                'moderate_wait'   => __( 'Please wait, we are generating preview for you', 'easy-facebook-likebox' ),
            ) );
            wp_enqueue_script( 'media-upload' );
            wp_enqueue_media();
        }

        /*
         * Adds Facebook sub-menu in dashboard
         */
        public function efbl_menu() {
            add_submenu_page(
                'feed-them-all',
                __( 'Facebook', 'easy-facebook-likebox' ),
                __( 'Facebook', 'easy-facebook-likebox' ),
                'manage_options',
                'easy-facebook-likebox',
                array($this, 'efbl_page'),
                1
            );
        }

        /*
         * efbl_page contains the html/markup of the Facebook page.
         * Returns nothing.
         */
        public function efbl_page() {
            /**
             * Facebook page view.
             */
            include_once EFBL_PLUGIN_DIR . 'admin/views/html-admin-page-easy-facebook-likebox.php';
        }

        /*
         * get saved option values
         */
        private function options( $option = null ) {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $fta_settings = wp_parse_args( $fta_settings['plugins']['facebook'], $this->efbl_default_options() );
            return $fta_settings[$option];
        }

        /**
         * Provides default values for the Social Options.
         */
        function efbl_default_options() {
            $defaults = array(
                'efbl_enable_popup'          => null,
                'efbl_popup_interval'        => null,
                'efbl_popup_width'           => null,
                'efbl_popup_height'          => null,
                'efbl_popup_shortcode'       => '',
                'efbl_enable_home_only'      => null,
                'efbl_enable_if_login'       => null,
                'efbl_enable_if_not_login'   => null,
                'efbl_do_not_show_again'     => null,
                'efbl_do_not_show_on_mobile' => null,
            );
            return apply_filters( 'efbl_default_options', $defaults );
        }

        /*
         * Deletes Facebook cached data on AJax
         */
        function efbl_delete_transient() {
            esf_check_ajax_referer();
            $value = sanitize_text_field( $_POST['efbl_option'] );
            $replaced_value = str_replace( '_transient_', '', $value );
            $page_id = explode( '-', $value );
            if ( isset( $page_id['1'] ) && !empty( $page_id['1'] ) ) {
                $page_id = $page_id['1'];
                //                      if ( is_numeric( $page_id ) ) {
                //                          $page_id = efbl_get_page_id( $page_id );
                //                          esf_delete_media( $page_id );
                //                      }
                $page_logo_trasneint_name = 'esf_logo_' . $page_id;
                delete_transient( $page_logo_trasneint_name );
            }
            $efbl_deleted_trans = delete_transient( $replaced_value );
            if ( isset( $efbl_deleted_trans ) ) {
                wp_send_json_success( array(__( 'Deleted', 'easy-facebook-likebox' ), $value) );
            } else {
                wp_send_json_error( __( 'Something went wrong! Refresh the page and try again', 'easy-facebook-likebox' ) );
            }
        }

        /*
         * Get the attachment ID from the file URL
         */
        function efbl_get_image_id( $image_url ) {
            global $wpdb;
            $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", $image_url ) );
            return $attachment[0];
        }

        /**
         * Delete all cached data
         *
         * @since 6.3.2
         */
        function clear_all_cache() {
            esf_check_ajax_referer();
            $cache = $this->get_cache( 'all' );
            if ( $cache ) {
                foreach ( $cache as $id => $single ) {
                    $transient_name = str_replace( '_transient_', '', $id );
                    $page_id = explode( '-', $transient_name );
                    if ( isset( $page_id['1'] ) && !empty( $page_id['1'] ) ) {
                        $page_id = $page_id['1'];
                        //                              if( is_numeric( $page_id ) ) {
                        //                                  $page_id = efbl_get_page_id( $page_id );
                        //                                  esf_delete_media( $page_id );
                        //                              }
                        $page_logo_trasneint_name = 'esf_logo_' . $page_id;
                        delete_transient( $page_logo_trasneint_name );
                    }
                    $efbl_deleted_trans = delete_transient( $transient_name );
                }
            }
            if ( isset( $efbl_deleted_trans ) ) {
                wp_send_json_success( __( 'Deleted', 'easy-facebook-likebox' ) );
            } else {
                wp_send_json_error( __( 'Something went wrong! Refresh the page and try again', 'easy-facebook-likebox' ) );
            }
        }

        /**
         *  Get albums list on Ajax
         *
         * @since 6.2.2
         */
        function efbl_get_albums_list() {
            esf_check_ajax_referer();
            $FTA = new Feed_Them_All();
            $page_id = sanitize_text_field( $_POST['page_id'] );
            $albums_list = efbl_get_albums_list( $page_id );
            if ( isset( $_POST['is_block'] ) && isset( $albums_list ) && !empty( $albums_list ) ) {
                wp_send_json_success( $albums_list );
            }
            $html = '<option value="">' . __( 'None', 'easy-facebook-likebox' ) . '</option>';
            if ( isset( $albums_list ) ) {
                foreach ( $albums_list as $list ) {
                    if ( isset( $list->picture->data->url ) && !empty( isset( $list->picture->data->url ) ) ) {
                        $pic_url = $list->picture->data->url;
                    } else {
                        $pic_url = '';
                    }
                    $html .= '<option data-icon="' . $pic_url . '" value="' . $list->id . '">' . $list->name . '</option>';
                }
            } else {
                $html = '';
            }
            if ( isset( $html ) ) {
                wp_send_json_success( $html );
            } else {
                wp_send_json_error( __( 'Something Went Wrong! Please try again.', 'easy-facebook-likebox' ) );
            }
        }

        /*
         * Get the access token and save back into DB
         */
        public function efbl_save_facebook_access_token() {
            esf_check_ajax_referer();
            $access_token = sanitize_text_field( $_POST['access_token'] );
            $approved_pages = array();
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $fta_api_url = 'https://graph.facebook.com/v16.0/me/accounts?fields=access_token,username,id,name,fan_count,category,about&access_token=' . $access_token;
            $args = array(
                'timeout'   => 150,
                'sslverify' => false,
            );
            $fta_pages = wp_remote_get( $fta_api_url, $args );
            // get the status code
            $response_code = wp_remote_retrieve_response_code( $fta_pages );
            // if the response code is not 200 then return error
            if ( $response_code != 200 ) {
                wp_send_json_error( __( 'Something went wrong! Please try again', 'easy-facebook-likebox' ) );
            }
            if ( is_array( $fta_pages ) && !is_wp_error( $fta_pages ) ) {
                $fb_pages = json_decode( $fta_pages['body'] );
                if ( $fb_pages->data ) {
                    $title = __( 'Approved Pages', 'easy-facebook-likebox' );
                    $efbl_all_pages_html = '<ul class="collection with-header"> <li class="collection-header"><h5>' . $title . '</h5> 
		        <a href="#fta-remove-at" class="esf-modal-trigger fta-remove-at-btn tooltipped" data-position="left" data-delay="50" data-tooltip="' . __( 'Delete Access Token', 'easy-facebook-likebox' ) . '"><span class="dashicons dashicons-trash"></span></a></li>';
                    foreach ( $fb_pages->data as $efbl_page ) {
                        $page_logo_trasneint_name = 'esf_logo_' . $efbl_page->id;
                        $auth_img_src = get_transient( $page_logo_trasneint_name );
                        if ( !$auth_img_src || '' == $auth_img_src ) {
                            $auth_img_src = 'https://graph.facebook.com/' . $efbl_page->id . '/picture?type=large&redirect=0&access_token=' . $access_token;
                            $auth_img_src = wp_remote_get( $auth_img_src, $args );
                            if ( is_array( $auth_img_src ) && !is_wp_error( $auth_img_src ) ) {
                                $auth_img_src = json_decode( $auth_img_src['body'] );
                                if ( isset( $auth_img_src->data->url ) && !empty( $auth_img_src->data->url ) ) {
                                    $auth_img_src = $auth_img_src->data->url;
                                    //                                      $local_img    = esf_serve_media_locally( $efbl_page->id, $auth_img_src );
                                    //
                                    //                                      if ( $local_img ) {
                                    //                                          $auth_img_src = $local_img;
                                    //                                      }
                                    set_transient( $page_logo_trasneint_name, $auth_img_src, 30 * 60 * 60 * 24 );
                                }
                            }
                        }
                        if ( isset( $efbl_page->username ) ) {
                            $efbl_username = $efbl_page->username;
                            $efbl_username_label = __( 'Username:', 'easy-facebook-likebox' );
                        } else {
                            $efbl_username = $efbl_page->id;
                            $efbl_username_label = __( 'ID:', 'easy-facebook-likebox' );
                        }
                        $efbl_all_pages_html .= sprintf(
                            '<li class="collection-item avatar li-' . $efbl_page->id . '">
		                <a href="https://www.facebook.com/' . $efbl_page->id . '" target="_blank">
		                <img src="%2$s" alt="" class="circle">
		                </a>   
		                <div class="esf-bio-wrap">       
		                <span class="title">%1$s</span>
		                <p>%3$s <br> %5$s %4$s <span class="dashicons dashicons-admin-page efbl_copy_id tooltipped" data-position="right" data-clipboard-text="%4$s" data-delay="100" data-tooltip="%6$s"></span></p>
		                </div></li>',
                            $efbl_page->name,
                            $auth_img_src,
                            $efbl_page->category,
                            $efbl_username,
                            $efbl_username_label,
                            __( 'Copy', 'easy-facebook-likebox' )
                        );
                        $efbl_page = (array) $efbl_page;
                        $approved_pages[$efbl_page['id']] = $efbl_page;
                    }
                    $efbl_all_pages_html .= '</ul>';
                }
            }
            $fta_self_url = 'https://graph.facebook.com/me?fields=id,name&access_token=' . $access_token;
            $fta_self_data = json_decode( jws_fetchUrl( $fta_self_url, $args ) );
            $user_id = $fta_self_data->id;
            $fta_settings['plugins']['facebook']['approved_pages'] = $approved_pages;
            $fta_settings['plugins']['facebook']['access_token'] = $access_token;
            $fta_settings['plugins']['facebook']['type'] = 'page';
            $fta_settings['plugins']['facebook']['author'] = $fta_self_data;
            $efbl_saved = update_option( 'fta_settings', $fta_settings );
            if ( isset( $efbl_saved ) ) {
                wp_send_json_success( array(__( 'Successfully Authenticated!', 'easy-facebook-likebox' ), $efbl_all_pages_html) );
            } else {
                wp_send_json_error( __( 'Something went wrong! Refresh the page and try again', 'easy-facebook-likebox' ) );
            }
        }

        /*
         * efbl_create_skin_url on ajax.
         * Returns the URL.
         */
        function efbl_create_skin_url() {
            esf_check_ajax_referer();
            $skin_id = intval( $_POST['skin_id'] );
            $selectedVal = intval( $_POST['selectedVal'] );
            $page_id = intval( $_POST['page_id'] );
            $page_permalink = get_permalink( $page_id );
            $customizer_url = admin_url( 'customize.php' );
            if ( isset( $page_permalink ) ) {
                $customizer_url = add_query_arg( array(
                    'url'              => urlencode( $page_permalink ),
                    'autofocus[panel]' => 'efbl_customize_panel',
                    'efbl_skin_id'     => $skin_id,
                    'mif_customize'    => 'yes',
                    'efbl_account_id'  => $selectedVal,
                ), $customizer_url );
            }
            wp_send_json_success( array(__( 'Please wait! We are generating a preview for you.', 'easy-facebook-likebox' ), $customizer_url) );
        }

        /**
         * Get moderate tab data and render shortcode to get a preview
         *
         * @since 6.2.3
         */
        public function efbl_get_moderate_feed() {
            esf_check_ajax_referer();
            $page_id = intval( $_POST['page_id'] );
            global $efbl_skins;
            $skin_id = '';
            if ( isset( $efbl_skins ) ) {
                foreach ( $efbl_skins as $skin ) {
                    if ( $skin['layout'] == 'grid' ) {
                        $skin_id = $skin['ID'];
                    }
                }
            }
            $shortcode = '[efb_feed fanpage_id="' . $page_id . '" test_mode="true" is_moderate="true" skin_id="' . $skin_id . '" words_limit="25" post_limit="30" links_new_tab="1"]';
            wp_send_json_success( do_shortcode( $shortcode ) );
        }

        /**
         * Preload feed data to cache
         *
         * @since 6.4.5
         */
        public function preload_feed() {
            esf_check_ajax_referer();
            if ( isset( $_POST['shortcode'] ) && !empty( $_POST['shortcode'] ) ) {
                $shortcode = wp_kses_stripslashes( sanitize_text_field( $_POST['shortcode'] ) );
                do_shortcode( $shortcode );
                wp_send_json_success();
            } else {
                wp_send_json_error();
            }
        }

        /**
         * Return Plugin cache data
         *
         * @since 6.2.3
         *
         * @param string $type
         *
         * @return array
         */
        public function get_cache( $type = 'posts' ) {
            global $wpdb;
            $efbl_trans_sql = "SELECT `option_name` AS `name`, `option_value` AS `value`\n\t\t    FROM  {$wpdb->options}\n\t\t    WHERE `option_name` LIKE '%transient_%'\n\t\t    ORDER BY `option_name`";
            $efbl_trans_results = $wpdb->get_results( $efbl_trans_sql );
            $efbl_trans_posts = array();
            $efbl_trans_group = array();
            $efbl_trans_bio = array();
            $all_cache = array();
            if ( $efbl_trans_results ) {
                foreach ( $efbl_trans_results as $efbl_trans_result ) {
                    if ( strpos( $efbl_trans_result->name, 'efbl' ) !== false && strpos( $efbl_trans_result->name, 'posts' ) !== false && strpos( $efbl_trans_result->name, 'timeout' ) == false ) {
                        $efbl_trans_posts[$efbl_trans_result->name] = $efbl_trans_result->value;
                    }
                    if ( strpos( $efbl_trans_result->name, 'efbl' ) !== false && strpos( $efbl_trans_result->name, 'bio' ) !== false && strpos( $efbl_trans_result->name, 'timeout' ) == false ) {
                        $efbl_trans_bio[$efbl_trans_result->name] = $efbl_trans_result->value;
                    }
                    if ( strpos( $efbl_trans_result->name, 'efbl' ) !== false && strpos( $efbl_trans_result->name, 'group' ) !== false && strpos( $efbl_trans_result->name, 'timeout' ) == false ) {
                        $efbl_trans_group[$efbl_trans_result->name] = $efbl_trans_result->value;
                    }
                }
            }
            if ( $type == 'bio' ) {
                $cache = $efbl_trans_bio;
            }
            if ( $type == 'group' ) {
                $cache = $efbl_trans_group;
            }
            if ( $type == 'posts' ) {
                $cache = $efbl_trans_posts;
            }
            if ( $type == 'all' ) {
                $cache = array_merge( $efbl_trans_bio, $efbl_trans_group, $efbl_trans_posts );
            }
            return $cache;
        }

    }

    $Easy_Facebook_Likebox_Admin = new Easy_Facebook_Likebox_Admin();
}