<?php

/**
 * Admin View: Tab - PopUp
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$ESF_Admin = new ESF_Admin();
$default_page_id = efbl_default_page_id();
?>
<div id="efbl-likebox" class="col s12 efbl_tab_c slideLeft <?php 
echo ( $active_tab == 'efbl-likebox' ? 'active' : '' );
?>">
	<div id="efbl-likebox-use"
		 class="tab-content efbl_tab_c_holder">
		<div class="row">

			<div class="efbl_collapsible_info col s12">

				<div class="efbl_default_shortcode_holder col s8">
					<h5><?php 
esc_html_e( 'How to use this plugin?', 'easy-facebook-likebox' );
?></h5>
					<p><?php 
esc_html_e( 'Copy and paste the following shortcode in any page, post or text widget to display the likebox/page plugin.', 'easy-facebook-likebox' );
?></p>

					<div class="efbl-shortcode-holder">
						<blockquote class="efbl-shortcode-block">
							[efb_likebox
							fanpage_url="<?php 
esc_attr_e( $default_page_id );
?>"
							responsive="1"]
						</blockquote>
						<a class="btn waves-effect efbl_copy_shortcode waves-light tooltipped"
						   data-position="right" data-delay="50"
						   data-tooltip="<?php 
esc_html_e( 'Copy', 'easy-facebook-likebox' );
?>"
						   data-clipboard-text='[efb_likebox fanpage_url="<?php 
esc_attr_e( $default_page_id );
?>" responsive="1"]'
						   href="javascript:void(0);"><span
									class="dashicons dashicons-admin-page right"></span>
						</a>
					</div>
					<?php 
esc_html_e( $efbl_default_likebox_notice );
?>
					<h5 class="efbl_more_head"><?php 
esc_html_e( 'Need More Options?', 'easy-facebook-likebox' );
?></h5>
					<p><?php 
esc_html_e( 'Use the following shortcode generator to further customize the shortcode.', 'easy-facebook-likebox' );
?></p>
				</div>

				<div class="efbl_shortocode_genrator_main col s4">
					<h5><?php 
esc_html_e( 'How to use shortcode?', 'easy-facebook-likebox' );
?></h5>
					<ol>
						<li><?php 
esc_html_e( 'Generate the shortcode using the shortcode generator below.', 'easy-facebook-likebox' );
?></li>
						<li><?php 
esc_html_e( 'Copy the shortcode in the left column or generate shortcode if you need more options.', 'easy-facebook-likebox' );
?></li>
						<li><?php 
esc_html_e( 'Paste in the page/post content or in text widget', 'easy-facebook-likebox' );
?></li>
					</ol>
				</div>

				<form class="efbl_like_box_shortocode_genrator"
					  name="efbl_like_box_shortocode_genrator"
					  type="post">
					<h5><?php 
esc_html_e( 'Shortcode Generator', 'easy-facebook-likebox' );
?></h5>
					<div class="input-field col s12 efbl_fields">
						<label for="efbl_like_box_url"
							   class=""><?php 
esc_html_e( 'Your page full URL', 'easy-facebook-likebox' );
?></label>
						<a href="javascript:void(0)"
						   class="efbl_open_likebox_collapisble"
						   data-id="efbl_like_box_url_info">?</a>
						<input id="efbl_like_box_url" type="text">
					</div>

					<?php 
?>


					<div class="input-field col s6 efbl_fields" style="padding-right: 10px;">
						<label for="efbl_like_box_width"
							   class=""><?php 
esc_html_e( 'Box width', 'easy-facebook-likebox' );
?></label>
						<a href="javascript:void(0)"
						   class="efbl_open_likebox_collapisble"
						   data-id="efbl_like_box_width_info">?</a>
						<input id="efbl_like_box_width"
							   type="number" min="1">
					</div>

					<div class="input-field col s6 efbl_fields">
						<label for="efbl_like_box_height"
							   class=""><?php 
esc_html_e( 'Box height', 'easy-facebook-likebox' );
?></label>
						<a href="javascript:void(0)"
						   style="right: 10px;"
						   class="efbl_open_likebox_collapisble"
						   data-id="efbl_like_box_height_info">?</a>
						<input id="efbl_like_box_height"
							   type="number" min="1">
					</div>

					<div class="input-field col s6 efbl_fields" style="padding-right: 10px;margin-top: -2px;">
						<label><?php 
esc_html_e( 'Select language', 'easy-facebook-likebox' );
?></label>
						<a href="javascript:void(0)"
						   class="efbl_open_likebox_collapisble"
						   data-id="efbl_like_box_locale_info">?</a>
						<select id="efbl_like_box_locale"
								class="efbl_like_box_locale">

							<?php 
$efbl_get_locales = efbl_get_locales();
if ( $efbl_get_locales ) {
    foreach ( $efbl_get_locales as $key => $efbl_get_local ) {
        ?>
									<option 
									<?php 
        if ( $key == 'en_US' ) {
            ?>
										 selected <?php 
        }
        ?> value="<?php 
        esc_attr_e( $key );
        ?>"><?php 
        esc_html_e( $efbl_get_local );
        ?></option>
									<?php 
    }
}
?>
						</select>
					</div>

					<div class="input-field col s6 efbl_fields"
						 style="padding-right: 10px;">
						<label for="efbl_like_box_app_id"
							   class=""><?php 
esc_html_e( 'Facebook App ID(optional)', 'easy-facebook-likebox' );
?></label>
						<a href="javascript:void(0)"
						   class="efbl_open_likebox_collapisble"
						   data-id="efbl_like_box_appid_info">?</a>
						<input id="efbl_like_box_app_id"
							   type="text">
					</div>

					<div class="col s6 efbl_fields checkbox-field">
						<a href="javascript:void(0)"
						   style="right: 10px;"
						   class="efbl_open_likebox_collapisble"
						   data-id="efbl_like_box_responsive_info">?</a>
						<input name="efbl_like_box_responsive"
							   type="checkbox" class="filled-in"
							   value=""
							   id="efbl_like_box_responsive"/>
						<label for="efbl_like_box_responsive"><?php 
esc_html_e( 'Responsive', 'easy-facebook-likebox' );
?></label>
					</div>

					<div class="col s6 efbl_fields checkbox-field">
						<a href="javascript:void(0)"
						   class="efbl_open_likebox_collapisble"
						   data-id="efbl_like_box_faces_info">?</a>
						<input name="efbl_like_box_faces"
							   type="checkbox" class="filled-in"
							   value="" id="efbl_like_box_faces"/>
						<label for="efbl_like_box_faces"><?php 
esc_html_e( 'Show faces', 'easy-facebook-likebox' );
?></label>
					</div>

					<div class="col s6 efbl_fields checkbox-field">
						<a href="javascript:void(0)"
						   style="right: 10px;"
						   class="efbl_open_likebox_collapisble"
						   data-id="efbl_like_box_stream_info">?</a>
						<input name="efbl_like_box_stream"
							   type="checkbox" class="filled-in"
							   value="" id="efbl_like_box_stream"/>
						<label for="efbl_like_box_stream"><?php 
esc_html_e( 'Show posts stream', 'easy-facebook-likebox' );
?></label>
					</div>

					<div class="col s6 efbl_fields checkbox-field">
						<a href="javascript:void(0)"
						   class="efbl_open_likebox_collapisble"
						   data-id="efbl_like_box_cover_info">?</a>
						<input name="efbl_like_box_cover"
							   type="checkbox" class="filled-in"
							   value="" id="efbl_like_box_cover"/>
						<label for="efbl_like_box_cover"><?php 
esc_html_e( 'Hide cover', 'easy-facebook-likebox' );
?></label>
					</div>

					<div class="col s6 efbl_fields checkbox-field">
						<a href="javascript:void(0)"
						   style="right: 10px;"
						   class="efbl_open_likebox_collapisble"
						   data-id="efbl_like_box_sh_info">?</a>
						<input name="efbl_like_box_small_header"
							   type="checkbox" class="filled-in"
							   value=""
							   id="efbl_like_box_small_header"/>
						<label for="efbl_like_box_small_header"><?php 
esc_html_e( 'Small header', 'easy-facebook-likebox' );
?></label>
					</div>

					<div class="col s6 efbl_fields checkbox-field">
						<a href="javascript:void(0)"
						   class="efbl_open_likebox_collapisble"
						   data-id="efbl_like_box_cta_info">?</a>
						<input name="efbl_like_box_hide_cta"
							   type="checkbox" class="filled-in"
							   value=""
							   id="efbl_like_box_hide_cta"/>
						<label for="efbl_like_box_hide_cta"><?php 
esc_html_e( 'Hide call to action button', 'easy-facebook-likebox' );
?></label>
					</div>
					<?php 
?>
						<div class="col s12 efbl_fields checkbox-field">
							<input name="" class="esf-modal-trigger"
								   href="#efbl-tabs-upgrade"
								   type="checkbox" required
								   value="efbl_free_tabs"
								   id="efbl_free_tabs"/>
							<label for="efbl_free_tabs"><?php 
esc_html_e( 'Tabs', 'easy-facebook-likebox' );
?></label>
							<a href="javascript:void(0)"
							   class="efbl_open_likebox_collapisble"
							   data-id="efbl_tabs_info">?</a>
						</div>
					<?php 
?>

					<input type="submit"
						   class="btn efbl_likebox_shortcode_submit"
						   value="<?php 
esc_html_e( 'Generate', 'easy-facebook-likebox' );
?>"/>
				</form>

				<div class="efbl_likebox_generated_shortcode">
					<p><?php 
esc_html_e( 'Paste in the page/post content or in text widget', 'easy-facebook-likebox' );
?></p>
					<blockquote
							class="efbl-likebox-shortcode-block"></blockquote>
					<a class="btn waves-effect efbl_likebox_copy_shortcode efbl_likebox_shortcode_generated_final waves-light tooltipped"
					   data-position="right" data-delay="50"
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
esc_html_e( 'Look for Easy Facebook Likebox widget in available widgets section.', 'easy-facebook-likebox' );
?></li>
					<li><?php 
esc_html_e( 'Drag and drop the widget to any of your active sidebar.', 'easy-facebook-likebox' );
?></li>
					<li><?php 
esc_html_e( 'Change default values with your requirements like fanpage url and animation etc.', 'easy-facebook-likebox' );
?></li>
					<li><?php 
esc_html_e( 'Click the save button and visit your site to see likebox in widget', 'easy-facebook-likebox' );
?></li>
				</ol>
				<a class=" btn" href="<?php 
echo esc_url( admin_url( 'widgets.php' ) );
?>"><?php 
esc_html_e( 'Widgets', 'easy-facebook-likebox' );
?></a>
			</div>
		</div>

		<h5><?php 
esc_html_e( 'Unable to understand shortocde parameters?', 'easy-facebook-likebox' );
?></h5>
		<p><?php 
esc_html_e( 'No worries, Each shortocde parameter is explained below first read them and generate your shortocde.', 'easy-facebook-likebox' );
?></p>
		<ul class="collapsible efbl_shortcode_accord efbl_likebox_shortcode_accord"
			data-collapsible="accordion">
			<li id="efbl_like_box_url_info">
				<div class="collapsible-header">
					<span class="mif_detail_head"> <?php 
esc_html_e( 'Page URL', 'easy-facebook-likebox' );
?> </span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'Your Facebook fanpage URL. You can find your page URL from browser address bar when page is opened. Like https://facebook.com/easysocialfeed', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li id="efbl_tabs_info">
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Tabs', 'easy-facebook-likebox' );
?> <a
								href="<?php 
echo esc_url( efl_fs()->get_upgrade_url() );
?>">(<?php 
esc_html_e( 'pro', 'easy-facebook-likebox' );
?>)</a></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'You can now have timeline, events and messages tabs in the likebox. Simply filter the feeds from stream', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li id="efbl_like_box_appid_info">
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Facebook APP ID', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( "To get any type of data from Facebook server it requires Facebook developer app which is responsible of all Facebook calls. Don't worry we have approved apps from Facebook which will be usind if you don't have app registred. You can register your app from Facebook developer account and add ID here.", 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li id="efbl_like_box_width_info">
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Box Width', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'Enter Likebox width in pixels. Likebox will be generated according to defined width.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li id="efbl_like_box_height_info">
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Box Height', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'Enter Likebox height in pixels. Likebox will be generated according to defined height.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li id="efbl_like_box_locale_info">
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Select Language', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'Select the language in which you want to display your feeds.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li id="efbl_like_box_responsive_info">
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Responsive', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'If checked box will automatically adjust on mobile and tablet devices', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li id="efbl_like_box_faces_info">
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Show Faces', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'If checked show profile photos of friends who already liked the page.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li id="efbl_like_box_stream_info">
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Show posts stream', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'If checked it will show posts of the page after likebox.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li id="efbl_like_box_cover_info">
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Hide cover', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'If checked it will not show your Facebook page cover in likebox.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li id="efbl_like_box_sh_info">
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Small Header', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'If checked it will show small header. Cover picture size will be minimized.', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

			<li id="efbl_like_box_cta_info">
				<div class="collapsible-header">
					<span class="mif_detail_head"><?php 
esc_html_e( 'Hide call to action button', 'easy-facebook-likebox' );
?></span>
				</div>
				<div class="collapsible-body">
					<p><?php 
esc_html_e( 'If checked it will not display call to action button like Contact Us', 'easy-facebook-likebox' );
?></p>
				</div>
			</li>

		</ul>
	</div>
</div>
