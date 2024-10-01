<?php
global $efbl_skins;

if ( isset( $efbl_skins ) ) {
	foreach ( $efbl_skins as $efbl_skin ) {

		$selected_layout = isset( $efbl_skin['layout'] ) ? $efbl_skin['layout'] : '';

		if ( ! isset( $efbl_skin['design'] ) || empty( $efbl_skin['design'] ) ) {
			continue;
		}

		$skin_id = isset( $efbl_skin['ID'] ) ? intval( $efbl_skin['ID'] ) : 0;

		/*
		* Columns Css
		*/
		$efbl_number_of_cols = esf_get_design_value( $efbl_skin, 'number_of_cols', 3 );
		$no_of_columns       = '33.33';
		switch ( $efbl_number_of_cols ) {
			case 2:
				$no_of_columns = '50';
				break;
			case 3:
				$no_of_columns = '33.33';
				break;
			case 4:
				$no_of_columns = '25';
				break;
		}
		?>

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-grid-skin .efbl-row.e-outer {
	grid-template-columns: repeat(auto-fill, minmax(<?php echo $no_of_columns; ?>%, 1fr));
}

		<?php
		/*
		* General Layout CSS
		*/
		$bg_color = esf_get_design_value( $efbl_skin, 'wraper_background_color' );
		if ( $bg_color ) :
			?>
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_feeds_holder.efbl_feeds_carousel {
	background-color: <?php echo $bg_color; ?>;
}
		<?php endif; ?>

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_feeds_holder.efbl_feeds_carousel .owl-nav {
	display: <?php echo esf_get_design_value( $efbl_skin, 'show_next_prev_icon' ) ? 'flex' : 'none !important'; ?>;
}

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_feeds_holder.efbl_feeds_carousel .owl-dots {
	display: <?php echo esf_get_design_value( $efbl_skin, 'show_nav' ) ? 'block' : 'none !important'; ?>;
}

		<?php
		$nav_color = esf_get_design_value( $efbl_skin, 'nav_color' );
		if ( $nav_color ) :
			?>
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_feeds_holder.efbl_feeds_carousel .owl-dots .owl-dot span {
	background-color: <?php echo $nav_color; ?>;
}
		<?php endif; ?>

		<?php
		$nav_active_color = esf_get_design_value( $efbl_skin, 'nav_active_color' );
		if ( $nav_active_color ) :
			?>
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_feeds_holder.efbl_feeds_carousel .owl-dots .owl-dot.active span {
	background-color: <?php echo $nav_active_color; ?>;
}
		<?php endif; ?>

		<?php
		$load_more_bg    = esf_get_design_value( $efbl_skin, 'load_more_background_color' );
		$load_more_color = esf_get_design_value( $efbl_skin, 'load_more_color' );
		if ( $load_more_bg || $load_more_color ) :
			?>
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_load_more_holder a.efbl_load_more_btn span {
			<?php if ( $load_more_bg ) : ?>
	background-color: <?php echo $load_more_bg; ?>;
	<?php endif; ?>
			<?php if ( $load_more_color ) : ?>
	color: <?php echo $load_more_color; ?>;
	<?php endif; ?>
}
		<?php endif; ?>

		<?php
		$load_more_hover_bg    = esf_get_design_value( $efbl_skin, 'load_more_hover_background_color' );
		$load_more_hover_color = esf_get_design_value( $efbl_skin, 'load_more_hover_color' );
		if ( $load_more_hover_bg || $load_more_hover_color ) :
			?>
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_load_more_holder a.efbl_load_more_btn:hover span {
			<?php if ( $load_more_hover_bg ) : ?>
	background-color: <?php echo $load_more_hover_bg; ?>;
	<?php endif; ?>
			<?php if ( $load_more_hover_color ) : ?>
	color: <?php echo $load_more_hover_color; ?>;
	<?php endif; ?>
}
		<?php endif; ?>

		<?php
		/*
		* Header CSS
		*/
		$header_bg             = esf_get_design_value( $efbl_skin, 'header_background_color' );
		$header_color          = esf_get_design_value( $efbl_skin, 'header_text_color' );
		$header_shadow         = esf_get_design_value( $efbl_skin, 'header_shadow' );
		$header_border_color   = esf_get_design_value( $efbl_skin, 'header_border_color' );
		$header_border_style   = esf_get_design_value( $efbl_skin, 'header_border_style' );
		$header_border_top     = esf_get_design_value( $efbl_skin, 'header_border_top' );
		$header_border_bottom  = esf_get_design_value( $efbl_skin, 'header_border_bottom' );
		$header_border_left    = esf_get_design_value( $efbl_skin, 'header_border_left' );
		$header_border_right   = esf_get_design_value( $efbl_skin, 'header_border_right' );
		$header_padding_top    = esf_get_design_value( $efbl_skin, 'header_padding_top' );
		$header_padding_bottom = esf_get_design_value( $efbl_skin, 'header_padding_bottom' );
		$header_padding_left   = esf_get_design_value( $efbl_skin, 'header_padding_left' );
		$header_padding_right  = esf_get_design_value( $efbl_skin, 'header_padding_right' );

		if ( $header_bg || $header_color || $header_shadow || $header_border_color || $header_border_style || $header_border_top || $header_border_bottom || $header_border_left || $header_border_right || $header_padding_top || $header_padding_bottom || $header_padding_left || $header_padding_right ) :
			?>
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_header {
			<?php if ( $header_bg ) : ?>
	background: <?php echo $header_bg; ?>;
	<?php endif; ?>
			<?php if ( $header_color ) : ?>
	color: <?php echo $header_color; ?>;
	<?php endif; ?>
			<?php if ( $header_shadow ) : ?>
	box-shadow: 0 0 10px 0 <?php echo esf_get_design_value( $efbl_skin, 'header_shadow_color', '#000' ); ?>;
	-moz-box-shadow: 0 0 10px 0 <?php echo esf_get_design_value( $efbl_skin, 'header_shadow_color', '#000' ); ?>;
	-webkit-box-shadow: 0 0 10px 0 <?php echo esf_get_design_value( $efbl_skin, 'header_shadow_color', '#000' ); ?>;
	<?php else : ?>
	box-shadow: none;
	<?php endif; ?>
			<?php if ( $header_border_color ) : ?>
	border-color: <?php echo $header_border_color; ?>;
	<?php endif; ?>
			<?php if ( $header_border_style ) : ?>
	border-style: <?php echo $header_border_style; ?>;
	<?php endif; ?>
			<?php if ( $header_border_top ) : ?>
	border-top-width: <?php echo $header_border_top; ?>px;
	<?php endif; ?>
			<?php if ( $header_border_bottom ) : ?>
	border-bottom-width: <?php echo $header_border_bottom; ?>px;
	<?php endif; ?>
			<?php if ( $header_border_left ) : ?>
	border-left-width: <?php echo $header_border_left; ?>px;
	<?php endif; ?>
			<?php if ( $header_border_right ) : ?>
	border-right-width: <?php echo $header_border_right; ?>px;
	<?php endif; ?>
			<?php if ( $header_padding_top ) : ?>
	padding-top: <?php echo $header_padding_top; ?>px;
	<?php endif; ?>
			<?php if ( $header_padding_bottom ) : ?>
	padding-bottom: <?php echo $header_padding_bottom; ?>px;
	<?php endif; ?>
			<?php if ( $header_padding_left ) : ?>
	padding-left: <?php echo $header_padding_left; ?>px;
	<?php endif; ?>
			<?php if ( $header_padding_right ) : ?>
	padding-right: <?php echo $header_padding_right; ?>px;
	<?php endif; ?>
}
		<?php endif; ?>

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_header .efbl_header_inner_wrap .efbl_header_content .efbl_header_meta .efbl_header_title {
		<?php if ( $title_size = esf_get_design_value( $efbl_skin, 'title_size' ) ) : ?>
	font-size: <?php echo $title_size; ?>px;
	<?php endif; ?>
}

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_header .efbl_header_inner_wrap .efbl_header_img img {
	border-radius: <?php echo esf_get_design_value( $efbl_skin, 'header_round_dp' ) ? '50%' : '0'; ?>;
}

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_header .efbl_header_inner_wrap .efbl_header_content .efbl_header_meta .efbl_cat,
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_header .efbl_header_inner_wrap .efbl_header_content .efbl_header_meta .efbl_followers {
		<?php if ( $metadata_size = esf_get_design_value( $efbl_skin, 'metadata_size' ) ) : ?>
	font-size: <?php echo $metadata_size; ?>px;
	<?php endif; ?>
}

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_header .efbl_header_inner_wrap .efbl_header_content .efbl_bio {
		<?php if ( $bio_size = esf_get_design_value( $efbl_skin, 'bio_size' ) ) : ?>
	font-size: <?php echo $bio_size; ?>px;
	<?php endif; ?>
}

		<?php
		/*
		* Feed CSS
		*/
		$feed_borders_color               = esf_get_design_value( $efbl_skin, 'feed_borders_color' );
		$feed_shadow                      = esf_get_design_value( $efbl_skin, 'feed_shadow' );
		$feed_bg_color                    = esf_get_design_value( $efbl_skin, 'feed_background_color' );
		$feed_padding_top                 = esf_get_design_value( $efbl_skin, 'feed_padding_top' );
		$feed_padding_bottom              = esf_get_design_value( $efbl_skin, 'feed_padding_bottom' );
		$feed_padding_left                = esf_get_design_value( $efbl_skin, 'feed_padding_left' );
		$feed_padding_right               = esf_get_design_value( $efbl_skin, 'feed_padding_right' );
		$feed_spacing                     = esf_get_design_value( $efbl_skin, 'feed_spacing' );
		$feed_text_color                  = esf_get_design_value( $efbl_skin, 'feed_text_color' );
		$feed_meta_data_color             = esf_get_design_value( $efbl_skin, 'feed_meta_data_color' );
		$popup_icon_color                 = esf_get_design_value( $efbl_skin, 'popup_icon_color' );
		$feed_hover_shadow_color          = esf_get_design_value( $efbl_skin, 'feed_hover_shadow_color' );
		$feed_type_icon_color             = esf_get_design_value( $efbl_skin, 'feed_type_icon_color' );
		$feed_meta_buttons_bg_color       = esf_get_design_value( $efbl_skin, 'feed_meta_buttons_bg_color' );
		$feed_meta_buttons_color          = esf_get_design_value( $efbl_skin, 'feed_meta_buttons_color' );
		$feed_meta_buttons_hover_bg_color = esf_get_design_value( $efbl_skin, 'feed_meta_buttons_hover_bg_color' );
		$feed_meta_buttons_hover_color    = esf_get_design_value( $efbl_skin, 'feed_meta_buttons_hover_color' );

		if ( $feed_borders_color || $feed_shadow || $feed_bg_color || $feed_padding_top || $feed_padding_bottom || $feed_padding_left || $feed_padding_right || $feed_spacing || $feed_text_color || $feed_meta_data_color || $popup_icon_color || $feed_hover_shadow_color || $feed_type_icon_color || $feed_meta_buttons_bg_color || $feed_meta_buttons_color || $feed_meta_buttons_hover_bg_color || $feed_meta_buttons_hover_color ) :
			?>
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper,
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-thumbnail-wrapper .efbl-thumbnail-col,
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-post-footer {
			<?php if ( $feed_borders_color ) : ?>
	border-color: <?php echo $feed_borders_color; ?>;
	<?php endif; ?>
}

			<?php if ( $feed_shadow ) : ?>
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper {
	box-shadow: 0 0 10px 0 <?php echo esf_get_design_value( $efbl_skin, 'feed_shadow_color', '#000' ); ?>;
	-moz-box-shadow: 0 0 10px 0 <?php echo esf_get_design_value( $efbl_skin, 'feed_shadow_color', '#000' ); ?>;
	-webkit-box-shadow: 0 0 10px 0 <?php echo esf_get_design_value( $efbl_skin, 'feed_shadow_color', '#000' ); ?>;
}
	<?php else : ?>
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper {
	box-shadow: none;
}
	<?php endif; ?>

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-thumbnail-wrapper .efbl-thumbnail-col a img {
			<?php if ( $feed_borders_color ) : ?>
	outline-color: <?php echo $feed_borders_color; ?>;
	<?php endif; ?>
}

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper,
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl_feeds_carousel .efbl-story-wrapper .efbl-grid-wrapper {
			<?php if ( $feed_bg_color ) : ?>
	background-color: <?php echo $feed_bg_color; ?>;
	<?php endif; ?>
			<?php if ( $feed_padding_top ) : ?>
	padding-top: <?php echo $feed_padding_top; ?>px;
	<?php endif; ?>
			<?php if ( $feed_padding_bottom ) : ?>
	padding-bottom: <?php echo $feed_padding_bottom; ?>px;
	<?php endif; ?>
			<?php if ( $feed_padding_left ) : ?>
	padding-left: <?php echo $feed_padding_left; ?>px;
	<?php endif; ?>
			<?php if ( $feed_padding_right ) : ?>
	padding-right: <?php echo $feed_padding_right; ?>px;
	<?php endif; ?>
			<?php if ( $feed_spacing ) : ?>
	margin-bottom: <?php echo $feed_spacing; ?>px !important;
	<?php endif; ?>
}

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper,
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-feed-content > .efbl-d-flex .efbl-profile-title span,
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-feed-content .description,
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-feed-content .description a,
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-feed-content .efbl_link_text,
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-feed-content .efbl_link_text .efbl_title_link a {
			<?php if ( $feed_text_color ) : ?>
	color: <?php echo $feed_text_color; ?>;
	<?php endif; ?>
}

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-post-footer .efbl-reacted-item,
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-post-footer .efbl-reacted-item .efbl_all_comments_wrap {
			<?php if ( $feed_meta_data_color ) : ?>
	color: <?php echo $feed_meta_data_color; ?>;
	<?php endif; ?>
}

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-overlay {
			<?php if ( $popup_icon_color ) : ?>
	color: <?php echo $popup_icon_color; ?> !important;
	<?php endif; ?>
			<?php if ( $feed_hover_shadow_color ) : ?>
	background: <?php echo $feed_hover_shadow_color; ?> !important;
	<?php endif; ?>
}

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-overlay .-story-wrapper .efbl-overlay .efbl_multimedia,
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-overlay .icon-esf-video-camera {
			<?php if ( $feed_type_icon_color ) : ?>
	color: <?php echo $feed_type_icon_color; ?> !important;
	<?php endif; ?>
}

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-post-footer .efbl-view-on-fb,
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-post-footer .esf-share-wrapper .esf-share {
			<?php if ( $feed_meta_buttons_bg_color ) : ?>
	background: <?php echo $feed_meta_buttons_bg_color; ?>;
	<?php endif; ?>
			<?php if ( $feed_meta_buttons_color ) : ?>
	color: <?php echo $feed_meta_buttons_color; ?>;
	<?php endif; ?>
}

.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-post-footer .efbl-view-on-fb:hover,
.efbl_feed_wraper.efbl_skin_<?php echo $skin_id; ?> .efbl-story-wrapper .efbl-post-footer .esf-share-wrapper .esf-share:hover {
			<?php if ( $feed_meta_buttons_hover_bg_color ) : ?>
	background: <?php echo $feed_meta_buttons_hover_bg_color; ?>;
	<?php endif; ?>
			<?php if ( $feed_meta_buttons_hover_color ) : ?>
	color: <?php echo $feed_meta_buttons_hover_color; ?>;
	<?php endif; ?>
}

		<?php endif; // End of feed CSS checks ?>

		<?php
		/*
		* Popup CSS
		*/
		?>
.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo $skin_id; ?> .efbl-d-columns-wrapper {
		<?php
		if ( $popup_bg_color = esf_get_design_value( $efbl_skin, 'popup_background_color' ) ) :
			?>
	background-color: <?php echo $popup_bg_color; ?>;
<?php endif; ?>
}
		<?php
	}
}
?>
