<?php 
/*
Template Name: 404
*/

get_header(null, ['bodyClass' => 'page-404']);
?>

<!-- 404 -->
<section id="error-404">
	<div class="container" style="height:100%;">
		<div class="row">
			<div class="column column-12">
				
				<!-- header -->
				<h2 class="heading animated" data-animation="fadeIn">404</h2>
				
				<!-- content -->
				<div class="animated card" style="animation-delay: .1s; text-align:center;" data-animation="fadeInUp">
					<p>Page not found.</p>
					<p>Go to <a href="<?php bloginfo('url'); ?>" target="_self">home page</a>?</p>
				</div>
				
			</div>	
		</div>
	</div>
</section>
<!-- / about -->

<?php get_footer(); ?>