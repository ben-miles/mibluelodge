<?php 
/*
Template Name: Home
*/

get_header(null, ['bodyClass' => 'page-home']);
include('section-hero.php');
include('section-wm-message.php');
include('section-social-media.php');
include('section-calendar.php');
get_footer();
?>