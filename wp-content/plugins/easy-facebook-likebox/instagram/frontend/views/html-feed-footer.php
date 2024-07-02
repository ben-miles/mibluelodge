<?php

do_action( 'esf_insta_before_feed_footer', $esf_insta_feed );
$combined_atts = $hashtag . '+' . $feeds_per_page . '+' . $caption_words . '+' . $skin_id . '+' . $cache_seconds . '+' . $user_id . '+' . $link_target . '+' . $is_moderate . '+' . $profile_picture;
if ( $mif_instagram_type == 'personal' ) {
    $mif_self_name = $mif_instagram_personal_accounts[$user_id]['username'];
    $mif_self_username = $mif_self_name;
} else {
    $mif_self_name = $esf_insta_user_data->name;
    $mif_self_username = $esf_insta_user_data->username;
}
if ( $hashtag && !empty( $hashtag ) ) {
    $mif_self_username = 'explore/tags/' . $hashtag;
    $mif_self_name = '#' . $hashtag;
}
if ( isset( $insta_settings['moderated'][$user_id]['ids'] ) && !empty( $insta_settings['moderated'][$user_id]['ids'] ) ) {
    $i = $feeds_per_page;
}
?>

	<div class="esf_insta_load_more_btns_wrap">
		<div class="esf_insta_feed_btns_holder">

			<?php 
?>

			<div class="esf-insta-follow-btn-wrap">
				<a href="<?php 
echo esc_url( $this->instagram_url );
?>/<?php 
echo esc_attr_e( $mif_self_username );
?>"
				   class="esf-insta-follow-btn" target="<?php 
esc_attr_e( $link_target );
?>"><i
							class="icon icon-esf-instagram"></i> <?php 
esc_html_e( 'Follow on Instagram', 'easy-facebook-likebox' );
?>
				</a>
			</div>

		</div>
	</div>
<?php 
do_action( 'esf_insta_after_feed_footer', $esf_insta_feed );