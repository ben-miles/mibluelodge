<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Register Facebook blocks
 *
 * @since 6.5.0
 */
if ( !class_exists( 'ESF_FB_Blocks' ) ) {
    class ESF_FB_Blocks {
        function __construct() {
            $this->includes();
            add_action( 'enqueue_block_editor_assets', array($this, 'enqueue_block_editor_assets') );
        }

        /**
         * Get the list of blocks
         *
         * @return array
         * @since 6.5.0
         */
        public function blocks_list() {
            $list = array('halfwidth', 'fullwidth', 'thumbnail');
            return apply_filters( 'esf_fb_blocks_list', $list );
        }

        /**
         * Include all required files
         *
         * @since 6.5.0
         */
        public function includes() {
            // get the list of blocks
            $blocks = $this->blocks_list();
            // Register all blocks
            if ( $blocks ) {
                foreach ( $blocks as $block ) {
                    register_block_type( EFBL_PLUGIN_DIR . 'includes/blocks/build/' . $block, $this->block_attributes( $block ) );
                }
            }
        }

        /**
         * Enqueue script for block
         */
        public function enqueue_block_editor_assets() {
            // get the list of blocks
            $blocks = $this->blocks_list();
            // Register all blocks
            if ( $blocks ) {
                $efbl = new Easy_Facebook_Likebox();
                $efbl->enqueue_styles();
                $efbl->enqueue_scripts();
                $settings = get_option( 'fta_settings', false );
                $pages = false;
                $groups = false;
                if ( isset( $settings['plugins']['facebook'] ) ) {
                    $settings = $settings['plugins']['facebook'];
                    if ( isset( $settings['approved_pages'] ) && !empty( $settings['approved_pages'] ) ) {
                        $pages = $settings['approved_pages'];
                    }
                    if ( isset( $settings['approved_groups'] ) && !empty( $settings['approved_groups'] ) ) {
                        $groups = $settings['approved_groups'];
                        $result = array();
                        foreach ( $groups as $key => $value ) {
                            $result[$value->id] = $value;
                        }
                        $groups = $result;
                    }
                } else {
                    $settings = false;
                }
                foreach ( $blocks as $block ) {
                    wp_enqueue_script(
                        'esf-fb-' . $block . '-editor-script',
                        EFBL_PLUGIN_URL . 'includes/blocks/src/' . $block . '/edit.js',
                        array(),
                        '1.0',
                        true
                    );
                    wp_localize_script( 'esf-fb-' . $block . '-editor-script', 'esfFBBlockData', array(
                        'ajax_url' => admin_url( 'admin-ajax.php' ),
                        'settings' => $settings,
                        'pages'    => $pages,
                        'groups'   => $groups,
                        'adminUrl' => admin_url(),
                        'nonce'    => wp_create_nonce( 'efbl-ajax-nonce' ),
                    ) );
                }
            }
        }

        /**
         * Define block attributes
         *
         * @return array
         */
        public function block_attributes( $block = 'halfwidth' ) {
            $attributes = array();
            if ( 'halfwidth' === $block ) {
                $attributes = apply_filters( 'esf/fb/halfwidth/options', array(
                    'icon'            => 'facebook',
                    'title'           => 'ESF FB: Half Width',
                    'description'     => __( 'Display Facebook Page Feed in Half Width', 'easy-facebook-likebox' ),
                    'attributes'      => array(
                        'skin'           => array(
                            'type'    => 'string',
                            'default' => 'half',
                        ),
                        'fanpage_id'     => array(
                            'type' => 'string',
                        ),
                        'type'           => array(
                            'type'    => 'string',
                            'default' => '',
                        ),
                        'words_limit'    => array(
                            'type'    => 'number',
                            'default' => 25,
                        ),
                        'links_new_tab'  => array(
                            'type'    => 'number',
                            'default' => 1,
                        ),
                        'post_limit'     => array(
                            'type'    => 'number',
                            'default' => 10,
                        ),
                        'cache_unit'     => array(
                            'type'    => 'number',
                            'default' => 1,
                        ),
                        'cache_duration' => array(
                            'type'    => 'string',
                            'default' => 'days',
                        ),
                        'show_like_box'  => array(
                            'type'    => 'number',
                            'default' => 0,
                        ),
                        'filter'         => array(
                            'type'    => 'string',
                            'default' => '',
                        ),
                        'events_filter'  => array(
                            'type'    => 'string',
                            'default' => '',
                        ),
                        'album_id'       => array(
                            'type'    => 'string',
                            'default' => '',
                        ),
                    ),
                    'render_callback' => array($this, 'load_block_html'),
                ) );
            } elseif ( 'fullwidth' === $block ) {
                $attributes = apply_filters( 'esf/fb/fullwidth/options', array(
                    'icon'            => 'facebook',
                    'title'           => 'ESF FB: Full Width',
                    'description'     => __( 'Display Facebook Page Feed in Full Width', 'easy-facebook-likebox' ),
                    'attributes'      => array(
                        'skin'           => array(
                            'type'    => 'string',
                            'default' => 'full',
                        ),
                        'fanpage_id'     => array(
                            'type' => 'string',
                        ),
                        'type'           => array(
                            'type'    => 'string',
                            'default' => '',
                        ),
                        'words_limit'    => array(
                            'type'    => 'number',
                            'default' => 25,
                        ),
                        'links_new_tab'  => array(
                            'type'    => 'number',
                            'default' => 1,
                        ),
                        'post_limit'     => array(
                            'type'    => 'number',
                            'default' => 10,
                        ),
                        'cache_unit'     => array(
                            'type'    => 'number',
                            'default' => 1,
                        ),
                        'cache_duration' => array(
                            'type'    => 'string',
                            'default' => 'days',
                        ),
                        'show_like_box'  => array(
                            'type'    => 'number',
                            'default' => 0,
                        ),
                        'filter'         => array(
                            'type'    => 'string',
                            'default' => '',
                        ),
                        'events_filter'  => array(
                            'type'    => 'string',
                            'default' => '',
                        ),
                        'album_id'       => array(
                            'type'    => 'string',
                            'default' => '',
                        ),
                    ),
                    'render_callback' => array($this, 'load_block_html'),
                ) );
            } elseif ( 'thumbnail' === $block ) {
                $attributes = apply_filters( 'esf/fb/thumbnail/options', array(
                    'icon'            => 'facebook',
                    'title'           => 'ESF FB: Thumbnail',
                    'description'     => __( 'Display Facebook Page Feed in Thumbnail', 'easy-facebook-likebox' ),
                    'attributes'      => array(
                        'skin'           => array(
                            'type'    => 'string',
                            'default' => 'thumbnail',
                        ),
                        'fanpage_id'     => array(
                            'type' => 'string',
                        ),
                        'type'           => array(
                            'type'    => 'string',
                            'default' => '',
                        ),
                        'words_limit'    => array(
                            'type'    => 'number',
                            'default' => 25,
                        ),
                        'links_new_tab'  => array(
                            'type'    => 'number',
                            'default' => 1,
                        ),
                        'post_limit'     => array(
                            'type'    => 'number',
                            'default' => 10,
                        ),
                        'cache_unit'     => array(
                            'type'    => 'number',
                            'default' => 1,
                        ),
                        'cache_duration' => array(
                            'type'    => 'string',
                            'default' => 'days',
                        ),
                        'show_like_box'  => array(
                            'type'    => 'number',
                            'default' => 0,
                        ),
                        'filter'         => array(
                            'type'    => 'string',
                            'default' => '',
                        ),
                        'events_filter'  => array(
                            'type'    => 'string',
                            'default' => '',
                        ),
                        'album_id'       => array(
                            'type'    => 'string',
                            'default' => '',
                        ),
                    ),
                    'render_callback' => array($this, 'load_block_html'),
                ) );
            }
            return $attributes;
        }

        /**
         * Load carousel block html
         *
         * @param $attributes
         *
         * @return false|string
         * @since 5.0.0
         */
        public function load_block_html( $attributes ) {
            if ( $attributes['fanpage_id'] && isset( $attributes['skin'] ) ) {
                $attributes['skin_id'] = $this->get_skin_id( $attributes['skin'] );
                $efbl = new Easy_Facebook_Likebox();
                return $efbl->render_fbfeed_box( $attributes );
            } else {
                ob_start();
                require EFBL_PLUGIN_DIR . 'includes/blocks/templates/html-no-account-selected.php';
                $content = ob_get_contents();
                ob_end_clean();
                return $content;
            }
        }

        /**
         * Get skin id
         *
         * @since 6.5.0
         * @return int|mixed|string
         */
        public function get_skin_id( $skin = 'half' ) {
            $settings = get_option( 'fta_settings', false );
            if ( isset( $settings['plugins']['facebook']['default_skin_id'] ) && !empty( $settings['plugins']['facebook']['default_skin_id'] ) ) {
                $skin_id = $settings['plugins']['facebook']['default_skin_id'];
            }
            global $efbl_skins;
            if ( $efbl_skins ) {
                foreach ( $efbl_skins as $key => $value ) {
                    if ( $value['layout'] === $skin ) {
                        $skin_id = $key;
                        break;
                    }
                }
            }
            return $skin_id;
        }

    }

    new ESF_FB_Blocks();
}