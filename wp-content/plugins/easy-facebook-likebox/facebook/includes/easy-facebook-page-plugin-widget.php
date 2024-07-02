<?php

class Easy_Facebook_Page_Plugin_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct( 
            'easy_facebook_page_plugin',
            // Base ID
            __( 'Easy Facebook Likebox (page plugin)', 'easy-facebook-likebox' ),
            // Name
            array(
                'description' => __( 'Drag and drop this widget for Facebook Likebox or facebook fan page plugin integration', 'easy-facebook-likebox' ),
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
        global $efbl;
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before_widget'];
        if ( !empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        echo $efbl->render_fb_page_plugin( $instance );
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
        //Get locales
        $locales = efbl_get_locales();
        $defaults = array(
            'title'        => '',
            'fb_appid'     => '',
            'fanpage_url'  => '',
            'box_width'    => 250,
            'box_height'   => '',
            'show_stream'  => 0,
            'hide_cover'   => 0,
            'responsive'   => 0,
            'hide_cta'     => 0,
            'small_header' => 0,
            'locale'       => 'en_US',
            'locale_other' => '',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        extract( $instance, EXTR_SKIP );
        ?>

		<p>
			<label for="<?php 
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
			<label for="<?php 
        echo $this->get_field_id( 'fanpage_url' );
        ?>"><?php 
        _e( 'Fanpage Url:', 'easy-facebook-likebox' );
        ?></label>
			<input class="widefat"
				    id="<?php 
        echo $this->get_field_id( 'fanpage_url' );
        ?>"
				    name="<?php 
        echo $this->get_field_name( 'fanpage_url' );
        ?>"
				    type="text"
				    value="<?php 
        echo esc_attr( $fanpage_url );
        ?>"><br/>
			<i><?php 
        _e( 'Enter full URL of the page', 'easy-facebook-likebox' );
        ?></i>
		</p>

		<p style="margin-bottom:0; ">
			<label><?php 
        _e( 'Tabs:', 'easy-facebook-likebox' );
        ?></label></p>

		<?php 
        ?>
			<p>
			<?php 
        echo __( "We're sorry, Tabs feature is not included in your plan. Please upgrade to premium version to unlock this and all other cool features. ", 'easy-facebook-likebox' );
        echo '<a href="' . efl_fs()->get_upgrade_url() . '">' . __( 'Upgrade to PRO', 'easy-facebook-likebox' ) . '</a></p>';
        ?>

		<p>
			<label for="<?php 
        echo $this->get_field_id( 'fb_appid' );
        ?>"><?php 
        _e( 'Application ID:', 'easy-facebook-likebox' );
        ?></label>
			<input class="widefat"
				    id="<?php 
        echo $this->get_field_id( 'fb_appid' );
        ?>"
				    name="<?php 
        echo $this->get_field_name( 'fb_appid' );
        ?>"
				    type="text"
				    value="<?php 
        echo esc_attr( $fb_appid );
        ?>"><br/>
			<i>Optional</i>
		</p>

		<p>
			<label for="<?php 
        echo $this->get_field_id( 'box_width' );
        ?>"><?php 
        _e( 'Width:', 'easy-facebook-likebox' );
        ?></label>
			<input class="widefat"
				    id="<?php 
        echo $this->get_field_id( 'box_width' );
        ?>"
				    name="<?php 
        echo $this->get_field_name( 'box_width' );
        ?>"
				    type="text"
				    value="<?php 
        echo esc_attr( $box_width );
        ?>"><br/>
		</p>

		<p>
			<label for="<?php 
        echo $this->get_field_id( 'box_height' );
        ?>"><?php 
        _e( 'Height:', 'easy-facebook-likebox' );
        ?></label>
			<input class="widefat"
				    id="<?php 
        echo $this->get_field_id( 'box_height' );
        ?>"
				    name="<?php 
        echo $this->get_field_name( 'box_height' );
        ?>"
				    type="text"
				    value="<?php 
        echo esc_attr( $box_height );
        ?>"><br/>
		</p>


		<p>
			<label for="<?php 
        echo $this->get_field_id( 'locale' );
        ?>"><?php 
        _e( 'Locale:', 'easy-facebook-likebox' );
        ?></label>


			<select class="widefat"
					id="<?php 
        echo $this->get_field_id( 'locale' );
        ?>"
					name="<?php 
        echo $this->get_field_name( 'locale' );
        ?>">
				<?php 
        if ( $locales ) {
            foreach ( $locales as $key => $value ) {
                ?>
						<option <?php 
                selected( $locale, $key, $echo = true );
                ?>
								value="<?php 
                esc_attr_e( $key );
                ?>"><?php 
                esc_html_e( $value );
                ?></option>
						<?php 
            }
        }
        ?>
			</select>
			<i><?php 
        _e( 'Language of your page', 'easy-facebook-likebox' );
        ?></i>
		</p>

		<p>
			<label for="<?php 
        echo $this->get_field_id( 'locale_other' );
        ?>"><?php 
        _e( 'Locale (Other):', 'easy-facebook-likebox' );
        ?></label>
			<input class="widefat"
				    id="<?php 
        echo $this->get_field_id( 'locale_other' );
        ?>"
				    name="<?php 
        echo $this->get_field_name( 'locale_other' );
        ?>"
				    type="text"
                    value="<?php 
        echo esc_attr( $locale_other );
        ?>"
				    placeholder="en_US">

			<i><?php 
        _e( 'input locale if you can not find yours in dropdown list in this format e.g fr_FR for frecnh.', 'easy-facebook-likebox' );
        ?></i>
		</p>


		<p class="widget-half" style="float:left;width: 50%;">
			<input type="checkbox" class="widefat"
				    id="<?php 
        echo $this->get_field_id( 'responsive' );
        ?>"
				    name="<?php 
        echo $this->get_field_name( 'responsive' );
        ?>"
				    value="1" <?php 
        checked( $responsive, 1 );
        ?>>
			<label for="<?php 
        echo $this->get_field_id( 'responsive' );
        ?>">Responsive</label>

		</p>

		<p class="widget-half" style="float:left;width: 50%;">
			<input type="checkbox" class="widefat"
				    id="<?php 
        echo $this->get_field_id( 'hide_cover' );
        ?>"
				    name="<?php 
        echo $this->get_field_name( 'hide_cover' );
        ?>"
				    value="1" <?php 
        checked( $hide_cover, 1 );
        ?>>
			<label for="<?php 
        echo $this->get_field_id( 'hide_cover' );
        ?>"><?php 
        _e( 'Hide Cover Photo', 'easy-facebook-likebox' );
        ?></label>

		</p>

		<p class="widget-half" style="float:left;width: 50%;">
			<input type="checkbox" class="widefat"
				    id="<?php 
        echo $this->get_field_id( 'show_stream' );
        ?>"
				    name="<?php 
        echo $this->get_field_name( 'show_stream' );
        ?>"
				    value="1" <?php 
        checked( $show_stream, 1 );
        ?>>
			<label for="<?php 
        echo $this->get_field_id( 'show_stream' );
        ?>"><?php 
        _e( 'Show Posts', 'easy-facebook-likebox' );
        ?></label>

		</p>
		<p class="widget-half" style="float:left;width: 50%;">
			<input type="checkbox" class="widefat"
				    id="<?php 
        echo $this->get_field_id( 'hide_cta' );
        ?>"
				    name="<?php 
        echo $this->get_field_name( 'hide_cta' );
        ?>"
				    value="1" <?php 
        checked( $hide_cta, 1 );
        ?>>
			<label for="<?php 
        echo $this->get_field_id( 'hide_cta' );
        ?>"><?php 
        _e( 'Hide CTA button', 'easy-facebook-likebox' );
        ?></label>

		</p>
		<p class="widget-half" style="float:left;width: 100%;">
			<input type="checkbox" class="widefat"
				    id="<?php 
        echo $this->get_field_id( 'small_header' );
        ?>"
				    name="<?php 
        echo $this->get_field_name( 'small_header' );
        ?>"
				    value="1" <?php 
        checked( $small_header, 1 );
        ?>>
			<label for="<?php 
        echo $this->get_field_id( 'small_header' );
        ?>"><?php 
        _e( 'Use small header', 'easy-facebook-likebox' );
        ?></label>

		</p>


		<div class="clearfix"></div>

		<p><?php 
        _e( 'Use below shortcode to display like box inside pages, posts or in any shortcode aware textarea/editor', 'easy-facebook-likebox' );
        ?></p>
		<?php 
        if ( empty( $show_stream ) ) {
            $show_stream = 0;
        }
        if ( empty( $show_header ) ) {
            $show_header = 0;
        }
        if ( empty( $hide_cover ) ) {
            $hide_cover = 0;
        }
        if ( !empty( $locale_other ) ) {
            $locale = $locale_other;
        }
        if ( !empty( $fb_appid ) ) {
            $fb_appid = 'fb_appid="' . $fb_appid . '"';
        }
        $fanpage_url = efbl_parse_url( $fanpage_url );
        $responsive = ( empty( $responsive ) ? wp_strip_all_tags( 0 ) : $responsive );
        $hide_cta = ( empty( $hide_cta ) ? wp_strip_all_tags( 0 ) : $hide_cta );
        $small_header = ( empty( $small_header ) ? wp_strip_all_tags( 0 ) : $small_header );
        if ( isset( $efbl_tabs_timeline ) && !empty( $efbl_tabs_timeline ) ) {
            $efbl_tabs_timeline = ( $efbl_tabs_timeline === 1 ? 'timeline,' : null );
        }
        if ( isset( $efbl_tabs_events ) && !empty( $efbl_tabs_events ) ) {
            $efbl_tabs_events = ( $efbl_tabs_events === 1 ? 'events,' : null );
        }
        if ( isset( $efbl_tabs_messages ) && !empty( $efbl_tabs_messages ) ) {
            $efbl_tabs_messages = ( $efbl_tabs_messages === 1 ? 'messages' : null );
        }
        if ( !empty( $efbl_tabs_timeline ) or !empty( $efbl_tabs_events ) or !empty( $efbl_tabs_messages ) ) {
            $tabs = 'tabs="' . $efbl_tabs_timeline . $efbl_tabs_events . $efbl_tabs_messages . '"';
        } else {
            $tabs = null;
        }
        ?>

		<p style="background:#ddd; padding:5px; "><?php 
        echo '[efb_likebox fanpage_url="' . $fanpage_url . '" ' . $tabs . ' ' . $fb_appid . ' box_width="' . $box_width . '" box_height="' . $box_height . '"  locale="' . $locale . '" responsive="' . $responsive . '" show_stream="' . $show_stream . '" hide_cover="' . $hide_cover . '" small_header="' . $small_header . '" hide_cta="' . $hide_cta . '" ]';
        ?></p>

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
        $instance['fanpage_url'] = ( !empty( $new_instance['fanpage_url'] ) ? wp_strip_all_tags( $new_instance['fanpage_url'] ) : '' );
        $instance['fb_appid'] = ( !empty( $new_instance['fb_appid'] ) ? wp_strip_all_tags( $new_instance['fb_appid'] ) : '' );
        $instance['show_stream'] = ( !empty( $new_instance['show_stream'] ) ? wp_strip_all_tags( $new_instance['show_stream'] ) : '' );
        $instance['hide_cover'] = ( !empty( $new_instance['hide_cover'] ) ? wp_strip_all_tags( $new_instance['hide_cover'] ) : '' );
        $instance['box_height'] = ( !empty( $new_instance['box_height'] ) ? wp_strip_all_tags( $new_instance['box_height'] ) : '' );
        $instance['box_width'] = ( !empty( $new_instance['box_width'] ) ? wp_strip_all_tags( $new_instance['box_width'] ) : '' );
        $instance['responsive'] = ( !empty( $new_instance['responsive'] ) ? wp_strip_all_tags( $new_instance['responsive'] ) : '' );
        $instance['small_header'] = ( !empty( $new_instance['small_header'] ) ? wp_strip_all_tags( $new_instance['small_header'] ) : '' );
        $instance['hide_cta'] = ( !empty( $new_instance['hide_cta'] ) ? wp_strip_all_tags( $new_instance['hide_cta'] ) : '' );
        $instance['locale'] = ( !empty( $new_instance['locale'] ) ? wp_strip_all_tags( $new_instance['locale'] ) : '' );
        $instance['locale_other'] = ( !empty( $new_instance['locale_other'] ) ? wp_strip_all_tags( $new_instance['locale_other'] ) : '' );
        return $instance;
    }

}
