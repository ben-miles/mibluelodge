<?php

/**
 * Title: Hero Section 
 * Slug: blockverse/hero-section
 * Categories: blockverse
 */
$blockverse_images = array(
    BLOCKVERSE_URL . 'assets/images/banner_image.jpg',
);
?>
<!-- wp:cover {"url":"<?php echo esc_url($blockverse_images[0]) ?>","id":11,"dimRatio":70,"overlayColor":"primary","minHeight":860} -->
<div class="wp-block-cover" style="min-height:860px"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-70 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-11" alt="" src="<?php echo esc_url($blockverse_images[0]) ?>" data-object-fit="cover" />
    <div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"900px"}} -->
        <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|80","left":"var:preset|spacing|80"}}}} -->
            <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"100%","style":{"spacing":{"blockGap":"var:preset|spacing|50","padding":{"top":"1.5rem"}}}} -->
                <div class="wp-block-column is-vertically-aligned-center" style="padding-top:1.5rem;flex-basis:100%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":6,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","textTransform":"uppercase","letterSpacing":"2px"}},"textColor":"light-shade","fontSize":"x-small"} -->
                        <h6 class="wp-block-heading has-text-align-center has-light-shade-color has-text-color has-x-small-font-size" style="font-style:normal;font-weight:600;letter-spacing:2px;text-transform:uppercase">Welcome to BlockVerse</h6>
                        <!-- /wp:heading -->

                        <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":1.4,"fontSize":"4em"}},"textColor":"background"} -->
                        <h1 class="wp-block-heading has-text-align-center has-background-color has-text-color" style="font-size:4em;font-style:normal;font-weight:600;line-height:1.4">The Ultimate Partner for Your Digital Solution.</h1>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":1.6}},"textColor":"background"} -->
                    <p class="has-text-align-center has-background-color has-text-color" style="line-height:1.6">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"var:preset|spacing|70"}}},"fontSize":"normal"} -->
                    <div class="wp-block-buttons has-custom-font-size has-normal-font-size" style="margin-top:var(--wp--preset--spacing--70);font-style:normal;font-weight:500"><!-- wp:button {"textColor":"foreground-alt","style":{"spacing":{"padding":{"left":"var:preset|spacing|50","right":"var:preset|spacing|50","top":"1.1rem","bottom":"1.1rem"}}},"className":"is-style-outline"} -->
                        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-foreground-alt-color has-text-color wp-element-button" href="#" style="padding-top:1.1rem;padding-right:var(--wp--preset--spacing--50);padding-bottom:1.1rem;padding-left:var(--wp--preset--spacing--50)">Create Free Account</a></div>
                        <!-- /wp:button -->

                        <!-- wp:button {"backgroundColor":"foreground-alt","textColor":"background-alt","style":{"spacing":{"padding":{"left":"var:preset|spacing|50","right":"var:preset|spacing|50","top":"1.2rem","bottom":"1.2rem"}}},"className":"is-style-button-hover-secondary-bgcolor"} -->
                        <div class="wp-block-button is-style-button-hover-secondary-bgcolor"><a class="wp-block-button__link has-background-alt-color has-foreground-alt-background-color has-text-color has-background wp-element-button" href="#" style="padding-top:1.2rem;padding-right:var(--wp--preset--spacing--50);padding-bottom:1.2rem;padding-left:var(--wp--preset--spacing--50)">Get Started Today</a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->

                    <!-- wp:spacer {"height":"10px"} -->
                    <div style="height:10px" aria-hidden="true" class="wp-block-spacer"></div>
                    <!-- /wp:spacer -->
                </div>
                <!-- /wp:column -->
            </div>
            <!-- /wp:columns -->
        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:cover -->