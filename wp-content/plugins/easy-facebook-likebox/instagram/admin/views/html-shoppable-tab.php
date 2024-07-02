<?php
/**
 * Admin View: Tab - Moderate
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="mif-shoppable" class="mif_tab_c slideLeft <?php echo $active_tab == 'mif-shoppable' ? 'active' : ''; ?>">
	<div class="row">
		<div class="mif_tabs_holder">
				<div id="mif-shoppable-wrap" class="tab-content">
                    <h5><?php esc_html_e( 'Want to show Shoppable Feed?' ); ?></h5>
                    <p><?php esc_html_e( 'Easily add a page on your website where visitors can shop directly from your Instagram feed' ); ?>.</p>

					<div class="mif-shoppable-fields-wrap">

					<div class="input-field col s12 mif_fields">
						<label><?php esc_html_e( 'Account(s)', 'easy-facebook-likebox' ); ?></label>
						<select id="mif_shoppable_user_id" class="icons mif_skin_id">
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

					</div>

					<button class="btn waves-effect mif-get-shoppable-feed waves-light"><?php esc_html_e( 'Refresh feed', 'easy-facebook-likebox' ); ?></button>
					<div class="mif-shoppable-visual-wrap
					<?php
					if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'facebook_premium', true ) ) {
						?>
						 mif-shoppable-free-view <?php } ?>">
                        <div class="mif-shoppable-visual-feed">
                        </div>
                        <div class="mif-shoppable-general">
                            <h5><?php esc_html_e('Shoppable Preset', 'easy-facebook-likebox'); ?></h5>
                            <form class="ei-shoppable-general-form" name="ei-shoppable-general-form">
                                <div class="ei-field-container ei-btn-text-wrap">
                                    <label> <?php esc_html_e('Button/link text', 'easy-facebook-likebox'); ?> </label>
                                    <input type="text" id="ei-link-text" <?php if( $is_free ) { ?> disabled <?php } ?> value="<?php echo esc_attr( $link_text ) ?>" name="link_text" />
                                </div>
                                <div class="ei-field-container">
                                    <label> <?php esc_html_e('Click behaviour', 'easy-facebook-likebox'); ?></label>
                                    <select <?php if( $is_free ) { ?> disabled <?php } ?> class="ei-select2" id="ei-click-behaviour" name="click_behaviour">
                                        <option <?php selected( $click_behaviour, 'popup' ); ?> value="popup"><?php echo esc_html_e( 'Popup', 'easy-facebook-likebox' ); ?></option>
                                        <option <?php selected( $click_behaviour, 'direct_link' ); ?> value="direct_link"><?php echo esc_html_e( 'Direct Link', 'easy-facebook-likebox' ); ?></option>
                                    </select>
                                </div>
                                <div class="ei-cta-wrap">
                                    <input type="submit" <?php if( $is_free ) { ?> disabled <?php } ?> name="ei-shoppable-general-form" class="btn <?php if( $is_free ) { ?> disabled <?php } ?>" value="<?php esc_html_e('Save', 'easy-facebook-likebox'); ?>">
                                    <a href="#esf-insta-shoppable-reset" <?php if( $is_free ) { ?> disabled <?php } ?> class="btn <?php if( $is_free ) { ?> disabled <?php } ?> <?php if( ! $is_free ) { ?> esf-modal-trigger <?php } ?>"><?php esc_html_e('Reset All', 'easy-facebook-likebox'); ?></a>
                                    <div id="esf-insta-shoppable-reset" class="esf-modal">
                                        <div class="modal-content">
                                            <div class="mif-modal-content"><span class="mif-lock-icon">
						<span class="dashicons dashicons-warning"></span>
					</span>
                                                <h5><?php esc_html_e( 'Are you sure?', 'easy-facebook-likebox' ); ?></h5>
                                                <p><?php esc_html_e( 'Do you really want to delete the Shoppable Settings? It will delete all the shoppable settings of selected feed.', 'easy-facebook-likebox' ); ?></p>
                                                <a class="btn modal-close"
                                                   href="javascript:void(0)"><?php esc_html_e( 'Cancel', 'easy-facebook-likebox' ); ?></a>
                                                <a class="btn ei-del-shoppable modal-close"
                                                   href="javascript:void(0)"><?php esc_html_e( 'Delete', 'easy-facebook-likebox' ); ?></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
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
