<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/*
* Define Instagram module directory
*/
if ( !defined( 'ESF_INSTA_PLUGIN_DIR' ) ) {
    define( 'ESF_INSTA_PLUGIN_DIR', FTA_PLUGIN_DIR . '/instagram/' );
}
/*
* Define Instagram module URL
*/
if ( !defined( 'ESF_INSTA_PLUGIN_URL' ) ) {
    define( 'ESF_INSTA_PLUGIN_URL', FTA_PLUGIN_URL . '/instagram/' );
}
/*
* Define Instagram module file
*/
if ( !defined( 'ESF_INSTA_PLUGIN_FILE' ) ) {
    define( 'ESF_INSTA_PLUGIN_FILE', FTA_PLUGIN_FILE . '/instagram/' );
}
/*
* Global Helper funtions for Instagram module
*/
require ESF_INSTA_PLUGIN_DIR . 'includes/esf-insta-helper-functions.php';
if ( !class_exists( 'ESF_Insta_Skins' ) ) {
    /*
     * All Instagram skins
     */
    include ESF_INSTA_PLUGIN_DIR . 'admin/includes/class-esf-insta-skins.php';
}
/*
* Extend the Instagram customizer class
*/
require ESF_INSTA_PLUGIN_DIR . 'admin/includes/class-esf-insta-customizer-extend.php';
if ( !class_exists( 'ESF_Insta_Customizer' ) ) {
    /*
     * Instagram customizer
     */
    include ESF_INSTA_PLUGIN_DIR . 'admin/includes/class-esf-insta-customizer.php';
}
if ( !class_exists( 'ESF_Instagram_Admin' ) ) {
    /*
     * Instagram module admin dashoboard
     */
    include ESF_INSTA_PLUGIN_DIR . 'admin/class-easy-facebook-likebox-instagram-admin.php';
}
/*
* Instagram frontend modules
*/
require ESF_INSTA_PLUGIN_DIR . 'frontend/class-easy-facebook-likebox-instagram-frontend.php';