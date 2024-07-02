<?php
/**
 * Admin View: Tab - Moderate
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$FTA          = new Feed_Them_All();
$fta_settings = $FTA->fta_get_settings();
?>
<div id="efbl-moderate" class="col s12 efbl_tab_c slideLeft <?php echo $active_tab == 'efbl-moderate' ? 'active' : ''; ?>">
	<div class="row">
		<div class="efbl_tabs_holder">
				<div id="efbl-moderate-wrap" class="tab-content efbl_tab_c_holder">
					<h5><?php esc_html_e( 'Want to show or hide only specific posts?' ); ?></h5>
					<p><?php esc_html_e( 'Select posts to hide or show from feed' ); ?>.</p>
					<div class="efbl-moderate-fields-wrap">
						<div class="input-field col s12 efbl_fields">
							<label><?php esc_html_e( 'Select Page', 'easy-facebook-likebox' ); ?></label>
							<select id="efbl_moderate_page_id"
									class="icons efbl_moderate_page_id">
								<?php
								$type = 'page';
								if ( $fta_settings['plugins']['facebook']['approved_pages'] ) {
									$i = 0;
									foreach ( $fta_settings['plugins']['facebook']['approved_pages'] as $efbl_page ) {
										$i++;
										if ( $efbl_page['id'] ) {

											 $username = $efbl_page['id'];

											if ( $i == 1 ) {
												$first_page_id = $username;
											}
											?>
											<option value="<?php esc_attr_e( $username ); ?>"
													data-icon="<?php echo efbl_get_page_logo( $efbl_page['id'] ); ?>" 
																		  <?php
																			if ( $i == 1 ) {
																				?>
														 selected <?php } ?>><?php esc_html_e( $efbl_page['name'] ); ?></option>

											<?php
										}
									}
								} else {
									?>

									<option value="" disabled
											selected><?php esc_html_e( 'No page(s) found, Please connect your Facebook page with plugin first from authenticate tab', 'easy-facebook-likebox' ); ?></option>

									<?php
								}
								?>
							</select>
						</div>
						<div class="efbl-moderate-type-wrap">
							<div class="efbl-moderate-type">
								<input name="efbl_moderate_type"
									   type="radio" class="with-gap"
									   value="hide" checked id="efbl_hide"/>
								<label for="efbl_hide"><?php esc_html_e( 'Hide the selected posts', 'easy-facebook-likebox' ); ?></label>
							</div>
							<div class="efbl-moderate-type">
								<input name="efbl_moderate_type"
									   type="radio" class="with-gap"
									   value="show"  id="efbl_show"/>
								<label for="efbl_show"><?php esc_html_e( 'Only show the selected posts', 'easy-facebook-likebox' ); ?></label>
							</div>
						</div>
					</div>

					<button class="btn waves-effect efbl-get-moderate-feed waves-light"><?php esc_html_e( 'Get feed', 'easy-facebook-likebox' ); ?></button>
					<div class="efbl-moderate-visual-wrap 
					<?php
					if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
						?>
						 efbl-moderate-free-view <?php } ?>">
						<?php
						if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
							global $efbl_skins;
							$skin_id = '';
							if ( isset( $efbl_skins ) ) {
								foreach ( $efbl_skins as $skin ) {
									if ( $skin['layout'] == 'grid' ) {
										$skin_id = $skin['ID'];
									}
								}
							}

							$shortcode = '[efb_feed fanpage_id="' . $first_page_id . '" type="' . $type . '" test_mode="false" is_moderate="true" skin_id="' . $skin_id . '" words_limit="25" post_limit="30" links_new_tab="1"]';
							echo do_shortcode( $shortcode );
						}
						?>
					</div>

					<?php
					if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
						$ESF_Admin   = new ESF_Admin();
						$banner_info = $ESF_Admin->esf_upgrade_banner();
						?>
						<div class="efbl-moderate-pro">
							<a href="<?php echo efl_fs()->get_upgrade_url(); ?>&trial=true"
							   class="trial-btn"><?php esc_html_e( 'Free 7-day PRO trial', 'easy-facebook-likebox' ); ?>
							</a>
							<a href="<?php echo efl_fs()->get_upgrade_url(); ?>"
							   class=" btn pro-btn"><span class="dashicons dashicons-unlock right"></span><?php esc_html_e( 'Upgrade to pro', 'easy-facebook-likebox' ); ?>
							</a>
							<p><?php esc_html_e( 'Upgrade today and get ' . $banner_info['discount'] . ' discount! On the checkout click on "Have a promotional code?" and enter', 'easy-facebook-likebox' ); ?>
								<?php if ( $banner_info['coupon'] ) { ?>
									<code><?php esc_html_e( $banner_info['coupon'] ); ?></code>
								<?php } ?>
							</p>
						</div>
					<?php } ?>

				</div>

			</div>
	</div>
</div>
