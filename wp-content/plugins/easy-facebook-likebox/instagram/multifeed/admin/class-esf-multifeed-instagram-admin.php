<?php
/*
* Stop execution if someone tried to get file directly.
*/ 
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Frontend Class to create Custom Post Type and handling shortcodes
 *
 * @since  1.0.0
 */
if ( ! class_exists( 'Esf_Multifeed_Instagram_Admin' ) ){

class Esf_Multifeed_Instagram_Admin {

	/**
	 * Constructor.
	 *
	 * Fire all required wp actions
	 *
	 * @since  1.0.0
	 */
	function __construct(){

		add_action( 'esf_insta_page_attr', array(
			$this,
			'esfmf_multiple_pages_select'
		) );

	}

	/**
	 * Add multiple attr to shortcode generator select
	 *
	 * @since  1.0.0
	 *
	 * @return html attribute
	 */
	public function esfmf_multiple_pages_select() {

		echo 'multiple="multiple"';
	}


}

new Esf_Multifeed_Instagram_Admin();
}