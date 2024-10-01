<?php

/**
 * Plugin Name: Easy Social Feed
 * Plugin URI:        https://wordpress.org/plugins/easy-facebook-likebox
 * Description:       Formerly "Easy Facebook Like Box and Custom Facebook Feed" plugin allows you to easily display custom facebook feed, custom Instagram photos and videos feed, page plugin (like box) on your website using either widget or shortcode to increase facbook fan page likes. You can use the shortcode generator. Additionally, it also now allows you to display the customized facebook feed on your website using the same color scheme of your website. Its completely customizable with lots of optional settings. Its also responsive facebook like box at the same time.
 * Version:           6.6.1
 * Author:            Easy Social Feed
 * Author URI:        https://easysocialfeed.com/
 * Text Domain:       easy-facebook-likebox
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( function_exists( 'efl_fs' ) ) {
    efl_fs()->set_basename( false, __FILE__ );
} else {
    if ( !function_exists( 'efl_fs' ) ) {
        // Create a helper function for easy SDK access.
        function efl_fs() {
            global $efl_fs;
            if ( !isset( $efl_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $efl_fs = fs_dynamic_init( array(
                    'id'              => '4142',
                    'slug'            => 'easy-facebook-likebox',
                    'type'            => 'plugin',
                    'public_key'      => 'pk_d982f4dff842224ca5e54c84f6822',
                    'is_premium'      => false,
                    'has_addons'      => true,
                    'has_paid_plans'  => true,
                    'trial'           => array(
                        'days'               => 7,
                        'is_require_payment' => true,
                    ),
                    'has_affiliation' => 'all',
                    'menu'            => array(
                        'support'    => false,
                        'slug'       => 'feed-them-all',
                        'first-path' => 'admin.php?page=esf_welcome',
                    ),
                    'is_live'         => true,
                ) );
            }
            return $efl_fs;
        }

        // Init Freemius.
        efl_fs();
        // Signal that SDK was initiated.
        do_action( 'efl_fs_loaded' );
    }
    //======================================================================
    // Code for the Main structure
    //======================================================================
    $options = get_option( 'fta_settings' );
    $fb_status = $options['plugins']['facebook']['status'];
    if ( isset( $options['plugins']['facebook'] ) ) {
        $fb = $options['plugins']['facebook'];
    } else {
        $fb = array();
    }
    if ( !array_key_exists( 'status', $fb ) ) {
        $fb_status = 'activated';
    }
    if ( $fb_status == 'activated' ) {
        require_once plugin_dir_path( __FILE__ ) . 'facebook/frontend/includes/core-functions.php';
        require_once plugin_dir_path( __FILE__ ) . 'facebook/frontend/easy-facebook-likebox.php';
        require_once plugin_dir_path( __FILE__ ) . 'facebook/includes/easy-custom-facebook-feed-widget.php';
        require_once plugin_dir_path( __FILE__ ) . 'facebook/includes/easy-facebook-page-plugin-widget.php';
        function register_fblx_widget() {
            register_widget( 'Easy_Custom_Facebook_Feed_Widget' );
            register_widget( 'Easy_Facebook_Page_Plugin_Widget' );
        }

        add_action( 'widgets_init', 'register_fblx_widget' );
    }
    $insta_status = $options['plugins']['instagram']['status'];
    if ( isset( $options['plugins']['instagram'] ) ) {
        $insta = $options['plugins']['instagram'];
    } else {
        $insta = array();
    }
    if ( !array_key_exists( 'status', $insta ) ) {
        $insta_status = 'activated';
    }
    if ( $insta_status == 'activated' ) {
        require_once plugin_dir_path( __FILE__ ) . 'instagram/includes/esf-instagram-feed-widget.php';
        function register_insta_widget() {
            register_widget( 'ESF_Instagram_Feed_Widget' );
        }

        add_action( 'widgets_init', 'register_insta_widget' );
    }
    if ( !class_exists( 'Feed_Them_All' ) ) {
        class Feed_Them_All {
            public $version = '6.6.1';

            public $fta_slug = 'easy-facebook-likebox';

            public $plug_slug = 'easy-facebook-likebox';

            function __construct() {
                add_action( 'init', array($this, 'constants') );
                add_action( 'init', array($this, 'includes') );
                add_action( 'init', array($this, 'create_uploads_folder') );
                add_action( 'plugins_loaded', array($this, 'load_textdomain'), 1 );
                register_activation_hook( __FILE__, array($this, 'fta_activated') );
            }

            /*
             * constants defines all the plugin constants.
             * Returns nothing.
             * defined() func used to define constant.
             */
            public function constants() {
                if ( !defined( 'FTA_VERSION' ) ) {
                    define( 'FTA_VERSION', $this->version );
                }
                if ( !defined( 'FTA_PLUGIN_DIR' ) ) {
                    define( 'FTA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
                }
                if ( !defined( 'FTA_PLUGIN_URL' ) ) {
                    define( 'FTA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
                }
                if ( !defined( 'FTA_PLUGIN_FILE' ) ) {
                    define( 'FTA_PLUGIN_FILE', __FILE__ );
                }
            }

            /**
             * Load Easy Facebook likebox textdomain.
             *
             * @since 6.2.1
             *
             * @return void
             * @access public
             */
            public function load_textdomain() {
                load_plugin_textdomain( 'easy-facebook-likebox', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
            }

            /*
             * fta_activated will Add all the necessary data into the database on plugin install.
             * Returns nothing.
             */
            public function fta_activated() {
                $install_date = $this->fta_get_settings( 'installDate' );
                $fta_settings = array(
                    'version'     => $this->version,
                    'installDate' => date( 'Y-m-d h:i:s' ),
                    'plugins'     => $this::fta_plugins(),
                );
                if ( empty( $install_date ) ) {
                    update_option( 'fta_settings', $fta_settings );
                }
            }

            /*
             * includes will include all the necessary files.
             * Returns nothing.
             * include() func used to include any file.
             */
            public function includes() {
                include FTA_PLUGIN_DIR . '/includes/class-module-search.php';
                include FTA_PLUGIN_DIR . '/includes/core-functions.php';
                include FTA_PLUGIN_DIR . 'admin/class-esf-admin.php';
                $fta_plugins = $this->fta_plugins();
                $instagram_status = $fta_plugins['instagram']['status'];
                if ( $instagram_status == 'activated' ) {
                    include FTA_PLUGIN_DIR . 'instagram/autoload.php';
                }
                $fb_status = $fta_plugins['facebook']['status'];
                if ( $fb_status == 'activated' ) {
                    include FTA_PLUGIN_DIR . 'facebook/autoload.php';
                }
            }

            /**
             * Create uploads folder if not exists.
             *
             * @since 6.4.4
             */
            public function create_uploads_folder() {
                $upload_dir = wp_upload_dir();
                $upload_dir = $upload_dir['basedir'];
                $upload_dir = $upload_dir . '/esf-instagram';
                if ( !file_exists( $upload_dir ) ) {
                    wp_mkdir_p( $upload_dir );
                }
                $upload_dir = wp_upload_dir();
                $upload_dir = $upload_dir['basedir'];
                $upload_dir = $upload_dir . '/esf-facebook';
                if ( !file_exists( $upload_dir ) ) {
                    wp_mkdir_p( $upload_dir );
                }
            }

            /*
             * fta_plugins Holds all the FTA plugins data
             */
            public function fta_plugins() {
                $Feed_Them_All = new Feed_Them_All();
                $fb_status = $Feed_Them_All->fta_get_settings();
                $fb_status = $fb_status['plugins']['facebook']['status'];
                $insta_status = $Feed_Them_All->fta_get_settings();
                $insta_status = $insta_status['plugins']['instagram']['status'];
                if ( empty( $fb_status ) ) {
                    $fb_status = 'activated';
                }
                if ( empty( $insta_status ) ) {
                    $insta_status = 'activated';
                }
                /*
                 * Making an array of all plugins
                 */
                $fta_plugins = array(
                    'facebook'  => array(
                        'name'          => __( 'Custom Facebook Feed - Page Plugin (Likebox)', 'easy-facebook-likebox' ),
                        'slug'          => 'easy-facebook-likebox',
                        'activate_slug' => 'facebook',
                        'description'   => __( 'Display customizable and mobile-friendly Facebook post, images, videos, events, albums feed and Facebook page plugin using shortcode and widget', 'easy-facebook-likebox' ),
                        'img_name'      => 'fb_cover.png',
                        'status'        => $fb_status,
                    ),
                    'instagram' => array(
                        'name'          => __( 'Custom Instagram Feed', 'easy-facebook-likebox' ),
                        'slug'          => 'mif',
                        'activate_slug' => 'instagram',
                        'description'   => __( 'Display stunning photos from the Instagram account in the feed, any Hashtag Feed and gallery of photos in the PopUp using shortcode, widget, inside popup and widget', 'easy-facebook-likebox' ),
                        'img_name'      => 'insta_cover.png',
                        'status'        => $insta_status,
                    ),
                );
                return $fta_plugins;
            }

            /*
             * It will get the saved settings.
             */
            public function fta_get_settings( $key = null ) {
                $fta_settings = get_option( 'fta_settings', false );
                if ( $key ) {
                    $fta_settings = $fta_settings[$key];
                }
                return $fta_settings;
            }

            /*
             * fta_settings_link Will add the My Instagram settings page link in the plugin area.
             */
            public function fta_settings_link( $links ) {
                $fta_link = array('<a href="' . admin_url( 'admin.php?page=feed-them-all' ) . '">' . __( 'Settings', 'easy-facebook-likebox' ) . '</a>');
                return array_merge( $fta_link, $links );
            }

            /**
             * Return module status
             *
             * @since 6.2.8
             *
             * @param $slug
             *
             * @return mixed|string
             */
            public function module_status( $slug ) {
                $settings = $this->fta_get_settings();
                $status = $settings['plugins'][$slug]['status'];
                if ( empty( $status ) ) {
                    $status = 'activated';
                }
                return $status;
            }

            public function fta_get_image_id( $image_url ) {
                global $wpdb;
                $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", $image_url ) );
                return $attachment[0];
            }

        }

        new Feed_Them_All();
    }
}