<?php 
/*
Template Name: Section - Intro
*/
// error_reporting(0);
?>

<!-- intro -->
<section id="intro">
    <div class="container" style="height:100%;">
    	<div class="row">

			<!-- portrait -->
			<div class="column column-6">
				<svg class="animated" data-animation="fadeIn" id="portrait" viewBox="0 0 200 200" style="overflow:visible;">
					<defs>
						<clipPath id="mask">
							<path d="" id="path"></path>
						</clipPath>
					</defs>
					<path class="float float1" fill="#ccc" d="M39.4,-18.4C44.5,2.9,37.6,22.6,21.3,36C5,49.4,-20.6,56.6,-40.8,44.7C-60.9,32.8,-75.5,1.7,-67.7,-23.2C-60,-48.1,-30,-66.9,-6.4,-64.8C17.2,-62.7,34.3,-39.7,39.4,-18.4Z" style="transform: scale(0.7) translate(25%, 25%);" />
					<path class="float float2" fill="#7c96b2" d="M52.3,-41.3C63.3,-28,64.4,-6.5,59.6,13.1C54.7,32.7,43.7,50.4,28,57.9C12.2,65.5,-8.4,62.8,-29.5,55.1C-50.6,47.3,-72.3,34.4,-77.3,16.5C-82.3,-1.4,-70.6,-24.2,-55,-38.5C-39.3,-52.9,-19.7,-58.7,0.5,-59.2C20.7,-59.6,41.4,-54.5,52.3,-41.3Z" style="transform: scale(0.6) translate(150%, 140%);" />
					<image clip-path="url(#mask)" height="100%" width="100%" href="wp-content/themes/benmiles-wp/img/ben-miles_portrait_IMG-1724_sq.jpg" />
				</svg>
			</div>

			<!-- info -->
			<div class="column column-6">
				<div class="animated" data-animation="fadeInUp"><?php echo displaySVG('ben-miles_logo'); ?></div>
				<h1 class="site-title animated" data-animation="fadeInUp" style="animation-delay: .1s;">Ben Miles</h2>
				<h2 class="site-description animated" data-animation="fadeInUp" style="animation-delay: .2s;">Graphic Designer & <br>Full-Stack Web Developer</h2>
				<ul class="social-media">
					<li class="animated" data-animation="fadeInUp" style="animation-delay: .3s;">
						<a href="https://www.linkedin.com/in/benjaminmiles/" target="_blank">
							<?php echo displaySVG('linkedin'); ?>
						</a>
					</li>
					<li class="animated" data-animation="fadeInUp" style="animation-delay: .4s;">
						<a href="https://codepen.io/benmiles/" target="_blank">
							<?php echo displaySVG('codepen'); ?>
						</a>
					</li>
					<li class="animated" data-animation="fadeInUp" style="animation-delay: .5s;">
						<a href="https://github.com/ben-miles" target="_blank">
							<?php echo displaySVG('github'); ?>
						</a>
					</li>
				</ul>
				<a href="#about" target="_self" class="button cta animated" data-animation="fadeInUp" style="animation-delay: .5s;">
					<?php echo displaySVG('down', 'bounce'); ?>
				</a>
			</div>

		</div>
    </div>
</section>
<!-- / intro -->