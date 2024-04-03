<?php

// Enable Featured Image / Post Thumbnail
// add_theme_support('post-thumbnails');

// Enable Custom Page Titles
// add_theme_support('title-tag');

// Disable automatic image scaling
// add_filter( 'big_image_size_threshold', '__return_false' );

// Shorten Automatic Excerpts
// Via https://www.hostinger.com/tutorials/wordpress-excerpt-length
// function shorten_auto_excerpts($length){ 
// 	return 18; 
// }
// add_filter('excerpt_length', 'shorten_auto_excerpts');

// Change "More" Indicator on Auto Excerpts
// function excerpt_more_indicator( $more ) {
// 	return '...';
// }
// add_filter( 'excerpt_more', 'excerpt_more_indicator' );

// Remove Gutenberg / Block Library CSS
// function remove_wp_block_library_css(){
// 	wp_dequeue_style( 'wp-block-library' );
// 	wp_dequeue_style( 'wp-block-library-theme' );
// 	wp_dequeue_style( 'wc-blocks-style' );
// 	wp_dequeue_style( 'global-styles' );
// } 
// add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );

// Remove Emojis
// Via https://kinsta.com/knowledgebase/disable-emojis-wordpress/
// function remove_emojis() {
// 	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
// 	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
// 	remove_action( 'wp_print_styles', 'print_emoji_styles' );
// 	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
// 	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
// 	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
// 	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
// 	add_filter( 'tiny_mce_plugins', 'remove_emojis_tinymce' );
// 	add_filter( 'wp_resource_hints', 'remove_emojis_remove_dns_prefetch', 10, 2 );
// }
// add_action( 'init', 'remove_emojis' );
// function remove_emojis_tinymce( $plugins ) {
// 	if ( is_array( $plugins ) ) {
// 		return array_diff( $plugins, array( 'wpemoji' ) );
// 	} else {
// 		return array();
// 	}
// }
// function remove_emojis_remove_dns_prefetch( $urls, $relation_type ) {
// if ( 'dns-prefetch' == $relation_type ) {
// 	$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
// 	$urls = array_diff( $urls, array( $emoji_svg_url ) );
// }
// return $urls;
// }

// Add Menu Support
// register_nav_menus([
// 	'header' => __( 'Header Menu', 'mibluelodge' ),
// 	'footer' => __( 'Footer Menu', 'mibluelodge' ),
// 	'social' => __( 'Social Media Menu', 'mibluelodge' )
// ]);
// Register Custom Navigation Walker
// function register_navwalker(){
// 	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
// }
// add_action( 'after_setup_theme', 'register_navwalker' );
// Modify WordPress' Navigation Menus to use Bootstrap 5 syntax
// add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );
// function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
// 	if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
// 		if ( array_key_exists( 'data-toggle', $atts ) ) {
// 			unset( $atts['data-toggle'] );
// 			$atts['data-bs-toggle'] = 'dropdown';
// 		}
// 	}
// 	return $atts;
// }

// Load Custom Scripts and Styles
// function load_custom_scripts_and_styles() {

	// Make sure the custom script gets a `type` attribute set to `module`
	// add_filter( 'script_loader_tag', 'add_type_to_script', 10, 3 );
	// function add_type_to_script( $tag, $handle, $src ) {
	// 	if ( $handle === 'custom' ) {
	// 		$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
	// 	}
	// 	return $tag;
	// }

	// Load Styles
	// if(is_singular( 'portfolio' )){
		// Single Portfolio Pages Only:
		// wp_enqueue_style( 'glightbox', get_template_directory_uri() . '/assets/css/glightbox.min.css', array(), null, false );
		// wp_enqueue_script( 'glightbox', get_template_directory_uri() . '/assets/js/glightbox.min.js', array(), null, false );
	// }
	// wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), null, false );
	// wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/fontawesome.min.css', array(), null, false );
	// wp_enqueue_style( 'fontawesome-brands', get_template_directory_uri() . '/assets/css/brands.min.css', array(), null, false );
	// wp_enqueue_style( 'custom', get_template_directory_uri() . '/assets/css/custom.css', false, '', 'all' );
	
	// Load Scripts
	// wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js?render=' . GOOGLE_RECAPTCHA_SITE_KEY, array(), null, false );

	// wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), null, false );
	// wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/js/custom.js', array(), null, false );
// }
// add_action( 'wp_enqueue_scripts', 'load_custom_scripts_and_styles' );

// Load Custom Admin Styles
// function load_custom_admin_styles() {
	// Admin
	// wp_enqueue_style( 'admin', get_template_directory_uri() . '/assets/css/admin.css', array(), null, false );
// }
//add_action( 'admin_enqueue_scripts', 'load_custom_admin_styles' );

/*
* displaySVG
* Generates optimized, inline SVG code from an SVG file
* Accepts: Name of SVG file, Additional CSS Class(es)
* Returns: String of HTML containing optimized, inline SVG code
* Based on https://stackoverflow.com/a/30000684/6853842
*/
// function displaySVG( $filename = '', $additional_classes = NULL ){
//     $svg_file = file_get_contents( get_template_directory_uri() . '/assets/icons/' . $filename . '.svg' );
//     $search_string = '<svg';
//     $start_position = strpos( $svg_file, $search_string );
//     $svg_code = substr( $svg_file, $start_position );
//     $output = '<div class="svg-wrapper svg-' . $filename . ' ' . $additional_classes . '">' . $svg_code . '</div>';
//     return $output;
// }





// Add Gutenberg / Block Editor support for full-width sections
// add_theme_support ('align-wide');

/**
 * Enqueue the style.css file.
 * 
 * @since 1.0.0
 */
function lesson_one_style() {
	wp_enqueue_style(
		'lesson-one-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'lesson_one_style' );

?>