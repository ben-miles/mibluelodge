<?php
if (!defined('BLOCKVERSE_VERSION')) {
    // Replace the version number of the theme on each release.
    define('BLOCKVERSE_VERSION', wp_get_theme()->get('Version'));
}
define('BLOCKVERSE_DEBUG', defined('WP_DEBUG') && WP_DEBUG === true);
define('BLOCKVERSE_DIR', trailingslashit(get_template_directory()));
define('BLOCKVERSE_URL', trailingslashit(get_template_directory_uri()));

if (!function_exists('blockverse_support')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * @since walker_fse 1.0.0
     *
     * @return void
     */
    function blockverse_support()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        // Add support for block styles.
        add_theme_support('wp-block-styles');
        add_theme_support('post-thumbnails');
        // Enqueue editor styles.
        add_editor_style('style.css');
    }

endif;
add_action('after_setup_theme', 'blockverse_support');

/*----------------------------------------------------------------------------------
Enqueue Styles
-----------------------------------------------------------------------------------*/
if (!function_exists('blockverse_styles')) :
    function blockverse_styles()
    {
        // registering style for theme
        wp_enqueue_style('blockverse-style', get_stylesheet_uri(), array(), BLOCKVERSE_VERSION);
        wp_enqueue_style('blockverse-blocks-style', get_template_directory_uri() . '/assets/css/blocks.css');
        if (is_rtl()) {
            wp_enqueue_style('rtl-css', get_template_directory_uri() . '/assets/css/rtl.css', 'rtl_css');
        }
    }
endif;

add_action('wp_enqueue_scripts', 'blockverse_styles');

/**
 * Enqueue scripts for admin area
 */
function blockverse_admin_style()
{
    wp_enqueue_style('admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', array(), BLOCKVERSE_VERSION, 'all');
}
add_action('admin_enqueue_scripts', 'blockverse_admin_style');

/**
 * Enqueue assets scripts for both backend and frontend
 */
function blockverse_block_assets()
{
    wp_enqueue_style('blockverse-blocks-style', get_template_directory_uri() . '/assets/css/blocks.css');
}
add_action('enqueue_block_assets', 'blockverse_block_assets');

/**
 * Load core file.
 */
require_once get_template_directory() . '/inc/core/init.php';

/**
 * Load welcome page file.
 */
require_once get_template_directory() . '/inc/admin/welcome-notice.php';

if (!function_exists('blockverse_excerpt_more_postfix')) {
    function blockverse_excerpt_more_postfix($more)
    {
        if (is_admin()) {
            return $more;
        }
        return '...';
    }
    add_filter('excerpt_more', 'blockverse_excerpt_more_postfix');
}
if (!function_exists('blockverse_excerpt_limit')) {
    function blockverse_excerpt_limit($length)
    {
        if (is_admin()) {
            return $length;
        }
        return 29;
    }
    add_filter('excerpt_length', 'blockverse_excerpt_limit');
}
