<?php 
/*
Template Name: Home
*/

get_header(null, ['bodyClass' => 'page-home']);
include('section-intro.php');
include('section-about.php');
include('section-portfolio-featured.php');
include('section-contact.php');
get_footer();
?>