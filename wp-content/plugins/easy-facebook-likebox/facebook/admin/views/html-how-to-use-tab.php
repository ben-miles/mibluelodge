<?php

/**
 * Admin View: Tab - How to Use
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $efbl_skins;
$FTA = new Feed_Them_All();
$fta_settings = $FTA->fta_get_settings();
$efbl_default_likebox_notice = '';
?>
<div id="efbl-general" class="col s12 efbl_tab_c slideLeft <?php 
echo esc_attr( ( $active_tab == 'efbl-general' ? 'active' : '' ) );
?>">
	<div class="row">
		<div class="col s10  efbl_tabs_holder">
				<div id="efbl-feed-use" class="tab-content efbl_tab_c_holder">

					<div class="row">

						<div class="efbl_collapsible_info col s12">

							<div class="efbl_default_shortcode_holder col s8">
								<?php 
if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) || isset( $fta_settings['plugins']['facebook']['approved_groups'] ) ) {
    ?>
								<h5><?php 
    esc_html_e( 'How to use this plugin?', 'easy-facebook-likebox' );
    ?></h5>
								<p><?php 
    esc_html_e( 'Copy and paste the following shortcode in any page, post or text widget to display the feed.', 'easy-facebook-likebox' );
    ?></p>
									<?php 
}
if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !empty( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {
    $default_page_id = efbl_default_page_id();
    ?>
									<div class="efbl-use-options">
										<h5><?php 
    esc_html_e( 'Page Feed', 'easy-facebook-likebox' );
    ?></h5>
										<div class="efbl-shortcode-holder">
											<blockquote
													class="efbl-shortcode-block">
												[efb_feed fanpage_id="<?php 
    esc_attr_e( $default_page_id );
    ?>" type="page" skin_id="<?php 
    echo efbl_default_skin_id();
    ?>" words_limit="25" links_new_tab="1"]
											</blockquote>

											<a class="btn efbl_copy_shortcode efbl_copy_default_shortcode"
											   data-position="right" data-delay="50"
											   data-tooltip="<?php 
    esc_html_e( 'Copy', 'easy-facebook-likebox' );
    ?>"
											   data-clipboard-text='[efb_feed fanpage_id="<?php 
    esc_attr_e( $default_page_id );
    ?>" type="page" skin_id="<?php 
    echo efbl_default_skin_id();
    ?>" words_limit="25" links_new_tab="1"]'
											   href="javascript:void(0);"><span class="dashicons dashicons-admin-page right"></span>
											</a>
										</div>
									</div>

								<?php 
}
?>

								<?php 
if ( isset( $fta_settings['plugins']['facebook']['approved_groups'] ) && !empty( $fta_settings['plugins']['facebook']['approved_groups'] ) ) {
    if ( isset( $fta_settings['plugins']['facebook']['approved_groups'][0]->id ) ) {
        $default_group_id = $fta_settings['plugins']['facebook']['approved_groups'][0]->id;
    } else {
        $default_group_id = '';
    }
    if ( !isset( $default_group_id ) && isset( $fta_settings['plugins']['facebook']['approved_groups'][1]->id ) ) {
        $default_group_id = $fta_settings['plugins']['facebook']['approved_groups'][1]->id;
    }
}
if ( !isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !isset( $fta_settings['plugins']['facebook']['approved_groups'] ) ) {
    ?>

								<blockquote
										class="efbl-red-notice"><?php 
    esc_html_e( 'It looks like you did not authenticate the plugin. Please go to ', 'easy-facebook-likebox' );
    ?>
									<a href="<?php 
    echo esc_url( admin_url( 'admin.php?page=easy-facebook-likebox' ) );
    ?>"><?php 
    esc_html_e( 'Authenticate', 'easy-facebook-likebox' );
    ?></a> <?php 
    esc_html_e( 'page and click on the "Connect My Facebook Account" button and approve page(s) or group(s) from Facebook authentication process', 'easy-facebook-likebox' );
    ?>
								</blockquote>

								<?php 
}
?>
								<div class="efbl-use-options">
									<h5 class="efbl_more_head"><?php 
esc_html_e( 'Need More Options?', 'easy-facebook-likebox' );
?></h5>
									<p><?php 
esc_html_e( 'Use the following shortcode generator to further customize the shortcode.', 'easy-facebook-likebox' );
?></p>
								</div>
							</div>

							<form class="efbl_shortocode_genrator"
								  name="efbl_shortocode_genrator" type="post">
								<h5><?php 
esc_html_e( 'Shortcode Generator', 'easy-facebook-likebox' );
?></h5>
									<div class="efbl-shortcode-fields-wrap">
										<div class="input-field col s12 efbl_fields efbl-page-releated-field">
											<label><?php 
esc_html_e( 'Select Page', 'easy-facebook-likebox' );
?></label>
											<a href="javascript:void(0)"
											   class="efbl_open_collapisble"
											   data-id="efbl_page_info">?</a>
											<select id="efbl_page_id"
													class="icons efbl_page_id" <?php 
do_action( 'esf_fb_page_attr' );
?>>
												<?php 
if ( $fta_settings['plugins']['facebook']['approved_pages'] ) {
    $i = 0;
    foreach ( $fta_settings['plugins']['facebook']['approved_pages'] as $efbl_page ) {
        $i++;
        if ( $efbl_page['id'] ) {
            if ( isset( $efbl_page['username'] ) ) {
                $username = $efbl_page['username'];
            } else {
                $username = $efbl_page['id'];
            }
            if ( $i == 1 ) {
                $first_page_id = $username;
            }
            ?>
															<option value="<?php 
            esc_attr_e( $username );
            ?>"
																	data-icon="<?php 
            echo efbl_get_page_logo( $efbl_page['id'] );
            ?>" 
																						  <?php 
            if ( $i == 1 ) {
                ?>
																		 selected <?php 
            }
            ?>><?php 
            esc_html_e( $efbl_page['name'] );
            ?></option>

															<?php 
        }
    }
} else {
    ?>

													<option value="" disabled
															selected><?php 
    esc_html_e( 'No page(s) found, Please connect your Facebook page with plugin first from authenticate tab', 'easy-facebook-likebox' );
    ?></option>

													<?php 
}
?>
											</select>
										</div>

										<div class="input-field col s12 efbl_fields efbl-addon-upgrade-link efbl-page-releated-field">
											<?php 
if ( !class_exists( 'Esf_Multifeed_Facebook_Frontend' ) ) {
    ?>
												<a href="<?php 
    echo esc_url( efl_fs()->get_upgrade_url() );
    ?>"><?php 
    esc_html_e( 'Multifeed: Display posts from multiple pages in single feed (pro-feature)', 'easy-facebook-likebox' );
    ?></a>
											<?php 
}
?>
										</div>
										<div class="input-field col s12 efbl_fields">
											<label for="efbl_access_token"
												   class=""><?php 
esc_html_e( 'Access Token (Optional)', 'easy-facebook-likebox' );
?></label>
											<a href="javascript:void(0)"
											   class="efbl_open_collapisble"
											   data-id="efbl_access_token_info">?</a>
											<input id="efbl_access_token" type="text">
										</div>

										<?php 
?>
											<div class="col s12 efbl_fields efbl-page-releated-field">
												<label><?php 
esc_html_e( 'Filter Posts', 'easy-facebook-likebox' );
?></label>
												<a href="javascript:void(0)"
												   class="efbl_open_collapisble"
												   data-id="efbl_filter_posts_info">?</a>
												<select id="efbl_free_filter_popup"
														class="icons efbl_filter">
													<option value="none"><?php 
esc_html_e( 'None', 'easy-facebook-likebox' );
?></option>
													<option value=""><?php 
esc_html_e( 'Images', 'easy-facebook-likebox' );
?></option>
													<option value=""><?php 
esc_html_e( 'Videos', 'easy-facebook-likebox' );
?></option>
													<option value=""><?php 
esc_html_e( 'Events', 'easy-facebook-likebox' );
?></option>
													<option value=""><?php 
esc_html_e( 'Albums', 'easy-facebook-likebox' );
?></option>
													<option value=""><?php 
esc_html_e( 'Mentioned', 'easy-facebook-likebox' );
?></option>
												</select>
											</div>
										<?php 
?>

										<?php 
?>

										<div class="input-field col s12 efbl_fields">
											<label><?php 
esc_html_e( 'Select skin and layout', 'easy-facebook-likebox' );
?></label>
											<a href="javascript:void(0)"
											   class="efbl_open_collapisble"
											   data-id="efbl_skin_id_info">?</a>
											<select id="efbl_skin_id"
													class="icons efbl_skin_id">
												<?php 
if ( isset( $efbl_skins ) ) {
    foreach ( $efbl_skins as $efbl_skin ) {
        $layout_selected = ucfirst( $efbl_skin['layout'] );
        ?>
														<option value="<?php 
        esc_attr_e( $efbl_skin['ID'] );
        ?>" 
																						 <?php 
        if ( $efbl_skin['layout'] == 'half' ) {
            ?>
															 selected <?php 
        }
        ?> data-icon="<?php 
        echo get_the_post_thumbnail_url( $efbl_skin['ID'], 'thumbnail' );
        ?>"><?php 
        esc_html_e( $efbl_skin['title'] );
        ?> | Layout: <?php 
        esc_html_e( $layout_selected );
        ?></span>
														</option>

														<?php 
    }
}
if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
    ?>
													<option value="free-grid"><?php 
    esc_html_e( 'Grid Skin | Layout: Grid (pro)', 'easy-facebook-likebox' );
    ?></option>
													<option value="free-masonry"><?php 
    esc_html_e( 'Grid Masonry | Layout: Masonry (pro)', 'easy-facebook-likebox' );
    ?></option>
													<option value="free-carousel"><?php 
    esc_html_e( 'Grid Carousel | Layout: Carousel (pro)', 'easy-facebook-likebox' );
    ?></option>
												<?php 
}
?>

											</select>
										</div>
										<div class="input-field col s6 efbl_fields"
											 style="padding-right: 10px;">
											<label for="efbl_post_limit"
												   class=""><?php 
esc_html_e( 'Number of posts to display', 'easy-facebook-likebox' );
?></label>
											<a href="javascript:void(0)"
											   style="right: 10px;"
											   class="efbl_open_collapisble"
											   data-id="efbl_post_limit_info">?</a>
											<input id="efbl_post_limit" value="10"
												   type="number" min="1">
										</div>
										<div class="input-field col s6 efbl_fields">
											<label for="efbl_caption_words"
												   class=""><?php 
esc_html_e( 'Number of words in caption/content', 'easy-facebook-likebox' );
?></label>
											<a href="javascript:void(0)"
											   class="efbl_open_collapisble"
											   data-id="efbl_caption_words_info">?</a>
											<input id="efbl_caption_words" value="25"
												   type="number" min="1">
										</div>
										<div class="input-field col s6 efbl_fields"
											 style="padding-right:10px;">
											<label for="efbl_cache_unit"
												   class=""><?php 
esc_html_e( 'Cache Unit', 'easy-facebook-likebox' );
?></label>
											<a href="javascript:void(0)"
											   style="right: 10px;"
											   class="efbl_open_collapisble"
											   data-id="efbl_cache_unit_info">?</a>
											<input id="efbl_cache_unit" value="1"
												   type="number" min="1">
										</div>
										<div class="input-field col s6 efbl_fields">
											<label><?php 
esc_html_e( 'Cache Duration', 'easy-facebook-likebox' );
?></label>
											<a href="javascript:void(0)"
											   class="efbl_open_collapisble"
											   data-id="efbl_cache_duration_info">?</a>
											<select id="efbl_cache_duration"
													class="efbl_cache_duration">
												<option value="minutes"><?php 
esc_html_e( 'Minutes', 'easy-facebook-likebox' );
?></option>
												<option value="hours"><?php 
esc_html_e( 'Hours', 'easy-facebook-likebox' );
?></option>
												<option selected
														value="days"><?php 
esc_html_e( 'Days', 'easy-facebook-likebox' );
?></option>
											</select>
										</div>
										<?php 
if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
} else {
    ?>
											<div class="col s6 efbl_fields checkbox-field">
												<a href="javascript:void(0)" style="right: 10px;" class="efbl_open_collapisble" data-id="efbl_load_more_info">?</a>
												<input name="efbl_load_more_free" type="checkbox" class="filled-in esf-modal-trigger" href="#efbl-load-more-upgrade"  id="efbl_load_more_free"/>
												<label for="efbl_load_more_free"><?php 
    esc_html_e( 'Load More', 'easy-facebook-likebox' );
    ?></label>
											</div>
										<?php 
}
?>
										<div class="col s6 efbl_fields checkbox-field efbl-page-releated-field">
											<a href="javascript:void(0)"
											   style="right: 10px;"
											   class="efbl_open_collapisble"
											   data-id="efbl_show_likebox_info">?</a>
											<input name="efbl_show_likebox"
												   type="checkbox" class="filled-in"
												   value="" id="efbl_show_likebox"/>
											<label for="efbl_show_likebox"><?php 
esc_html_e( 'Show Likebox', 'easy-facebook-likebox' );
?></label>
										</div>
										<?php 
if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
} else {
    ?>
											<div class="col s6 efbl_fields checkbox-field efbl-page-releated-field">
												<a href="javascript:void(0)" style="right: 10px;" class="efbl_open_collapisble" data-id="efbl_live_stream_only_info">?</a>
												<input name="efbl_live_stream_only_free" type="checkbox" class="filled-in esf-modal-trigger" href="#efbl-live-stream-only-upgrade"  id="efbl_live_stream_only_free"/>
												<label for="efbl_live_stream_only_free"><?php 
    esc_html_e( 'Show live stream only', 'easy-facebook-likebox' );
    ?></label>
											</div>
										<?php 
}
?>
										<div class="col s6 checkbox-field efbl_fields">
											<a href="javascript:void(0)"
											   class="efbl_open_collapisble"
											   data-id="efbl_link_new_tab_info">?</a>
											<input name="efbl_link_new_tab"
												   type="checkbox" checked class="filled-in"
												   value="" id="efbl_link_new_tab"/>
											<label for="efbl_link_new_tab"><?php 
esc_html_e( 'Open links in new tab', 'easy-facebook-likebox' );
?></label>
										</div>
									</div>
							</form>
							<input type="submit"
								   class="btn  efbl_shortcode_submit"
								   value="<?php 
esc_html_e( 'Generate', 'easy-facebook-likebox' );
?>"/>

							<div class="efbl_generated_shortcode">
								<p><?php 
esc_html_e( 'Paste in the page/post content or in text widget', 'easy-facebook-likebox' );
?></p>
								<blockquote
										class="efbl-shortcode-block"></blockquote>
								<a class="btn waves-effect efbl_copy_shortcode efbl_shortcode_generated_final waves-light tooltipped"
								   data-position="bottom" data-delay="50"
								   data-tooltip="<?php 
esc_html_e( 'Copy', 'easy-facebook-likebox' );
?>"
								   href="javascript:void(0);"><span class="dashicons dashicons-admin-page right"></span>
								</a>
							</div>

						</div>

						<div class="efbl_collapsible_info col s12">
							<h5><?php 
esc_html_e( 'How to use Widget?', 'easy-facebook-likebox' );
?></h5>
							<ol>
								<li><?php 
esc_html_e( 'Go to Appearance > Widgets.', 'easy-facebook-likebox' );
?></li>
								<li><?php 
esc_html_e( 'Look for Easy Facebook Feed widget in available widgets section.', 'easy-facebook-likebox' );
?></li>
								<li><?php 
esc_html_e( 'Drag and drop the widget to any of your active sidebar.', 'easy-facebook-likebox' );
?></li>
								<li><?php 
esc_html_e( 'Change default values with your requirements like fanpage ID of your page and post layout etc.', 'easy-facebook-likebox' );
?></li>
								<li><?php 
esc_html_e( 'Click the save button and visit your site to see feeds in widget', 'easy-facebook-likebox' );
?></li>
							</ol>
							<a class="btn" href="<?php 
echo esc_url( admin_url( 'widgets.php' ) );
?>"><?php 
esc_html_e( 'Widgets', 'easy-facebook-likebox' );
?>
							</a>
						</div>


					</div>

					<h5><?php 
esc_html_e( 'Unable to understand shortcode parameters?', 'easy-facebook-likebox' );
?></h5>
					<p><?php 
esc_html_e( 'No worries, Each shortcode parameter is explained below first read them and generate your shortocde.', 'easy-facebook-likebox' );
?></p>
					<ul class="collapsible efbl_shortcode_accord"
						data-collapsible="accordion">
						<li id="efbl_page_info">
							<div class="collapsible-header">
								<span class="mif_detail_head"><?php 
esc_html_e( 'Pages', 'easy-facebook-likebox' );
?></span>
							</div>
							<div class="collapsible-body">
								<p><?php 
esc_html_e( 'List of pages you approved for plugin to get the feeds. Select the page you want to display feeds.', 'easy-facebook-likebox' );
?></p>
							</div>
						</li>
						<li id="efbl_access_token_info">
							<div class="collapsible-header">
								<span class="mif_detail_head"><?php 
esc_html_e( 'Access Token (Optional)', 'easy-facebook-likebox' );
?></span>
							</div>
							<div class="collapsible-body">
								<p><?php 
esc_html_e( "Access Token provided from Facebook to display your page feeds. If you have your own Facebook app and retrieved access token you can use that to display your feed but this is optional if you don't have your app the default access token will be used. Please note: Your Access token is required to show your page events you can follow the steps explained ", 'easy-facebook-likebox' );
?>
									<a target='_blank'
									   href="<?php 
echo esc_url( 'https://easysocialfeed.com/custom-facebook-feed/page-token/' );
?>"><?php 
esc_html_e( 'here', 'easy-facebook-likebox' );
?></a>. <?php 
esc_html_e( 'This step is only required for events filter', 'easy-facebook-likebox' );
?>
								</p>
							</div>
						</li>

						<li id="efbl_filter_posts_info">
							<div class="collapsible-header">

								<span class="mif_detail_head"><?php 
esc_html_e( 'Filter posts', 'easy-facebook-likebox' );
?>
									<a href="<?php 
echo esc_url( efl_fs()->get_upgrade_url() );
?>">(<?php 
esc_html_e( 'pro', 'easy-facebook-likebox' );
?>)</a>
								</span>
							</div>
							<div class="collapsible-body">
								<p><?php 
esc_html_e( 'You can filter page feed by mentioned, events, albums, videos and images. Select any of them to display only specific type of posts like page mentioned only posts, pages events only, page albums only, page videos only and page images only.', 'easy-facebook-likebox' );
?></p>
							</div>
						</li>

						<li id="efbl_filter_events_info">
							<div class="collapsible-header">
								<span class="mif_detail_head"><?php 
esc_html_e( 'Events Filter', 'easy-facebook-likebox' );
?> <a
											href="<?php 
echo esc_url( efl_fs()->get_upgrade_url() );
?>">(<?php 
esc_html_e( 'pro', 'easy-facebook-likebox' );
?>)</a></span>
							</div>
							<div class="collapsible-body">
								<p><?php 
esc_html_e( 'Filter events to display past, upcoming or all events. Default value is Upcoming', 'easy-facebook-likebox' );
?></p>
							</div>
						</li>

						<li id="efbl_skin_id_info">
							<div class="collapsible-header">
								<span class="mif_detail_head"><?php 
esc_html_e( 'Skin', 'easy-facebook-likebox' );
?></span>
							</div>
							<div class="collapsible-body">
								<p><?php 
esc_html_e( "Skins let's you totally customize the look and feel of your feed in real time. Skin holds all the design settings like feed layout, page header and single post colors, margins and alot of cool settings seprately. You can create new skin from Facebook Likebox - ESPF > Facebook > Skins tab.", 'easy-facebook-likebox' );
?></p>
							</div>
						</li>

						<li id="efbl_post_limit_info">
							<div class="collapsible-header">
								<span class="mif_detail_head"><?php 
esc_html_e( 'Number of posts', 'easy-facebook-likebox' );
?></span>
							</div>
							<div class="collapsible-body">
								<p><?php 
esc_html_e( 'You can set number of posts to display on your website page. Like if you set 10 only first 10 posts from your page will retrieve.', 'easy-facebook-likebox' );
?></p>
							</div>
						</li>

						<li id="efbl_caption_words_info">
							<div class="collapsible-header">
								<span class="mif_detail_head"><?php 
esc_html_e( 'Number of words in caption/content', 'easy-facebook-likebox' );
?></span>
							</div>
							<div class="collapsible-body">
								<p><?php 
esc_html_e( 'You can set number of words in post description. Like if you set 20 only 20 words from feed description will display.', 'easy-facebook-likebox' );
?></p>
							</div>
						</li>

						<li id="efbl_cache_unit_info">
							<div class="collapsible-header">
								<span class="mif_detail_head"><?php 
esc_html_e( 'Cache unit', 'easy-facebook-likebox' );
?></span>
							</div>
							<div class="collapsible-body">
								<p><?php 
esc_html_e( 'Feeds Will be automatically refreshed after selected time interval. In this setting, the possible values are any number. Recommended value is 5', 'easy-facebook-likebox' );
?></p>
							</div>
						</li>

						<li id="efbl_cache_duration_info">
							<div class="collapsible-header">
								<span class="mif_detail_head"><?php 
esc_html_e( 'Cache duration', 'easy-facebook-likebox' );
?></span>
							</div>
							<div class="collapsible-body">
								<p><?php 
esc_html_e( 'Define cache duration to refresh feeds automatically. Like after specified minutes/hours/days feeds would be refreshed. Recommended value is days', 'easy-facebook-likebox' );
?></p>
							</div>
						</li>

						<li id="efbl_load_more_info">
							<div class="collapsible-header">
								<span class="mif_detail_head"><?php 
esc_html_e( 'Load More', 'easy-facebook-likebox' );
?> <a
											href="<?php 
echo esc_url( efl_fs()->get_upgrade_url() );
?>">(<?php 
esc_html_e( 'pro', 'easy-facebook-likebox' );
?>)</a></span>
							</div>
							<div class="collapsible-body">
								<p><?php 
esc_html_e( 'Load More button at the bottom of each feed to infinitely load more posts, events, photos, videos, or albums.', 'easy-facebook-likebox' );
?></p>
							</div>
						</li>

						<li id="efbl_live_stream_only_info">
							<div class="collapsible-header">
								<span class="mif_detail_head"><?php 
esc_html_e( 'Show live stream only', 'easy-facebook-likebox' );
?> <a
											href="<?php 
echo esc_url( efl_fs()->get_upgrade_url() );
?>">(<?php 
esc_html_e( 'pro', 'easy-facebook-likebox' );
?>)</a></span>
							</div>
							<div class="collapsible-body">
								<p><?php 
esc_html_e( 'Display only live stream post when page goes live', 'easy-facebook-likebox' );
?>.</p>
							</div>
						</li>

						<li id="efbl_show_likebox_info">
							<div class="collapsible-header">
								<span class="mif_detail_head"><?php 
esc_html_e( 'Show likebox', 'easy-facebook-likebox' );
?></span>
							</div>
							<div class="collapsible-body">
								<p><?php 
esc_html_e( 'It will let you show the page like box or the page plugin at the end of feeds.', 'easy-facebook-likebox' );
?></p>
							</div>
						</li>

						<li id="efbl_link_new_tab_info">
							<div class="collapsible-header">
								<span class="mif_detail_head"><?php 
esc_html_e( 'Links in new tab', 'easy-facebook-likebox' );
?></span>
							</div>
							<div class="collapsible-body">
								<p><?php 
esc_html_e( 'If checked all links in feeds will be opened in a new browser tab instead of current tab.', 'easy-facebook-likebox' );
?></p>
							</div>
						</li>

					</ul>
				</div>

			</div>
	</div>
</div>
