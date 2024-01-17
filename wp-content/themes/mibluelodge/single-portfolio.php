<?php 
/*
Template Name: Single Portfolio
*/

get_header(null, ['bodyClass' => 'page-portfolio-item']);
$meta = [
	'Agency' => get_field( 'agency' ),
	'Client' => get_field( 'client' ),
	'Date' => get_the_date(),
	'URL' => get_field( 'url' )
];
?>

<!-- single-portfolio -->
<section id="single-portfolio">
    <div class="container">
    	<div class="row">

			<?php 
			// Start the loop.
			while(have_posts()) : the_post(); 
			?>

			<!-- Title -->
			<div class="column column-12">
				<h2 class="heading animated" data-animation="fadeIn"><?php the_title(); ?></h2>
			</div>
			
			<!-- Meta -->
			<div class="column column-12">
				<div class="post-meta">
					<?php 
						$animationDelay = 0;
						foreach($meta as $key => $value){
							if($value){
								if($key == 'URL'){
									$value = '<a href="' . $value . '" target="_blank" class="external-link">' . displaySVG('external-link') . urlToLabel( $value ) . '</a>';
								} else {
									$value = '<span>' . $value . '</span>';
								}
								echo "<div class='post-meta-item animated " . strtolower($key) . "' data-animation='fadeIn' style='animation-delay: " . $animationDelay . "s;'><h4 class='label'>" . $key . "</h4>" . $value . "</div>";
								$animationDelay += 0.1;
							}
						}
					?>
				</div>
			</div>
				
			<!-- Additional Images -->
			<div class="column column-6" style="justify-content: flex-start;">
				<div class="thumbnail animated" data-animation="fadeInUp">
					<?php the_post_thumbnail($post->ID,'small'); ?>
				</div>
				<div class="portfolio">
					<div class="row" style="width:auto;margin:0 -15px;">
						<?php 
						$images = acf_photo_gallery('additional_images', $post->ID);
						if( count($images) ):
							$animationDelay = 0;
							foreach($images as $image):
								$id = $image['id'];
								$title = $image['title'];
								$caption = $image['caption'];
								$full_image_url = $image['full_image_url'];
								$custom_thumbnail_image_url = acf_photo_gallery_resize_image($full_image_url, 360, 200);
						?>
						<div class="column column-6">
							<div class="portfolio-item animated" data-animation="fadeInUp" style="animation-delay: <?php echo $animationDelay; ?>s;">
								<a href="<?php echo $full_image_url; ?>" target="_blank" class="glightbox" data-glightbox="title: <?php echo $title; ?>; description: <?php echo $caption; ?>">
									<img src="<?php echo $custom_thumbnail_image_url; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>">
									<div class="meta"><?php echo $title; ?></div>
								</a>
							</div>
						</div>
						<?php 
						$animationDelay += 0.1;
						endforeach; 
						endif; 
						?>
					</div>
				</div>
			</div>
			
			<!-- Text -->
			<div class="column column-6" style="justify-content: flex-start;">
			<?php if( get_the_content() ){ ?>
				<div class="content animated" style="animation-delay: .1s;" data-animation="fadeIn">
					<?php the_content(); ?>
				</div>
			<?php } ?>
				<div class="categories animated" style="animation-delay: .2s;" data-animation="fadeIn">
					<h4 class="label">Categories</h4>
					<?php 
						$post_categories = get_the_category();
						if ( !empty( $post_categories ) ) {
							$animationDelay = 0;
							echo '<ul class="post-tags">';
							foreach( $post_categories as $post_category ) {
								echo '<li><a href="' . get_category_link( $post_category ) . '" class="animated" data-animation="fadeIn" style="animation-delay: ' . $animationDelay . 's;">' . $post_category->name . '</a></li>';
								$animationDelay += 0.1;
							}
							echo '</ul>';
						} 
					?>
				</div>
				<div class="tags animated" style="animation-delay: .3s;" data-animation="fadeIn">
					<h4 class="label">Tags</h4>
					<?php 
						$post_tags = get_the_tags();
						if ( !empty( $post_tags ) ) {
							$animationDelay = 0;
							echo '<ul class="post-tags">';
							foreach( $post_tags as $post_tag ) {
								echo '<li><a href="' . get_tag_link( $post_tag ) . '" class="animated" data-animation="fadeIn" style="animation-delay: ' . $animationDelay . 's;">' . $post_tag->name . '</a></li>';
								$animationDelay += 0.1;
							}
							echo '</ul>';
						} 
					?>
				</div>
			</div>

			<!-- Post Navigation -->
			<div class="column column-12">
				<?php 
				the_post_navigation(
					array(
						'next_text' => '<h4 class="label">Next: </h4>%title',
						'prev_text' => '<h4 class="label">Previous: </h4>%title',
						)
					);
				?>
			</div>

			<?php 
			// End the loop.
			endwhile;
			?>

		</div>
	</div>
</section>
<!-- / about -->

<!-- lightbox -->
<!-- <div id="lightbox">
	<div id="lightbox-inner">
		<button id="lightbox-close">&times;</button>
		<div id="lightbox-body"></div>
	</div>
</div> -->
<!-- / lightbox -->

<?php get_footer(); ?>