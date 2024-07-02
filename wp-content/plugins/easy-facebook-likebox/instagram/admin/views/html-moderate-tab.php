<?php
/**
 * Admin View: Tab - Moderate
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="mif-moderate" class="mif_tab_c slideLeft <?php echo $active_tab == 'mif-moderate' ? 'active' : ''; ?>">
	<div class="row">
		<div class="mif_tabs_holder">
				<div id="mif-moderate-wrap" class="tab-content">
					<h5><?php esc_html_e( 'Want to show or hide only specific posts?' ); ?></h5>
					<p><?php esc_html_e( 'Select posts to hide or show from feed' ); ?>.</p>

					<div class="mif-moderate-fields-wrap">

					<div class="input-field col s12 mif_fields">
						<label><?php esc_html_e( 'Account(s)', 'easy-facebook-likebox' ); ?></label>
						<select id="mif_moderate_user_id" class="icons mif_skin_id">
							<?php
							$mif_personal_connected_accounts = esf_insta_personal_account();
							if ( esf_insta_instagram_type() == 'personal' && ! empty( $mif_personal_connected_accounts ) ) {
								$i = 0;
								foreach ( $mif_personal_connected_accounts as $personal_id => $mif_personal_connected_account ) {
									$i++;
									if ( $i == 1 ) {
										$first_user_id = $personal_id;
									}
									?>
									<option value="<?php esc_attr_e( $personal_id ); ?>" 
																	 <?php
																		if ( $i == 1 ) {
																			?>
										 selected <?php } ?> ><?php esc_html_e( $mif_personal_connected_account['username'] ); ?></option>

									<?php
								}
							}

							$esf_insta_business_accounts = esf_insta_business_accounts();

							if ( esf_insta_instagram_type() != 'personal' && $esf_insta_business_accounts ) {

								if ( $esf_insta_business_accounts ) {
									$i = 0;
									foreach ( $esf_insta_business_accounts as $mif_insta_single_account ) {
										$i++;
										if ( $i == 1 ) {
											$first_user_id = $mif_insta_single_account->id;
										}
										?>
										<option value="<?php esc_attr_e( $mif_insta_single_account->id ); ?>"
												data-icon="<?php echo esc_url( $mif_insta_single_account->profile_picture_url ); ?>" 
																	  <?php
																		if ( $i == 1 ) {
																			?>
													 selected <?php } ?>><?php esc_html_e( $mif_insta_single_account->username ); ?></option>
										<?php
									}
								} else {
									?>

									<option value="" disabled
											selected><?php esc_html_e( 'No accounts found, Please connect your Instagram account with plugin first', 'easy-facebook-likebox' ); ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>

					<div class="mif-moderate-type-wrap">
						<div class="mif-moderate-type">
							<input name="mif_moderate_type"
								   type="radio" class="with-gap"
								   value="hide" checked id="mif_hide"/>
							<label for="mif_hide"><?php esc_html_e( 'Hide the selected posts', 'easy-facebook-likebox' ); ?></label>
						</div>
						<div class="mif-moderate-type">
							<input name="mif_moderate_type"
								   type="radio" class="with-gap"
								   value="show"  id="mif_show"/>
							<label for="mif_show"><?php esc_html_e( 'Only show the selected posts', 'easy-facebook-likebox' ); ?></label>
						</div>
					</div>

					</div>

					<button class="btn waves-effect mif-get-moderate-feed waves-light"><?php esc_html_e( 'Refresh feed', 'easy-facebook-likebox' ); ?></button>
					<div class="mif-moderate-visual-wrap  
					<?php
					if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'facebook_premium', true ) ) {
						?>
						 mif-moderate-free-view <?php } ?>">
						<?php
						if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'facebook_premium', true ) ) {
							global $mif_skins;
							$skin_id = '';
							if ( isset( $mif_skins ) ) {
								foreach ( $mif_skins as $skin ) {
									if ( $skin['layout'] == 'grid' ) {
										$skin_id = $skin['ID'];
									}
								}
							}
							$shortcode = '[my-instagram-feed user_id="' . $first_user_id . '" is_moderate="true" skin_id="' . $skin_id . '" words_limit="25" feeds_per_page="30" links_new_tab="1"]';
							echo do_shortcode( $shortcode );
						}
						?>
					</div>
					<?php
					if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'facebook_premium', true ) ) {
						$ESF_Admin   = new ESF_Admin();
						$banner_info = $ESF_Admin->esf_upgrade_banner();
						?>
						<div class="mif-moderate-pro">
							<a href="<?php echo efl_fs()->get_upgrade_url(); ?>&trial=true"
							   class="trial-btn"><?php esc_html_e( 'Free 7-day PRO trial', 'easy-facebook-likebox' ); ?>
							</a>
							<a href="<?php echo efl_fs()->get_upgrade_url(); ?>"
							   class=" btn pro-btn"><span class="dashicons dashicons-unlock"></span><?php esc_html_e( 'Upgrade to pro', 'easy-facebook-likebox' ); ?>
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
