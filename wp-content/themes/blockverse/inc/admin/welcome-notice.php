<?php

/**
 * file for holding dashboard welcome page for theme
 */
if (!function_exists('blockverse_is_plugin_installed')) {
    function blockverse_is_plugin_installed($plugin_slug)
    {
        $plugin_path = WP_PLUGIN_DIR . '/' . $plugin_slug;
        return file_exists($plugin_path);
    }
}
if (!function_exists('blockverse_is_plugin_activated')) {
    function blockverse_is_plugin_activated($plugin_slug)
    {
        return is_plugin_active($plugin_slug);
    }
}
if (!function_exists('blockverse_welcome_notice')) :
    function blockverse_welcome_notice()
    {
        global $pagenow;
        $meta            = get_option('blockverse-welcome-notice-update');
        $current_screen  = get_current_screen();

        if (is_admin() && !$meta) {
            if ($current_screen->id !== 'dashboard' && $current_screen->id !== 'themes') {
                return;
            }
            if (is_network_admin()) {
                return;
            }
            if (!current_user_can('manage_options')) {
                return;
            }
            $theme = wp_get_theme();

            if (is_child_theme()) {
                $theme = wp_get_theme()->parent();
            }
            $blockverse_version = $theme->get('Version');


?>
            <div class="blockverse-admin-notice notice notice-info is-dismissible content-install-plugin theme-info-notice">
                <div class="info-content">
                    <h5><span class="theme-name"><span><?php echo __('Welcome to BlockVerse', 'blockverse'); ?></span></h5>
                    <h1><?php echo __('Congratulations! BlockVerse has been installed and ready to build your website!', 'blockverse'); ?></h1>
                    </h3>
                    <p class="notice-text"><?php echo __('Please install and activate all recommended pluign to import the demo with "one click demo import" feature.', 'blockverse') ?></p>
                    <h3><?php echo __('Required Plugins', 'blockverse'); ?></h3>
                    <ul class="blockverse-required-plugin">
                        <li>

                            <h4><?php echo __('1.  Walker Core', 'blockverse'); ?>
                                <?php
                                if (blockverse_is_plugin_activated('walker-core/walker-core.php')) {
                                    echo __(': Plugin has been already activated!', 'blockverse');
                                } elseif (blockverse_is_plugin_installed('walker-core/walker-core.php')) {
                                    echo __(': Plugin does not activated, Activate the plugin to use one click demo import and unlock premium features.', 'blockverse');
                                } else {
                                    echo ': <a href="' . get_admin_url() . 'plugin-install.php?tab=plugin-information&plugin=walker-core&TB_iframe=true&width=600&height=550">' . esc_html__('Install and Activate', 'blockverse') . '</a>';
                                }
                                ?>
                            </h4>
                        </li>
                        <li>
                            <h4><?php echo __('2. Advanced Import - Need only to use "one click demo import" features', 'blockverse'); ?>
                                <?php
                                if (blockverse_is_plugin_activated('advanced-import/advanced-import.php')) {
                                    echo __(': Plugin has been already activated!', 'blockverse');
                                } elseif (blockverse_is_plugin_installed('advanced-import/advanced-import.php')) {
                                    echo __(': Plugin does not activated, Activate the plugin to use one click demo import feature.', 'blockverse');
                                } else {
                                    echo ': <a href="' . get_admin_url() . 'plugin-install.php?tab=plugin-information&plugin=advanced-import&TB_iframe=true&width=600&height=550">' . esc_html__('Install and Activate', 'blockverse') . '</a>';
                                }
                                ?>
                            </h4>
                        </li>
                    </ul>
                    <a href="<?php echo admin_url(); ?>themes.php?page=about-blockverse" class="button admin-button info-button"><?php echo __('Explore blockverse', 'blockverse'); ?></a>
                    <a href="<?php echo admin_url(); ?>themes.php?blockverse-welcome-notice-update=true" class="admin-button dismiss-notice btn-notice-dismiss"><?php echo __('Dismiss Notice', 'blockverse'); ?></a>

                </div>

            </div>
    <?php
        }
    }
endif;
add_action('admin_notices', 'blockverse_welcome_notice');

if (!function_exists('blockverse_ignore_admin_notice')) :
    function blockverse_ignore_admin_notice()
    {
        if (isset($_GET['blockverse-welcome-notice-update']) && $_GET['blockverse-welcome-notice-update'] = 'true') {
            update_option('blockverse-welcome-notice-update', true);
        }
    }
endif;
add_action('admin_init', 'blockverse_ignore_admin_notice');


function blockverse_dashboard_menu()
{
    add_theme_page(esc_html__('BlockVerse', 'blockverse'), esc_html__('BlockVerse', 'blockverse'), 'edit_theme_options', 'about-blockverse', 'blockverse_theme_info_display');
}
add_action('admin_menu', 'blockverse_dashboard_menu');
function blockverse_theme_info_display()
{ ?>
    <div class="dashboard-about-blockverse">
        <h1> <?php echo __('Welcome to the BlockVerse - FSE WordPress Theme', 'blockverse') ?></h1>
        <p><?php echo __('BlockVerse is the multipurpose FSE theme which provides more than 10 home sections and 15+ beautiful patterns which is ready to build any type of functional website. With its minimal, clean design and powerful feature set, BlockVerse enables power to build any kinds of website and provides a wide range of valuable patterns, including hero/banner, about us, portfolio/project, call-to-action buttons, and customer testimonials, teams and more. BlockVerse is suitable for any niches whether  for your business, personal brand, or creative project or blogs and comes with more than 60+ beautiful premium patterns. Explore more about BlockVerse at https://walkerwp.com/blockverse/.', 'blockverse') ?></p>

        <h3 class="blockverse-baisc-guideline-header"><?php echo __('Basic Theme Setup', 'blockverse') ?></h3>
        <div class="blockverse-baisc-guideline">
            <div class="featured-box">
                <ul>
                    <li><strong><?php echo __('Setup Header Layout:', 'blockverse') ?></strong>
                        <ul>
                            <li> - <?php echo __('Go to Appearance -> Editor -> Template Parts -> Header:', 'blockverse') ?></li>
                            <li> - <?php echo __('click on Header > Click on Edit (Icon) > Add or Remove Requirend block/content as your requirement.:', 'blockverse') ?></li>
                            <li> - <?php echo __('Click on save to update your layout', 'blockverse') ?></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="featured-box">
                <ul>
                    <li><strong><?php echo __('Setup Footer Layout:', 'blockverse') ?></strong>
                        <ul>
                            <li> - <?php echo __('Go to Appearance -> Editor -> Template Parts -> Footer:', 'blockverse') ?></li>
                            <li> - <?php echo __('click on Footer > Click on Edit (Icon) > Add or Remove Requirend block/content as your requirement.:', 'blockverse') ?></li>
                            <li> - <?php echo __('Click on save to update your layout', 'blockverse') ?></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="featured-box">
                <ul>
                    <li><strong><?php echo __('Setup Templates like Homepage/404/Search/Page/Single and more templates Layout:', 'blockverse') ?></strong>
                        <ul>
                            <li> - <?php echo __('Go to Appearance -> Editor -> Templates:', 'blockverse') ?></li>
                            <li> - <?php echo __('click on Template(You need to edit/update) > Click on Edit (Icon) > Add or Remove Requirend block/content as your requirement.:', 'blockverse') ?></li>
                            <li> - <?php echo __('Click on save to update your layout', 'blockverse') ?></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <h3><?php echo __('Required Plugins', 'blockverse'); ?></h3>
        <p class="notice-text"><?php echo __('Please install and activate all recommended pluign to import the demo with "one click demo import" feature and unlock premium features!(for pro version)', 'blockverse') ?></p>
        <ul class="blockverse-required-plugin">
            <li>

                <h4><?php echo __('1.  Walker Core', 'blockverse'); ?>
                    <?php
                    if (blockverse_is_plugin_activated('walker-core/walker-core.php')) {
                        echo __(': Plugin has been already activated!', 'blockverse');
                    } elseif (blockverse_is_plugin_installed('walker-core/walker-core.php')) {
                        echo __(': Plugin does not activated, Activate the plugin to use one click demo import and unlock premium features.', 'blockverse');
                    } else {
                        echo ': <a href="' . get_admin_url() . 'plugin-install.php?tab=plugin-information&plugin=walker-core&TB_iframe=true&width=600&height=550">' . esc_html__('Install and Activate', 'blockverse') . '</a>';
                    }
                    ?>
                </h4>
            </li>
            <li>
                <h4><?php echo __('2. Advanced Import - Need only to use "one click demo import" features', 'blockverse'); ?>
                    <?php
                    if (blockverse_is_plugin_activated('advanced-import/advanced-import.php')) {
                        echo __(': Plugin has been already activated!', 'blockverse');
                    } elseif (blockverse_is_plugin_installed('advanced-import/advanced-import.php')) {
                        echo __(': Plugin does not activated, Activate the plugin to use one click demo import feature.', 'blockverse');
                    } else {
                        echo ': <a href="' . get_admin_url() . 'plugin-install.php?tab=plugin-information&plugin=advanced-import&TB_iframe=true&width=600&height=550">' . esc_html__('Install and Activate', 'blockverse') . '</a>';
                    }
                    ?>
                </h4>
            </li>
        </ul>
        <div class="featured-list">
            <div class="half-col free-features">
                <h3><?php echo __('BlockVerse Features (Free)', 'blockverse') ?></h3>
                <ul>
                    <li><strong> - <?php echo __('Offer 11 Home Sections and Patterns', 'blockverse') ?></strong>
                        <ul>
                            <li> <?php echo __('Hero section pattern', 'blockverse') ?></li>
                            <li> <?php echo __('About section pattern', 'blockverse') ?></li>
                            <li> <?php echo __('Service section pattern', 'blockverse') ?></li>
                            <li> <?php echo __('Team section pattern', 'blockverse') ?></li>
                            <li> <?php echo __('Testimonial section pattern', 'blockverse') ?></li>
                            <li> <?php echo __('Brands Logo section pattern', 'blockverse') ?></li>
                            <li> <?php echo __('CTA section pattern', 'blockverse') ?></li>
                            <li> <?php echo __('Pricing Table section pattern', 'blockverse') ?></li>
                            <li> <?php echo __('Project/Portfolio Section Pattern', 'blockverse') ?></li>
                            <li> <?php echo __('FAQ section pattern', 'blockverse') ?></li>
                            <li> <?php echo __('Blog section pattern', 'blockverse') ?></li>
                        </ul>
                    </li>

                    <li> <strong>- <?php echo __('15+ FSE Templates Ready', 'blockverse') ?></strong>
                        <ul>
                            <li> <?php echo __('404 Template', 'blockverse') ?></li>
                            <li> <?php echo __('Search Template', 'blockverse') ?></li>
                            <li> <?php echo __('Sitemap Template', 'blockverse') ?></li>
                            <li> <?php echo __('Page Template', 'blockverse') ?></li>
                            <li> <?php echo __('Left Sidebar Page Template', 'blockverse') ?></li>
                            <li> <?php echo __('Blank Template', 'blockverse') ?></li>
                            <li> <?php echo __('Full Width Page  Template', 'blockverse') ?></li>
                            <li> <?php echo __('Single Template', 'blockverse') ?></li>
                            <li> <?php echo __('Product Single Template', 'blockverse') ?></li>
                            <li> <?php echo __('Left Sidebar Single Template', 'blockverse') ?></li>
                            <li> <?php echo __('Archive Template', 'blockverse') ?></li>
                            <li> <?php echo __('WooCommerce ProductA rchive Template', 'blockverse') ?></li>
                            <li> <?php echo __('WooCommerce Cart Page Template', 'blockverse') ?></li>
                            <li> <?php echo __('WooCommerce Checkout Page Template', 'blockverse') ?></li>
                            <li> <?php echo __('WooCommerce Single Page Template', 'blockverse') ?></li>
                        </ul>
                    <li>
                    <li><strong> - <?php echo __('2 Header Layouts', 'blockverse') ?></strong></li>
                    <li> <strong>- <?php echo __('2 Footer Layouts', 'blockverse') ?></strong></li>
                    <li><strong> - <?php echo __('12+ Beautiful Fonts Option', 'blockverse') ?></strong></li>
                    <li> <strong>- <?php echo __('3 Styles Variations', 'blockverse') ?></strong></li>
                </ul>
            </div>
            <div class="half-col pro-features">
                <h3><?php echo __('Premium Features', 'blockverse') ?></h3>
                <ul>
                    <li><?php echo __('Include all free Features and comes with more 60+ Premium patterns', 'blockverse') ?></strong></li>
                    <li><?php echo __('Header Layout - 6', 'blockverse') ?></li>
                    <li><?php echo __('Footer Layout - 6', 'blockverse') ?></li>
                    <li><?php echo __('Banner Layout - 5', 'blockverse') ?></li>
                    <li><?php echo __('Magazine Layout Patterns - 9', 'blockverse') ?></li>
                    <li><?php echo __('WooCommerce Product Layout Patterns - 5', 'blockverse') ?></li>
                    <li><?php echo __('Latest Blog Patterns - 3 ', 'blockverse') ?></li>
                    <li><?php echo __('Testimonials Layout Patterns - 6', 'blockverse') ?></li>
                    <li><?php echo __('Teams Layout Pattern - 4', 'blockverse') ?></li>
                    <li><?php echo __('FAQ Layout Patterns - 2', 'blockverse') ?></li>
                    <li><?php echo __('Stats Counter Layout Patterns - 4', 'blockverse') ?></li>
                    <li><?php echo __('Contact Section Patterns - 4', 'blockverse') ?></li>
                    <li><?php echo __('Pricing Table Patterns - 3', 'blockverse') ?></li>
                    <li><?php echo __('About Layout Patterns - 3', 'blockverse') ?></li>
                    <li><?php echo __('Service Layout Patterns - 4', 'blockverse') ?></li>
                    <li><?php echo __('CTA Layout Patterns - 2+', 'blockverse') ?></li>
                </ul>
                <a href="https://walkerwp.com/pricing-plans/" class="upgrade-btn button" target="_blank"><?php echo __('Upgrade to Pro', 'blockverse') ?></a>
            </div>
        </div>
    </div>
<?php
}
