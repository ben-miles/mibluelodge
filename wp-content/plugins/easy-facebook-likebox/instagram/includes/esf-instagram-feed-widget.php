<?php

class ESF_Instagram_Feed_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct( 
            'esf_instagram_feed',
            // Base ID
            __( 'Easy Instagram Feed', 'easy-facebook-likebox' ),
            // Name
            array(
                'description' => __( 'Drag and drop this widget for instagram feed integration', 'easy-facebook-likebox' ),
            )
         );
    }

    /**
     * Front-end display of widget.
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     *
     * @see WP_Widget::widget()
     *
     */
    public function widget( $args, $instance ) {
        $ESF_Instagram_Frontend = new ESF_Instagram_Frontend();
        if ( isset( $instance['title'] ) ) {
            $title = apply_filters( 'widget_title', $instance['title'] );
        } else {
            $title = '';
        }
        echo $args['before_widget'];
        if ( !empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        echo $ESF_Instagram_Frontend->esf_insta_shortcode( $instance );
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     *
     * @see WP_Widget::form()
     *
     */
    public function form( $instance ) {
        $mif_skin_default_id = '';
        $Feed_Them_All = new Feed_Them_All();
        /*
         *  Getting the FTA Plugin settings.
         */
        $fta_settings = $Feed_Them_All->fta_get_settings();
        if ( isset( $fta_settings['plugins']['instagram']['default_skin_id'] ) ) {
            $mif_skin_default_id = $fta_settings['plugins']['instagram']['default_skin_id'];
        }
        global $mif_skins;
        if ( isset( $fta_settings['plugins']['instagram']['authenticated_accounts'] ) ) {
            $mif_users = $fta_settings['plugins']['instagram']['authenticated_accounts'];
        }
        if ( isset( $fta_settings['plugins']['facebook']['access_token'] ) ) {
            $fb_access_token = $fta_settings['plugins']['facebook']['access_token'];
        }
        $defaults = array(
            'title'           => '',
            'wrapper_class'   => null,
            'user_id'         => null,
            'hashtag'         => null,
            'skin_id'         => $mif_skin_default_id,
            'feeds_per_page'  => 9,
            'caption_words'   => 25,
            'links_new_tab'   => 1,
            'load_more'       => 1,
            'show_stories'    => 1,
            'profile_picture' => null,
            'cache_unit'      => 1,
            'cache_duration'  => 'days',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        extract( $instance, EXTR_SKIP );
        ?>
		<div class="efbl_widget">

			<p>
				<label style="font-weight: bold;"
					   for="<?php 
        echo $this->get_field_id( 'title' );
        ?>"><?php 
        _e( 'Title:', 'easy-facebook-likebox' );
        ?></label>
				<input class="widefat"
					   id="<?php 
        echo $this->get_field_id( 'title' );
        ?>"
					   name="<?php 
        echo $this->get_field_name( 'title' );
        ?>"
					   type="text" value="<?php 
        echo esc_attr( $title );
        ?>">
			</p>

			<p>
				<?php 
        $show_auth_msg = true;
        $mif_personal_connected_accounts = esf_insta_personal_account();
        $esf_insta_business_accounts = esf_insta_business_accounts();
        if ( esf_insta_instagram_type() == 'personal' && !empty( $mif_personal_connected_accounts ) ) {
            $show_auth_msg = false;
        }
        if ( esf_insta_instagram_type() != 'personal' && $esf_insta_business_accounts ) {
            $show_auth_msg = false;
        }
        if ( $show_auth_msg ) {
            ?>
					<span style="color: #ff0303; font-weight: bold;"><?php 
            esc_html_e( 'No account found, Please connect your Instagram account with plugin first from authentication tab', 'easy-facebook-likebox' );
            ?>
							<a href="<?php 
            echo esc_url( admin_url( 'admin.php?page=mif' ) );
            ?>"><?php 
            esc_html_e( 'Yes, take me there', 'easy-facebook-likebox' );
            ?></a>
						</span>
					<?php 
        } else {
            ?>
					<label style="font-weight: bold;"
						   for="<?php 
            echo $this->get_field_id( 'user_id' );
            ?>"><?php 
            _e( 'Select Account:', 'easy-facebook-likebox' );
            ?></label>
					<select 
					<?php 
            if ( class_exists( 'Esf_Multifeed_Instagram_Frontend' ) ) {
                ?>
						 multiple <?php 
            }
            ?>  style="width: 100%;"
							id="<?php 
            echo $this->get_field_id( 'user_id' );
            ?>"
							name="<?php 
            echo $this->get_field_name( 'user_id' );
            ?>
											 <?php 
            if ( class_exists( 'Esf_Multifeed_Instagram_Frontend' ) ) {
                ?>
								[]<?php 
            }
            ?>">

						<?php 
            if ( esf_insta_instagram_type() == 'personal' && !empty( $mif_personal_connected_accounts ) ) {
                $i = 0;
                foreach ( $mif_personal_connected_accounts as $personal_id => $mif_personal_connected_account ) {
                    $i++;
                    ?>

							<option value="<?php 
                    echo $personal_id;
                    ?>" <?php 
                    selected( $personal_id, $user_id, true );
                    ?> ><?php 
                    echo $mif_personal_connected_account['username'];
                    ?></option>
								<?php 
                }
            }
            if ( esf_insta_instagram_type() != 'personal' && $esf_insta_business_accounts ) {
                if ( $esf_insta_business_accounts ) {
                    $i = 0;
                    foreach ( $esf_insta_business_accounts as $mif_insta_single_account ) {
                        $i++;
                        ?>
									<option value="<?php 
                        echo $mif_insta_single_account->id;
                        ?>" <?php 
                        selected( $user_id, $mif_insta_single_account->id, true );
                        ?> ><?php 
                        echo $mif_insta_single_account->username;
                        ?></option>
									<?php 
                    }
                } else {
                    ?>

								<option value="" disabled
										selected><?php 
                    esc_html_e( 'No accounts found, Please connect your Instagram account with plugin first', 'easy-facebook-likebox' );
                    ?></option>
								<?php 
                }
            }
            ?>
					</select>

				<br/>

					<i><?php 
            __( "List of connected accounts, Select one to display it's feeds", 'easy-facebook-likebox' );
            ?></i>

				<?php 
        }
        ?>
			</p>
			<?php 
        ?>

			<p>
				<label style="font-weight: bold;"
					   for="<?php 
        echo $this->get_field_id( 'skin_id' );
        ?>"><?php 
        _e( 'Skin:', 'easy-facebook-likebox' );
        ?></label><br/>
				<?php 
        if ( isset( $mif_skins ) ) {
            ?>
					<select style="width: 100%;"
							id="<?php 
            echo $this->get_field_id( 'skin_id' );
            ?>"
							name="<?php 
            echo $this->get_field_name( 'skin_id' );
            ?>">

						<?php 
            foreach ( $mif_skins as $mif_skin ) {
                if ( $mif_skin['layout'] == 'half_width' ) {
                    continue;
                }
                ?>

							<option value="<?php 
                echo $mif_skin['ID'];
                ?>" <?php 
                selected( $skin_id, $mif_skin['ID'], true );
                ?>><?php 
                echo $mif_skin['title'];
                ?></option>

							<?php 
            }
            if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                ?>

						<option value="free-masonry" disabled><?php 
                esc_html_e( 'Skin - Masonry (pro)', 'easy-facebook-likebox' );
                ?></option>
						<option value="free-carousel" disabled><?php 
                esc_html_e( 'Skin - Carousel (pro)', 'easy-facebook-likebox' );
                ?></option>
						<option value="free-half_width" disabled><?php 
                esc_html_e( 'Skin - Half Width (pro)', 'easy-facebook-likebox' );
                ?></option>
						<option value="free-full_width" disabled><?php 
                esc_html_e( 'Skin - Full Width (pro)', 'easy-facebook-likebox' );
                ?></option>
						<?php 
            }
            ?>

					</select>

					<br/>
					<i><?php 
            esc_html_e( 'Skin holds all the design settings like feed layout, page header and single post colors, margins and a lot of cool settings separately. You can create new skin from Easy Social Feed > Instagram > Customise(skins) tab.', 'easy-facebook-likebox' );
            ?></i>
					<?php 
        } else {
            echo __( 'WHOOPS, No skin found. You can create new skin from Easy Social Feed > Instagram > Skins tab. ', 'easy-facebook-likebox' );
            ?>
					<a href="<?php 
            echo admin_url( 'admin.php?page=easy-facebook-likebox#efbl-skins' );
            ?>"> <?php 
            echo __( 'Yes, take me there', 'easy-facebook-likebox' );
            ?> </a>
					<?php 
        }
        ?>
			</p>

			<div class="clearfix"></div>

			<p>
				<label style="font-weight: bold;"
					   for="<?php 
        echo $this->get_field_id( 'feeds_per_page' );
        ?>"><?php 
        _e( 'Posts to display:', 'easy-facebook-likebox' );
        ?></label>
				<input class="widefat"
					   id="<?php 
        echo $this->get_field_id( 'feeds_per_page' );
        ?>"
					   name="<?php 
        echo $this->get_field_name( 'feeds_per_page' );
        ?>"
					   type="number" min="1"
					   value="<?php 
        echo esc_attr( $feeds_per_page );
        ?>"
					   size="5"><br/>
				<i><?php 
        esc_html_e( 'Define how many posts you want to display in feed', 'easy-facebook-likebox' );
        ?></i>
			</p>


			<p>
				<label style="font-weight: bold;"
					   for="<?php 
        echo $this->get_field_id( 'caption_words' );
        ?>"><?php 
        _e( 'Words limit to show:', 'easy-facebook-likebox' );
        ?></label>
				<input class="widefat"
					   id="<?php 
        echo $this->get_field_id( 'caption_words' );
        ?>"
					   name="<?php 
        echo $this->get_field_name( 'caption_words' );
        ?>"
					   type="number" min="1"
					   value="<?php 
        echo esc_attr( $caption_words );
        ?>" size="5"><br/>
				<i><?php 
        esc_html_e( 'Define how many words you want to show in feed', 'easy-facebook-likebox' );
        ?></i>
			</p>

			<p class="widget-half" style="width:50%;float: left;">
				<input type="checkbox" class="widefat"
					   id="<?php 
        echo $this->get_field_id( 'links_new_tab' );
        ?>"
					   name="<?php 
        echo $this->get_field_name( 'links_new_tab' );
        ?>"
					   value="1" <?php 
        checked( $links_new_tab, 1 );
        ?>>
				<label style="font-weight: bold;"
					   for="<?php 
        echo $this->get_field_id( 'links_new_tab' );
        ?>"><?php 
        _e( 'Open links in New tab', 'easy-facebook-likebox' );
        ?></label>

			</p>

		<?php 
        if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
        } else {
            ?>
				<p class="widget-half" style="width: 100%;float: left;">
					<label style="font-weight: bold;"><?php 
            _e( 'Show Stories', 'easy-facebook-likebox' );
            ?>:</label>
					<?php 
            _e( "We're sorry, Account Stories not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' );
            ?>
					<a href="<?php 
            echo esc_url( efl_fs()->get_upgrade_url() );
            ?>"><?php 
            _e( 'Upgrade to PRO', 'easy-facebook-likebox' );
            ?></a>
				</p>

			<?php 
        }
        ?>

			<?php 
        if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
        } else {
            ?>
				<p class="widget-half" style="width: 100%;float: left;">
					<label style="font-weight: bold;"><?php 
            _e( 'Load More', 'easy-facebook-likebox' );
            ?>:</label>
					<?php 
            _e( "We're sorry, load more feature is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' );
            ?>
					<a href="<?php 
            echo esc_url( efl_fs()->get_upgrade_url() );
            ?>"><?php 
            _e( 'Upgrade to PRO', 'easy-facebook-likebox' );
            ?></a>
				</p>

			<?php 
        }
        ?>

			<div class="clearfix"></div>
			<p style="float: left;">
				<label style="font-weight: bold;"
					   for="<?php 
        echo $this->get_field_id( 'cache_unit' );
        ?>"><?php 
        _e( 'Check new posts after every:', 'easy-facebook-likebox' );
        ?></label><br/>

				<input class="half_field"
					   id="<?php 
        echo $this->get_field_id( 'cache_unit' );
        ?>"
					   name="<?php 
        echo $this->get_field_name( 'cache_unit' );
        ?>"
					   type="number" min="1"
					   value="<?php 
        echo esc_attr( $cache_unit );
        ?>" size="5">
				<select class="half_field"
						id="<?php 
        echo $this->get_field_id( 'cache_duration' );
        ?>"
						name="<?php 
        echo $this->get_field_name( 'cache_duration' );
        ?>">
					<option <?php 
        selected( $cache_duration, 'hours', $echo = true );
        ?>
							value="hours"><?php 
        _e( 'Hours', 'easy-facebook-likebox' );
        ?></option>
					<option <?php 
        selected( $cache_duration, 'minutes', $echo = true );
        ?>
							value="minutes"><?php 
        _e( 'Minutes', 'easy-facebook-likebox' );
        ?></option>
					<option <?php 
        selected( $cache_duration, 'days', $echo = true );
        ?>
							value="days"><?php 
        _e( 'Days', 'easy-facebook-likebox' );
        ?></option>

				</select><br/>
				<i><?php 
        _e( 'Plugin will store the posts in database temporarily and will look for new posts after every selected time duration', 'easy-facebook-likebox' );
        ?></i>
			</p>

		</div>
		<?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     * @see WP_Widget::update()
     *
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '' );
        if ( !empty( $new_instance['user_id'] ) ) {
            $instance['user_id'] = esc_sql( $new_instance['user_id'] );
        } else {
            $instance['user_id'] = '';
        }
        $instance['profile_picture'] = ( !empty( $new_instance['profile_picture'] ) ? wp_strip_all_tags( $new_instance['profile_picture'] ) : '' );
        $instance['hashtag'] = ( !empty( $new_instance['hashtag'] ) ? wp_strip_all_tags( $new_instance['hashtag'] ) : '' );
        $instance['skin_id'] = ( !empty( $new_instance['skin_id'] ) ? wp_strip_all_tags( $new_instance['skin_id'] ) : '' );
        $instance['feeds_per_page'] = ( !empty( $new_instance['feeds_per_page'] ) ? wp_strip_all_tags( $new_instance['feeds_per_page'] ) : '' );
        $instance['caption_words'] = ( !empty( $new_instance['caption_words'] ) ? wp_strip_all_tags( $new_instance['caption_words'] ) : '' );
        $instance['links_new_tab'] = ( !empty( $new_instance['links_new_tab'] ) ? wp_strip_all_tags( $new_instance['links_new_tab'] ) : '' );
        $instance['load_more'] = ( !empty( $new_instance['load_more'] ) ? wp_strip_all_tags( $new_instance['load_more'] ) : '' );
        $instance['show_stories'] = ( !empty( $new_instance['show_stories'] ) ? wp_strip_all_tags( $new_instance['show_stories'] ) : '' );
        $instance['cache_unit'] = ( !empty( $new_instance['cache_unit'] ) ? wp_strip_all_tags( $new_instance['cache_unit'] ) : '' );
        $instance['cache_duration'] = ( !empty( $new_instance['cache_duration'] ) ? wp_strip_all_tags( $new_instance['cache_duration'] ) : '' );
        return $instance;
    }

}

function esf_photo_upload_option(  $hook  ) {
    if ( $hook != 'widgets.php' ) {
        return;
    }
    wp_enqueue_script(
        'esf-image-uploader',
        FTA_PLUGIN_URL . 'admin/assets/js/esf-image-uploader.js',
        array('jquery', 'media-upload', 'thickbox'),
        '1.0.0',
        true
    );
    wp_localize_script( 'esf-image-uploader', 'esf_image_uploader', array(
        'title'    => __( 'Select or Upload Image', 'easy-facebook-likebox' ),
        'btn_text' => __( 'Use this Image', 'easy-facebook-likebox' ),
    ) );
    wp_enqueue_script( 'media-upload' );
    wp_enqueue_script( 'thickbox' );
    wp_enqueue_style( 'thickbox' );
}

add_action( 'admin_enqueue_scripts', 'esf_photo_upload_option' );