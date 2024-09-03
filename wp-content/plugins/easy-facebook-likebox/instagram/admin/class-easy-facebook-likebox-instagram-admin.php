<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//======================================================================
// Admin of Instagram Module
//======================================================================
if ( !class_exists( 'ESF_Instagram_Admin' ) ) {
    class ESF_Instagram_Admin {
        function __construct() {
            add_action( 'admin_menu', array($this, 'esf_insta_menu'), 100 );
            add_action( 'admin_enqueue_scripts', array($this, 'esf_insta_style') );
            add_action( 'wp_ajax_mif_remove_access_token', array($this, 'esf_insta_remove_access_token') );
            add_action( 'wp_ajax_mif_save_access_token', array($this, 'esf_insta_save_access_token') );
            add_action( 'wp_ajax_mif_save_business_access_token', array($this, 'esf_insta_save_business_access_token') );
            add_action( 'wp_ajax_esf_insta_create_skin_url', array($this, 'esf_insta_create_skin_url') );
            add_action( 'wp_ajax_mif_delete_transient', array($this, 'esf_insta_delete_transient') );
            add_action( 'wp_ajax_mif_clear_all_cache', array($this, 'clear_all_cache') );
            add_action( 'wp_ajax_mif_get_moderate_feed', array($this, 'esf_insta_get_moderate_feed') );
            add_action( 'wp_ajax_mif_get_shoppable_feed', array($this, 'get_shoppable_feed') );
            add_action( 'wp_ajax_mif_preload_feed', array($this, 'preload_feed') );
        }

        /*
         * esf_insta_style will enqueue style and js files.
         * Returns hook name of the current page in admin.
         * $hook will contain the hook name.
         */
        public function esf_insta_style( $hook ) {
            if ( 'easy-social-feed_page_mif' !== $hook ) {
                return;
            }
            wp_enqueue_style( 'select2', ESF_INSTA_PLUGIN_URL . 'admin/assets/css/select2.min.css' );
            wp_enqueue_script( 'select2', ESF_INSTA_PLUGIN_URL . 'admin/assets/js/select2.min.js', array('jquery') );
            wp_enqueue_style( 'esf-insta-admin-style', ESF_INSTA_PLUGIN_URL . 'admin/assets/css/esf-insta-admin-style.css' );
            wp_enqueue_style( 'esf-insta-frontend', ESF_INSTA_PLUGIN_URL . 'frontend/assets/css/esf-insta-frontend.css' );
            wp_enqueue_script( 'esf-insta-admin-script', ESF_INSTA_PLUGIN_URL . 'admin/assets/js/esf-insta-admin-script.js', array('jquery', 'esf-admin') );
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $default_skin_id = $fta_settings['plugins']['instagram']['default_skin_id'];
            wp_localize_script( 'esf-insta-admin-script', 'mif', array(
                'ajax_url'        => admin_url( 'admin-ajax.php' ),
                'nonce'           => wp_create_nonce( 'esf-ajax-nonce' ),
                'copied'          => __( 'Copied', 'easy-facebook-likebox' ),
                'error'           => __( 'Something went wrong!', 'easy-facebook-likebox' ),
                'saving'          => __( 'Saving', 'easy-facebook-likebox' ),
                'deleting'        => __( 'Deleting', 'easy-facebook-likebox' ),
                'generating'      => __( 'Generating Shortcode', 'easy-facebook-likebox' ),
                'connect_account' => __( 'Please connect your Instagram account with plugin', 'easy-facebook-likebox' ),
                'moderate_wait'   => __( 'Please wait, we are generating preview for you', 'easy-facebook-likebox' ),
                'default_skin_id' => $default_skin_id,
            ) );
            wp_enqueue_script( 'media-upload' );
            wp_enqueue_media();
        }

        /*
         * Adds Instagram sub-menu in dashboard
         */
        function esf_insta_menu() {
            if ( efl_fs()->is_free_plan() ) {
                $menu_position = 2;
            } else {
                $menu_position = null;
            }
            add_submenu_page(
                'feed-them-all',
                __( 'Instagram', 'easy-facebook-likebox' ),
                __( 'Instagram', 'easy-facebook-likebox' ),
                'manage_options',
                'mif',
                array($this, 'esf_insta_page'),
                $menu_position
            );
        }

        /*
         * esf_insta_page contains the html/markup of the Instagram page.
         */
        function esf_insta_page() {
            /**
             * Instagram page view.
             */
            include_once ESF_INSTA_PLUGIN_DIR . 'admin/views/html-admin-page-mif.php';
        }

        /*
         * Returns the Skin URL
         */
        function esf_insta_create_skin_url() {
            esf_check_ajax_referer();
            $skin_id = intval( $_POST['skin_id'] );
            $selectedVal = intval( $_POST['selectedVal'] );
            $page_id = intval( $_POST['page_id'] );
            $page_permalink = get_permalink( $page_id );
            $customizer_url = admin_url( 'customize.php' );
            if ( isset( $page_permalink ) ) {
                $customizer_url = add_query_arg( array(
                    'url'              => urlencode( $page_permalink ),
                    'autofocus[panel]' => 'mif_customize_panel',
                    'mif_skin_id'      => $skin_id,
                    'mif_customize'    => 'yes',
                    'mif_account_id'   => $selectedVal,
                ), $customizer_url );
            }
            wp_send_json_success( array(__( 'Please wait! We are generating a preview for you', 'easy-facebook-likebox' ), $customizer_url) );
        }

        /*
         * Deletes the cache
         */
        function esf_insta_delete_transient() {
            esf_check_ajax_referer();
            $transient_id = sanitize_text_field( $_POST['transient_id'] );
            $replaced_value = str_replace( '_transient_', '', $transient_id );
            // Delete feed media from local server.
            if ( strpos( $replaced_value, 'posts' ) !== false ) {
                $feed = get_transient( $replaced_value );
                if ( $feed ) {
                    $feed = json_decode( $feed );
                    if ( isset( $feed->data ) ) {
                        foreach ( $feed->data as $post ) {
                            esf_delete_media( $post->id, 'instagram' );
                            if ( isset( $post->media_type ) && isset( $post->children->data ) && $post->media_type == 'CAROUSEL_ALBUM' ) {
                                foreach ( $post->children->data as $feed_carousel ) {
                                    esf_delete_media( $feed_carousel->id, 'instagram' );
                                }
                            }
                        }
                    }
                }
            }
            $mif_deleted_trans = delete_transient( $replaced_value );
            $str = explode( '-', $replaced_value );
            if ( isset( $str[1] ) ) {
                delete_transient( 'esf_insta_logo_' . $str[1] );
                esf_delete_media( $str[1], 'instagram' );
            }
            if ( isset( $mif_deleted_trans ) ) {
                $returned_arr = array(__( 'Cache is successfully deleted.', 'easy-facebook-likebox' ), $transient_id);
                wp_send_json_success( $returned_arr );
            } else {
                wp_send_json_error( __( 'Something Went Wrong! Please try again.', 'easy-facebook-likebox' ) );
            }
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
                    $str = explode( '-', $id );
                    if ( isset( $str[1] ) ) {
                        delete_transient( 'esf_insta_logo_' . $str[1] );
                        esf_delete_media( $str[1], 'instagram' );
                    }
                    $mif_deleted_trans = delete_transient( $transient_name );
                }
                esf_delete_media_folder( 'instagram' );
            }
            if ( isset( $mif_deleted_trans ) ) {
                wp_send_json_success( __( 'Cache is successfully deleted.', 'easy-facebook-likebox' ) );
            } else {
                wp_send_json_error( __( 'Something Went Wrong! Please try again.', 'easy-facebook-likebox' ) );
            }
        }

        /*
         * Get the image ID by URL
         */
        function mif_get_image_id( $image_url ) {
            global $wpdb;
            $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", $image_url ) );
            return $attachment[0];
        }

        /*
         * Gets the remote URL and sends back the json decoded data
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
         *  Return the user ID from access token.
         */
        public function mif_get_user_id( $access_token ) {
            $access_token_exploded = explode( '.', $access_token );
            return $access_token_exploded['0'];
        }

        /*
         *  Return the user name from access token.
         */
        public function mif_get_user_name( $access_token ) {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $authenticated_accounts = $fta_settings['plugins']['instagram']['authenticated_accounts'];
            $mif_user_id = $this->mif_get_user_id( $access_token );
            return $authenticated_accounts[$mif_user_id]['username'];
        }

        /*
         * Gets the access token, autenticate it and save it to DB.
         */
        public function esf_insta_save_access_token() {
            esf_check_ajax_referer();
            $access_token = sanitize_text_field( $_POST['access_token'] );
            $mif_accounts_html = '';
            $self_data = "https://graph.instagram.com/me?fields=id,username&access_token={$access_token}";
            $self_decoded_data = $this->esf_insta_get_data( $self_data );
            if ( isset( $self_decoded_data->error ) && !empty( $self_decoded_data->error ) ) {
                wp_send_json_error( $self_decoded_data->error->message );
            } elseif ( isset( $self_decoded_data ) && !empty( $self_decoded_data ) ) {
                $FTA = new Feed_Them_All();
                $fta_settings = $FTA->fta_get_settings();
                $mif_accounts_html .= '<ul class="collection with-header"> <li class="collection-header"><h5>' . __( 'Connected Instagram Account', 'easy-facebook-likebox' ) . '</h5> 
				<a href="#fta-remove-at" class="modal-trigger fta-remove-at-btn tooltipped" data-type="personal" data-position="left" data-delay="50" data-tooltip="' . __( 'Delete Access Token', 'easy-facebook-likebox' ) . '"><span class="dashicons dashicons-trash"></span></a></li>
				<li class="collection-item li-' . $self_decoded_data->id . '">
				 <div class="esf-bio-wrap">    
						  <span class="title">' . $self_decoded_data->username . '</span>
						  <p>' . __( 'ID:', 'easy-facebook-likebox' ) . ' ' . $self_decoded_data->id . ' <span class="dashicons dashicons-admin-page efbl_copy_id tooltipped" data-position="right" data-clipboard-text="' . $self_decoded_data->id . '" data-delay="100" data-tooltip="' . __( 'Copy', 'easy-facebook-likebox' ) . '"></span></p>
			   </div>
				</li>
			</ul>';
                $fta_settings['plugins']['instagram']['instagram_connected_account'][$self_decoded_data->id];
                $fta_settings['plugins']['instagram']['instagram_connected_account'][$self_decoded_data->id]['username'] = $self_decoded_data->username;
                $fta_settings['plugins']['instagram']['instagram_connected_account'][$self_decoded_data->id]['access_token'] = $access_token;
                $fta_settings['plugins']['instagram']['selected_type'] = 'personal';
                $mif_saved = update_option( 'fta_settings', $fta_settings );
                if ( isset( $mif_saved ) ) {
                    wp_send_json_success( array(__( 'Successfully Authenticated!', 'easy-facebook-likebox' ), $mif_accounts_html) );
                } else {
                    wp_send_json_error( __( 'Something went wrong! Refresh the page and try again', 'easy-facebook-likebox' ) );
                }
            } else {
                wp_send_json_error( __( 'Something went wrong! Refresh the page and try again', 'easy-facebook-likebox' ) );
            }
        }

        /*
         * Get the access token and save back into DB
         */
        public function esf_insta_save_business_access_token() {
            if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
                $access_token = sanitize_text_field( $_POST['access_token'] );
                $id = sanitize_text_field( $_POST['id'] );
                $fta_api_url = 'https://graph.facebook.com/me/accounts?fields=access_token,username,id,name,fan_count,category,about&access_token=' . $access_token;
                $args = array(
                    'timeout'   => 150,
                    'sslverify' => false,
                );
                $fta_pages = wp_remote_get( $fta_api_url, $args );
                if ( is_array( $fta_pages ) && !is_wp_error( $fta_pages ) ) {
                    $fb_pages = json_decode( $fta_pages['body'] );
                    $approved_pages = array();
                    if ( $fb_pages->data ) {
                        $title = __( 'Connected Instagram Accounts', 'easy-facebook-likebox' );
                        $efbl_all_pages_html = '<ul class="collection with-header"> <li class="collection-header"><h5>' . $title . '</h5> 
			<a href="#fta-remove-at" class="modal-trigger fta-remove-at-btn tooltipped" data-position="left" data-delay="50" data-tooltip="' . __( 'Delete Access Token', 'easy-facebook-likebox' ) . '"><span class="dashicons dashicons-trash"></span></a></li>';
                        foreach ( $fb_pages->data as $efbl_page ) {
                            $fta_insta_api_url = 'https://graph.facebook.com/v4.0/' . $efbl_page->id . '/?fields=connected_instagram_account,instagram_accounts{username,profile_pic}&access_token=' . $efbl_page->access_token;
                            $fta_insta_accounts = wp_remote_get( $fta_insta_api_url, $args );
                            if ( is_array( $fta_insta_accounts ) && !is_wp_error( $fta_insta_accounts ) ) {
                                $fta_insta_accounts = json_decode( $fta_insta_accounts['body'] );
                                $fta_insta_connected_api_url = 'https://graph.facebook.com/v4.0/' . $fta_insta_accounts->connected_instagram_account->id . '/?fields=name,profile_picture_url,ig_id,username&access_token=' . $efbl_page->access_token;
                                $fta_insta_connected_account = wp_remote_get( $fta_insta_connected_api_url, $args );
                                if ( is_array( $fta_insta_connected_account ) && !is_wp_error( $fta_insta_connected_account ) ) {
                                    $fta_insta_connected_account = json_decode( $fta_insta_connected_account['body'] );
                                    if ( 'insta' == $id ) {
                                        if ( $fta_insta_connected_account->ig_id ) {
                                            $logo_trasneint_name = 'esf_insta_logo_' . $fta_insta_connected_account->ig_id;
                                            $auth_img_src = get_transient( $logo_trasneint_name );
                                            if ( !$auth_img_src || '' == $auth_img_src ) {
                                                $auth_img_src = 'https://graph.facebook.com/' . $efbl_page->id . '/picture?type=large&redirect=0&access_token=' . $access_token;
                                                $auth_img_src = wp_remote_get( $auth_img_src, $args );
                                                if ( is_array( $auth_img_src ) && !is_wp_error( $auth_img_src ) ) {
                                                    $auth_img_src = json_decode( $auth_img_src['body'] );
                                                    if ( isset( $auth_img_src->data->url ) && !empty( $auth_img_src->data->url ) ) {
                                                        $auth_img_src = $auth_img_src->data->url;
                                                        $local_img = esf_serve_media_locally( $fta_insta_connected_account->ig_id, $auth_img_src, 'instagram' );
                                                        if ( $local_img ) {
                                                            $auth_img_src = $local_img;
                                                        }
                                                        set_transient( $logo_trasneint_name, $auth_img_src, 30 * 60 * 60 * 24 );
                                                    }
                                                }
                                            }
                                            if ( $auth_img_src->error ) {
                                                if ( isset( $fta_insta_connected_account->profile_picture_url ) && !empty( $fta_insta_connected_account->profile_picture_url ) ) {
                                                    $auth_img_src = $fta_insta_connected_account->profile_picture_url;
                                                } else {
                                                    $auth_img_src = '';
                                                }
                                            }
                                            $efbl_all_pages_html .= sprintf(
                                                '<li class="collection-item avatar fta_insta_connected_account li-' . $fta_insta_connected_account->ig_id . '">
					 
					<a href="https://www.instagram.com/' . $fta_insta_connected_account->username . '" target="_blank">
							  <img src="%2$s" alt="" class="circle">
					</a>  
					<div class="esf-bio-wrap">        
							  <span class="title">%1$s</span>
							 <p>%5$s <br> %6$s %3$s <span class="dashicons dashicons-admin-page efbl_copy_id tooltipped" data-position="right" data-clipboard-text="%3$s" data-delay="100" data-tooltip="%7$s"></span></p></div>
					 </li>',
                                                $fta_insta_connected_account->name,
                                                $auth_img_src,
                                                $fta_insta_connected_account->id,
                                                __( 'Instagram account connected with ' . $efbl_page->name . '', 'easy-facebook-likebox' ),
                                                $fta_insta_connected_account->username,
                                                __( 'ID:', 'easy-facebook-likebox' ),
                                                __( 'Copy', 'easy-facebook-likebox' )
                                            );
                                        }
                                    }
                                }
                                $efbl_page = (array) $efbl_page;
                                $approved_pages[$efbl_page['id']] = $efbl_page;
                                $approved_pages[$efbl_page['id']]['instagram_accounts'] = $fta_insta_accounts;
                                $approved_pages[$efbl_page['id']]['instagram_connected_account'] = $fta_insta_connected_account;
                            }
                        }
                        $efbl_all_pages_html .= '</ul>';
                        $FTA = new Feed_Them_All();
                        $fta_settings = $FTA->fta_get_settings();
                        $fta_settings['plugins']['facebook']['approved_pages'] = $approved_pages;
                        $fta_settings['plugins']['facebook']['access_token'] = $access_token;
                        $fta_self_url = 'https://graph.facebook.com/me?fields=id,name&access_token=' . $access_token;
                        $fta_self_data = wp_remote_get( $fta_self_url, $args );
                        if ( is_array( $fta_self_data ) && !is_wp_error( $fta_self_data ) ) {
                            $fta_self_data = json_decode( $fta_self_data['body'] );
                            $fta_settings['plugins']['facebook']['author'] = $fta_self_data;
                        }
                        $fta_settings['plugins']['instagram']['selected_type'] = 'business';
                        update_option( 'fta_settings', $fta_settings );
                        wp_send_json_success( array(__( 'Successfully Authenticated!', 'easy-facebook-likebox' ), $efbl_all_pages_html) );
                    } else {
                        wp_send_json_error( __( 'No page found', 'easy-facebook-likebox' ) );
                    }
                } else {
                    if ( $fta_pages->get_error_message() ) {
                        $error_msg = $fta_pages->get_error_message();
                    } else {
                        $error_msg = __( 'Something went wrong! Refresh the page and try again', 'easy-facebook-likebox' );
                    }
                    wp_send_json_error( $error_msg );
                }
            }
        }

        /*
         * Removes the access token
         */
        function esf_insta_remove_access_token() {
            esf_check_ajax_referer();
            $Feed_Them_All = new Feed_Them_All();
            $fta_settings = $Feed_Them_All->fta_get_settings();
            unset($fta_settings['plugins']['instagram']['instagram_connected_account']);
            $fta_settings['plugins']['instagram']['selected_type'] = 'business';
            $delted_data = update_option( 'fta_settings', $fta_settings );
            if ( isset( $delted_data ) ) {
                echo wp_send_json_success( __( 'Deleted', 'easy-facebook-likebox' ) );
                wp_die();
            } else {
                echo wp_send_json_error( __( 'Something Went Wrong! Please try again.', 'easy-facebook-likebox' ) );
                wp_die();
            }
        }

        /**
         * Get moderate tab data and render shortcode to get a preview
         *
         * @since 6.2.3
         */
        public function esf_insta_get_moderate_feed() {
            esf_check_ajax_referer();
            $user_id = intval( $_POST['user_id'] );
            $clear_cache = sanitize_text_field( $_POST['clear_cache'] );
            global $mif_skins;
            $skin_id = '';
            if ( isset( $mif_skins ) ) {
                foreach ( $mif_skins as $skin ) {
                    if ( $skin['layout'] == 'grid' ) {
                        $skin_id = $skin['ID'];
                    }
                }
            }
            if ( $clear_cache ) {
                $type = esf_insta_instagram_type();
                $transient_name = "esf_insta_user_posts-{$user_id}-30-{$type}-1-d";
                delete_transient( $transient_name );
            }
            $shortcode = '[my-instagram-feed user_id="' . $user_id . '" is_moderate="true" skin_id="' . $skin_id . '" words_limit="25" feeds_per_page="30" links_new_tab="1"]';
            wp_send_json_success( do_shortcode( $shortcode ) );
        }

        /**
         * Get Shoppable tab data and render shortcode to get a preview
         *
         * @since 6.4.5
         */
        public function get_shoppable_feed() {
            esf_check_ajax_referer();
            $user_id = intval( $_POST['user_id'] );
            $clear_cache = sanitize_text_field( $_POST['clear_cache'] );
            global $mif_skins;
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $skin_id = '';
            if ( isset( $mif_skins ) ) {
                foreach ( $mif_skins as $skin ) {
                    if ( $skin['layout'] == 'grid' ) {
                        $skin_id = $skin['ID'];
                    }
                }
            }
            if ( $clear_cache ) {
                $type = esf_insta_instagram_type();
                $transient_name = "esf_insta_user_posts-{$user_id}-30-{$type}-1-d";
                delete_transient( $transient_name );
            }
            $link_text = '';
            $click_behaviour = '';
            $global_settings = array(
                'link_text'       => $link_text,
                'click_behaviour' => $click_behaviour,
            );
            $shortcode = '[my-instagram-feed user_id="' . $user_id . '" is_shoppable="true" skin_id="' . $skin_id . '" words_limit="25" feeds_per_page="30" links_new_tab="1"]';
            wp_send_json_success( array(
                'html'            => do_shortcode( $shortcode ),
                'global_settings' => $global_settings,
            ) );
        }

        /**
         * Preload feed data to cache
         *
         * @since 6.4.4
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
            $mif_trans_sql = "SELECT `option_name` AS `name`, `option_value` AS `value` FROM  {$wpdb->options} WHERE `option_name` LIKE '%transient_%' ORDER BY `option_name`";
            $mif_trans_results = $wpdb->get_results( $mif_trans_sql );
            $mif_trans_posts = array();
            $mif_trans_bio = array();
            $mif_trans_stories = array();
            $all_cache = array();
            if ( $mif_trans_results ) {
                foreach ( $mif_trans_results as $mif_trans_result ) {
                    if ( strpos( $mif_trans_result->name, 'esf_insta' ) !== false && strpos( $mif_trans_result->name, 'posts' ) !== false && strpos( $mif_trans_result->name, 'timeout' ) == false ) {
                        $mif_trans_posts[$mif_trans_result->name] = $mif_trans_result->value;
                    }
                    if ( strpos( $mif_trans_result->name, 'esf_insta' ) !== false && strpos( $mif_trans_result->name, 'stories' ) !== false && strpos( $mif_trans_result->name, 'timeout' ) == false ) {
                        $mif_trans_stories[$mif_trans_result->name] = $mif_trans_result->value;
                    }
                    if ( strpos( $mif_trans_result->name, 'esf_insta' ) !== false && strpos( $mif_trans_result->name, 'bio' ) !== false && strpos( $mif_trans_result->name, 'timeout' ) == false ) {
                        $mif_trans_bio[$mif_trans_result->name] = $mif_trans_result->value;
                    }
                }
            }
            if ( $type == 'bio' ) {
                $cache = $mif_trans_bio;
            }
            if ( $type == 'stories' ) {
                $cache = $mif_trans_stories;
            }
            if ( $type == 'posts' ) {
                $cache = $mif_trans_posts;
            }
            if ( $type == 'all' ) {
                $cache = array_merge( $mif_trans_bio, $mif_trans_stories, $mif_trans_posts );
            }
            return $cache;
        }

    }

    $ESF_Instagram_Admin = new ESF_Instagram_Admin();
}