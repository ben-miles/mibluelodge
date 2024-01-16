<?php

/**
 * Title: Testimonial Block 2
 * Slug: blockverse/testimonial-layout-style-two
 * Categories: blockverse
 */
$blockverse_images = array(
    BLOCKVERSE_URL . 'assets/images/testimonial_1.jpg',
    BLOCKVERSE_URL . 'assets/images/testimonial_2.jpg',
    BLOCKVERSE_URL . 'assets/images/testimonial_3.jpg',
    BLOCKVERSE_URL . 'assets/images/star_icon.png',
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"5.83rem","bottom":"8rem","right":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group" style="padding-top:5.83rem;padding-right:var(--wp--preset--spacing--40);padding-bottom:8rem;padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","letterSpacing":"2px"}},"textColor":"primary","fontSize":"normal"} -->
    <h5 class="wp-block-heading has-text-align-center has-primary-color has-text-color has-normal-font-size" style="font-style:normal;font-weight:700;letter-spacing:2px;text-transform:uppercase">Testimonials</h5>
    <!-- /wp:heading -->

    <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"xxx-large"} -->
    <h1 class="wp-block-heading has-text-align-center has-xxx-large-font-size" style="font-style:normal;font-weight:500">Client’s Thoughts Towards Us</h1>
    <!-- /wp:heading -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"},"margin":{"top":"var:preset|spacing|70"}}}} -->
    <div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","right":"var:preset|spacing|50","bottom":"2rem","left":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"5px"}},"backgroundColor":"nutral","className":"is-style-default","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-default has-nutral-background-color has-background" style="border-radius:5px;padding-top:2rem;padding-right:var(--wp--preset--spacing--50);padding-bottom:2rem;padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"left","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} -->
                <h4 class="wp-block-heading has-text-align-left has-medium-font-size" style="font-style:normal;font-weight:500">It was a very good experience</h4>
                <!-- /wp:heading -->

                <!-- wp:image {"id":237,"width":100,"sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($blockverse_images[3]) ?>" alt="" class="wp-image-237" width="100" /></figure>
                <!-- /wp:image -->

                <!-- wp:paragraph {"align":"left"} -->
                <p class="has-text-align-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh mauris, nec turpis orci lectus maecenas. Suspendisse sed magna</p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40)"><!-- wp:image {"id":228,"width":60,"height":60,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"55px"}}} -->
                    <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($blockverse_images[0]) ?>" alt="" class="wp-image-228" style="border-radius:55px" width="60" height="60" /></figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"0"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} -->
                    <div class="wp-block-group" style="margin-top:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:heading {"textAlign":"left","level":5,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"medium"} -->
                        <h5 class="wp-block-heading has-text-align-left has-medium-font-size" style="font-style:normal;font-weight:600">Lexy T</h5>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"align":"left","textColor":"light-gray","fontSize":"small"} -->
                        <p class="has-text-align-left has-light-gray-color has-text-color has-small-font-size">UI/UX Designer</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","right":"var:preset|spacing|50","bottom":"2rem","left":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"5px"}},"backgroundColor":"nutral","className":"is-style-default","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-default has-nutral-background-color has-background" style="border-radius:5px;padding-top:2rem;padding-right:var(--wp--preset--spacing--50);padding-bottom:2rem;padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"left","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} -->
                <h4 class="wp-block-heading has-text-align-left has-medium-font-size" style="font-style:normal;font-weight:500">It was a very good experience</h4>
                <!-- /wp:heading -->

                <!-- wp:image {"id":237,"width":100,"sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($blockverse_images[3]) ?>" alt="" class="wp-image-237" width="100" /></figure>
                <!-- /wp:image -->

                <!-- wp:paragraph {"align":"left"} -->
                <p class="has-text-align-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh mauris, nec turpis orci lectus maecenas. Suspendisse sed magna</p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40)"><!-- wp:image {"id":14,"width":60,"height":60,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"55px"}}} -->
                    <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($blockverse_images[1]) ?>" alt="" class="wp-image-14" style="border-radius:55px" width="60" height="60" /></figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"0"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} -->
                    <div class="wp-block-group" style="margin-top:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:heading {"textAlign":"left","level":5,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"medium"} -->
                        <h5 class="wp-block-heading has-text-align-left has-medium-font-size" style="font-style:normal;font-weight:600">Lexy T</h5>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"align":"left","textColor":"light-gray","fontSize":"small"} -->
                        <p class="has-text-align-left has-light-gray-color has-text-color has-small-font-size">UI/UX Designer</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","right":"var:preset|spacing|50","bottom":"2rem","left":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"5px"}},"backgroundColor":"nutral","className":"is-style-default","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-default has-nutral-background-color has-background" style="border-radius:5px;padding-top:2rem;padding-right:var(--wp--preset--spacing--50);padding-bottom:2rem;padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"left","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} -->
                <h4 class="wp-block-heading has-text-align-left has-medium-font-size" style="font-style:normal;font-weight:500">It was a very good experience</h4>
                <!-- /wp:heading -->

                <!-- wp:image {"id":237,"width":100,"sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($blockverse_images[3]) ?>" alt="" class="wp-image-237" width="100" /></figure>
                <!-- /wp:image -->

                <!-- wp:paragraph {"align":"left"} -->
                <p class="has-text-align-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh mauris, nec turpis orci lectus maecenas. Suspendisse sed magna</p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40)"><!-- wp:image {"id":15,"width":60,"height":60,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"55px"}}} -->
                    <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($blockverse_images[2]) ?>" alt="" class="wp-image-15" style="border-radius:55px" width="60" height="60" /></figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"0"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} -->
                    <div class="wp-block-group" style="margin-top:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:heading {"textAlign":"left","level":5,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"medium"} -->
                        <h5 class="wp-block-heading has-text-align-left has-medium-font-size" style="font-style:normal;font-weight:600">Lexy T</h5>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"align":"left","textColor":"light-gray","fontSize":"small"} -->
                        <p class="has-text-align-left has-light-gray-color has-text-color has-small-font-size">UI/UX Designer</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->