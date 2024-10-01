<?php
global $mif_skins;

if ( isset( $mif_skins ) ) {
	foreach ( $mif_skins as $esf_insta_skin ) {

		$selected_layout = isset( $esf_insta_skin['layout'] ) ? $esf_insta_skin['layout'] : '';

		if ( ! isset( $esf_insta_skin['design'] ) || empty( $esf_insta_skin['design'] ) ) {
			continue;
		}

		$skin_id = isset( $esf_insta_skin['ID'] ) ? intval( $esf_insta_skin['ID'] ) : 0;

		/*
		* Columns Css
		*/
		$efbl_number_of_cols = esf_get_design_value( $esf_insta_skin, 'number_of_cols', 3 );
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

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-grid-skin .esf-insta-row.e-outer {
	grid-template-columns: repeat(auto-fill, minmax(<?php echo $no_of_columns; ?>%, 1fr));
}

		<?php
		/*
		* General Layout CSS
		*/
		?>
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf_insta_feeds_holder.esf_insta_feeds_carousel .owl-nav {
	display: <?php echo esf_get_design_value( $esf_insta_skin, 'show_next_prev_icon' ) ? 'flex' : 'none !important'; ?>;
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf_insta_feeds_holder.esf_insta_feeds_carousel .owl-dots span {
		<?php if ( $nav_color = esf_get_design_value( $esf_insta_skin, 'nav_color' ) ) : ?>
	background-color: <?php echo $nav_color; ?>;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf_insta_feeds_holder.esf_insta_feeds_carousel .owl-dots .owl-dot.active span {
		<?php if ( $nav_active_color = esf_get_design_value( $esf_insta_skin, 'nav_active_color' ) ) : ?>
	background-color: <?php echo $nav_active_color; ?>;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf_insta_feeds_holder.esf_insta_feeds_carousel .owl-dots {
	display: <?php echo esf_get_design_value( $esf_insta_skin, 'show_nav' ) ? 'block' : 'none !important'; ?>;
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf_insta_load_more_holder a.esf_insta_load_more_btn span {
		<?php if ( $load_more_bg = esf_get_design_value( $esf_insta_skin, 'load_more_background_color' ) ) : ?>
	background-color: <?php echo $load_more_bg; ?>;
	<?php endif; ?>
		<?php if ( $load_more_color = esf_get_design_value( $esf_insta_skin, 'load_more_color' ) ) : ?>
	color: <?php echo $load_more_color; ?>;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf_insta_load_more_holder a.esf_insta_load_more_btn:hover span {
		<?php if ( $load_more_hover_bg = esf_get_design_value( $esf_insta_skin, 'load_more_hover_background_color' ) ) : ?>
	background-color: <?php echo $load_more_hover_bg; ?>;
	<?php endif; ?>
		<?php if ( $load_more_hover_color = esf_get_design_value( $esf_insta_skin, 'load_more_hover_color' ) ) : ?>
	color: <?php echo $load_more_hover_color; ?>;
	<?php endif; ?>
}

		<?php
		/*
		* Header CSS
		*/
		?>
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf_insta_header {
		<?php if ( $header_bg = esf_get_design_value( $esf_insta_skin, 'header_background_color' ) ) : ?>
	background: <?php echo $header_bg; ?>;
	<?php endif; ?>
		<?php if ( $header_color = esf_get_design_value( $esf_insta_skin, 'header_text_color' ) ) : ?>
	color: <?php echo $header_color; ?>;
	<?php endif; ?>
		<?php if ( esf_get_design_value( $esf_insta_skin, 'header_shadow' ) ) : ?>
	box-shadow: 0 0 10px 0 <?php echo esf_get_design_value( $esf_insta_skin, 'header_shadow_color', '#000' ); ?>;
	-moz-box-shadow: 0 0 10px 0 <?php echo esf_get_design_value( $esf_insta_skin, 'header_shadow_color', '#000' ); ?>;
	-webkit-box-shadow: 0 0 10px 0 <?php echo esf_get_design_value( $esf_insta_skin, 'header_shadow_color', '#000' ); ?>;
	<?php else : ?>
	box-shadow: none;
	<?php endif; ?>
		<?php if ( $header_border_color = esf_get_design_value( $esf_insta_skin, 'header_border_color' ) ) : ?>
	border-color: <?php echo $header_border_color; ?>;
	<?php endif; ?>
		<?php if ( $header_border_style = esf_get_design_value( $esf_insta_skin, 'header_border_style' ) ) : ?>
	border-style: <?php echo $header_border_style; ?>;
	<?php endif; ?>
		<?php if ( $header_border_top = esf_get_design_value( $esf_insta_skin, 'header_border_top' ) ) : ?>
	border-top-width: <?php echo $header_border_top; ?>px;
	<?php endif; ?>
		<?php if ( $header_border_bottom = esf_get_design_value( $esf_insta_skin, 'header_border_bottom' ) ) : ?>
	border-bottom-width: <?php echo $header_border_bottom; ?>px;
	<?php endif; ?>
		<?php if ( $header_border_left = esf_get_design_value( $esf_insta_skin, 'header_border_left' ) ) : ?>
	border-left-width: <?php echo $header_border_left; ?>px;
	<?php endif; ?>
		<?php if ( $header_border_right = esf_get_design_value( $esf_insta_skin, 'header_border_right' ) ) : ?>
	border-right-width: <?php echo $header_border_right; ?>px;
	<?php endif; ?>
		<?php if ( $header_padding_top = esf_get_design_value( $esf_insta_skin, 'header_padding_top' ) ) : ?>
	padding-top: <?php echo $header_padding_top; ?>px;
	<?php endif; ?>
		<?php if ( $header_padding_bottom = esf_get_design_value( $esf_insta_skin, 'header_padding_bottom' ) ) : ?>
	padding-bottom: <?php echo $header_padding_bottom; ?>px;
	<?php endif; ?>
		<?php if ( $header_padding_left = esf_get_design_value( $esf_insta_skin, 'header_padding_left' ) ) : ?>
	padding-left: <?php echo $header_padding_left; ?>px;
	<?php endif; ?>
		<?php if ( $header_padding_right = esf_get_design_value( $esf_insta_skin, 'header_padding_right' ) ) : ?>
	padding-right: <?php echo $header_padding_right; ?>px;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf_insta_header .esf_insta_header_inner_wrap .esf_insta_header_content .esf_insta_header_meta .esf_insta_header_title {
		<?php if ( $title_size = esf_get_design_value( $esf_insta_skin, 'title_size' ) ) : ?>
	font-size: <?php echo $title_size; ?>px;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf_insta_header .esf_insta_header_inner_wrap .esf_insta_header_content .esf_insta_header_meta .esf_insta_header_title a {
		<?php if ( $header_color = esf_get_design_value( $esf_insta_skin, 'header_text_color' ) ) : ?>
	color: <?php echo $header_color; ?>;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf_insta_header .esf_insta_header_inner_wrap .esf_insta_header_img img {
	border-radius: <?php echo esf_get_design_value( $esf_insta_skin, 'header_round_dp' ) ? '50%' : '0'; ?>;
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf_insta_header .esf_insta_header_inner_wrap .esf_insta_header_content .esf_insta_header_meta .esf_insta_cat,
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf_insta_header .esf_insta_header_inner_wrap .esf_insta_header_content .esf_insta_header_meta .esf_insta_followers {
		<?php if ( $metadata_size = esf_get_design_value( $esf_insta_skin, 'metadata_size' ) ) : ?>
	font-size: <?php echo $metadata_size; ?>px;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf_insta_header .esf_insta_header_inner_wrap .esf_insta_header_content .esf_insta_bio {
		<?php if ( $bio_size = esf_get_design_value( $esf_insta_skin, 'bio_size' ) ) : ?>
	font-size: <?php echo $bio_size; ?>px;
	<?php endif; ?>
}

		<?php
		/*
		* Feed CSS
		*/
		?>
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper,
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper .esf-insta-thumbnail-wrapper .esf-insta-thumbnail-col,
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper .esf-insta-post-footer {
		<?php if ( $feed_borders_color = esf_get_design_value( $esf_insta_skin, 'feed_borders_color' ) ) : ?>
	border-color: <?php echo $feed_borders_color; ?>;
	<?php endif; ?>
}

		<?php if ( esf_get_design_value( $esf_insta_skin, 'feed_shadow' ) ) : ?>
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper {
	box-shadow: 0 0 10px 0 <?php echo esf_get_design_value( $esf_insta_skin, 'feed_shadow_color', '#000' ); ?>;
	-moz-box-shadow: 0 0 10px 0 <?php echo esf_get_design_value( $esf_insta_skin, 'feed_shadow_color', '#000' ); ?>;
	-webkit-box-shadow: 0 0 10px 0 <?php echo esf_get_design_value( $esf_insta_skin, 'feed_shadow_color', '#000' ); ?>;
}
<?php else : ?>
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper {
	box-shadow: none;
}
<?php endif; ?>

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper .esf-insta-thumbnail-wrapper .esf-insta-thumbnail-col a img {
		<?php if ( $feed_borders_color = esf_get_design_value( $esf_insta_skin, 'feed_borders_color' ) ) : ?>
	outline-color: <?php echo $feed_borders_color; ?>;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper,
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta_feeds_carousel .esf-insta-story-wrapper .esf-insta-grid-wrapper {
		<?php if ( $feed_bg_color = esf_get_design_value( $esf_insta_skin, 'feed_background_color' ) ) : ?>
	background-color: <?php echo $feed_bg_color; ?>;
	<?php endif; ?>
		<?php if ( $feed_padding_top = esf_get_design_value( $esf_insta_skin, 'feed_padding_top' ) ) : ?>
	padding-top: <?php echo $feed_padding_top; ?>px;
	<?php endif; ?>
		<?php if ( $feed_padding_bottom = esf_get_design_value( $esf_insta_skin, 'feed_padding_bottom' ) ) : ?>
	padding-bottom: <?php echo $feed_padding_bottom; ?>px;
	<?php endif; ?>
		<?php if ( $feed_padding_left = esf_get_design_value( $esf_insta_skin, 'feed_padding_left' ) ) : ?>
	padding-left: <?php echo $feed_padding_left; ?>px;
	<?php endif; ?>
		<?php if ( $feed_padding_right = esf_get_design_value( $esf_insta_skin, 'feed_padding_right' ) ) : ?>
	padding-right: <?php echo $feed_padding_right; ?>px;
	<?php endif; ?>
		<?php if ( $feed_spacing = esf_get_design_value( $esf_insta_skin, 'feed_spacing' ) ) : ?>
	margin-bottom: <?php echo $feed_spacing; ?>px !important;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper,
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta_feeds_carousel .esf-insta-story-wrapper .esf-insta-grid-wrapper {
		<?php if ( $feed_text_color = esf_get_design_value( $esf_insta_skin, 'feed_text_color' ) ) : ?>
	color: <?php echo $feed_text_color; ?>;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper .esf-insta-post-footer .esf-insta-reacted-item,
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper .esf-insta-post-footer .esf-insta-reacted-item .esf_insta_all_comments_wrap {
		<?php if ( $feed_meta_data_color = esf_get_design_value( $esf_insta_skin, 'feed_meta_data_color' ) ) : ?>
	color: <?php echo $feed_meta_data_color; ?>;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper .esf-insta-overlay {
		<?php if ( $popup_icon_color = esf_get_design_value( $esf_insta_skin, 'popup_icon_color' ) ) : ?>
	color: <?php echo $popup_icon_color; ?> !important;
	<?php endif; ?>
		<?php if ( $feed_hover_shadow_color = esf_get_design_value( $esf_insta_skin, 'feed_hover_shadow_color' ) ) : ?>
	background: <?php echo $feed_hover_shadow_color; ?> !important;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper .esf-insta-overlay .esf_insta_multimedia,
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper .esf-insta-overlay .icon-esf-video-camera {
		<?php if ( $feed_type_icon_color = esf_get_design_value( $esf_insta_skin, 'feed_type_icon_color' ) ) : ?>
	color: <?php echo $feed_type_icon_color; ?> !important;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper .esf-insta-post-footer .esf-insta-view-on-fb,
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper .esf-insta-post-footer .esf-share-wrapper .esf-share {
		<?php if ( $feed_meta_buttons_bg_color = esf_get_design_value( $esf_insta_skin, 'feed_meta_buttons_bg_color' ) ) : ?>
	background: <?php echo $feed_meta_buttons_bg_color; ?>;
	<?php endif; ?>
		<?php if ( $feed_meta_buttons_color = esf_get_design_value( $esf_insta_skin, 'feed_meta_buttons_color' ) ) : ?>
	color: <?php echo $feed_meta_buttons_color; ?>;
	<?php endif; ?>
}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper .esf-insta-post-footer .esf-insta-view-on-fb:hover,
.esf_insta_feed_wraper.esf-insta-skin-<?php echo $skin_id; ?> .esf-insta-story-wrapper .esf-insta-post-footer .esf-share-wrapper .esf-share:hover {
		<?php if ( $feed_meta_buttons_hover_bg_color = esf_get_design_value( $esf_insta_skin, 'feed_meta_buttons_hover_bg_color' ) ) : ?>
	background: <?php echo $feed_meta_buttons_hover_bg_color; ?>;
	<?php endif; ?>
		<?php if ( $feed_meta_buttons_hover_color = esf_get_design_value( $esf_insta_skin, 'feed_meta_buttons_hover_color' ) ) : ?>
	color: <?php echo $feed_meta_buttons_hover_color; ?>;
	<?php endif; ?>
}

		<?php
		/*
		* Popup CSS
		*/
		?>
.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-d-columns-wrapper,
.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-d-columns-wrapper .esf-insta-caption::after {
		<?php if ( $popup_sidebar_bg = esf_get_design_value( $esf_insta_skin, 'popup_sidebar_bg' ) ) : ?>
	background: <?php echo $popup_sidebar_bg; ?>;
	<?php endif; ?>
}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-d-columns-wrapper,
.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-d-columns-wrapper .esf-insta-caption .esf-insta-feed-description,
.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> a,
.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> span {
		<?php if ( $popup_sidebar_color = esf_get_design_value( $esf_insta_skin, 'popup_sidebar_color' ) ) : ?>
	color: <?php echo $popup_sidebar_color; ?>;
	<?php endif; ?>
}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-d-columns-wrapper .esf-insta-post-header {
	display: <?php echo esf_get_design_value( $esf_insta_skin, 'popup_show_header' ) ? 'flex' : 'none !important'; ?>;
}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-d-columns-wrapper .esf-insta-post-header .esf-insta-profile-image {
	display: <?php echo esf_get_design_value( $esf_insta_skin, 'popup_show_header_logo' ) ? 'block' : 'none'; ?>;
}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-d-columns-wrapper .esf-insta-post-header h2 {
		<?php if ( $popup_header_title_color = esf_get_design_value( $esf_insta_skin, 'popup_header_title_color' ) ) : ?>
	color: <?php echo $popup_header_title_color; ?>;
	<?php endif; ?>
}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-d-columns-wrapper .esf-insta-post-header span {
		<?php if ( $popup_post_time_color = esf_get_design_value( $esf_insta_skin, 'popup_post_time_color' ) ) : ?>
	color: <?php echo $popup_post_time_color; ?>;
	<?php endif; ?>
}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-feed-description,
.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta_link_text {
	display: <?php echo esf_get_design_value( $esf_insta_skin, 'popup_show_caption' ) ? 'block' : 'none'; ?>;
}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-d-columns-wrapper .esf-insta-reactions-box {
	display: <?php echo esf_get_design_value( $esf_insta_skin, 'popup_show_meta' ) ? 'flex' : 'none !important'; ?>;
		<?php if ( $popup_meta_border_color = esf_get_design_value( $esf_insta_skin, 'popup_meta_border_color' ) ) : ?>
	border-color: <?php echo $popup_meta_border_color; ?>;
	<?php endif; ?>
}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-d-columns-wrapper .esf-insta-reactions-box .esf-insta-reactions span {
		<?php if ( $popup_meta_color = esf_get_design_value( $esf_insta_skin, 'popup_meta_color' ) ) : ?>
	color: <?php echo $popup_meta_color; ?>;
	<?php endif; ?>
}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-d-columns-wrapper .esf-insta-reactions-box .esf-insta-reactions .esf_insta_popup_likes_main {
	display: <?php echo esf_get_design_value( $esf_insta_skin, 'popup_show_reactions_counter' ) ? 'flex' : 'none !important'; ?>;
}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-d-columns-wrapper .esf-insta-reactions-box .esf-insta-reactions .esf-insta-popup-comments-icon-wrapper {
	display: <?php echo esf_get_design_value( $esf_insta_skin, 'popup_show_comments_counter' ) ? 'flex' : 'none !important'; ?>;
}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-commnets,
.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-comments-list {
	display: <?php echo esf_get_design_value( $esf_insta_skin, 'popup_show_comments' ) ? 'block' : 'none'; ?>;
}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-action-btn {
	display: <?php echo esf_get_design_value( $esf_insta_skin, 'popup_show_view_fb_link' ) ? 'block' : 'none'; ?>;
}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo $skin_id; ?> .esf-insta-d-columns-wrapper .esf-insta-comments-list .esf-insta-comment-wrap {
		<?php if ( $popup_comments_color = esf_get_design_value( $esf_insta_skin, 'popup_comments_color' ) ) : ?>
	color: <?php echo $popup_comments_color; ?>;
	<?php endif; ?>
}

		<?php
	}
}
?>
