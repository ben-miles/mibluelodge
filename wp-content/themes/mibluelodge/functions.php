<?php
/**
 * mibluelodge functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mibluelodge
 * @since mibluelodge 1.0
 */

/**
 * Register block styles.
 */

if ( ! function_exists( 'mibluelodge_block_styles' ) ) :
	/**
	 * Register custom block styles
	 *
	 * @since mibluelodge 1.0
	 * @return void
	 */
	function mibluelodge_block_styles() {

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __( 'Arrow icon', 'mibluelodge' ),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __( 'Pill', 'mibluelodge' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'mibluelodge' ),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __( 'With arrow', 'mibluelodge' ),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __( 'With asterisk', 'mibluelodge' ),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
		register_block_style(
			'core/group',
			array(
				'name'         => 'torn-bottom',
				'label'        => __( 'Torn (Bottom)', 'mibluelodge' ),
				'inline_style' => "
				.is-style-torn-bottom {
					overflow: hidden;
					position: relative
				}
				.is-style-torn-bottom::before {
					content: '';
					position: absolute;
					z-index: 3;
					pointer-events: none;
					background-repeat: no-repeat;
					bottom: -0.1vw;
					left: -0.1vw;
					right: -0.1vw;
					top: -0.1vw;
					background-size: 100% 60px;
					background-position: 50% 100%;
					background-image: url('" . get_template_directory_uri() . "/assets/images/torn-paper.svg');
				}
				@media (min-width:2100px) {
					.is-style-paper-bottom::before {
						background-size: 100% calc(2vw + 60px);
					}
				}",
			)
		);
		register_block_style(
			'core/group',
			array(
				'name'         => 'torn-top',
				'label'        => __( 'Torn (Top)', 'mibluelodge' ),
				'inline_style' => "
				.is-style-torn-top {
					overflow: hidden;
					position: relative
				}
				.is-style-torn-top::before {
					content: '';
					position: absolute;
					transform: rotateZ(180deg);
					z-index: 3;
					pointer-events: none;
					background-repeat: no-repeat;
					bottom: -0.1vw;
					left: -0.1vw;
					right: -0.1vw;
					top: -0.1vw;
					background-size: 100% 60px;
					background-position: 50% 100%;
					background-image: url('" . get_template_directory_uri() . "/assets/images/torn-paper.svg');
				}
				@media (min-width:2100px) {
					.is-style-torn-top::before {
						background-size: 100% calc(2vw + 60px);
					}
				}",
			)
		);
		register_block_style(
			'core/group',
			array(
				'name'         => 'torn-both',
				'label'        => __( 'Torn (Both)', 'mibluelodge' ),
				'inline_style' => "
				.is-style-torn-both {
					overflow: hidden;
					position: relative
				}
				.is-style-torn-both::before,
				.is-style-torn-both::after {
					content: '';
					position: absolute;
					z-index: 3;
					pointer-events: none;
					background-repeat: no-repeat;
					bottom: -0.1vw;
					left: -0.1vw;
					right: -0.1vw;
					top: -0.1vw;
					background-size: 100% 60px;
					background-position: 50% 100%;
					background-image: url('" . get_template_directory_uri() . "/assets/images/torn-paper.svg');
				}
				.is-style-torn-both::before {
					transform: rotateZ(180deg);
				}
				@media (min-width:2100px) {
					.is-style-torn-both::before,
					.is-style-torn-both::after {
						background-size: 100% calc(2vw + 60px);
					}
				}",
			)
		);
		register_block_style(
			'core/html',
			array(
				'name'         => 'google-calendar-embed',
				'label'        => __( 'Google Calendar Embed', 'mibluelodge' ),
				'inline_style' => "
				@media (max-width: 800px) {
					.responsive-google-calendar-embed .google-calendar-embed-month {
						display: none;
					}
					.responsive-google-calendar-embed .google-calendar-embed-agenda {
						display: block;
					}
				 }
				 @media (min-width: 800px) {
					.responsive-google-calendar-embed .google-calendar-embed-month {
						display: block;
					}
					.responsive-google-calendar-embed .google-calendar-embed-agenda {
						display: none;
					}
				 }
				 .responsive-google-calendar-embed {
					position: relative;
					padding-bottom: 56.25%;
					padding-top: 30px;
					height: 0;
					overflow: hidden;
				 }
				 .responsive-google-calendar-embed iframe,   
				 .responsive-google-calendar-embed object,  
				 .responsive-google-calendar-embed embed {
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
				 }",
			)
		);
		register_block_style(
			'core/image',
			array(
				'name'         => 'image-card',
				'label'        => __( 'Card', 'mibluelodge' ),
				'inline_style' => "
				.is-style-image-card {
					background: #fff;
					border: 3px solid #fff;
					box-shadow: 0 0 0 1px var(--wp--preset--color--base-2);
				}
				.is-style-image-card figcaption {
					background: #fff;
					margin-top: 0;
					margin-left: -1px;
					margin-right: -1px;
					padding: 2px 3px 5px;
				}",
			)
		);
		register_block_style(
			'core/paragraph',
			array(
				'name'         => 'text-shadow-dark',
				'label'        => __( 'Text Shadow (Dark)', 'mibluelodge' ),
				'inline_style' => "
				.is-style-text-shadow-dark {
					text-shadow: 1px 2px 3px black;
				}",
			)
		);
		register_block_style(
			'core/table',
			array(
				'name'         => 'no-cell-borders',
				'label'        => __( 'No Cell Borders', 'mibluelodge' ),
				'inline_style' => "
				.is-style-no-cell-borders td {
					border: none;
				}
				.is-style-no-cell-borders {
					border: 3px solid gray;
				}",
			)
		);
	}
endif;

add_action( 'init', 'mibluelodge_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'mibluelodge_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since mibluelodge 1.0
	 * @return void
	 */
	function mibluelodge_block_stylesheets() {
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'mibluelodge-button-style-outline',
				'src'    => get_parent_theme_file_uri( 'assets/css/button-outline.css' ),
				'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
				'path'   => get_parent_theme_file_path( 'assets/css/button-outline.css' ),
			)
		);
	}
endif;

add_action( 'init', 'mibluelodge_block_stylesheets' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'mibluelodge_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since mibluelodge 1.0
	 * @return void
	 */
	function mibluelodge_pattern_categories() {

		register_block_pattern_category(
			'mibluelodge_page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'mibluelodge' ),
				'description' => __( 'A collection of full page layouts.', 'mibluelodge' ),
			)
		);
	}
endif;

add_action( 'init', 'mibluelodge_pattern_categories' );

// Add the ability to randomly sort the results of GenerateBlocks' Query Loop block
add_filter( 'generateblocks_query_loop_args', function( $query_args, $attributes ) {
    // Custom CSS class to signify random order
    $randomClass = 'has-order-random';
	// Check if the block has the custom CSS class
    if ( !empty( $attributes['className'] ) && strpos( $attributes['className'], $randomClass ) !== false ) {
    	// Merge the current $query_args with editor defined args
		return array_merge( $query_args,  [ 'orderby' => 'rand' ] );
    }
	// Otherwise just carry on with the default query args
    return $query_args;
}, 10, 2 );

// Add the ability to open links in new tabs for any block (for when there is no control in the block settings)
function db_rerender_url_new_tab( $block_content, $block ) {
	// Custom CSS class to signify open link in new tab
	$newTabLinkClass = 'open-link-in-new-tab';
	if( !is_admin() && !empty( $block['attrs']['className'] ) && strpos( $block['attrs']['className'], $newTabLinkClass ) !== false  ) {
			$search='href="';
			$replace='target="_blank" href="';
			$output = str_replace($search, $replace, $block_content);
			return $output;
	}
	return $block_content;
}
add_filter( 'render_block', 'db_rerender_url_new_tab', 10, 2 );