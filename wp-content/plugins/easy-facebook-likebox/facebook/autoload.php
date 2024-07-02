<?php

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}
/*----------------------------------------------------------------------------*
 * Defining Paths
 *----------------------------------------------------------------------------*/
// Plugin Folder Path
if ( !defined( 'EFBL_PLUGIN_DIR' ) ) {
    define( 'EFBL_PLUGIN_DIR', FTA_PLUGIN_DIR . 'facebook/' );
}
// Plugin Folder URL
if ( !defined( 'EFBL_PLUGIN_URL' ) ) {
    define( 'EFBL_PLUGIN_URL', FTA_PLUGIN_URL . 'facebook/' );
}
// Plugin Root File
if ( !defined( 'EFBL_PLUGIN_FILE' ) ) {
    define( 'EFBL_PLUGIN_FILE', FTA_PLUGIN_URL . 'facebook/' );
}
/*----------------------------------------------------------------------------*
 * Including EFBL Files
 *----------------------------------------------------------------------------*/
/*
 * Includes admin file
*/
require_once EFBL_PLUGIN_DIR . 'admin/includes/efbl-skins.php';
/*
 * Includes Customizer file
*/
require_once EFBL_PLUGIN_DIR . 'admin/includes/efbl-customizer.php';
/*
 * Includes Customizer Extend file
*/
require_once EFBL_PLUGIN_DIR . 'admin/includes/efbl-customizer-extend.php';
/*
 * Includes admin file
*/
require_once EFBL_PLUGIN_DIR . 'admin/class-easy-facebook-likebox-admin.php';
if ( function_exists( 'register_block_type' ) ) {
    require_once EFBL_PLUGIN_DIR . 'includes/blocks/esf-fb-blocks.php';
}