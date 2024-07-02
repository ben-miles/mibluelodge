<?php
global  $efbl_skins;
if ( isset( $efbl_skins ) ) {
	foreach ( $efbl_skins as $efbl_skin ) {

	  $selected_layout = $efbl_skin['layout'];

	  if( !isset( $efbl_skin['design'] ) || empty( $efbl_skin['design'] ) ){

		continue;

	  }

	  $skin_id = $efbl_skin['ID'];

	  /*
	  * Columns Css
	  */

	  if( isset( $efbl_skin['design']['number_of_cols'] ) ){

		$efbl_number_of_cols = $efbl_skin['design']['number_of_cols'];

		switch ($efbl_number_of_cols) {
		  case 2:
		   $no_of_columns = '50';
		  break;
		  case 3:
		   $no_of_columns = '33.33';
		  break;
		  case 4:
		   $no_of_columns = '25';
		  break;

		  default:
			$no_of_columns = '33.33';
		  break;
		} ?>

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-grid-skin .efbl-row.e-outer {
    grid-template-columns: repeat(auto-fill, minmax(<?php echo $no_of_columns; ?>%, 1fr));
}

<?php  }



  /*
  * General Layout CSS
  */
  ?>

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_feeds_holder.efbl_feeds_carousel {

<?php if( $efbl_skin['design']['wraper_background_color'] ){ ?> background-color: <?php echo $efbl_skin['design']['wraper_background_color']; ?>;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_feeds_holder.efbl_feeds_carousel .owl-nav {

<?php if( $efbl_skin['design']['show_next_prev_icon'] ){ ?> display: flex;

<?php }else{ ?> display: none !important;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_feeds_holder.efbl_feeds_carousel .owl-dots {

<?php if( $efbl_skin['design']['show_nav'] ){ ?> display: block;

<?php }else{ ?> display: none !important;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_feeds_holder.efbl_feeds_carousel .owl-dots .owl-dot span {

<?php if( $efbl_skin['design']['nav_color'] ){ ?> background-color: <?php echo $efbl_skin['design']['nav_color']; ?>;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_feeds_holder.efbl_feeds_carousel .owl-dots .owl-dot.active span {

<?php if( $efbl_skin['design']['nav_active_color'] ){ ?> background-color: <?php echo $efbl_skin['design']['nav_active_color']; ?>;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_load_more_holder a.efbl_load_more_btn span {

<?php if( $efbl_skin['design']['load_more_background_color'] ){ ?> background-color: <?php echo $efbl_skin['design']['load_more_background_color']; ?>;

<?php } ?><?php if( $efbl_skin['design']['load_more_color'] ){ ?> color: <?php echo $efbl_skin['design']['load_more_color']; ?>;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_load_more_holder a.efbl_load_more_btn:hover span {

<?php if( $efbl_skin['design']['load_more_hover_background_color'] ){ ?> background-color: <?php echo $efbl_skin['design']['load_more_hover_background_color']; ?>;

<?php } ?><?php if( $efbl_skin['design']['load_more_hover_color'] ){ ?> color: <?php echo $efbl_skin['design']['load_more_hover_color']; ?>;

<?php } ?>

}

<?php
 /*
* Header CSS
*/
?>
.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_header {

<?php if( $efbl_skin['design']['header_background_color'] ){ ?> background: <?php echo $efbl_skin['design']['header_background_color']; ?>;

<?php } ?><?php if( $efbl_skin['design']['header_text_color'] ){ ?> color: <?php echo $efbl_skin['design']['header_text_color']; ?>;

<?php } ?><?php if( isset( $efbl_skin['design']['header_shadow'] ) && !empty( $efbl_skin['design']['header_shadow'] ) ){ ?> box-shadow: 0 0 10px 0 <?php echo $efbl_skin['design']['header_shadow_color']; ?>;
    -moz-box-shadow: 0 0 10px 0 <?php echo $efbl_skin['design']['header_shadow_color']; ?>;
    -webkit-box-shadow: 0 0 10px 0 <?php echo $efbl_skin['design']['header_shadow_color']; ?>;


<?php }else{ ?> box-shadow: none;

<?php } ?><?php if( $efbl_skin['design']['header_border_color'] ){ ?> border-color: <?php echo $efbl_skin['design']['header_border_color']; ?>;

<?php } ?><?php if( $efbl_skin['design']['header_border_style'] ){ ?> border-style: <?php echo $efbl_skin['design']['header_border_style']; ?>;

<?php } ?><?php if( $efbl_skin['design']['header_border_top'] ){ ?> border-top-width: <?php echo $efbl_skin['design']['header_border_top']; ?>px;

<?php } ?><?php if( $efbl_skin['design']['header_border_bottom'] ){ ?> border-bottom-width: <?php echo $efbl_skin['design']['header_border_bottom']; ?>px;

<?php } ?><?php if( $efbl_skin['design']['header_border_left'] ){ ?> border-left-width: <?php echo $efbl_skin['design']['header_border_left']; ?>px;

<?php } ?><?php if( $efbl_skin['design']['header_border_right'] ){ ?> border-right-width: <?php echo $efbl_skin['design']['header_border_right']; ?>px;

<?php } ?><?php if( $efbl_skin['design']['header_padding_top'] ){ ?> padding-top: <?php echo $efbl_skin['design']['header_padding_top']; ?>px;

<?php } ?><?php if( $efbl_skin['design']['header_padding_bottom'] ){ ?> padding-bottom: <?php echo $efbl_skin['design']['header_padding_bottom']; ?>px;

<?php } ?><?php if( $efbl_skin['design']['header_padding_left'] ){ ?> padding-left: <?php echo $efbl_skin['design']['header_padding_left']; ?>px;

<?php } ?><?php if( $efbl_skin['design']['header_padding_right'] ){ ?> padding-right: <?php echo $efbl_skin['design']['header_padding_right']; ?>px;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_header .efbl_header_inner_wrap .efbl_header_content .efbl_header_meta .efbl_header_title {

<?php if( $efbl_skin['design']['title_size'] ){ ?> font-size: <?php echo $efbl_skin['design']['title_size']; ?>px;

<?php } ?>

}


.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_header .efbl_header_inner_wrap .efbl_header_img img {

<?php if( $efbl_skin['design']['header_round_dp'] ){ ?> border-radius: 50%;

<?php }else{ ?> border-radius: 0;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_header .efbl_header_inner_wrap .efbl_header_content .efbl_header_meta .efbl_cat, .efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_header .efbl_header_inner_wrap .efbl_header_content .efbl_header_meta .efbl_followers {

<?php if( $efbl_skin['design']['metadata_size'] ){ ?> font-size: <?php echo $efbl_skin['design']['metadata_size']; ?>px;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_header .efbl_header_inner_wrap .efbl_header_content .efbl_bio {

<?php if( $efbl_skin['design']['bio_size'] ){ ?> font-size: <?php echo $efbl_skin['design']['bio_size']; ?>px;

<?php } ?>

}

<?php
  /*
  * Feed CSS
  */
  ?>
.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper, .efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-thumbnail-wrapper .efbl-thumbnail-col, .efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-post-footer {

<?php if( $efbl_skin['design']['feed_borders_color'] ){ ?> border-color: <?php echo $efbl_skin['design']['feed_borders_color']; ?>;

<?php } ?>

}

<?php if( isset( $efbl_skin['design']['feed_shadow'] ) && !empty( $efbl_skin['design']['feed_shadow'] ) ){ ?>

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper {

    box-shadow: 0 0 10px 0 <?php echo $efbl_skin['design']['feed_shadow_color']; ?>;
    -moz-box-shadow: 0 0 10px 0 <?php echo $efbl_skin['design']['feed_shadow_color']; ?>;
    -webkit-box-shadow: 0 0 10px 0 <?php echo $efbl_skin['design']['feed_shadow_color']; ?>;

}

<?php }else{ ?>

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper {
    box-shadow: none;
}

<?php } ?>

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-thumbnail-wrapper .efbl-thumbnail-col a img {

<?php if( $efbl_skin['design']['feed_borders_color'] ){ ?> outline-color: <?php echo $efbl_skin['design']['feed_borders_color']; ?>;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper, .efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl_feeds_carousel .efbl-story-wrapper .efbl-grid-wrapper {

<?php if( $efbl_skin['design']['feed_background_color'] ){ ?> background-color: <?php echo $efbl_skin['design']['feed_background_color']; ?>;

<?php } ?><?php if( $efbl_skin['design']['feed_padding_top'] ){ ?> padding-top: <?php echo $efbl_skin['design']['feed_padding_top']; ?>px;

<?php } ?><?php if( $efbl_skin['design']['feed_padding_bottom'] ){ ?> padding-bottom: <?php echo $efbl_skin['design']['feed_padding_bottom']; ?>px;

<?php } ?><?php if( $efbl_skin['design']['feed_padding_left'] ){ ?> padding-left: <?php echo $efbl_skin['design']['feed_padding_left']; ?>px;

<?php } ?><?php if( $efbl_skin['design']['feed_padding_right'] ){ ?> padding-right: <?php echo $efbl_skin['design']['feed_padding_right']; ?>px;

<?php } ?><?php if( $efbl_skin['design']['feed_spacing'] ){ ?> margin-bottom: <?php echo $efbl_skin['design']['feed_spacing']; ?>px !important;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper, .efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-feed-content > .efbl-d-flex .efbl-profile-title span, .efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-feed-content .description, .efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-feed-content .description a, .efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-feed-content .efbl_link_text, .efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-feed-content .efbl_link_text .efbl_title_link a {

<?php if( $efbl_skin['design']['feed_text_color'] ){ ?> color: <?php echo $efbl_skin['design']['feed_text_color']; ?>;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-post-footer .efbl-reacted-item, .efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-post-footer .efbl-reacted-item .efbl_all_comments_wrap {

<?php if( $efbl_skin['design']['feed_meta_data_color'] ){ ?> color: <?php echo $efbl_skin['design']['feed_meta_data_color']; ?>;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-overlay {

<?php if( $efbl_skin['design']['popup_icon_color'] ){ ?> color: <?php echo $efbl_skin['design']['popup_icon_color']; ?> !important;

<?php } ?><?php if( $efbl_skin['design']['feed_hover_shadow_color'] ){ ?> background: <?php echo $efbl_skin['design']['feed_hover_shadow_color']; ?> !important;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-overlay .efbl_multimedia, .efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-overlay .icon-esf-video-camera {

<?php if( $efbl_skin['design']['feed_type_icon_color'] ){ ?> color: <?php echo $efbl_skin['design']['feed_type_icon_color']; ?> !important;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-post-footer .efbl-view-on-fb, .efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-post-footer .esf-share-wrapper .esf-share {

<?php if( $efbl_skin['design']['feed_meta_buttons_bg_color'] ){ ?> background: <?php echo $efbl_skin['design']['feed_meta_buttons_bg_color']; ?>;

<?php } ?><?php if( $efbl_skin['design']['feed_meta_buttons_color'] ){ ?> color: <?php echo $efbl_skin['design']['feed_meta_buttons_color']; ?>;

<?php } ?>

}

.efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-post-footer .efbl-view-on-fb:hover, .efbl_feed_wraper.efbl_skin_<?php echo intval( $skin_id ) ;?> .efbl-story-wrapper .efbl-post-footer .esf-share-wrapper .esf-share:hover {

<?php if( $efbl_skin['design']['feed_meta_buttons_hover_bg_color'] ){ ?> background: <?php echo $efbl_skin['design']['feed_meta_buttons_hover_bg_color']; ?>;

<?php } ?><?php if( $efbl_skin['design']['feed_meta_buttons_hover_color'] ){ ?> color: <?php echo $efbl_skin['design']['feed_meta_buttons_hover_color']; ?>;

<?php } ?>

}

<?php
/*
* Popup CSS
*/
?>
.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-d-columns-wrapper, .efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-d-columns-wrapper .efbl-caption::after {

<?php if( $efbl_skin['design']['popup_sidebar_bg'] ){ ?> background: <?php echo $efbl_skin['design']['popup_sidebar_bg']; ?>;

<?php } ?>

}

.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-d-columns-wrapper, .efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-d-columns-wrapper .efbl-caption .efbl-feed-description, .efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> a, .efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> span {

<?php if( $efbl_skin['design']['popup_sidebar_color'] ){ ?> color: <?php echo $efbl_skin['design']['popup_sidebar_color']; ?>;

<?php } ?>

}

.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-d-columns-wrapper .efbl-post-header {

<?php if( $efbl_skin['design']['popup_show_header'] ){ ?> display: flex;

<?php }else{ ?> display: none !important;

<?php } ?>

}

.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-d-columns-wrapper .efbl-post-header .efbl-profile-image {

<?php if( $efbl_skin['design']['popup_show_header_logo'] ){ ?> display: block;

<?php }else{ ?> display: none;

<?php } ?>

}

.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-d-columns-wrapper .efbl-post-header h2 {

<?php if( $efbl_skin['design']['popup_header_title_color'] ){ ?> color: <?php echo $efbl_skin['design']['popup_header_title_color']; ?>;

<?php } ?>

}

.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-d-columns-wrapper .efbl-post-header span {

<?php if( $efbl_skin['design']['popup_post_time_color'] ){ ?> color: <?php echo $efbl_skin['design']['popup_post_time_color']; ?>;

<?php } ?>

}

.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-feed-description, .efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl_link_text {

<?php if( $efbl_skin['design']['popup_show_caption'] ){ ?> display: block;

<?php }else{ ?> display: none;

<?php } ?>

}

.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-d-columns-wrapper .efbl-reactions-box {

<?php if( $efbl_skin['design']['popup_show_meta'] ){ ?> display: flex;

<?php }else{ ?> display: none !important;

<?php } ?><?php if( $efbl_skin['design']['popup_meta_border_color'] ){ ?> border-color: <?php echo $efbl_skin['design']['popup_meta_border_color']; ?>;

<?php } ?>

}

.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-d-columns-wrapper .efbl-reactions-box .efbl-reactions span {

<?php if( $efbl_skin['design']['popup_meta_color'] ){ ?> color: <?php echo $efbl_skin['design']['popup_meta_color']; ?>;

<?php } ?>

}


.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-d-columns-wrapper .efbl-reactions-box .efbl-reactions .efbl_popup_likes_main {

<?php if( $efbl_skin['design']['popup_show_reactions_counter'] ){ ?> display: flex;

<?php }else{ ?> display: none !important;

<?php } ?>

}

.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-d-columns-wrapper .efbl-reactions-box .efbl-reactions .efbl-popup-comments-icon-wrapper {

<?php if( $efbl_skin['design']['popup_show_comments_counter'] ){ ?> display: flex;

<?php }else{ ?> display: none !important;

<?php } ?>

}

.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-commnets, .efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-comments-list {

<?php if( $efbl_skin['design']['popup_show_comments'] ){ ?> display: block;

<?php }else{ ?> display: none;

<?php } ?>

}

.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-action-btn {

<?php if( $efbl_skin['design']['popup_show_view_fb_link'] ){ ?> display: block;

<?php }else{ ?> display: none;

<?php } ?>

}

.efbl_feed_popup_container .efbl-post-detail.efbl-popup-skin-<?php echo intval( $skin_id ) ;?> .efbl-d-columns-wrapper .efbl-comments-list .efbl-comment-wrap {

<?php if( $efbl_skin['design']['popup_comments_color'] ){ ?> color: <?php echo $efbl_skin['design']['popup_comments_color']; ?>;

<?php } ?>

}


<?php  }  
  }      

  ?>
  