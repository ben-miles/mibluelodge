<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//======================================================================//
// Instagram module customizer
//======================================================================//
if ( !class_exists( 'ESF_Insta_Customizer' ) ) {
    class ESF_Insta_Customizer {
        function __construct() {
            add_action( 'customize_register', array($this, 'esf_insta_customizer') );
            add_action( 'customize_preview_init', array($this, 'esf_insta_live_preview') );
            add_action( 'customize_controls_enqueue_scripts', array($this, 'esf_insta_customizer_scripts') );
        }

        /*
         * Includes style file for customizer
         */
        function esf_insta_customizer_scripts() {
            wp_enqueue_style( 'esf-insta-customizer-style', ESF_INSTA_PLUGIN_URL . 'admin/assets/css/esf-insta-customizer-style.css' );
        }

        /*
         * Includes the Instagram customizer menu and add all the settings.
         */
        public function esf_insta_customizer( $wp_customize ) {
            $Feed_Them_All = new Feed_Them_All();
            /* Getting the skin id from URL and saving in option for confliction.*/
            if ( isset( $_GET['mif_skin_id'] ) ) {
                $skin_id = sanitize_text_field( $_GET['mif_skin_id'] );
                update_option( 'mif_skin_id', $skin_id );
            }
            if ( isset( $_GET['mif_account_id'] ) ) {
                $mif_account_id = sanitize_text_field( $_GET['mif_account_id'] );
                update_option( 'mif_account_id', $mif_account_id );
            }
            /* Getting back the skin saved ID.*/
            $skin_id = get_option( 'mif_skin_id', false );
            /* Getting the saved values.*/
            $skin_values = get_option( 'mif_skin_' . $skin_id, false );
            $selected_layout = get_post_meta( $skin_id, 'layout', true );
            if ( !$selected_layout ) {
                $selected_layout = ( is_string( $selected_layout ) ? strtolower( $selected_layout ) : '' );
            }
            $selected_layout = ( is_string( $selected_layout ) ? strtolower( $selected_layout ) : '' );
            global $mif_skins;
            /* Adding our efbl panel in customizer.*/
            $wp_customize->add_panel( 'mif_customize_panel', array(
                'title' => __( 'Easy Instagram Feed', 'easy-facebook-likebox' ),
            ) );
            //======================================================================
            // Layout section
            //======================================================================
            /* Adding layout section in customizer under efbl panel.*/
            $wp_customize->add_section( 'mif_layout', array(
                'title'       => __( 'Layout Settings', 'easy-facebook-likebox' ),
                'description' => __( 'Select the layout settings in real-time.', 'easy-facebook-likebox' ),
                'priority'    => 35,
                'panel'       => 'mif_customize_panel',
            ) );
            if ( 'grid' == $selected_layout ) {
                $mif_cols_transport = 'postMessage';
            } else {
                $mif_cols_transport = 'refresh';
            }
            if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_layout_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Layout Settings', 'easy-facebook-likebox' ),
                    'section'     => 'mif_layout',
                    'description' => __( 'We are sorry, Layout settings are not included in your plan. Please upgrade to the premium version to unlock the following settings<ul>
                           <li>Number Of Columns</li>
                           <li>Show Or Hide Load More Button</li>
                           <li>Load More Background Color</li>
                           <li>Load More Color</li>
                           <li>Load More Hover Background Color</li>
                           <li>Load More Hover Color</li>
                           </ul>', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_layout_upgrade',
                )) );
            }
            //======================================================================
            // Header section
            //======================================================================
            $wp_customize->add_section( 'mif_header', array(
                'title'       => __( 'Header', 'easy-facebook-likebox' ),
                'description' => __( 'Customize the header in the real time.', 'easy-facebook-likebox' ),
                'priority'    => 35,
                'panel'       => 'mif_customize_panel',
            ) );
            $setting = 'mif_skin_' . $skin_id . '[show_header]';
            $wp_customize->add_setting( $setting, array(
                'default'   => false,
                'transport' => 'refresh',
                'type'      => 'option',
            ) );
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Show Or Hide Header', 'easy-facebook-likebox' ),
                'section'     => 'mif_header',
                'settings'    => $setting,
                'description' => __( 'Show or hide page header.', 'easy-facebook-likebox' ),
                'type'        => 'checkbox',
            ) );
            $setting = 'mif_skin_' . $skin_id . '[header_background_color]';
            $wp_customize->add_setting( $setting, array(
                'default'   => '#fff',
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $setting, array(
                'label'       => __( 'Header Background Color', 'easy-facebook-likebox' ),
                'section'     => 'mif_header',
                'settings'    => $setting,
                'description' => __( 'Select the background color of header.', 'easy-facebook-likebox' ),
            )) );
            $setting = 'mif_skin_' . $skin_id . '[header_text_color]';
            $wp_customize->add_setting( $setting, array(
                'default'   => '#000',
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $setting, array(
                'label'       => __( 'Header Text Color', 'easy-facebook-likebox' ),
                'section'     => 'mif_header',
                'settings'    => $setting,
                'description' => __( 'Select the content color in header.', 'easy-facebook-likebox' ),
            )) );
            $setting = 'mif_skin_' . $skin_id . '[title_size]';
            $wp_customize->add_setting( $setting, array(
                'default'   => 16,
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Title Size', 'easy-facebook-likebox' ),
                'section'     => 'mif_header',
                'settings'    => $setting,
                'description' => __( 'Select the text size of profile name.', 'easy-facebook-likebox' ),
                'type'        => 'number',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
            ) );
            $setting = 'mif_skin_' . $skin_id . '[header_shadow]';
            $wp_customize->add_setting( $setting, array(
                'default'   => false,
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Show Or Hide Box Shadow', 'easy-facebook-likebox' ),
                'section'     => 'mif_header',
                'settings'    => $setting,
                'description' => __( 'Show or Hide box shadow.', 'easy-facebook-likebox' ),
                'type'        => 'checkbox',
            ) );
            $setting = 'mif_skin_' . $skin_id . '[header_shadow_color]';
            $wp_customize->add_setting( $setting, array(
                'default'   => 'rgba(0,0,0,0.15)',
                'type'      => 'option',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new Customize_Alpha_Color_Control($wp_customize, $setting, array(
                'label'        => __( 'Shadow color', 'easy-facebook-likebox' ),
                'section'      => 'mif_header',
                'settings'     => $setting,
                'show_opacity' => true,
            )) );
            if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_dp_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Show Or Hide Display Picture', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Show Or Hide Display Picture” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_dp_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_round_dp_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Round Display Picture', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Round Display Picture” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_round_dp_upgrade',
                )) );
            }
            $setting = 'mif_skin_' . $skin_id . '[metadata_size]';
            $wp_customize->add_setting( $setting, array(
                'default'   => 16,
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Size of total followers', 'easy-facebook-likebox' ),
                'section'     => 'mif_header',
                'settings'    => $setting,
                'description' => __( 'Select the text size of total followers in the header.', 'easy-facebook-likebox' ),
                'type'        => 'number',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
            ) );
            if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_head_hide_bio_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Show Or Hide Bio', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Show Or Hide Bio” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_head_hide_bio_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_head_border_color_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Text Size of Bio', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Text Size of Bio” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_head_border_color_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_head_border_color_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Header Border Color', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Header Border Color” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_head_border_color_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_head_border_style_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Border Style', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Border Style” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_head_border_style_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_head_border_top_size_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Border Top', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Border Top” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_head_border_top_size_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_head_border_bottom_size_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Border Bottom', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Border Bottom” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_head_border_bottom_size_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_head_border_left_size_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Border Left', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Border Left” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_head_border_left_size_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_head_border_right_size_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Border Right', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Border Right” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_head_border_right_size_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_head_padding_top_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Padding Top', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Padding Top” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_head_padding_top_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_head_padding_bottom_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Padding Bottom', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Padding Bottom” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_head_padding_bottom_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_head_padding_left_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Padding Left', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Padding Left” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_head_padding_left_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_head_padding_right_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Padding Right', 'easy-facebook-likebox' ),
                    'section'     => 'mif_header',
                    'description' => __( 'We are sorry, “Padding Right” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_head_padding_right_upgrade',
                )) );
            }
            //======================================================================
            // Feed section
            //======================================================================
            if ( 'half_width' == $selected_layout || 'full_width' == $selected_layout || 'grid' == $selected_layout ) {
                $setting = 'mif_skin_' . $skin_id . '[feed_background_color]';
                $wp_customize->add_setting( $setting, array(
                    'default'   => '#fff',
                    'transport' => 'postMessage',
                    'type'      => 'option',
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $setting, array(
                    'label'       => __( 'Background Color', 'easy-facebook-likebox' ),
                    'section'     => 'mif_feed',
                    'settings'    => $setting,
                    'description' => __( 'Select the Background color of feed.', 'easy-facebook-likebox' ),
                )) );
                $setting = 'mif_skin_' . $skin_id . '[feed_borders_color]';
                $wp_customize->add_setting( $setting, array(
                    'default'   => '#dee2e6',
                    'transport' => 'postMessage',
                    'type'      => 'option',
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $setting, array(
                    'label'       => __( 'Borders Color', 'easy-facebook-likebox' ),
                    'section'     => 'mif_feed',
                    'settings'    => $setting,
                    'description' => __( "Select the border's color in the feed", 'easy-facebook-likebox' ),
                )) );
            }
            if ( 'carousel' !== $selected_layout ) {
                $setting = 'mif_skin_' . $skin_id . '[feed_shadow]';
                $wp_customize->add_setting( $setting, array(
                    'default'   => false,
                    'transport' => 'postMessage',
                    'type'      => 'option',
                ) );
                $wp_customize->add_control( $setting, array(
                    'label'       => __( 'Show Or Hide Box Shadow', 'easy-facebook-likebox' ),
                    'section'     => 'mif_feed',
                    'settings'    => $setting,
                    'description' => __( 'Show or Hide box shadow.', 'easy-facebook-likebox' ),
                    'type'        => 'checkbox',
                ) );
                $setting = 'mif_skin_' . $skin_id . '[feed_shadow_color]';
                $wp_customize->add_setting( $setting, array(
                    'default'   => 'rgba(0,0,0,0.15)',
                    'type'      => 'option',
                    'transport' => 'postMessage',
                ) );
                $wp_customize->add_control( new Customize_Alpha_Color_Control($wp_customize, $setting, array(
                    'label'        => __( 'Shadow color', 'easy-facebook-likebox' ),
                    'section'      => 'mif_feed',
                    'settings'     => $setting,
                    'show_opacity' => true,
                )) );
            }
            if ( 'half_width' == $selected_layout || 'full_width' == $selected_layout ) {
                if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                } else {
                    $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_header_feed_upgrade', array(
                        'settings'    => array(),
                        'label'       => __( 'Show Or Hide Feed Header', 'easy-facebook-likebox' ),
                        'section'     => 'mif_feed',
                        'description' => __( 'We are sorry, “Show Or Hide Feed Header” is a premium feature.', 'easy-facebook-likebox' ),
                        'popup_id'    => 'mif_header_feed_upgrade',
                    )) );
                    $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_header_feed_logo_upgrade', array(
                        'settings'    => array(),
                        'label'       => __( 'Show Or Hide Feed Header Logo', 'easy-facebook-likebox' ),
                        'section'     => 'mif_feed',
                        'description' => __( 'We are sorry, “Show Or Hide Feed Header Logo” is a premium feature.', 'easy-facebook-likebox' ),
                        'popup_id'    => 'mif_header_feed_logo_upgrade',
                    )) );
                }
            }
            if ( 'carousel' !== $selected_layout ) {
                if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                } else {
                    $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_text_color_feed_upgrade', array(
                        'settings'    => array(),
                        'label'       => __( 'Text Color', 'easy-facebook-likebox' ),
                        'section'     => 'mif_feed',
                        'description' => __( 'We are sorry, “Text Color” is a premium feature.', 'easy-facebook-likebox' ),
                        'popup_id'    => 'mif_text_color_feed_upgrade',
                    )) );
                }
                if ( $selected_layout == 'grid' ) {
                    $feed_default_padding = 3;
                } else {
                    $feed_default_padding = 15;
                }
                $setting = 'mif_skin_' . $skin_id . '[feed_padding_top]';
                $wp_customize->add_setting( $setting, array(
                    'default'   => $feed_default_padding,
                    'transport' => 'postMessage',
                    'type'      => 'option',
                ) );
                $wp_customize->add_control( $setting, array(
                    'label'       => __( 'Padding Top', 'easy-facebook-likebox' ),
                    'section'     => 'mif_feed',
                    'settings'    => $setting,
                    'description' => __( 'Select the padding top', 'easy-facebook-likebox' ),
                    'type'        => 'number',
                    'input_attrs' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ) );
                $setting = 'mif_skin_' . $skin_id . '[feed_padding_bottom]';
                $wp_customize->add_setting( $setting, array(
                    'default'   => $feed_default_padding,
                    'transport' => 'postMessage',
                    'type'      => 'option',
                ) );
                $wp_customize->add_control( $setting, array(
                    'label'       => __( 'Padding Bottom', 'easy-facebook-likebox' ),
                    'section'     => 'mif_feed',
                    'settings'    => $setting,
                    'description' => __( 'Select the padding bottom of feed.', 'easy-facebook-likebox' ),
                    'type'        => 'number',
                    'input_attrs' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ) );
                $setting = 'mif_skin_' . $skin_id . '[feed_padding_right]';
                $wp_customize->add_setting( $setting, array(
                    'default'   => $feed_default_padding,
                    'transport' => 'postMessage',
                    'type'      => 'option',
                ) );
                $wp_customize->add_control( $setting, array(
                    'label'       => __( 'Padding Right', 'easy-facebook-likebox' ),
                    'section'     => 'mif_feed',
                    'settings'    => $setting,
                    'description' => __( 'Select the padding right for feed.', 'easy-facebook-likebox' ),
                    'type'        => 'number',
                    'input_attrs' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ) );
                $setting = 'mif_skin_' . $skin_id . '[feed_padding_left]';
                $wp_customize->add_setting( $setting, array(
                    'default'   => $feed_default_padding,
                    'transport' => 'postMessage',
                    'type'      => 'option',
                ) );
                $wp_customize->add_control( $setting, array(
                    'label'       => __( 'Padding  Left', 'easy-facebook-likebox' ),
                    'section'     => 'mif_feed',
                    'settings'    => $setting,
                    'description' => __( 'Select the padding left for feed.', 'easy-facebook-likebox' ),
                    'type'        => 'number',
                    'input_attrs' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ) );
            }
            if ( $selected_layout == 'grid' ) {
                $feed_default_spacing = 30;
                $feed_transport = 'postMessage';
            } elseif ( $selected_layout == 'carousel' ) {
                $feed_default_spacing = 0;
                $feed_transport = 'refresh';
            } else {
                $feed_default_spacing = 20;
                $feed_transport = 'postMessage';
            }
            $setting = 'mif_skin_' . $skin_id . '[feed_spacing]';
            $wp_customize->add_setting( $setting, array(
                'default'   => $feed_default_spacing,
                'transport' => $feed_transport,
                'type'      => 'option',
            ) );
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Spacing', 'easy-facebook-likebox' ),
                'section'     => 'mif_feed',
                'settings'    => $setting,
                'description' => __( 'Select the spacing between feeds.', 'easy-facebook-likebox' ),
                'type'        => 'number',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
            ) );
            $wp_customize->add_section( 'mif_feed', array(
                'title'       => __( 'Feed', 'easy-facebook-likebox' ),
                'description' => __( 'Customize the Single Feed Design In Real Time', 'easy-facebook-likebox' ),
                'priority'    => 35,
                'panel'       => 'mif_customize_panel',
            ) );
            if ( 'half_width' == $selected_layout || 'full_width' == $selected_layout ) {
                if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                } else {
                    $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_meta_feed_upgrade', array(
                        'settings'    => array(),
                        'label'       => __( 'Feed Meta Color', 'easy-facebook-likebox' ),
                        'section'     => 'mif_feed',
                        'description' => __( 'We are sorry, “Feed Meta Color” is a premium feature.', 'easy-facebook-likebox' ),
                        'popup_id'    => 'mif_meta_feed_upgrade',
                    )) );
                }
                $setting = 'mif_skin_' . $skin_id . '[show_likes]';
                $wp_customize->add_setting( $setting, array(
                    'default'   => true,
                    'transport' => 'refresh',
                    'type'      => 'option',
                ) );
                $wp_customize->add_control( $setting, array(
                    'label'    => __( 'Show Or Hide Likes Counter', 'easy-facebook-likebox' ),
                    'section'  => 'mif_feed',
                    'settings' => $setting,
                    'type'     => 'checkbox',
                ) );
                $setting = 'mif_skin_' . $skin_id . '[show_comments]';
                $wp_customize->add_setting( $setting, array(
                    'default'   => true,
                    'transport' => 'refresh',
                    'type'      => 'option',
                ) );
                $wp_customize->add_control( $setting, array(
                    'label'    => __( 'Show Or Hide Comments Counter', 'easy-facebook-likebox' ),
                    'section'  => 'mif_feed',
                    'settings' => $setting,
                    'type'     => 'checkbox',
                ) );
                $setting = 'mif_skin_' . $skin_id . '[show_feed_caption]';
                $wp_customize->add_setting( $setting, array(
                    'default'   => true,
                    'transport' => 'refresh',
                    'type'      => 'option',
                ) );
                $wp_customize->add_control( $setting, array(
                    'label'    => __( 'Show Or Hide Feed Caption', 'easy-facebook-likebox' ),
                    'section'  => 'mif_feed',
                    'settings' => $setting,
                    'type'     => 'checkbox',
                ) );
            }
            if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_popup_icon_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Show Or Hide Open PopUp Icon', 'easy-facebook-likebox' ),
                    'section'     => 'mif_feed',
                    'description' => __( 'We are sorry, “Show Or Hide Open PopUp Icon” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_popup_icon_feed_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_popup_icon_color_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Open PopUp Icon color', 'easy-facebook-likebox' ),
                    'section'     => 'mif_feed',
                    'description' => __( 'We are sorry, “Open PopUp Icon color” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_popup_icon_color_feed_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_popup_icon_color_feedtype_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Feed Type Icon color', 'easy-facebook-likebox' ),
                    'section'     => 'mif_feed',
                    'description' => __( 'We are sorry, “Feed Type Icon color” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_popup_icon_color_feedtype_upgrade',
                )) );
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_popup_cta_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Show Or Hide Feed Call To Action Buttons', 'easy-facebook-likebox' ),
                    'section'     => 'mif_feed',
                    'description' => __( 'We are sorry, “Show Or Hide Feed Call To Action Buttons” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_popup_cta_feed_upgrade',
                )) );
            }
            if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_popup_bg_hover_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Feed Hover Shadow Color', 'easy-facebook-likebox' ),
                    'section'     => 'mif_feed',
                    'description' => __( 'We are sorry, “Feed Hover Shadow Color” is a premium feature.', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_popup_bg_hover_feed_upgrade',
                )) );
            }
            //======================================================================
            // PopUP section
            //======================================================================
            /* Adding layout section in customizer under efbl panel.*/
            $wp_customize->add_section( 'mif_popup', array(
                'title'       => __( 'Media lightbox', 'easy-facebook-likebox' ),
                'description' => __( 'Customize the PopUp In Real Time', 'easy-facebook-likebox' ),
                'priority'    => 35,
                'panel'       => 'mif_customize_panel',
            ) );
            if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_MIF_PopUp($wp_customize, 'mif_popup_popup_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Media Lightbox Settings', 'easy-facebook-likebox' ),
                    'section'     => 'mif_popup',
                    'description' => __( 'We are sorry, Media Lightbox Settings are not included in your plan. Please upgrade to the premium version to unlock the following settings<ul>
                           <li>Sidebar Background Color</li>
                           <li>Sidebar Content Color</li>
                           <li>Show Or Hide PopUp Header</li>
                           <li>Show Or Hide Header Logo</li>
                           <li>Header Title Color</li>
                           <li>Post Time Color</li>
                           <li>Show Or Hide Caption</li>
                           <li>Show Or Hide Meta Section</li>
                           <li>Meta Background Color</li>
                           <li>Meta Content Color</li>
                           <li>Show Or Hide Reactions Counter</li>
                           <li>Show Or Hide Comments Counter</li>
                           <li>Show Or Hide View On Facebook Link</li>
                           <li>Show Or Hide Comments</li>
                           <li>Comments Background Color</li>
                           <li>Comments Color</li>
                           </ul>', 'easy-facebook-likebox' ),
                    'popup_id'    => 'mif_popup_popup_upgrade',
                )) );
            }
        }

        /**
         * Includes scripts for live preview
         */
        public function esf_insta_live_preview() {
            $skin_id = get_option( 'mif_skin_id', false );
            wp_enqueue_script(
                'esf-insta-live-preview',
                ESF_INSTA_PLUGIN_URL . 'admin/assets/js/esf-insta-live-preview.js',
                array('jquery', 'customize-preview'),
                true
            );
            wp_localize_script( 'esf-insta-live-preview', 'mif_skin_id', array($skin_id) );
        }

    }

    $ESF_Insta_Customizer = new ESF_Insta_Customizer();
}