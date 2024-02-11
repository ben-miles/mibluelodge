<?php 
/*
Template Name: Section - Social Media
*/
// error_reporting(0);
?>

<!-- hero -->
<section id="social-media">
    <div class="container">
    	<div class="row">
			<div class="col-12">
				<h1 class="title">Connect</h1>
				<h2 class="subtitle">Follow us on social media</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-3">
				<div class="bg-dark" style="height:300px;">&nbsp;</div>
			</div>
			<div class="col-3">
				<div class="bg-dark" style="height:300px;">&nbsp;</div>
			</div>
			<div class="col-3">
				<div class="bg-dark" style="height:300px;">&nbsp;</div>
			</div>
			<div class="col-3">
				<div class="bg-dark" style="height:300px;">&nbsp;</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<div class="social-media">
					<?php wp_nav_menu(['container' => false, 'menu_class' => 'navbar-nav ms-auto mb-2 mb-lg-0', 'theme_location' => 'social', 'walker' => new WP_Bootstrap_Navwalker()]); ?>
				</div>
			</div>
		</div>
    </div>
</section>
<!-- / hero -->