<?php 
/*
Template Name: Home
*/

get_header(null, ['bodyClass' => 'page-home']);
include('section-hero.php');
include('section-wm-message.php');
include('section-social-media.php');
include('section-calendar.php');
include('section-what-is-a-mason.php');
get_footer();
?>