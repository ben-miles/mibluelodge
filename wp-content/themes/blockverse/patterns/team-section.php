<?php

/**
 * Title: Team Section
 * Slug: blockverse/team-section
 * Categories: blockverse
 */
$blockverse_images = array(
    BLOCKVERSE_URL . 'assets/images/team_1.jpg',
    BLOCKVERSE_URL . 'assets/images/team_2.jpg',
    BLOCKVERSE_URL . 'assets/images/team_3.jpg',
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"5.83rem","bottom":"7rem","right":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group" style="padding-top:5.83rem;padding-right:var(--wp--preset--spacing--40);padding-bottom:7rem;padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"xxx-large"} -->
        <h1 class="wp-block-heading has-text-align-center has-xxx-large-font-size" style="font-style:normal;font-weight:600">Meet our Team</h1>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh mauris, nec turpis orci lectus maecenas. Suspendisse sed magna eget nibh in turpis.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","right":"var:preset|spacing|40","left":"var:preset|spacing|40"},"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
    <div class="wp-block-columns" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:column {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
        <div class="wp-block-column" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"url":"<?php echo esc_url($blockverse_images[0]) ?>","id":247,"dimRatio":50,"minHeight":450,"customGradient":"linear-gradient(180deg,rgba(0,0,0,0) 0%,rgb(0,0,0) 74%)","contentPosition":"bottom center","isDark":false,"className":"is-style-default","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
            <div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center is-style-default" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:450px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgba(0,0,0,0) 0%,rgb(0,0,0) 74%)"></span><img class="wp-block-cover__image-background wp-image-247" alt="" src="<?php echo esc_url($blockverse_images[0]) ?>" data-object-fit="cover" />
                <div class="wp-block-cover__inner-container"><!-- wp:social-links {"customIconBackgroundColor":"#a3a3a357","iconBackgroundColorValue":"#a3a3a357","align":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|20","left":"var:preset|spacing|20"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
                    <ul class="wp-block-social-links aligncenter has-icon-background-color"><!-- wp:social-link {"url":"#","service":"instagram"} /-->

                        <!-- wp:social-link {"url":"#","service":"twitter"} /-->

                        <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
                    </ul>
                    <!-- /wp:social-links -->
                </div>
            </div>
            <!-- /wp:cover -->

            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|20","right":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"top"}} -->
            <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)"><!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"foreground","fontSize":"large"} -->
                <h4 class="wp-block-heading has-text-align-center has-foreground-color has-text-color has-large-font-size" style="font-style:normal;font-weight:500">Lora Junior M</h4>
                <!-- /wp:heading -->

                <!-- wp:heading {"textAlign":"center","level":5,"style":{"color":{"text":"#a3a3a3"}},"fontSize":"normal"} -->
                <h5 class="wp-block-heading has-text-align-center has-text-color has-normal-font-size" style="color:#a3a3a3">Marketing Lead</h5>
                <!-- /wp:heading -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:cover {"url":"<?php echo esc_url($blockverse_images[1]) ?>","id":262,"dimRatio":50,"minHeight":450,"customGradient":"linear-gradient(180deg,rgba(0,0,0,0) 0%,rgb(0,0,0) 74%)","contentPosition":"bottom center","className":"is-style-default","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
            <div class="wp-block-cover has-custom-content-position is-position-bottom-center is-style-default" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:450px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgba(0,0,0,0) 0%,rgb(0,0,0) 74%)"></span><img class="wp-block-cover__image-background wp-image-262" alt="" src="<?php echo esc_url($blockverse_images[1]) ?>" data-object-fit="cover" />
                <div class="wp-block-cover__inner-container"><!-- wp:social-links {"customIconBackgroundColor":"#a3a3a357","iconBackgroundColorValue":"#a3a3a357","align":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|20","left":"var:preset|spacing|20"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
                    <ul class="wp-block-social-links aligncenter has-icon-background-color"><!-- wp:social-link {"url":"#","service":"instagram"} /-->

                        <!-- wp:social-link {"url":"#","service":"twitter"} /-->

                        <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
                    </ul>
                    <!-- /wp:social-links -->
                </div>
            </div>
            <!-- /wp:cover -->

            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|20","right":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"top"}} -->
            <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)"><!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"foreground","fontSize":"large"} -->
                <h4 class="wp-block-heading has-text-align-center has-foreground-color has-text-color has-large-font-size" style="font-style:normal;font-weight:500">Peter H</h4>
                <!-- /wp:heading -->

                <!-- wp:heading {"textAlign":"center","level":5,"style":{"color":{"text":"#a3a3a3"}},"fontSize":"normal"} -->
                <h5 class="wp-block-heading has-text-align-center has-text-color has-normal-font-size" style="color:#a3a3a3">Marketing Lead</h5>
                <!-- /wp:heading -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:cover {"url":"<?php echo esc_url($blockverse_images[2]) ?>","id":259,"dimRatio":50,"minHeight":450,"customGradient":"linear-gradient(180deg,rgba(0,0,0,0) 0%,rgb(0,0,0) 74%)","contentPosition":"bottom center","isDark":false,"className":"is-style-default","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
            <div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center is-style-default" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:450px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgba(0,0,0,0) 0%,rgb(0,0,0) 74%)"></span><img class="wp-block-cover__image-background wp-image-259" alt="" src="<?php echo esc_url($blockverse_images[2]) ?>" data-object-fit="cover" />
                <div class="wp-block-cover__inner-container"><!-- wp:social-links {"customIconBackgroundColor":"#a3a3a357","iconBackgroundColorValue":"#a3a3a357","align":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|20","left":"var:preset|spacing|20"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
                    <ul class="wp-block-social-links aligncenter has-icon-background-color"><!-- wp:social-link {"url":"#","service":"instagram"} /-->

                        <!-- wp:social-link {"url":"#","service":"twitter"} /-->

                        <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
                    </ul>
                    <!-- /wp:social-links -->
                </div>
            </div>
            <!-- /wp:cover -->

            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|20","right":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"top"}} -->
            <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)"><!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"foreground","fontSize":"large"} -->
                <h4 class="wp-block-heading has-text-align-center has-foreground-color has-text-color has-large-font-size" style="font-style:normal;font-weight:500">Liyana M</h4>
                <!-- /wp:heading -->

                <!-- wp:heading {"textAlign":"center","level":5,"style":{"color":{"text":"#a3a3a3"}},"fontSize":"normal"} -->
                <h5 class="wp-block-heading has-text-align-center has-text-color has-normal-font-size" style="color:#a3a3a3">Marketing Lead</h5>
                <!-- /wp:heading -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->