<?php 
/*
Template Name: Archive
*/

$category =	$tag = null;
if ( is_tag() ) {
	$meta_type = 'Tag';
	$meta_key = get_tag( get_query_var( 'tag_id' ) );
	$meta_description = '<p>' . $meta_key->description . '</p>';
	$tag = $meta_key->slug;
}
if ( is_category() ) {
	$meta_type = 'Category';
	$meta_key = get_category( get_query_var( 'cat' ) );
	// var_dump($meta_key);
	$meta_description = '<p>' . $meta_key->description . '</p>';
	$category = $meta_key->slug;
}

get_header(null, ['bodyClass' => 'page-archive']);
?>

<!-- archive -->
<section id="archive">
	<div class="container" style="height:100%;">
		<div class="row">
			<div class="column column-12">

				<h2 class="heading animated" data-animation="fadeIn">
					<?php echo $meta_type . ': ' . $meta_key->name; ?>
				</h2>

				<div id="meta-description">
					<?php echo $meta_description; ?>
				</div>

				<!-- gallery -->
				<div class="row">
					<?php getPortfolioItems($category,$tag); ?>
				</div>
				<!-- / gallery -->

			</div>
		</div>
	</div>
</section>
<!-- / archive -->

<?php get_footer(); ?>