<?php

/**
 * Title: Brand Logos Block
 * Slug: blockverse/brand-logos-block
 * Categories: blockverse
 */
$blockverse_images = array(
    BLOCKVERSE_URL . 'assets/images/logo_1.png',
    BLOCKVERSE_URL . 'assets/images/logo_2.png',
    BLOCKVERSE_URL . 'assets/images/logo_3.png',
    BLOCKVERSE_URL . 'assets/images/logo_4.png',
    BLOCKVERSE_URL . 'assets/images/logo_5.png',
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"4rem","top":"7rem","right":"var:preset|spacing|40","left":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"nutral","className":"blockverse-brand-logos","layout":{"type":"constrained","contentSize":"1060px"}} -->
<div class="wp-block-group blockverse-brand-logos has-nutral-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:7rem;padding-right:var(--wp--preset--spacing--40);padding-bottom:4rem;padding-left:var(--wp--preset--spacing--40)"><!-- wp:gallery {"columns":5,"imageCrop":false,"linkTo":"none","sizeSlug":"full","className":"blockverse-brand-logos is-style-enable-grayscale-mode-on-image"} -->
    <figure class="wp-block-gallery has-nested-images columns-5 blockverse-brand-logos is-style-enable-grayscale-mode-on-image"><!-- wp:image {"id":6,"sizeSlug":"full","linkDestination":"none"} -->
        <figure class="wp-block-image size-full"><img src="<?php echo esc_url($blockverse_images[0]) ?>" alt="" class="wp-image-6" /></figure>
        <!-- /wp:image -->

        <!-- wp:image {"id":8,"sizeSlug":"full","linkDestination":"none"} -->
        <figure class="wp-block-image size-full"><img src="<?php echo esc_url($blockverse_images[1]) ?>" alt="" class="wp-image-8" /></figure>
        <!-- /wp:image -->

        <!-- wp:image {"id":9,"sizeSlug":"full","linkDestination":"none"} -->
        <figure class="wp-block-image size-full"><img src="<?php echo esc_url($blockverse_images[2]) ?>" alt="" class="wp-image-9" /></figure>
        <!-- /wp:image -->

        <!-- wp:image {"id":7,"sizeSlug":"full","linkDestination":"none"} -->
        <figure class="wp-block-image size-full"><img src="<?php echo esc_url($blockverse_images[3]) ?>" alt="" class="wp-image-7" /></figure>
        <!-- /wp:image -->

        <!-- wp:image {"id":10,"sizeSlug":"full","linkDestination":"none"} -->
        <figure class="wp-block-image size-full"><img src="<?php echo esc_url($blockverse_images[4]) ?>" alt="" class="wp-image-10" /></figure>
        <!-- /wp:image -->
    </figure>
    <!-- /wp:gallery -->
</div>
<!-- /wp:group -->