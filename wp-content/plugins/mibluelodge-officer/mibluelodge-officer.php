<?php
/**
 * Plugin Name: MI Blue Lodge Officer
 * Description: Displays a Lodge Officer, including all corresponding custom fields
 */

 function mibluelodge_officer_register(){
	wp_enqueue_script(
		'mibluelodge-officer',
		plugin_dir_url(__FILE__).'mibluelodge-officer.js',
		array('wp-blocks','wp-i18n','wp-editor'),
		true,
		false
	);
 }
 add_action('enqueue_block_editor_assets','mibluelodge_officer_register');

?>