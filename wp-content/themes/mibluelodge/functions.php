<?php

// Enable Featured Image / Post Thumbnail
add_theme_support('post-thumbnails');

// Enable Custom Page Titles
add_theme_support('title-tag');

// Disable automatic image scaling
add_filter( 'big_image_size_threshold', '__return_false' );

// Shorten Automatic Excerpts
// Via https://www.hostinger.com/tutorials/wordpress-excerpt-length
function shorten_auto_excerpts($length){ 
	return 18; 
}
add_filter('excerpt_length', 'shorten_auto_excerpts');

// Change "More" Indicator on Auto Excerpts
function excerpt_more_indicator( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'excerpt_more_indicator' );

// Remove Automatic <p> and <br> Tags from Contact Form 7
// Via https://stackoverflow.com/a/49025096/6853842
add_filter('wpcf7_autop_or_not', '__return_false');

// Remove Gutenberg / Block Library CSS
function remove_wp_block_library_css(){
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'global-styles' );

} 
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );

// Remove Emojis
// Via https://kinsta.com/knowledgebase/disable-emojis-wordpress/
function remove_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'remove_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'remove_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'remove_emojis' );
function remove_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
function remove_emojis_remove_dns_prefetch( $urls, $relation_type ) {
if ( 'dns-prefetch' == $relation_type ) {
	$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
	$urls = array_diff( $urls, array( $emoji_svg_url ) );
}
return $urls;
}

// Add Menu Support
register_nav_menus( array(
	'primary' => __( 'Main Menu', 'mibluelodge' ),
	) );
// Register Custom Navigation Walker
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );
// Modify WordPress' Navigation Menus to use Bootstrap 5 syntax
add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );
function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
	if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
		if ( array_key_exists( 'data-toggle', $atts ) ) {
			unset( $atts['data-toggle'] );
			$atts['data-bs-toggle'] = 'dropdown';
		}
	}
	return $atts;
}

// Load Custom Scripts and Styles
function load_custom_scripts_and_styles() {

	// Make sure the custom script gets a `type` attribute set to `module`
	add_filter( 'script_loader_tag', 'add_type_to_script', 10, 3 );
	function add_type_to_script( $tag, $handle, $src ) {
		if ( $handle === 'custom' ) {
			$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
		}
		return $tag;
	}

	// Load Styles
	if(is_singular( 'portfolio' )){
		// Single Portfolio Pages Only:
		// wp_enqueue_style( 'glightbox', get_template_directory_uri() . '/assets/css/glightbox.min.css', array(), null, false );
		// wp_enqueue_script( 'glightbox', get_template_directory_uri() . '/assets/js/glightbox.min.js', array(), null, false );
	}
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), null, false );
	// wp_enqueue_style( 'custom', get_template_directory_uri() . '/assets/css/custom.css', false, '', 'all' );
	
	// Load Scripts
	// wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js?render=' . GOOGLE_RECAPTCHA_SITE_KEY, array(), null, false );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), null, false );
	// wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/js/custom.js', array(), null, false );
}
add_action( 'wp_enqueue_scripts', 'load_custom_scripts_and_styles' );

// Load custom Admin Styles
function load_custom_admin_styles() {
	// Admin
	wp_enqueue_style( 'admin', get_template_directory_uri() . '/assets/css/admin.css', array(), null, false );
}
add_action( 'admin_enqueue_scripts', 'load_custom_admin_styles' );

/*
* displaySVG
* Generates optimized, inline SVG code from an SVG file
* Accepts: Name of SVG file, Additional CSS Class(es)
* Returns: String of HTML containing optimized, inline SVG code
* Based on https://stackoverflow.com/a/30000684/6853842
*/
function displaySVG( $filename = '', $additional_classes = NULL ){
    $svg_file = file_get_contents( get_template_directory_uri() . '/assets/icons/' . $filename . '.svg' );
    $search_string = '<svg';
    $start_position = strpos( $svg_file, $search_string );
    $svg_code = substr( $svg_file, $start_position );
    $output = '<div class="svg-wrapper svg-' . $filename . ' ' . $additional_classes . '">' . $svg_code . '</div>';
    return $output;
}

/*
* urlToLabel
* Formats a complete URL string into a simpler label
* Accepts: A string containing a complete URL 
* Returns: A string containing only the domain name and extension
*/
function urlToLabel($url){
	// Remove common prefixes
	$label = str_replace( ["http://", "https://", "www."], "", $url );
	// Remove paths
	$label = explode('/', $label, 2);
	return $label[0];
}

/*
* getPortfolioItems
* Gets and formats Portfolio Items for display
* Accepts: Category Name(s), Tag(s), and a Max number of Items to collect, as arguments
* Returns: String of HTML containing the collection of Portfolio Items, formatted for display
*/
function getPortfolioItems($category=null,$tag=null,$max_items=-1){
	$args = array(
		'category_name' => $category,
		'order' => 'DESC',
		'orderby' => 'date',
		'post_status' => 'publish',
		'post_type' => 'portfolio',
		'posts_per_page' => $max_items,
		'tag' => $tag,
	);
	$loop = new WP_Query($args);
	$i = 0;
	while ($loop->have_posts()){
		$loop->the_post();
		// Format Meta
		$the_title = get_the_title();
		$the_categories = get_the_category();
		$the_categories_classes = "";
		foreach($the_categories as $the_category){
			$the_categories_classes .= $the_category->slug . ' ';
		}
		$the_date = get_the_date();
		$the_excerpt = get_the_excerpt();
		$the_thumbnail = get_the_post_thumbnail( null, 'medium', ['class' => 'thumbnail-image'] );
		$the_video = get_field( 'home_page_video' );
		$the_external_url = get_field( 'url' );
		$the_external_url_label = mb_strimwidth( urlToLabel( $the_external_url ), 0, 25, "..." );
		$the_permalink = get_permalink();
		$max_items = ( $max_items > 4 || $max_items === -1) ? 4 : $max_items;
		$column_class = 12 / $max_items;
		$animation_delay = $i % $max_items;
		?>
		<div class="column column-<?php echo $column_class . ' ' . $the_categories_classes; ?>">
			<div class="portfolio-item animated <?php echo ($the_video) ? 'has-video' : ''; ?>" data-animation="fadeInUp" style="animation-delay: 0.<?php echo $animation_delay; ?>s;">
				<a href="<?php echo $the_permalink; ?>" target="_self" class="media">
					<?php echo $the_thumbnail;
					if($the_video){ ?>
					<video loop muted preload="none" class="thumbnail-video">
						<source src="<?php echo $the_video; ?>" type="video/webm">
					</video>
					<?php } ?>
				</a>
				<div class="meta">
					<a href="<?php echo $the_permalink; ?>" target="_self">
						<h6 class="title"><?php echo $the_title; ?></h6>
					</a>
					<!--<div class="date"><?php //echo $the_date; ?></div>-->
					<p class="excerpt"><?php echo $the_excerpt; ?></p>
					<?php if($the_external_url){ ?>
					<a href="<?php echo $the_external_url; ?>" target="_blank" class="external-link"><?php echo displaySVG('external-link'); echo $the_external_url_label; ?></a>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
		$i++;
	}
	wp_reset_postdata();
}

?>