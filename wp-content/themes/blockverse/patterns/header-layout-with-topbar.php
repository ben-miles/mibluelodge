<?php

/**
 * Title: Header with Topbar
 * Slug: blockverse/header-layout-width-topbar
 * Categories: blockverse, header
 */
$blockverse_images = array(
    BLOCKVERSE_URL . 'assets/images/blockverse_logo.png',
);
?>
<!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30"}},"border":{"bottom":{"color":"#f0f0f0","width":"1px"}}},"className":"is-style-default","layout":{"type":"constrained","contentSize":"1200px"}} -->
    <div class="wp-block-group is-style-default" style="border-bottom-color:#f0f0f0;border-bottom-width:1px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
        <div class="wp-block-group"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"}} -->
            <div class="wp-block-group"><!-- wp:list {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}}},"className":"is-style-hide-bullet-list-link-hover-style-secondary"} -->
                <ul class="is-style-hide-bullet-list-link-hover-style-secondary has-link-color" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:list-item -->
                    <li><a href="#">+1 (012) 345-6789</a></li>
                    <!-- /wp:list-item -->
                </ul>
                <!-- /wp:list -->

                <!-- wp:paragraph -->
                <p>|</p>
                <!-- /wp:paragraph -->

                <!-- wp:list {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}}},"className":"is-style-hide-bullet-list-link-hover-style-secondary"} -->
                <ul class="is-style-hide-bullet-list-link-hover-style-secondary has-link-color" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:list-item -->
                    <li><a href="mailto:email@yoursite.com">email@yoursite.com</a></li>
                    <!-- /wp:list-item -->
                </ul>
                <!-- /wp:list -->
            </div>
            <!-- /wp:group -->

            <!-- wp:social-links {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|20","left":"var:preset|spacing|20"}}},"layout":{"type":"flex","justifyContent":"right"}} -->
            <ul class="wp-block-social-links"><!-- wp:social-link {"url":"#","service":"instagram"} /-->

                <!-- wp:social-link {"url":"#","service":"facebook"} /-->

                <!-- wp:social-link {"url":"#","service":"twitter"} /-->

                <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
            </ul>
            <!-- /wp:social-links -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|30","bottom":"var:preset|spacing|50","left":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
    <div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--30)"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
        <div class="wp-block-group"><!-- wp:image {"id":10,"width":200,"sizeSlug":"full","linkDestination":"custom"} -->
            <figure class="wp-block-image size-full is-resized"><a href="./"><img src="<?php echo esc_url($blockverse_images[0]) ?>" alt="" class="wp-image-10" width="200" /></a></figure>
            <!-- /wp:image -->

            <!-- wp:navigation -->
            <!-- wp:page-list /-->
            <!-- /wp:navigation -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->