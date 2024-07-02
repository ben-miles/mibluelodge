<?php
/**
 * Admin View: Tab - Skins
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $mif_skins;

if ( isset( $fta_settings['plugins']['instagram']['default_page_id'] ) ) {
	$page_id = $fta_settings['plugins']['instagram']['default_page_id'];
} else {
	$page_id = '';
}

if ( isset( $fta_settings['plugins']['instagram']['instagram_connected_account'] ) ) {

	$mif_personal_connected_accounts = $fta_settings['plugins']['instagram']['instagram_connected_account'];

} else {

	$mif_personal_connected_accounts = array();

}


$esf_insta_business_accounts = esf_insta_business_accounts();

?>
<div id="mif-skins" class="mif_tab_c slideLeft <?php echo $active_tab == 'mif-skins' ? 'active' : ''; ?>">
	<div class="row">

		<div class="mif_skin_head_wrap">
			<h5><?php esc_html_e( 'Want to customize the layout of Instagram feed?', 'easy-facebook-likebox' ); ?></h5>
			<p><?php esc_html_e( 'Skins allows you to totally customize the look and feel of your feed in real-time using WordPress customizer. Skin holds all the design settings like feed layout (fullwidth, Grid, etc), show hide elements, page header, and single post colors, margins and a lot of cool settings separately. Questions?', 'easy-facebook-likebox' ); ?>
				<a target="_blank"
				   href="<?php echo esc_url( 'https://easysocialfeed.com/documentation/how-to-use-skins/' ); ?>"><?php esc_html_e( 'See this support document', 'easy-facebook-likebox' ); ?></a>
			</p>
		</div>

		<div class="mif_all_skins col s12">
			<?php

			if ( $mif_skins ) {

				foreach ( $mif_skins as $mif_skin ) {

					$customizer_url = admin_url( 'customize.php' );
					if ( isset( $page_permalink ) ) {
						$customizer_url = add_query_arg(
							array(
								'url'              => urlencode( $page_permalink ),
								'autofocus[panel]' => 'mif_skins_panel',
								'mif_skin_id'      => $mif_skin['ID'],
								'mif_customize'    => 'yes',
							),
							$customizer_url
						);
					}

					if ( $mif_skin['layout'] ) {
						$img_url = ESF_INSTA_PLUGIN_URL . 'admin/assets/images/' . $mif_skin['layout'] . '.jpg';
					} else {
						$img_url = ESF_INSTA_PLUGIN_URL . 'admin/assets/images/grid.jpg';
					}
					?>

					<div class="card col mif_single_skin s3 mif_skin_<?php esc_attr_e( $mif_skin['ID'] ); ?>">
						<div class="card-image waves-effect waves-block waves-light">
							<img class="z-depth-1" src="<?php echo esc_url( $img_url ); ?>">
						</div>
						<div class="card-content">
							<span class="card-title"><?php esc_html_e( $mif_skin['title'] ); ?></span>
						</div>

						<div class="mif_cta_holder">
							<select class="mif_selected_account_<?php esc_attr_e( $mif_skin['ID'] ); ?>"
									required>
								<?php
								if ( esf_insta_instagram_type() == 'personal' && ! empty( $mif_personal_connected_accounts ) ) {

									foreach ( $mif_personal_connected_accounts as $personal_id => $mif_personal_connected_account ) {
										?>

										<option value="<?php esc_attr_e( $personal_id ); ?>"><?php esc_html_e( $mif_personal_connected_account['username'] ); ?></option>

										<?php
									}
								} else {

									if ( $esf_insta_business_accounts ) {
										foreach ( $esf_insta_business_accounts as $mif_insta_single_account ) {
											?>

											<option value="<?php esc_attr_e( $mif_insta_single_account->id ); ?>
													data-icon="<?php echo esc_url( $mif_insta_single_account->profile_picture_url ); ?>"><?php esc_html_e( $mif_insta_single_account->username ); ?></option>

											<?php
										}
									} else {
										?>

										<option value="" disabled
												selected><?php esc_html_e( 'No accounts found, Please connect your Instagram account with plugin first', 'easy-facebook-likebox' ); ?></option>

										<?php } ?>


																<?php } ?>
							</select>
							<label><?php esc_html_e( 'Please select your account first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any account)', 'easy-facebook-likebox' ); ?></label>
							<div class="mif-skin-actions-holder">
								<a class="btn esf_insta_skin_redirect"
								   data-page_id="<?php esc_attr_e( $page_id ); ?>"
								   data-skin_id="<?php esc_attr_e( $mif_skin['ID'] ); ?>"
								   href="javascript:void(0);">
									<?php esc_html_e( 'Edit', 'easy-facebook-likebox' ); ?>
									<span class="dashicons dashicons-edit right"></span></a>
								<a class="btn waves-effect esf_insta_copy_skin_id waves-light"
								   data-clipboard-text="<?php esc_attr_e( $mif_skin['ID'] ); ?>"
								   href="javascript:void(0);">
									<?php esc_html_e( 'Copy Skin ID', 'easy-facebook-likebox' ); ?>
									<span class="dashicons dashicons-admin-page right"></span>
								</a>
							</div>
						</div>
					</div>
					<?php
				}
			} else {
				?>

			<blockquote
					class="error"><?php esc_html_e( 'Whoops! No skin found. Create new skin from button above to totally customize your feed in real-time.', 'easy-facebook-likebox' ); ?>
				<?php
			}

			if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
			} else {
				?>

					<div class="card col mif_single_skin mif_single_skin_free s3">
						<a class="skin_free_full esf-modal-trigger"
						   href="#mif-free-masonry-upgrade"></a>
						<div class="card-image waves-effect waves-block waves-light">
							<a class="esf-modal-trigger"
							   href="#mif-free-masonry-upgrade"> <img class=""
																	  src="<?php echo ESF_INSTA_PLUGIN_URL; ?>admin/assets/images/masonary.jpg">
							</a>
						</div>
						<div class="card-content">
							<a class=" esf-modal-trigger"
							   href="#mif-free-masonry-upgrade"> <span
										class="card-title  grey-text text-darken-4">
								<?php esc_html_e( 'Skin - Masonry layout', 'easy-facebook-likebox' ); ?>
									</span>
							</a>
						</div>
						<div class="mif_cta_holder">
							<label><?php esc_html_e( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page)', 'easy-facebook-likebox' ); ?></label>
							<select class="mif_selected_account" required>
							<?php
							if ( esf_insta_instagram_type() == 'personal' && ! empty( $mif_personal_connected_accounts ) ) {

								foreach ( $mif_personal_connected_accounts as $personal_id => $mif_personal_connected_account ) {
									?>

										<option value="<?php esc_attr_e( $personal_id ); ?>"><?php esc_html_e( $mif_personal_connected_account['username'] ); ?></option>

									<?php
								}
							} else {

								if ( $esf_insta_business_accounts ) {
									foreach ( $esf_insta_business_accounts as $mif_insta_single_account ) {
										?>

											<option value="<?php esc_attr_e( $mif_insta_single_account->id ); ?>
													data-icon="<?php echo esc_url( $mif_insta_single_account->profile_picture_url ); ?>"><?php esc_html_e( $mif_insta_single_account->username ); ?></option>

										<?php
									}
								} else {
									?>

										<option value="" disabled
												selected><?php esc_html_e( 'No accounts found, Please connect your Instagram account with plugin first', 'easy-facebook-likebox' ); ?></option>

									<?php } ?>


															<?php } ?>
							</select>
							<div class="mif-skin-actions-holder">
								<a class="btn waves-effect  waves-light esf_insta_skin_redirect_free  esf-modal-trigger"
								   href="#mif-free-masonry-upgrade">
									<?php esc_html_e( 'Edit', 'easy-facebook-likebox' ); ?>
									<span class="dashicons dashicons-edit right"></span>
								</a>
								<a class="btn waves-effect esf_insta_copy_skin_id esf-modal-trigger  waves-light"
								   href="#mif-free-masonry-upgrade"><?php esc_html_e( 'Copy Skin ID', 'easy-facebook-likebox' ); ?>
									 <span class="dashicons dashicons-admin-page right"></span>
								</a>
							</div>
						</div>

					</div>

					<div class="card col mif_single_skin mif_single_skin_free s3">
						<a class="skin_free_full esf-modal-trigger"
						   href="#mif-free-carousel-upgrade"></a>
						<div class="card-image waves-effect waves-block waves-light">
							<a class=" esf-modal-trigger"
							   href="#mif-free-carousel-upgrade"> <img class=""
																	   src="<?php echo ESF_INSTA_PLUGIN_URL; ?>admin/assets/images/carousel.jpg">
							</a>
						</div>
						<div class="card-content">
							<a class=" esf-modal-trigger"
							   href="#mif-free-carousel-upgrade">
								<span class="card-title">
									<?php esc_html_e( 'Skin - Carousel layout', 'easy-facebook-likebox' ); ?>
								</span>
							</a>
						</div>
						<div class="mif_cta_holder">
							<label><?php esc_html_e( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page)', 'easy-facebook-likebox' ); ?></label>
							<select class="mif_selected_account" required>
								<?php
								if ( esf_insta_instagram_type() == 'personal' && ! empty( $mif_personal_connected_accounts ) ) {

									foreach ( $mif_personal_connected_accounts as $personal_id => $mif_personal_connected_account ) {
										?>

										<option value="<?php esc_attr_e( $personal_id ); ?>"><?php esc_html_e( $mif_personal_connected_account['username'] ); ?></option>

										<?php
									}
								} else {

									if ( $esf_insta_business_accounts ) {
										foreach ( $esf_insta_business_accounts as $mif_insta_single_account ) {
											?>

											<option value="<?php esc_attr_e( $mif_insta_single_account->id ); ?>
													data-icon="<?php echo esc_url( $mif_insta_single_account->profile_picture_url ); ?>"><?php esc_html_e( $mif_insta_single_account->username ); ?></option>

											<?php
										}
									} else {
										?>

										<option value="" disabled
												selected><?php esc_html_e( 'No accounts found, Please connect your Instagram account with plugin first', 'easy-facebook-likebox' ); ?></option>

										<?php } ?>


																<?php } ?>
							</select>
							<div class="mif-skin-actions-holder">
								<a class="btn waves-effect  waves-light esf_insta_skin_redirect_free esf-modal-trigger"
								   href="#mif-free-carousel-upgrade">
									<?php esc_html_e( 'Edit', 'easy-facebook-likebox' ); ?>
									<span class="dashicons dashicons-edit right"></span>
								</a>

								<a class="btn waves-effect esf_insta_copy_skin_id esf-modal-trigger  waves-light"
								   href="#mif-free-carousel-upgrade"><?php esc_html_e( 'Copy Skin ID', 'easy-facebook-likebox' ); ?>
									 <span class="dashicons dashicons-admin-page right"></span>
								</a>
							</div>
						</div>

					</div>

					<div class="card col mif_single_skin mif_single_skin_free s3">
						<a class="skin_free_full esf-modal-trigger"
						   href="#mif-free-half_width-upgrade"></a>
						<div class="card-image waves-effect waves-block waves-light">
							<a class=" esf-modal-trigger"
							   href="#mif-free-half_width-upgrade"> <img
										class=""
										src="<?php echo ESF_INSTA_PLUGIN_URL; ?>admin/assets/images/half_width.jpg">
							</a>
						</div>
						<div class="card-content">
							<a class=" esf-modal-trigger"
							   href="#mif-free-half_width-upgrade">
								<span class="card-title  grey-text text-darken-4"><?php esc_html_e( 'Skin - Half Width layout', 'easy-facebook-likebox' ); ?>
								</span>
							</a>
						</div>
						<div class="mif_cta_holder">
							<label><?php esc_html_e( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page)', 'easy-facebook-likebox' ); ?></label>
							<select class="mif_selected_account" required>
								<?php
								if ( esf_insta_instagram_type() == 'personal' && ! empty( $mif_personal_connected_accounts ) ) {

									foreach ( $mif_personal_connected_accounts as $personal_id => $mif_personal_connected_account ) {
										?>

										<option value="<?php esc_attr_e( $personal_id ); ?>"><?php esc_html_e( $mif_personal_connected_account['username'] ); ?></option>

										<?php
									}
								} else {

									if ( $esf_insta_business_accounts ) {
										foreach ( $esf_insta_business_accounts as $mif_insta_single_account ) {
											?>

											<option value="<?php esc_attr_e( $mif_insta_single_account->id ); ?>
													data-icon="<?php echo esc_url( $mif_insta_single_account->profile_picture_url ); ?>"><?php esc_html_e( $mif_insta_single_account->username ); ?></option>

											<?php
										}
									} else {
										?>

										<option value="" disabled
												selected><?php esc_html_e( 'No accounts found, Please connect your Instagram account with plugin first', 'easy-facebook-likebox' ); ?></option>

										<?php } ?>


																<?php } ?>
							</select>
							<div class="mif-skin-actions-holder">
								<a class="btn waves-effect  waves-light esf_insta_skin_redirect_free esf-modal-trigger"
								   href="#mif-free-half_width-upgrade">
									<?php esc_html_e( 'Edit', 'easy-facebook-likebox' ); ?>
									<span class="dashicons dashicons-edit right"></span>
								</a>
								<a class="btn waves-effect esf_insta_copy_skin_id esf-modal-trigger  waves-light"
								   href="#mif-free-half_width-upgrade"><?php esc_html_e( 'Copy Skin ID', 'easy-facebook-likebox' ); ?>
									 <span class="dashicons dashicons-admin-page right"></span>
								</a>
							</div>
						</div>
					</div>

					<div class="card col mif_single_skin mif_single_skin_free s3">
						<a class="skin_free_full esf-modal-trigger"
						   href="#mif-free-full_width-upgrade"></a>
						<div class="card-image waves-effect waves-block waves-light">
							<a class=" esf-modal-trigger"
							   href="#mif-free-full_width-upgrade"> <img
										class=""
										src="<?php echo ESF_INSTA_PLUGIN_URL; ?>admin/assets/images/full_width.jpg">
							</a>
						</div>
						<div class="card-content">
							<a class="esf-modal-trigger"
							   href="#mif-free-full_width-upgrade"> <span
										class="card-title">
									<?php esc_html_e( 'Skin - Full Width layout', 'easy-facebook-likebox' ); ?>
								</span>
							</a>
						</div>
						<div class="mif_cta_holder">
							<label><?php esc_html_e( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page)', 'easy-facebook-likebox' ); ?></label>
							<select class="mif_selected_account" required>
								<?php
								if ( esf_insta_instagram_type() == 'personal' && ! empty( $mif_personal_connected_accounts ) ) {

									foreach ( $mif_personal_connected_accounts as $personal_id => $mif_personal_connected_account ) {
										?>

										<option value="<?php esc_attr_e( $personal_id ); ?>"><?php esc_html_e( $mif_personal_connected_account['username'] ); ?></option>

										<?php
									}
								} else {

									if ( $esf_insta_business_accounts ) {
										foreach ( $esf_insta_business_accounts as $mif_insta_single_account ) {
											?>

											<option value="<?php esc_attr_e( $mif_insta_single_account->id ); ?>
													data-icon="<?php echo esc_url( $mif_insta_single_account->profile_picture_url ); ?>"><?php esc_html_e( $mif_insta_single_account->username ); ?></option>

											<?php
										}
									} else {
										?>

										<option value="" disabled
												selected><?php esc_html_e( 'No accounts found, Please connect your Instagram account with plugin first', 'easy-facebook-likebox' ); ?></option>

										<?php } ?>


																<?php } ?>
							</select>
							<div class="mif-skin-actions-holder">
							<a class="btn waves-effect  waves-light esf_insta_skin_redirect_free esf-modal-trigger"
							   href="#mif-free-full_width-upgrade">
								<?php esc_html_e( 'Edit', 'easy-facebook-likebox' ); ?>
									<span class="dashicons dashicons-edit right"></span>
							</a>
							<a class="btn waves-effect esf_insta_copy_skin_id esf-modal-trigger  waves-light"
							   href="#mif-free-full_width-upgrade"><?php esc_html_e( 'Copy Skin ID', 'easy-facebook-likebox' ); ?>
								 <span class="dashicons dashicons-admin-page right"></span>
							</a>
							</div>
						</div>

					</div>

				<?php } ?>

		</div>

	</div>
</div>
