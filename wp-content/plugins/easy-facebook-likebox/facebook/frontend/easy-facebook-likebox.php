<?php

/**
 * Plugin Name.
 *
 * @package   EasyFacebookLikeBox
 * @author    Danish Ali Malik
 * @license   GPL-2.0+
 * @link      https://easysocialfeed.com
 * @copyright 2019 MaltaThemes
 */
/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 *
 * @package EasyFacebookLikeBox
 * @author  Danish Ali Malik
 */
// Include and instantiate the class.
require_once 'includes/Mobile_Detect.php';
$mDetect = new EFBL_Mobile_Detect();
class Easy_Facebook_Likebox {
    /**
     * Plugin version, used for cache-busting of style and script file
     * references.
     *
     * @since   1.1.0
     *
     * @var     string
     */
    const VERSION = '6.5.9';

    /**
     *
     * Unique identifier for your plugin.
     *
     *
     * The variable name is used as the text domain when internationalizing
     *     strings of text. Its value should match the Text Domain file header
     *     in the main plugin file.
     *
     * @since    1.1.0
     *
     * @var      string
     */
    protected $plugin_slug = 'easy-facebook-likebox';

    /**
     * Instance of this class.
     *
     * @since    1.1.0
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Instance of the like box render function
     *
     * @since    1.1.0
     *
     * @var      object
     */
    public $likebox_instance = 1;

    /**
     * Initialize the plugin by setting localization and loading public scripts
     * and styles.
     *
     * @since     1.1.0
     */
    public function __construct() {
        // Activate plugin when new blog is added
        add_action( 'wpmu_new_blog', array($this, 'activate_new_site') );
        // Load public-facing style sheet and JavaScript.
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue_styles') );
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts') );
        add_shortcode( 'efb_likebox', array($this, 'efb_likebox_shortcode') );
        add_shortcode( 'efb_pageplugin', array($this, 'efb_pageplugin_shortcode') );
        add_shortcode( 'efb_feed', array($this, 'efb_feed_shortcode') );
        add_action( 'wp_ajax_efbl_generate_popup_html', array($this, 'efbl_generate_popup_html') );
        add_action( 'wp_ajax_nopriv_efbl_generate_popup_html', array($this, 'efbl_generate_popup_html') );
        add_action( 'wp_ajax_easy-facebook-likebox-customizer-style', array($this, 'efbl_load_customizer_css') );
        add_action( 'wp_ajax_nopriv_easy-facebook-likebox-customizer-style', array($this, 'efbl_load_customizer_css') );
    }

    /**
     * Fired when the plugin is activated.
     *
     * @param boolean $network_wide True if WPMU superadmin uses
     *                                       "Network Activate" action, false if
     *                                       WPMU is disabled or plugin is
     *                                       activated on an individual blog.
     *
     * @since    1.1.0
     *
     */
    public static function activate( $network_wide ) {
        if ( function_exists( 'is_multisite' ) && is_multisite() ) {
            if ( $network_wide ) {
                // Get all blog ids
                $blog_ids = self::get_blog_ids();
                foreach ( $blog_ids as $blog_id ) {
                    switch_to_blog( $blog_id );
                    self::single_activate();
                }
                restore_current_blog();
            } else {
                self::single_activate();
            }
        } else {
            self::single_activate();
        }
    }

    /**
     * Fired when the plugin is deactivated.
     *
     * @param boolean $network_wide True if WPMU superadmin uses
     *                                       "Network Deactivate" action, false
     *     if WPMU is disabled or plugin is deactivated on an individual blog.
     *
     * @since    1.1.0
     *
     */
    public static function deactivate( $network_wide ) {
        if ( function_exists( 'is_multisite' ) && is_multisite() ) {
            if ( $network_wide ) {
                // Get all blog ids
                $blog_ids = self::get_blog_ids();
                foreach ( $blog_ids as $blog_id ) {
                    switch_to_blog( $blog_id );
                    self::single_deactivate();
                }
                restore_current_blog();
            } else {
                self::single_deactivate();
            }
        } else {
            self::single_deactivate();
        }
    }

    /**
     * Fired when a new site is activated with a WPMU environment.
     *
     * @param int $blog_id ID of the new blog.
     *
     * @since    1.1.0
     *
     */
    public function activate_new_site( $blog_id ) {
        if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
            return;
        }
        switch_to_blog( $blog_id );
        self::single_activate();
        restore_current_blog();
    }

    /**
     * Get all blog ids of blogs in the current network that are:
     * - not archived
     * - not spam
     * - not deleted
     *
     * @return   array|false    The blog ids, false if no matches.
     * @since    1.1.0
     *
     */
    private static function get_blog_ids() {
        global $wpdb;
        // get an array of blog ids
        $sql = "SELECT blog_id FROM {$wpdb->blogs}\n\t\t\tWHERE archived = '0' AND spam = '0'\n\t\t\tAND deleted = '0'";
        return $wpdb->get_col( $sql );
    }

    /**
     * Fired for each blog when the plugin is activated.
     *
     * @since    1.1.0
     */
    private static function single_activate() {
        // @TODO: Define activation functionality here
        $install_date = get_option( 'efbl_installDate', false );
        /*
         * Save the plugin current version.
         */
        update_option( 'efbl_version', FTA_VERSION );
        /*
         * Save the plugin install time and date.
         */
        $install_date = add_option( 'efbl_installDate', date( 'Y-m-d h:i:s' ) );
        /*
         * Save the plugin type version.
         */
        update_option( 'efbl_version_type', 'pro' );
    }

    /**
     * Fired for each blog when the plugin is deactivated.
     *
     * @since    1.1.0
     */
    private static function single_deactivate() {
        // @TODO: Define deactivation functionality here
    }

    /**
     * Register and enqueue public-facing style sheet.
     *
     * @since    1.1.0
     */
    public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_slug . '-custom-fonts', FTA_PLUGIN_URL . 'frontend/assets/css/esf-custom-fonts.css' );
        if ( efl_fs()->is_free_plan() ) {
            wp_enqueue_style(
                $this->plugin_slug . '-popup-styles',
                plugins_url( 'assets/css/esf-free-popup.css', __FILE__ ),
                array(),
                self::VERSION
            );
        }
        wp_enqueue_style(
            $this->plugin_slug . '-frontend',
            plugins_url( 'assets/css/easy-facebook-likebox-frontend.css', __FILE__ ),
            array(),
            self::VERSION
        );
        wp_enqueue_style(
            $this->plugin_slug . '-customizer-style',
            admin_url( 'admin-ajax.php' ) . '?action=' . $this->plugin_slug . '-customizer-style',
            $this->plugin_slug . '-frontend',
            self::VERSION
        );
    }

    /**
     * Register and enqueues public-facing JavaScript files.
     *
     * @since    1.1.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script(
            $this->plugin_slug . '-popup-script',
            plugins_url( 'assets/js/esf-free-popup.min.js', __FILE__ ),
            array('jquery'),
            self::VERSION
        );
        wp_enqueue_script(
            $this->plugin_slug . '-public-script',
            plugins_url( 'assets/js/public.js', __FILE__ ),
            array('jquery', $this->plugin_slug . '-popup-script'),
            self::VERSION
        );
        $efbl_is_fb_pro = false;
        if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            $efbl_is_fb_pro = true;
        }
        wp_localize_script( $this->plugin_slug . '-public-script', 'public_ajax', array(
            'ajax_url'       => admin_url( 'admin-ajax.php' ),
            'efbl_is_fb_pro' => $efbl_is_fb_pro,
        ) );
    }

    /*
     * Include customizer style file
     */
    public function efbl_load_customizer_css() {
        header( 'Content-type: text/css; charset: UTF-8' );
        require EFBL_PLUGIN_DIR . 'frontend/assets/css/easy-facebook-likebox-customizer-style.css.php';
        exit;
    }

    public function efb_likebox_shortcode( $atts, $content = '' ) {
        return $this->render_fb_page_plugin( $atts );
    }

    public function efb_pageplugin_shortcode( $atts, $content = '' ) {
        return $this->render_fb_page_plugin( $atts );
    }

    public function efb_feed_shortcode( $atts, $content = '' ) {
        return $this->render_fbfeed_box( $atts );
    }

    public function render_fbfeed_box( $atts ) {
        $defaults = array(
            'fanpage_id'       => '',
            'accesstoken'      => '',
            'words_limit'      => 25,
            'post_limit'       => 10,
            'load_more'        => 1,
            'cache_unit'       => 1,
            'cache_duration'   => 'days',
            'skin_id'          => efbl_default_skin_id(),
            'links_new_tab'    => 0,
            'show_like_box'    => 0,
            'filter'           => '',
            'events_filter'    => '',
            'live_stream_only' => 0,
            'type'             => 'page',
            'is_moderate'      => false,
        );
        $instance = wp_parse_args( (array) $atts, $defaults );
        if ( isset( $atts['other_page_id'] ) && !empty( $atts['other_page_id'] ) ) {
            $instance['fanpage_id'] = $atts['other_page_id'];
        }
        if ( is_array( $instance['fanpage_id'] ) ) {
            $instance['fanpage_id'] = implode( ',', $instance['fanpage_id'] );
        }
        extract( $instance );
        ob_start();
        include 'views/feed.php';
        $returner = ob_get_contents();
        ob_end_clean();
        return $returner;
    }

    /**
     *          This fucntion will render the facebook page plugin
     *
     *
     * @since    4.0
     */
    public function render_fb_page_plugin( $options ) {
        $efbl_tabs = null;
        extract( $options, EXTR_SKIP );
        if ( !isset( $tabs ) ) {
            $tabs = '';
        }
        if ( empty( $fb_appid ) ) {
            $fb_appid = '395202813876688';
        }
        if ( empty( $locale ) ) {
            $locale = 'en_US';
        }
        if ( !empty( $locale_other ) ) {
            $locale = $locale_other;
        }
        $page_name_id = efbl_parse_url( $fanpage_url );
        if ( !isset( $show_stream ) ) {
            $show_stream = 0;
        }
        if ( !isset( $show_faces ) ) {
            $show_faces = 0;
        }
        if ( !isset( $hide_cover ) ) {
            $hide_cover = 0;
        }
        if ( !isset( $responsive ) ) {
            $responsive = 0;
        }
        if ( !isset( $hide_cta ) ) {
            $hide_cta = 0;
        }
        if ( !isset( $small_header ) ) {
            $small_header = 0;
        }
        $show_stream = ( $show_stream == 1 ? 'data-show-posts=true' : 'data-show-posts=false' );
        $show_faces = ( $show_faces == 1 ? 'data-show-facepile=true' : 'data-show-facepile=false' );
        $hide_cover = ( $hide_cover == 1 ? 'data-hide-cover="true"' : 'data-hide-cover=false' );
        $responsive = ( $responsive == 1 ? 'data-adapt-container-width=true' : 'data-adapt-container-width=false' );
        $hide_cta = ( $hide_cta == 1 ? 'data-hide-cta=true' : 'data-hide-cta=false' );
        $small_header = ( $small_header == 1 ? 'data-small-header="true"' : 'data-small-header="false"' );
        $efbl_tabs = null;
        if ( !isset( $animate_effect ) ) {
            $animate_effect = 'fadeIn';
        }
        if ( !isset( $box_height ) ) {
            $box_height = '';
        }
        if ( !isset( $box_width ) ) {
            $box_width = '';
        }
        $preLoader = plugins_url( 'assets/images/loader.gif', __FILE__ );
        $returner = '<div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.async=true; 
              js.src = "//connect.facebook.net/' . esc_attr( $locale ) . '/all.js#xfbml=1&appId=' . esc_attr( $fb_appid ) . '";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, \'script\', \'facebook-jssdk\'));</script>';
        $likebox_instance = $this->likebox_instance;
        $returner .= ' <div class="efbl-like-box ' . esc_attr( $likebox_instance ) . '">
                  <div class="fb-page" data-animclass="';
        if ( $animate_effect ) {
            $returner .= '' . esc_attr( $animate_effect ) . '';
        }
        $returner .= '" data-href="https://www.facebook.com/' . esc_attr( $page_name_id ) . '" ' . $hide_cover . ' data-width="' . esc_attr( $box_width ) . '"  ' . $efbl_tabs . ' data-height="' . esc_attr( $box_height ) . '" ' . $show_faces . '  ' . $show_stream . ' ' . $responsive . ' ' . $hide_cta . ' ' . $small_header . '>
                  </div> 
                  
               </div>
            ';
        $this->likebox_instance++;
        return $returner;
    }

    function efbl_generate_popup_html() {
        ob_start();
        $efbl_templateurl = locate_template( array('easy-facebook-likebox/html-free-popup.php') );
        if ( !$efbl_templateurl ) {
            $efbl_templateurl = EFBL_PLUGIN_DIR . 'frontend/views/html-free-popup.php';
        }
        require $efbl_templateurl;
        $html = ob_get_contents();
        ob_end_clean();
        echo $html;
        wp_die();
    }

    /**
     * Get posts from Facebook by given ID
     *
     * @param int   $page_id
     * @param array $instance
     * @param int   $test_mode
     *
     * @return mixed|void
     */
    public function query_posts( $page_id = 617177998743210, $instance = array(), $test_mode = false ) {
        if ( !isset( $page_id ) || empty( $page_id ) ) {
            $page_id = 617177998743210;
        }
        extract( $instance );
        $FTA = new Feed_Them_All();
        $fta_settings = $FTA->fta_get_settings();
        $fb_settings = $fta_settings['plugins']['facebook'];
        $has_album_data = false;
        if ( isset( $fb_settings['approved_pages'] ) ) {
            $approved_pages = $fb_settings['approved_pages'];
        } else {
            $approved_pages = array();
        }
        $test_mode = apply_filters( 'efbl_disable_cache', $test_mode );
        $page_id = efbl_parse_url( apply_filters( 'efbl_page_id_before_query', $page_id ) );
        $duration = $cache_unit . '-' . substr( $cache_duration, 0, 1 );
        // Get page access token
        if ( $approved_pages ) {
            foreach ( $approved_pages as $efbl_page ) {
                if ( !is_numeric( $page_id ) && $efbl_page['username'] && $efbl_page['username'] == $page_id ) {
                    $page_id = $efbl_page['id'];
                }
                if ( $efbl_page['id'] == $page_id ) {
                    $page_access_token = $efbl_page['access_token'];
                }
            }
        }
        if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
        } else {
            if ( !$page_access_token ) {
                return apply_filters( 'efbl_query_posts_return', array(
                    'posts'          => '',
                    'error'          => __( 'No account found, Please enter the account ID available in the dashboard', 'easy-facebook-likebox' ),
                    'next_posts_url' => '',
                    'transient_name' => '',
                    'is_saved_posts' => '',
                    'public_page'    => true,
                ) );
            }
        }
        // If page is not authenticated use user access token
        if ( !isset( $page_access_token ) && empty( $page_access_token ) ) {
            $public_page = true;
            if ( isset( $fb_settings['access_token'] ) && !empty( $fb_settings['access_token'] ) ) {
                $access_token = $fb_settings['access_token'];
            } else {
                $access_token = '';
            }
        } else {
            $access_token = $page_access_token;
            $public_page = false;
        }
        // If accesstoken is defined in the shortcode use it.
        if ( isset( $accesstoken ) && !empty( $accesstoken ) ) {
            $access_token = $accesstoken;
        }
        if ( empty( $access_token ) ) {
            return apply_filters( 'efbl_query_posts_return', array(
                'posts'          => '',
                'error'          => __( 'No access token found', 'easy-facebook-likebox' ),
                'next_posts_url' => '',
                'transient_name' => '',
                'is_saved_posts' => '',
                'public_page'    => $public_page,
            ) );
        }
        $post_limit = ( $post_limit ? $post_limit : '10' );
        $cache_seconds = efbl_get_cache_seconds( $instance );
        if ( isset( $approved_pages[$page_id]['name'] ) ) {
            $page_name = $approved_pages[$page_id]['name'];
        }
        $page_username = efbl_get_page_username( $page_id );
        $transient_name = 'efbl_posts_' . str_replace( ' ', '', $page_username ) . '-' . $post_limit . '-' . $duration;
        if ( empty( $page_name ) ) {
            $page_name = $page_id;
        }
        $is_saved_posts = false;
        $next_post_url = null;
        $posts_json = get_transient( $transient_name );
        if ( isset( $posts_json ) && !empty( $posts_json ) ) {
            $is_saved_posts = true;
        }
        if ( !$posts_json || '' == $posts_json || $test_mode ) {
            $efbl_api_url = add_query_arg( apply_filters( 'efbl_api_url_params', array(
                'fields'       => 'posts.limit(' . $post_limit . '){place,status_type,full_picture,permalink_url,likes{pic_crop,id,name},comments.limit(30){id,like_count,permalink_url,comments,reactions,comment_count,created_time,message,message_tags,attachment},reactions{id,name,pic_crop,type,link},created_time,story,message,reactions.type(LIKE).limit(0).summary(1).as(like),reactions.type(LOVE).limit(0).summary(1).as(love),reactions.type(HAHA).limit(0).summary(1).as(haha),reactions.type(WOW).limit(0).summary(1).as(wow),reactions.type(SAD).limit(0).summary(1).as(sad),reactions.type(ANGRY).limit(0).summary(1).as(angry),from,message_tags,shares,story_tags,picture,attachments},about,picture{url}',
                'access_token' => $access_token,
                'locale'       => 'en_us',
            ), $instance ), apply_filters( 'efbl_api_url_base', 'https://graph.facebook.com/v4.0/' . $page_id . '', $instance ) );
            $posts_json = jws_fetchUrl( $efbl_api_url );
            $json_decoded = json_decode( $posts_json );
            if ( !$test_mode && !empty( $json_decoded->posts->data ) ) {
                set_transient( $transient_name, $posts_json, $cache_seconds );
            }
        }
        $json_decoded = json_decode( $posts_json );
        if ( isset( $json_decoded->posts->data ) ) {
            $fbData = $json_decoded->posts->data;
        } else {
            $fbData = null;
        }
        if ( isset( $json_decoded->error ) ) {
            $error = $json_decoded->error->message;
        } else {
            $error = '';
        }
        $returner = apply_filters( 'efbl_query_posts_return', array(
            'posts'          => $fbData,
            'error'          => $error,
            'next_posts_url' => $next_post_url,
            'transient_name' => $transient_name,
            'is_saved_posts' => $is_saved_posts,
            'has_album_data' => $has_album_data,
            'public_page'    => $public_page,
        ) );
        return $returner;
    }

}

$efbl = new Easy_Facebook_Likebox();