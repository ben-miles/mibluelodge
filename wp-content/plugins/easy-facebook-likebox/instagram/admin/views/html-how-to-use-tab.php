<?php

/**
 * Admin View: Tab - How to Use
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $mif_skins;
if ( isset( $fta_settings['plugins']['instagram']['authenticated_accounts'] ) ) {
    $mif_users = $fta_settings['plugins']['instagram']['authenticated_accounts'];
}
if ( isset( $fta_settings['plugins']['facebook']['access_token'] ) ) {
    $fb_access_token = $fta_settings['plugins']['facebook']['access_token'];
}
?>
<div id="mif-shortcode" class="mif_tab_c slideLeft <?php 
echo ( $active_tab == 'mif-shortcode' ? 'active' : '' );
?>">
	<div class="mif-swipe-shortcode_wrap">

		<div class="mif_shortocode_genrator_wrap">

			<h5><?php 
esc_html_e( 'How to use this plugin?', 'easy-facebook-likebox' );
?></h5>

			<?php 
if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !empty( $fta_settings['plugins']['facebook']['approved_pages'] ) || esf_insta_instagram_type() == 'personal' ) {
    ?>

				<p><?php 
    esc_html_e( 'Copy and paste the following shortcode in any page, post or text widget to display the feed.', 'easy-facebook-likebox' );
    ?></p>
				<blockquote class="mif-shortcode-block"><div class="mif-shortcode-block-holder"> [my-instagram-feed
					user_id="<?php 
    echo esf_insta_default_id();
    ?>"
					skin_id="<?php 
    esc_attr_e( $fta_settings['plugins']['instagram']['default_skin_id'] );
    ?>"
					links_new_tab="1"
					]</div>
					<a class="btn waves-effect mif_copy_default_shortcode mif_copy_shortcode waves-light tooltipped"
					   data-position="right" data-delay="50"
					   data-tooltip="<?php 
    esc_html_e( 'Copy', 'easy-facebook-likebox' );
    ?>"
					   data-clipboard-text='[my-instagram-feed user_id="<?php 
    echo esf_insta_default_id();
    ?>" skin_id="<?php 
    esc_attr_e( $fta_settings['plugins']['instagram']['default_skin_id'] );
    ?>" links_new_tab="1"]'
					   href="javascript:void(0);">  <span class="dashicons dashicons-admin-page right"></span>
					</a>
				</blockquote>


			<?php 
} else {
    ?>

				<blockquote
						class="efbl-red-notice"><?php 
    esc_html_e( 'It looks like you have not connected your Instagram account with plugin yet. Please click on the Connect "My Instagram Account" button from authenticate tab to get the access token from Instagram', 'easy-facebook-likebox' );
    ?></blockquote>

			<?php 
}
?>

			<h5><?php 
esc_html_e( 'Need More Options?', 'easy-facebook-likebox' );
?></h5>
			<p><?php 
esc_html_e( 'Use the following shortcode generator to further customize the shortcode.', 'easy-facebook-likebox' );
?></p>
			<form class="mif_shortocode_genrator" name="mif_shortocode_genrator"
				  type="post">
				<div class="mif-shortcode-fields-wrap">
					<div class="input-field col s12 mif_fields">
						<label><?php 
esc_html_e( 'Account(s)', 'easy-facebook-likebox' );
?></label>
						<select id="mif_user_id" class="icons mif_skin_id"  <?php 
do_action( 'esf_insta_page_attr' );
?>>
							<?php 
$mif_personal_connected_accounts = esf_insta_personal_account();
if ( esf_insta_instagram_type() == 'personal' && !empty( $mif_personal_connected_accounts ) ) {
    $i = 0;
    foreach ( $mif_personal_connected_accounts as $personal_id => $mif_personal_connected_account ) {
        $i++;
        ?>
									<option value="<?php 
        esc_attr_e( $personal_id );
        ?>" 
																	 <?php 
        if ( $i == 1 ) {
            ?>
										 selected <?php 
        }
        ?> ><?php 
        esc_html_e( $mif_personal_connected_account['username'] );
        ?></option>

									<?php 
    }
}
$esf_insta_business_accounts = esf_insta_business_accounts();
if ( esf_insta_instagram_type() != 'personal' && $esf_insta_business_accounts ) {
    if ( $esf_insta_business_accounts ) {
        $i = 0;
        foreach ( $esf_insta_business_accounts as $mif_insta_single_account ) {
            $i++;
            ?>
										<option value="<?php 
            esc_attr_e( $mif_insta_single_account->id );
            ?>"
												data-icon="<?php 
            echo esc_url( $mif_insta_single_account->profile_picture_url );
            ?>" 
																	  <?php 
            if ( $i == 1 ) {
                ?>
													 selected <?php 
            }
            ?>><?php 
            esc_html_e( $mif_insta_single_account->username );
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
					</div>
					<div class="input-field col s12 mif_fields esf-insta-addon-upgrade-link">
						<?php 
if ( !class_exists( 'Esf_Multifeed_Instagram_Frontend' ) ) {
    ?>
							<a href="<?php 
    echo esc_url( admin_url( 'admin.php?slug=esf-multifeed&page=feed-them-all-addons' ) );
    ?>"><?php 
    esc_html_e( 'Multifeed Add-on: Display photos and videos from multiple accounts (works with hashtag as well) in single feed (pro- addon)', 'easy-facebook-likebox' );
    ?></a>
						<?php 
}
?>
					</div>
					<?php 
if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
} else {
    ?>
						<span class="mif_fields col s12 esf_insta_checkbox">
							 <input name="" class="esf-modal-trigger" href="#esf-insta-hashtag-upgrade"
									type="checkbox" id="esf-insta-free-hashtag"/>
						<label for="esf-insta-free-hashtag"><?php 
    esc_html_e( 'Hashtag', 'easy-facebook-likebox' );
    ?></label>

					</span>

						<div id="esf-insta-hashtag-upgrade"
							 class="fta-upgrade-modal esf-modal">
							<div class="modal-content">
								<div class="mif-modal-content"><span
											class="mif-lock-icon"><span class="dashicons dashicons-lock"></span></span>
									<h5><?php 
    esc_html_e( 'Premium Feature', 'easy-facebook-likebox' );
    ?></h5>
									<p><?php 
    esc_html_e( "We're sorry, Hashtag feature is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' );
    ?></p>
									<p><?php 
    esc_html_e( 'Upgrade today and get ' . $banner_info['discount'] . ' discount! On the checkout click on "Have a promotional code?" and enter', 'easy-facebook-likebox' );
    ?>
										<?php 
    if ( $banner_info['coupon'] ) {
        ?>
											<code><?php 
        esc_html_e( $banner_info['coupon'] );
        ?></code>
										<?php 
    }
    ?>
									</p>
									<hr/>
									<a href="<?php 
    echo esc_url( efl_fs()->get_upgrade_url() );
    ?>"
									   class=" btn"><span class="dashicons dashicons-unlock"></span><?php 
    esc_html_e( 'Upgrade now', 'easy-facebook-likebox' );
    ?>
									</a>

								</div>
							</div>

						</div>

					<?php 
}
?>

					<div class="input-field col s12 mif_fields">
						<label><?php 
esc_html_e( 'Select skin and layout', 'easy-facebook-likebox' );
?></label>
						<select id="mif_skin_id" class="icons mif_skin_id">
							<?php 
if ( $mif_skins ) {
    foreach ( $mif_skins as $mif_skin ) {
        ?>

									<option value="<?php 
        esc_attr_e( $mif_skin['ID'] );
        ?>"
											data-icon="<?php 
        echo get_the_post_thumbnail_url( $mif_skin['ID'], 'thumbnail' );
        ?>"><?php 
        esc_html_e( $mif_skin['title'] );
        ?></option>
									<?php 
    }
}
if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
} else {
    ?>
								<option value="free-masonry"><?php 
    esc_html_e( 'Skin - Masonry (pro)', 'easy-facebook-likebox' );
    ?></option>
								<option value="free-carousel"><?php 
    esc_html_e( 'Skin - Carousel (pro)', 'easy-facebook-likebox' );
    ?></option>
								<option value="free-half_width"><?php 
    esc_html_e( 'Skin - Half Width (pro)', 'easy-facebook-likebox' );
    ?></option>
								<option value="free-full_width"><?php 
    esc_html_e( 'Skin - Full Width (pro)', 'easy-facebook-likebox' );
    ?></option>
							<?php 
}
?>
						</select>
					</div>

					<div class="input-field col s6 mif_fields">
						<label for="mif_feeds_per_page"
							   class=""><?php 
esc_html_e( 'Feeds Per Page', 'easy-facebook-likebox' );
?></label>
						<input id="mif_feeds_per_page" type="number" value="9"
							   min="1">
					</div>

					<div class="input-field col s6 mif_fields">
						<label for="mif_caption_words"
							   class=""><?php 
esc_html_e( 'Caption Words (Leave empty to show full text)', 'easy-facebook-likebox' );
?></label>
						<input id="mif_caption_words" type="number" value="25"
							   min="1">
					</div>
					<div class="input-field col s6 mif_fields">
						<label for="mif_cache_unit"
							   class=""><?php 
esc_html_e( 'Cache Unit', 'easy-facebook-likebox' );
?></label>
						<input id="mif_cache_unit" type="number" value="1"
							   min="1">
					</div>

					<div class="input-field col s6 mif_fields">
						<label><?php 
esc_html_e( 'Cache Duration', 'easy-facebook-likebox' );
?></label>
						<select id="mif_cache_duration"
								class="icons mif_cache_duration">
							<option value="minutes"><?php 
esc_html_e( 'Minutes', 'easy-facebook-likebox' );
?></option>
							<option value="hours"><?php 
esc_html_e( 'Hours', 'easy-facebook-likebox' );
?></option>
							<option value="days" selected><?php 
esc_html_e( 'Days', 'easy-facebook-likebox' );
?></option>
						</select>
					</div>

					<div class="input-field col s12 mif_fields">
						<label for="mif_wrap_class"
							   class=""><?php 
esc_html_e( 'Wrapper Class', 'easy-facebook-likebox' );
?></label>
						<input id="mif_wrap_class" type="text">
					</div>
					<?php 
if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
} else {
    ?>
						<div class="col s6 mif_fields esf_insta_checkbox">
							<input name="esf_insta_load_more_free"
								   type="checkbox" class="filled-in esf-modal-trigger" href="#esf-insta-load-more-upgrade"
								   value="" id="esf_insta_load_more_free"/>
							<label for="esf_insta_load_more_free"><?php 
    esc_html_e( 'Load More', 'easy-facebook-likebox' );
    ?></label>
						</div>

					<div id="esf-insta-load-more-upgrade"
						 class="fta-upgrade-modal esf-modal">
						<div class="modal-content">

							<div class="mif-modal-content"><span
										class="mif-lock-icon"><span class="dashicons dashicons-lock"></span></span>
								<h5><?php 
    esc_html_e( 'Premium Feature', 'easy-facebook-likebox' );
    ?></h5>
								<p><?php 
    esc_html_e( "We're sorry, Load more is not included in your plan. Add load more button at the bottom of each feed to load more photos and videos.", 'easy-facebook-likebox' );
    ?></p>
								<p><?php 
    esc_html_e( 'Upgrade today and get ' . $banner_info['discount'] . ' discount! On the checkout click on "Have a promotional code?" and enter', 'easy-facebook-likebox' );
    ?>
									<?php 
    if ( $banner_info['coupon'] ) {
        ?>
										<code><?php 
        esc_html_e( $banner_info['coupon'] );
        ?></code>
									<?php 
    }
    ?>
								</p>
								<hr/>
								<a href="<?php 
    echo esc_url( efl_fs()->get_upgrade_url() );
    ?>"
								   class=" btn"><span class="dashicons dashicons-unlock"></span><?php 
    esc_html_e( 'Upgrade now', 'easy-facebook-likebox' );
    ?>
								</a>

							</div>
						</div>

					</div>

					<?php 
}
?>

					<div class="col s6 mif_fields esf_insta_checkbox">
						<input name="esf_insta_link_new_tab"
							   type="checkbox" checked 
							   value="" id="esf_insta_link_new_tab"/>
						<label for="esf_insta_link_new_tab"><?php 
esc_html_e( 'Open links in new tab', 'easy-facebook-likebox' );
?></label>
					</div>
					<?php 
if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
} else {
    ?>
						<div class="col s12 mif_fields esf_insta_checkbox">
							<input name="esf_insta_show_stories_free"
								   type="checkbox" class="filled-in esf-modal-trigger" href="#esf-insta-show_stories-upgrade"
								   value="" id="esf_insta_show_stories_free"/>
							<label for="esf_insta_show_stories_free"><?php 
    esc_html_e( 'Show Stories', 'easy-facebook-likebox' );
    ?></label>
						</div>

						<div id="esf-insta-show_stories-upgrade"
							 class="fta-upgrade-modal esf-modal">
							<div class="modal-content">

								<div class="mif-modal-content"><span
											class="mif-lock-icon"><span class="dashicons dashicons-lock"></span></span>
									<h5><?php 
    esc_html_e( 'Premium Feature', 'easy-facebook-likebox' );
    ?></h5>
									<p><?php 
    esc_html_e( "We're sorry, Account Stories are not included in your plan.", 'easy-facebook-likebox' );
    ?></p>
									<p><?php 
    esc_html_e( 'Upgrade today and get ' . $banner_info['coupon'] . ' discount! On the checkout click on "Have a promotional code?" and enter', 'easy-facebook-likebox' );
    ?>
										<?php 
    if ( $banner_info['coupon'] ) {
        ?>
											<code><?php 
        esc_html_e( $banner_info['coupon'] );
        ?></code>
										<?php 
    }
    ?>
									</p>
									<hr/>
									<a href="<?php 
    echo esc_url( efl_fs()->get_upgrade_url() );
    ?>"
									   class=" btn"><span class="dashicons dashicons-unlock"></span><?php 
    esc_html_e( 'Upgrade now', 'easy-facebook-likebox' );
    ?>
									</a>

								</div>
							</div>

						</div>

					<?php 
}
?>
					<?php 
?>
					<br>
					<div class="clear"></div>
					<input type="submit" class="btn  mif_shortcode_submit"
						   value="<?php 
esc_html_e( 'Generate', 'easy-facebook-likebox' );
?>"/>
				</div>
			</form>
			<div class="mif_generated_shortcode">
				<blockquote class="mif-shortcode-block"><div class="mif-shortcode-block-holder"></div>
					<a class="btn waves-effect mif_copy_shortcode mif_shortcode_generated_final waves-light tooltipped"
					   data-position="right" data-delay="50"
					   data-tooltip="<?php 
esc_html_e( 'Copy', 'easy-facebook-likebox' );
?>"
					   href="javascript:void(0);"><span class="dashicons dashicons-admin-page right"></span>
					</a>
				</blockquote>
			</div>
		</div>

		<h5><?php 
esc_html_e( 'Unable to understand shortocde parameters?', 'easy-facebook-likebox' );
?></h5>
		<p><?php 
esc_html_e( 'No worries, Each shortocde parameter is explained below first read them and generate your shortocde.', 'easy-facebook-likebox' );
?></p>


		<ul class="collapsible" data-collapsible="accordion">
			<li>
				<div class="collapsible-header">
					<span class="mif_detail_head"> <?php 
esc_html_e( 'Wrapper Class', 'easy-facebook-likebox' );
?> </span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'You can easily add the custom CSS class to the wraper of your Instagram Feeds.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>


			<li>
				<div class="collapsible-header">
					<span class="mif_detail_head"> <?php 
esc_html_e( 'Accounts', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'You can display any of the connected account feeds. Select the account you wish to display the feeds from list.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li>
				<div class="collapsible-header">
					<span class="mif_detail_head"> <?php 
esc_html_e( 'Skin', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'You can totally change the look and feel of your feeds section. Simply paste the Skin ID in skin_id parameter. You can find the skins in Dashboard -> My Instagram Feeds -> Skins section.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li>
				<div class="collapsible-header">
					<span class="mif_detail_head"> <?php 
esc_html_e( 'Feeds Per Page', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'You can show only specific feeds. Simply paste the Feeds Per Page number in feeds_per_page parameter.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li>
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Caption Words', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'You can show limited caption words. Simply paste the Caption Words number in caption_words parameter.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li>
				<div class="collapsible-header">
					<span class="mif_detail_head"> <?php 
esc_html_e( 'Cache Unit', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'Feeds Will be automatically refreshed after particular minutes/hours/days. Simply paste the number of days in cache_unit parameter.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li>
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Cache Duration', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'Define cache duration to refresh feeds automatically. Like after minutes/hours/days feeds would be refreshed. Simply paste the duration option in cache_duration parameter', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li>
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Load More', 'easy-facebook-likebox' );
?> <a href="<?php 
echo esc_url( efl_fs()->get_upgrade_url() );
?>">(<?php 
esc_html_e( 'pro', 'easy-facebook-likebox' );
?>)</a> </span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'Load More button at the bottom of each feed to infinitely load more posts, events, photos, videos, or albums.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

		</ul>

	</div>
</div>
