<?php

/**
 * Title: Call to Action
 * Slug: blockverse/call-to-action-section
 * Categories: blockverse
 */
$blockverse_images = array(
    BLOCKVERSE_URL . 'assets/images/cta_img.jpg',
);
?>
<!-- wp:cover {"url":"<?php echo esc_url($blockverse_images[0]) ?>","id":706,"dimRatio":90,"overlayColor":"primary","minHeight":563,"minHeightUnit":"px","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
<div class="wp-block-cover" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:563px"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-90 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-706" alt="" src="<?php echo esc_url($blockverse_images[0]) ?>" data-object-fit="cover" />
    <div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"800px"}} -->
        <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|30"}},"textColor":"foreground-alt","layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
            <div class="wp-block-group has-foreground-alt-color has-text-color" style="border-radius:10px;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"normal"} -->
                <h5 class="wp-block-heading has-text-align-center has-normal-font-size" style="font-style:normal;font-weight:600">Call to Action</h5>
                <!-- /wp:heading -->

                <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"xxx-large"} -->
                <h1 class="wp-block-heading has-text-align-center has-xxx-large-font-size" style="font-style:normal;font-weight:600">Build together, Grow Together! </h1>
                <!-- /wp:heading -->

                <!-- wp:spacer {"height":"8px"} -->
                <div style="height:8px" aria-hidden="true" class="wp-block-spacer"></div>
                <!-- /wp:spacer -->

                <!-- wp:paragraph {"align":"center"} -->
                <p class="has-text-align-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh mauris, nec turpis orci lectus maecenas. Suspendisse sed magna eget nibh in turpis.</p>
                <!-- /wp:paragraph -->

                <!-- wp:spacer {"height":"20px"} -->
                <div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
                <!-- /wp:spacer -->

                <!-- wp:buttons -->
                <div class="wp-block-buttons"><!-- wp:button {"textColor":"background","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|70","bottom":"var:preset|spacing|40","left":"var:preset|spacing|70"}}},"className":"is-style-outline"} -->
                    <div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-background-color has-text-color wp-element-button" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--70)">Get Started Now</a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:cover -->