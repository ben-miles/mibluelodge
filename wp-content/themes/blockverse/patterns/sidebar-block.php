<?php

/**
 * Title: Sidebar Block
 * Slug: blockverse/sidebar-block
 * Categories: blockverse
 */
$blockverse_images = array(
    BLOCKVERSE_URL . 'assets/images/testimonial_1.jpg',
);
?>
<!-- wp:group {"tagName":"aside","className":"blockverse-sidebar","layout":{"type":"constrained"}} -->
<aside class="wp-block-group blockverse-sidebar">
    <!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Search the site...","buttonText":"Search","buttonPosition":"button-inside","buttonUseIcon":true,"style":{"border":{"radius":"5px"}},"borderColor":"light-shade","fontSize":"normal"} /-->

    <!-- wp:group {"style":{"border":{"radius":"7px","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|70","right":"var:preset|spacing|50","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50"}}},"borderColor":"light-shade","layout":{"type":"constrained"}} -->
    <div class="wp-block-group has-border-color has-light-shade-border-color" style="border-width: 1px; border-radius: 7px; padding-top: var(--wp--preset--spacing--70); padding-right: var(--wp--preset--spacing--50); padding-bottom: var(--wp--preset--spacing--70); padding-left: var(--wp--preset--spacing--50)">
        <!-- wp:image {"align":"center","id":228,"width":100,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"100px"}}} -->
        <figure class="wp-block-image aligncenter size-full is-resized has-custom-border"><img src="<?php echo esc_url($blockverse_images[0]) ?>" alt="" class="wp-image-228" style="border-radius: 100px" width="100" /></figure>
        <!-- /wp:image -->

        <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"large"} -->
        <h3 class="wp-block-heading has-text-align-center has-large-font-size" style="font-style: normal; font-weight: 500">Emma L</h3>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center">Check out our new&nbsp;font generatorand level up your social bios. Need more? Head over to Glyphy for all the&nbsp;fancy fonts&nbsp;and&nbsp;cool symbols&nbsp;you could ever imagine.</p>
        <!-- /wp:paragraph -->

        <!-- wp:social-links {"layout":{"type":"flex","justifyContent":"center"}} -->
        <ul class="wp-block-social-links">
            <!-- wp:social-link {"url":"#","service":"instagram"} /-->

            <!-- wp:social-link {"url":"#","service":"twitter"} /-->

            <!-- wp:social-link {"url":"#","service":"spotify"} /-->
        </ul>
        <!-- /wp:social-links -->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"layout":{"type":"constrained"}} -->
    <div class="wp-block-group">
        <!-- wp:heading {"level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
        <h4 class="wp-block-heading" style="font-style: normal; font-weight: 500">Categories</h4>
        <!-- /wp:heading -->

        <!-- wp:categories {"className":"is-style-blockverse-categories-bullet-hide-style","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} /-->
    </div>
    <!-- /wp:group -->
</aside>
<!-- /wp:group -->