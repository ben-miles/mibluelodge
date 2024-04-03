<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

/* Override GeneratePress Credits Link in Footer (Sorry!) */
add_action('generate_credits', 'generate_add_footer_info');
function generate_add_footer_info() {
	$currentYear = date('Y');
	$siteName = get_bloginfo('name');
	$siteURL = get_bloginfo('url');
	$siteAuthor = 'Ben Miles';
	$siteAuthorURL = 'https://benmiles.com/';
	$copyright = '<span class="copyright">&copy; '.$currentYear.' <a href='.$siteURL.'>'.$siteName.'</a>. All Rights Reserved.</span> &bull; <span class="credit">Site by <a href='.$siteAuthorURL.'>'.$siteAuthor.'</a>.</span>';
	echo $copyright;
}

/* Apply Stylesheet to Block Editor */
add_action('after_setup_theme', 'add_styles_to_block_editor');
function add_styles_to_block_editor() {
	add_editor_style('style.css');
}

/**
 * We use WordPress's init hook to make sure
 * our blocks are registered early in the loading
 * process.
 *
 * @link https://developer.wordpress.org/reference/hooks/init/
 */
function mibluelodge_register_acf_blocks() {
    /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
	if(function_exists('acf_register_block_type')) {
    	
		// register our custom block
		register_block_type( __DIR__ . '/blocks/officer' );
	}
}
// Here we call our tt3child_register_acf_block() function on init.
add_action( 'init', 'mibluelodge_register_acf_blocks' );



add_action( 'acf/init', 'hfm_acf_init_blocks' );
function hfm_acf_init_blocks() {

    if ( function_exists( 'acf_register_block_type' ) ) {
        acf_register_block_type(
            array(
                'name'            => 'opening-hours',
                'title'           => 'Café Opening Hours',
                'description'     => 'Display opening hours for a café',
                'render_template' => 'block-templates/opening-hours.php',
                'category'        => 'text',
                'icon'            => 'admin-comments',
                'api_version'     => 2,
                'keywords'        => array( 'opening hours', 'hours' ),
                'mode'            => 'preview',
                'supports'        => array(
                    'jsx'        => true,
                    'color'      => array(
                        'text'       => true,
                        'background' => false,
                    ),
                    'align_text' => true,
                ),
            )
        );
    }
}