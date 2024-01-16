<?php

/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package blockverse
 * @since 1.0.0
 */

if (function_exists('register_block_style')) {
    /**
     * Register block styles.
     *
     * @since 0.1
     *
     * @return void
     */
    function blockverse_register_block_styles()
    {
        register_block_style(
            'core/columns',
            array(
                'name'  => 'blockverse-boxshadow',
                'label' => __('Box Shadow', 'blockverse')
            )
        );

        register_block_style(
            'core/column',
            array(
                'name'  => 'blockverse-boxshadow',
                'label' => __('Box Shadow', 'blockverse')
            )
        );
        register_block_style(
            'core/column',
            array(
                'name'  => 'blockverse-boxshadow-medium',
                'label' => __('Box Shadow Medium', 'blockverse')
            )
        );
        register_block_style(
            'core/column',
            array(
                'name'  => 'blockverse-boxshadow-large',
                'label' => __('Box Shadow Large', 'blockverse')
            )
        );

        register_block_style(
            'core/group',
            array(
                'name'  => 'blockverse-boxshadow',
                'label' => __('Box Shadow', 'blockverse')
            )
        );
        register_block_style(
            'core/group',
            array(
                'name'  => 'blockverse-boxshadow-medium',
                'label' => __('Box Shadow Medium', 'blockverse')
            )
        );
        register_block_style(
            'core/group',
            array(
                'name'  => 'blockverse-boxshadow-large',
                'label' => __('Box Shadow Larger', 'blockverse')
            )
        );
        register_block_style(
            'core/image',
            array(
                'name'  => 'blockverse-boxshadow',
                'label' => __('Box Shadow', 'blockverse')
            )
        );
        register_block_style(
            'core/image',
            array(
                'name'  => 'blockverse-boxshadow-medium',
                'label' => __('Box Shadow Medium', 'blockverse')
            )
        );
        register_block_style(
            'core/image',
            array(
                'name'  => 'blockverse-boxshadow-larger',
                'label' => __('Box Shadow Large', 'blockverse')
            )
        );
        register_block_style(
            'core/image',
            array(
                'name'  => 'blockverse-image-pulse',
                'label' => __('Iamge Pulse Effect', 'blockverse')
            )
        );
        register_block_style(
            'core/image',
            array(
                'name'  => 'blockverse-boxshadow-hover',
                'label' => __('Box Shadow on Hover', 'blockverse')
            )
        );
        register_block_style(
            'core/image',
            array(
                'name'  => 'blockverse-image-hover-pulse',
                'label' => __('Hover Pulse Effect', 'blockverse')
            )
        );
        register_block_style(
            'core/image',
            array(
                'name'  => 'blockverse-image-hover-rotate',
                'label' => __('Hover Rotate Effect', 'blockverse')
            )
        );
        register_block_style(
            'core/columns',
            array(
                'name'  => 'blockverse-boxshadow-hover',
                'label' => __('Box Shadow on Hover', 'blockverse')
            )
        );

        register_block_style(
            'core/column',
            array(
                'name'  => 'blockverse-boxshadow-hover',
                'label' => __('Box Shadow on Hover', 'blockverse')
            )
        );

        register_block_style(
            'core/group',
            array(
                'name'  => 'blockverse-boxshadow-hover',
                'label' => __('Box Shadow on Hover', 'blockverse')
            )
        );

        register_block_style(
            'core/post-terms',
            array(
                'name'  => 'categories-background-with-round',
                'label' => __('Background with round corner style', 'blockverse')
            )
        );
        register_block_style(
            'core/post-title',
            array(
                'name'  => 'title-hover-primary-color',
                'label' => __('Hover: Primary color', 'blockverse')
            )
        );
        register_block_style(
            'core/post-title',
            array(
                'name'  => 'title-hover-secondary-color',
                'label' => __('Hover: Secondary color', 'blockverse')
            )
        );
        register_block_style(
            'core/button',
            array(
                'name'  => 'button-hover-primary-color',
                'label' => __('Hover: Primary Color', 'blockverse')
            )
        );
        register_block_style(
            'core/button',
            array(
                'name'  => 'button-hover-secondary-color',
                'label' => __('Hover: Secondary Color', 'blockverse')
            )
        );
        register_block_style(
            'core/button',
            array(
                'name'  => 'button-hover-primary-bgcolor',
                'label' => __('Hover: Primary color fill', 'blockverse')
            )
        );
        register_block_style(
            'core/button',
            array(
                'name'  => 'button-hover-secondary-bgcolor',
                'label' => __('Hover: Secondary color fill', 'blockverse')
            )
        );
        register_block_style(
            'core/button',
            array(
                'name'  => 'button-hover-white-bgcolor',
                'label' => __('Hover: White color fill', 'blockverse')
            )
        );

        register_block_style(
            'core/read-more',
            array(
                'name'  => 'readmore-hover-primary-color',
                'label' => __('Hover: Primary Color', 'blockverse')
            )
        );
        register_block_style(
            'core/read-more',
            array(
                'name'  => 'readmore-hover-secondary-color',
                'label' => __('Hover: Secondary Color', 'blockverse')
            )
        );
        register_block_style(
            'core/read-more',
            array(
                'name'  => 'readmore-hover-primary-fill',
                'label' => __('Hover: Primary Fill', 'blockverse')
            )
        );
        register_block_style(
            'core/read-more',
            array(
                'name'  => 'readmore-hover-secondary-fill',
                'label' => __('Hover: secondary Fill', 'blockverse')
            )
        );

        register_block_style(
            'core/list',
            array(
                'name'  => 'list-style-no-bullet',
                'label' => __('List Style: Hide bullet', 'blockverse')
            )
        );
        register_block_style(
            'core/list',
            array(
                'name'  => 'hide-bullet-list-link-hover-style-primary',
                'label' => __('Hover style with primary color and hide bullet', 'blockverse')
            )
        );
        register_block_style(
            'core/list',
            array(
                'name'  => 'hide-bullet-list-link-hover-style-secondary',
                'label' => __('Hover style with secondary color and hide bullet', 'blockverse')
            )
        );

        register_block_style(
            'core/gallery',
            array(
                'name'  => 'enable-grayscale-mode-on-image',
                'label' => __('Enable Grayscale Mode on Image', 'blockverse')
            )
        );
        register_block_style(
            'core/social-links',
            array(
                'name'  => 'social-icon-border',
                'label' => __('Border Style', 'blockverse')
            )
        );
        register_block_style(
            'core/page-list',
            array(
                'name'  => 'blockverse-page-list-bullet-hide-style',
                'label' => __('Hide Bullet Style', 'blockverse')
            )
        );
        register_block_style(
            'core/categories',
            array(
                'name'  => 'blockverse-categories-bullet-hide-style',
                'label' => __('Hide Bullet Style', 'blockverse')
            )
        );
        register_block_style(
            'core/cover',
            array(
                'name'  => 'blockverse-cover-round-style',
                'label' => __('Round Corner Style', 'blockverse')
            )
        );
    }
    add_action('init', 'blockverse_register_block_styles');
}
