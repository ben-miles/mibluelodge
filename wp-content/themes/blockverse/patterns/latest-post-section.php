<?php

/**
 * Title: Latest Post Section
 * Slug: blockverse/latest-post-section
 * Categories: blockverse
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"5.83rem","bottom":"8rem","right":"var:preset|spacing|30","left":"var:preset|spacing|30"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group" style="padding-top:5.83rem;padding-right:var(--wp--preset--spacing--30);padding-bottom:8rem;padding-left:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","letterSpacing":"2px"}},"textColor":"primary","fontSize":"normal"} -->
        <h5 class="wp-block-heading has-text-align-center has-primary-color has-text-color has-normal-font-size" style="font-style:normal;font-weight:700;letter-spacing:2px;text-transform:uppercase">Blogs</h5>
        <!-- /wp:heading -->

        <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"xxx-large"} -->
        <h1 class="wp-block-heading has-text-align-center has-xxx-large-font-size" style="font-style:normal;font-weight:500">From our Blogs and Articles</h1>
        <!-- /wp:heading -->
    </div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"10px"} -->
    <div style="height:10px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:query {"queryId":56,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"flex","columns":3}} -->
    <div class="wp-block-query"><!-- wp:post-template -->
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40","padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:post-featured-image {"isLink":true,"height":"280px","overlayColor":"foreground","dimRatio":10,"align":"wide","style":{"border":{"radius":"5px"}}} /-->

            <!-- wp:post-terms {"term":"category","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"},"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"className":"is-style-categories-background-with-round"} /-->

            <!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"28px"}},"textColor":"foreground","className":"is-style-title-hover-primary-color"} /-->

            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group"><!-- wp:post-author-name {"style":{"typography":{"textTransform":"capitalize"}},"textColor":"light-gray"} /-->

                <!-- wp:post-date {"textColor":"light-gray"} /-->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
        <!-- /wp:post-template -->
    </div>
    <!-- /wp:query -->
</div>
<!-- /wp:group -->