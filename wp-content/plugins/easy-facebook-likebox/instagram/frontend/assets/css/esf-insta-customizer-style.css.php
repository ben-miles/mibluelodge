<?php

global  $mif_skins;

if ( isset( $mif_skins ) ) {
	foreach ( $mif_skins as $esf_insta_skin ) {

	  $selected_layout = $esf_insta_skin['layout'];

	  if( !isset( $esf_insta_skin['design'] ) || empty( $esf_insta_skin['design'] ) ){

		continue;

	  }

	  $skin_id = $esf_insta_skin['ID'];
	  
	  /*
	  * Columns Css
	  */
	  if( isset( $esf_insta_skin['design']['number_of_cols'] ) ){

		$efbl_number_of_cols = $esf_insta_skin['design']['number_of_cols'];

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

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-grid-skin .esf-insta-row.e-outer {
    grid-template-columns: repeat(auto-fill, minmax(<?php echo $no_of_columns; ?>%, 1fr));
}

<?php  }

  /*
  * General Layout CSS
  */
  ?>

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_feeds_holder.esf_insta_feeds_carousel .owl-nav {

<?php if( $esf_insta_skin['design']['show_next_prev_icon'] ){ ?> display: flex;

<?php }else{ ?> display: none !important;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_feeds_holder.esf_insta_feeds_carousel .owl-dots span {

<?php if( $esf_insta_skin['design']['nav_color'] ){ ?> background-color: <?php echo $esf_insta_skin['design']['nav_color']; ?>;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_feeds_holder.esf_insta_feeds_carousel .owl-dots .owl-dot.active span {

<?php if( $esf_insta_skin['design']['nav_active_color'] ){ ?> background-color: <?php echo $esf_insta_skin['design']['nav_active_color']; ?>;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_feeds_holder.esf_insta_feeds_carousel .owl-dots {

<?php if( $esf_insta_skin['design']['show_nav'] ){ ?> display: block;

<?php }else{ ?> display: none !important;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_load_more_holder a.esf_insta_load_more_btn span {

<?php if( $esf_insta_skin['design']['load_more_background_color'] ){ ?> background-color: <?php echo $esf_insta_skin['design']['load_more_background_color']; ?>;

<?php } ?><?php if( $esf_insta_skin['design']['load_more_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['load_more_color']; ?>;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_load_more_holder a.esf_insta_load_more_btn:hover span {

<?php if( $esf_insta_skin['design']['load_more_hover_background_color'] ){ ?> background-color: <?php echo $esf_insta_skin['design']['load_more_hover_background_color']; ?>;

<?php } ?><?php if( $esf_insta_skin['design']['load_more_hover_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['load_more_hover_color']; ?>;

<?php } ?>

}

<?php
 /*
* Header CSS
*/
?>
.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_header {

<?php if( $esf_insta_skin['design']['header_background_color'] ){ ?> background: <?php echo $esf_insta_skin['design']['header_background_color']; ?>;

<?php } ?><?php if( isset( $esf_insta_skin['design']['header_shadow'] ) && !empty( $esf_insta_skin['design']['header_shadow'] ) ){ ?> box-shadow: 0 0 10px 0<?php echo $esf_insta_skin['design']['header_shadow_color']; ?>;
    -moz-box-shadow: 0 0 10px 0<?php echo $esf_insta_skin['design']['header_shadow_color']; ?>;
    -webkit-box-shadow: 0 0 10px 0<?php echo $esf_insta_skin['design']['header_shadow_color']; ?>;


<?php }else{ ?> box-shadow: none;

<?php } ?><?php if( $esf_insta_skin['design']['header_text_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['header_text_color']; ?>;

<?php } ?><?php if( $esf_insta_skin['design']['header_border_color'] ){ ?> border-color: <?php echo $esf_insta_skin['design']['header_border_color']; ?>;

<?php } ?><?php if( $esf_insta_skin['design']['header_border_style'] ){ ?> border-style: <?php echo $esf_insta_skin['design']['header_border_style']; ?>;

<?php } ?><?php if( $esf_insta_skin['design']['header_border_top'] ){ ?> border-top-width: <?php echo $esf_insta_skin['design']['header_border_top']; ?>px;

<?php } ?><?php if( $esf_insta_skin['design']['header_border_bottom'] ){ ?> border-bottom-width: <?php echo $esf_insta_skin['design']['header_border_bottom']; ?>px;

<?php } ?><?php if( $esf_insta_skin['design']['header_border_left'] ){ ?> border-left-width: <?php echo $esf_insta_skin['design']['header_border_left']; ?>px;

<?php } ?><?php if( $esf_insta_skin['design']['header_border_right'] ){ ?> border-right-width: <?php echo $esf_insta_skin['design']['header_border_right']; ?>px;

<?php } ?><?php if( $esf_insta_skin['design']['header_padding_top'] ){ ?> padding-top: <?php echo $esf_insta_skin['design']['header_padding_top']; ?>px;

<?php } ?><?php if( $esf_insta_skin['design']['header_padding_bottom'] ){ ?> padding-bottom: <?php echo $esf_insta_skin['design']['header_padding_bottom']; ?>px;

<?php } ?><?php if( $esf_insta_skin['design']['header_padding_left'] ){ ?> padding-left: <?php echo $esf_insta_skin['design']['header_padding_left']; ?>px;

<?php } ?><?php if( $esf_insta_skin['design']['header_padding_right'] ){ ?> padding-right: <?php echo $esf_insta_skin['design']['header_padding_right']; ?>px;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_header .esf_insta_header_inner_wrap .esf_insta_header_content .esf_insta_header_meta .esf_insta_header_title {

<?php if( $esf_insta_skin['design']['title_size'] ){ ?> font-size: <?php echo $esf_insta_skin['design']['title_size']; ?>px;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_header .esf_insta_header_inner_wrap .esf_insta_header_content .esf_insta_header_meta .esf_insta_header_title a {

<?php if( $esf_insta_skin['design']['header_text_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['header_text_color']; ?>;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_header .esf_insta_header_inner_wrap .esf_insta_header_img img {

<?php if( $esf_insta_skin['design']['header_round_dp'] ){ ?> border-radius: 50%;

<?php }else{ ?> border-radius: 0;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_header .esf_insta_header_inner_wrap .esf_insta_header_content .esf_insta_header_meta .esf_insta_cat, .esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_header .esf_insta_header_inner_wrap .esf_insta_header_content .esf_insta_header_meta .esf_insta_followers {

<?php if( $esf_insta_skin['design']['metadata_size'] ){ ?> font-size: <?php echo $esf_insta_skin['design']['metadata_size']; ?>px;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_header .esf_insta_header_inner_wrap .esf_insta_header_content .esf_insta_bio {

<?php if( $esf_insta_skin['design']['bio_size'] ){ ?> font-size: <?php echo $esf_insta_skin['design']['bio_size']; ?>px;

<?php } ?>

}

<?php
  /*
  * Feed CSS
  */
  ?>
.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper, .esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-thumbnail-wrapper .esf-insta-thumbnail-col, .esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-post-footer {

<?php if( $esf_insta_skin['design']['feed_borders_color'] ){ ?> border-color: <?php echo $esf_insta_skin['design']['feed_borders_color']; ?>;

<?php } ?>

}

<?php if( isset( $esf_insta_skin['design']['feed_shadow'] ) && !empty( $esf_insta_skin['design']['feed_shadow'] ) ){ ?>

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper {

    box-shadow: 0 0 10px 0 <?php echo $esf_insta_skin['design']['feed_shadow_color']; ?>;
    -moz-box-shadow: 0 0 10px 0 <?php echo $esf_insta_skin['design']['feed_shadow_color']; ?>;
    -webkit-box-shadow: 0 0 10px 0 <?php echo $esf_insta_skin['design']['feed_shadow_color']; ?>;

}

<?php }else{ ?>

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper {
    box-shadow: none;
}

<?php } ?>

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-thumbnail-wrapper .esf-insta-thumbnail-col a img {

<?php if( $esf_insta_skin['design']['feed_borders_color'] ){ ?> outline-color: <?php echo $esf_insta_skin['design']['feed_borders_color']; ?>;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper, .esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf_insta_feeds_carousel .esf-insta-story-wrapper .esf-insta-grid-wrapper {

<?php if( $esf_insta_skin['design']['feed_background_color'] ){ ?> background-color: <?php echo $esf_insta_skin['design']['feed_background_color']; ?>;

<?php } ?><?php if( $esf_insta_skin['design']['feed_padding_top'] ){ ?> padding-top: <?php echo $esf_insta_skin['design']['feed_padding_top']; ?>px;

<?php } ?><?php if( $esf_insta_skin['design']['feed_padding_bottom'] ){ ?> padding-bottom: <?php echo $esf_insta_skin['design']['feed_padding_bottom']; ?>px;

<?php } ?><?php if( $esf_insta_skin['design']['feed_padding_left'] ){ ?> padding-left: <?php echo $esf_insta_skin['design']['feed_padding_left']; ?>px;

<?php } ?><?php if( $esf_insta_skin['design']['feed_padding_right'] ){ ?> padding-right: <?php echo $esf_insta_skin['design']['feed_padding_right']; ?>px;

<?php } ?><?php if( $esf_insta_skin['design']['feed_spacing'] ){ ?> margin-bottom: <?php echo $esf_insta_skin['design']['feed_spacing']; ?>px !important;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper, .esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-feed-content > .esf-insta-d-flex .esf-insta-profile-title span, .esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-feed-content .description, .esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-feed-content .description a, .esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-feed-content .esf_insta_link_text, .esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-feed-content .esf_insta_link_text .esf_insta_title_link a {

<?php if( $esf_insta_skin['design']['feed_text_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['feed_text_color']; ?>;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-post-footer .esf-insta-reacted-item, .esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-post-footer .esf-insta-reacted-item .esf_insta_all_comments_wrap {

<?php if( $esf_insta_skin['design']['feed_meta_data_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['feed_meta_data_color']; ?>;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-overlay {

<?php if( $esf_insta_skin['design']['popup_icon_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['popup_icon_color']; ?> !important;

<?php } ?><?php if( $esf_insta_skin['design']['feed_hover_shadow_color'] ){ ?> background: <?php echo $esf_insta_skin['design']['feed_hover_shadow_color']; ?> !important;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-overlay .esf_insta_multimedia, .esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-overlay .icon-esf-video-camera {

<?php if( $esf_insta_skin['design']['feed_type_icon_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['feed_type_icon_color']; ?> !important;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-post-footer .esf-insta-view-on-fb, .esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-post-footer .esf-share-wrapper .esf-share {

<?php if( $esf_insta_skin['design']['feed_meta_buttons_bg_color'] ){ ?> background: <?php echo $esf_insta_skin['design']['feed_meta_buttons_bg_color']; ?>;

<?php } ?><?php if( $esf_insta_skin['design']['feed_meta_buttons_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['feed_meta_buttons_color']; ?>;

<?php } ?>

}

.esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-post-footer .esf-insta-view-on-fb:hover, .esf_insta_feed_wraper.esf-insta-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-story-wrapper .esf-insta-post-footer .esf-share-wrapper .esf-share:hover {

<?php if( $esf_insta_skin['design']['feed_meta_buttons_hover_bg_color'] ){ ?> background: <?php echo $esf_insta_skin['design']['feed_meta_buttons_hover_bg_color']; ?>;

<?php } ?><?php if( $esf_insta_skin['design']['feed_meta_buttons_hover_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['feed_meta_buttons_hover_color']; ?>;

<?php } ?>

}

<?php
/*
* Popup CSS
*/
?>
.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper, .esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper .esf-insta-caption::after {

<?php if( $esf_insta_skin['design']['popup_sidebar_bg'] ){ ?> background: <?php echo $esf_insta_skin['design']['popup_sidebar_bg']; ?>;

<?php } ?>

}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper, .esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper .esf-insta-caption .esf-insta-feed-description, .esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> a, .esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> span {

<?php if( $esf_insta_skin['design']['popup_sidebar_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['popup_sidebar_color']; ?> !important;

<?php } ?>

}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper .esf-insta-post-header {

<?php if( $esf_insta_skin['design']['popup_show_header'] ){ ?> display: flex;

<?php }else{ ?> display: none !important;

<?php } ?>

}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper .esf-insta-post-header .esf-insta-profile-image {

<?php if( $esf_insta_skin['design']['popup_show_header_logo'] ){ ?> display: block;

<?php }else{ ?> display: none;

<?php } ?>

}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper .esf-insta-post-header h2 {

<?php if( $esf_insta_skin['design']['popup_header_title_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['popup_header_title_color']; ?>;

<?php } ?>

}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper .esf-insta-post-header span {

<?php if( $esf_insta_skin['design']['popup_post_time_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['popup_post_time_color']; ?>;

<?php } ?>

}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-feed-description {

<?php if( $esf_insta_skin['design']['popup_show_caption'] ){ ?> display: block;

<?php }else{ ?> display: none;

<?php } ?>

}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper .esf-insta-reactions-box {

<?php if( $esf_insta_skin['design']['popup_show_meta'] ){ ?> display: flex;

<?php }else{ ?> display: none !important;

<?php } ?><?php if( $esf_insta_skin['design']['popup_meta_border_color'] ){ ?> border-color: <?php echo $esf_insta_skin['design']['popup_meta_border_color']; ?>;

<?php } ?>

}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper .esf-insta-reactions-box .esf-insta-reactions span {

<?php if( $esf_insta_skin['design']['popup_meta_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['popup_meta_color']; ?>;

<?php } ?>

}


.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper .esf-insta-reactions-box .esf-insta-reactions .esf_insta_popup_likes_main {

<?php if( $esf_insta_skin['design']['popup_show_reactions_counter'] ){ ?> display: flex;

<?php }else{ ?> display: none !important;

<?php } ?>

}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper .esf-insta-reactions-box .esf-insta-reactions .esf-insta-popup-comments-icon-wrapper {

<?php if( $esf_insta_skin['design']['popup_show_comments_counter'] ){ ?> display: flex;

<?php }else{ ?> display: none !important;

<?php } ?>

}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-commnets, .esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-comments-list {

<?php if( $esf_insta_skin['design']['popup_show_comments'] ){ ?> display: block;

<?php }else{ ?> display: none;

<?php } ?>

}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-action-btn {

<?php if( $esf_insta_skin['design']['popup_show_view_insta_link'] ){ ?> display: block;

<?php }else{ ?> display: none;

<?php } ?>

}

.esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper .esf-insta-comments-list .esf-insta-comment-wrap, .esf_insta_feed_popup_container .esf-insta-post-detail.esf-insta-popup-skin-<?php echo intval( $skin_id ) ;?> .esf-insta-d-columns-wrapper .esf-insta-comments-list .esf-insta-comment-wrap a {

<?php if( $esf_insta_skin['design']['popup_comments_color'] ){ ?> color: <?php echo $esf_insta_skin['design']['popup_comments_color']; ?>;

<?php } ?>

}


<?php  }  
  }      

  ?>
  