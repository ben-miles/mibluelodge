<?php

/**
 * Title: Project Showcase
 * Slug: blockverse/project-showcase
 * Categories: blockverse
 */
$blockverse_images = array(
    BLOCKVERSE_URL . 'assets/images/product_1.jpg',
    BLOCKVERSE_URL . 'assets/images/product_2.jpg',
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"7rem","top":"7.5rem","right":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"backgroundColor":"nutral","layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group has-nutral-background-color has-background" style="padding-top:7.5rem;padding-right:var(--wp--preset--spacing--40);padding-bottom:7rem;padding-left:var(--wp--preset--spacing--40)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|80","left":"7rem"},"padding":{"bottom":"var:preset|spacing|80"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-center" style="padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
            <div class="wp-block-group"><!-- wp:heading {"level":5,"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","letterSpacing":"2px"}},"textColor":"primary","fontSize":"small"} -->
                <h5 class="wp-block-heading has-primary-color has-text-color has-small-font-size" style="font-style:normal;font-weight:600;letter-spacing:2px;text-transform:uppercase">Our Products</h5>
                <!-- /wp:heading -->

                <!-- wp:heading {"level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"textColor":"foreground","fontSize":"xxx-large"} -->
                <h1 class="wp-block-heading has-foreground-color has-text-color has-xxx-large-font-size" style="margin-top:var(--wp--preset--spacing--30);font-style:normal;font-weight:600">ERP &amp; CRM Development</h1>
                <!-- /wp:heading -->
            </div>
            <!-- /wp:group -->

            <!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} -->
            <p style="margin-bottom:var(--wp--preset--spacing--60)">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons -->
            <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"primary","textColor":"foreground-alt","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|50","bottom":"var:preset|spacing|30","left":"var:preset|spacing|50"}}},"className":"is-style-button-hover-secondary-bgcolor"} -->
                <div class="wp-block-button is-style-button-hover-secondary-bgcolor"><a class="wp-block-button__link has-foreground-alt-color has-primary-background-color has-text-color has-background wp-element-button" href="#" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--50)">Read More</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"id":22,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"10px"}}} -->
            <figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url($blockverse_images[0]) ?>" alt="" class="wp-image-22" style="border-radius:10px" /></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->

    <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|80","left":"7rem"},"margin":{"top":"7rem"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-center" style="margin-top:7rem"><!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"id":23,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"10px"}}} -->
            <figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url($blockverse_images[1]) ?>" alt="" class="wp-image-23" style="border-radius:10px" /></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
            <div class="wp-block-group"><!-- wp:heading {"level":5,"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","letterSpacing":"2px"}},"textColor":"primary","fontSize":"small"} -->
                <h5 class="wp-block-heading has-primary-color has-text-color has-small-font-size" style="font-style:normal;font-weight:600;letter-spacing:2px;text-transform:uppercase">Our Products</h5>
                <!-- /wp:heading -->

                <!-- wp:heading {"level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"textColor":"foreground","fontSize":"xxx-large"} -->
                <h1 class="wp-block-heading has-foreground-color has-text-color has-xxx-large-font-size" style="margin-top:var(--wp--preset--spacing--40);font-style:normal;font-weight:600">Blockverse Chatbot</h1>
                <!-- /wp:heading -->
            </div>
            <!-- /wp:group -->

            <!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} -->
            <p style="margin-bottom:var(--wp--preset--spacing--60)">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons -->
            <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"primary","textColor":"foreground-alt","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|50","bottom":"var:preset|spacing|30","left":"var:preset|spacing|50"}}},"className":"is-style-button-hover-secondary-bgcolor"} -->
                <div class="wp-block-button is-style-button-hover-secondary-bgcolor"><a class="wp-block-button__link has-foreground-alt-color has-primary-background-color has-text-color has-background wp-element-button" href="#" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--50)">Read More</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->