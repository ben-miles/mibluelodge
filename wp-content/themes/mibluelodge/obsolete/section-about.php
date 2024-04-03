<?php 
/*
Template Name: Section - About
*/
// error_reporting(0);
?>

<!-- about -->
<section id="about">
	<div class="container" style="height:100%;">
		<div class="row">
			<div class="column column-12">

				<h2 class="heading animated" data-animation="fadeIn">About Ben Miles</h2>
				
				<?php 
				if( is_front_page() ){
					// Display this content on the Home Page ?>
					<div class="animated card" data-animation="fadeIn" style="animation-delay: .1s;">
						<p>I am a highly-skilled and creative individual, with a passion for functional design. I have over fifteen years of working experience in graphic design, and almost ten in full-stack web development.</p>
						<p>Combining my design and programming skills, I create interactive and engaging web sites and applications that not only look great, but also function intuitively.</p>
					</div>
					<div class="button-group">
						<a href="#portfolio" target="_self" class="button cta animated" data-animation="fadeInUp" style="animation-delay: .2s;"><span>My Work</span><?php echo displaySVG('down'); ?></a>
						<a href="<?php echo home_url(); ?>/about" target="_self" class="button cta secondary animated" data-animation="fadeInUp" style="animation-delay: .3s;"><span>More About Me</span><?php echo displaySVG('right'); ?></a>
					</div>
				<?php } else { 
					// Display this content on the About Page ?>
					<div class="animated card" data-animation="fadeIn" style="animation-delay: .1s;">
						<p>I am a highly-skilled and creative individual, with a passion for design and technology. I have over fifteen years of working experience in graphic design, and almost ten in full-stack web development.</p>
						<p>I started my career as a graphic designer, but I was always interested in the technical side of things. I taught myself how to make web sites, and eventually made the switch to a full-stack web development role.</p>
						<p>I've freelanced, started my own web and print design company, lead design and production departments in an international print shop chain, and developed a variety of new and legacy applications in multiple web agencies.</p>
						<p>Combining my design and programming skills, I create interactive and engaging web sites and applications that not only look great, but also function intuitively.</p>
						<p>Outside of work, you'll most likely find me gardening, homebrewing, or screen printing.</p>
					</div>
					<a href="#experience-and-skills" target="_self" class="button cta animated" data-animation="fadeInUp" style="animation-delay: .2s;"><span>Experience & Skills</span><?php echo displaySVG('down', 'bounce'); ?></a>
				<?php } ?>

            </div>
        </div>
    </div>
</section>
<!-- / about -->