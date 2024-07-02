<?php
/**
 * Admin View: Tab - Skins
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $efbl_skins;


$FTA = new Feed_Them_All();

$efbl_page_options = '';

$fta_settings = $FTA->fta_get_settings();

if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) ) :
	foreach ( $fta_settings['plugins']['facebook']['approved_pages'] as $efbl_page ) :

		$efbl_page_options .= '<option value="' . esc_attr( $efbl_page['id'] ) . '" data-icon="' . efbl_get_page_logo( $efbl_page['id'] ) . '">' . esc_html( $efbl_page['name'] ) . '</option>';

		$efbl_redirect_class = 'efbl_skin_redirect';
	endforeach;
else :
	$efbl_page_options = '<option value="" disabled selected>' . __( 'No page found, Please connect your Facebook page with plugin first from authentication tab', 'easy-facebook-likebox' ) . '</option>';

	$efbl_redirect_class = 'disabled';
endif;

$page_id = null;
/* Getting the demo page id. */
if ( isset( $fta_settings['plugins']['facebook']['default_page_id'] ) && ! empty( $fta_settings['plugins']['facebook']['default_page_id'] ) ) :
	$page_id = $fta_settings['plugins']['facebook']['default_page_id'];
endif;

?>
<div id="efbl-skins" class="col s12 efbl_tab_c slideLeft <?php echo $active_tab == 'efbl-skins' ? 'active' : ''; ?>">
	<div class="efbl_skin_head_wrap">
		<h5><?php esc_html_e( 'Want to customize the layout of post feed?', 'easy-facebook-likebox' ); ?></h5>
		<p><?php esc_html_e( 'Skins allows you to totally customize the look and feel of your post feed in real-time using WordPress customizer. Skin holds all the design settings like feed layout (fullwidth, Grid, etc), show hide elements, page header, and single post colors, margins and a lot of cool settings separately. Questions?', 'easy-facebook-likebox' ); ?>
			<a target="_blank"
			   href="<?php echo esc_url( 'https://easysocialfeed.com/documentation/how-to-use-skins/' ); ?>"><?php esc_html_e( 'See this support document.', 'easy-facebook-likebox' ); ?></a>
		</p>
	</div>
	<div class="efbl_all_skins row">
		<?php
		/* Getting permalink from ID. */
		$page_permalink = get_permalink( $page_id );

		if ( isset( $efbl_skins ) ) {

			foreach ( $efbl_skins as $efbl_skin ) {

				$customizer_url = admin_url( 'customize.php' );

				if ( isset( $page_permalink ) ) {
					$customizer_url = add_query_arg(
						array(
							'url'              => urlencode( $page_permalink ),
							'autofocus[panel]' => 'efbl_customize_panel',
							'efbl_skin_id'     => $efbl_skin['ID'],
							'efbl_customize'   => 'yes',
						),
						$customizer_url
					);

				}

				if ( $efbl_skin['layout'] ) {
					$img_url = EFBL_PLUGIN_URL . 'admin/assets/images/' . $efbl_skin['layout'] . '.jpg';
				} else {
					$img_url = EFBL_PLUGIN_URL . 'admin/assets/images/half.jpg';
				}
				?>

				<div class="card col efbl_single_skin s3 efbl_skin_<?php esc_attr_e( $efbl_skin['ID'] ); ?>">
					<div class="card-image">
						<img class="z-depth-1" src="<?php echo esc_url( $img_url ); ?>">
					</div>
					<div class="card-content">
						<span class="card-title">
							<?php esc_html_e( $efbl_skin['title'] ); ?>
						</span>
					</div>

					<div class="efbl_cta_holder">
						<select class="efbl_selected_account_<?php esc_attr_e( $efbl_skin['ID'] ); ?>" required>
							<?php echo $efbl_page_options; ?>
						</select>
						<label>
							<?php esc_html_e( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page.)', 'easy-facebook-likebox' ); ?>
						</label>
						<div class="efbl-skin-actions-holder">
							<a class="btn  <?php esc_attr_e( $efbl_redirect_class ); ?>"
							   data-page_id="<?php esc_attr_e( $page_id ); ?>"
							   data-skin_id="<?php esc_attr_e( $efbl_skin['ID'] ); ?>"
							   href="javascript:void(0);">
								<?php esc_html_e( 'Edit', 'easy-facebook-likebox' ); ?>
								<span class="dashicons dashicons-edit right"></span>
							</a>
							<a class="btn waves-effect efbl_copy_skin_id waves-light"
							   data-clipboard-text="<?php esc_attr_e( $efbl_skin['ID'] ); ?>"
							   href="javascript:void(0);"><?php esc_html_e( 'Copy Skin ID', 'easy-facebook-likebox' ); ?>
								<span class="dashicons dashicons-admin-page right"></span>
							</a>
						</div>
					</div>
				</div>
				<?php
			}
		}

		if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
			?>

			<div class="card col efbl_single_skin efbl_single_skin_free s3">
				<a class="skin_free_full esf-modal-trigger"
				   href="#efbl-free-grid-upgrade"></a>
				<div class="card-image ">
					<a class="esf-modal-trigger" href="#efbl-free-grid-upgrade">
						<img class=""
							 src="<?php echo EFBL_PLUGIN_URL; ?>admin/assets/images/grid.jpg">
					</a>
				</div>
				<div class="card-content">
					<a class=" esf-modal-trigger" href="#efbl-free-grid-upgrade">
						<span class="card-title  grey-text text-darken-4"><?php esc_html_e( 'Skin - Grid layout', 'easy-facebook-likebox' ); ?></span>
					</a>
				</div>
				<div class="efbl_cta_holder">
					<select class="efbl_selected_account" required>
						<?php echo $efbl_page_options; ?>
					</select>
					<label><?php esc_html_e( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page.)', 'easy-facebook-likebox' ); ?></label>
					<div class="efbl-skin-actions-holder">
						<a class="btn  efbl_skin_redirect_free  esf-modal-trigger"
						   href="#efbl-free-grid-upgrade">
							<?php esc_html_e( 'Edit', 'easy-facebook-likebox' ); ?>
							<span class="dashicons dashicons-edit right"></span></a>

						<a class="btn waves-effect efbl_copy_skin_id esf-modal-trigger  waves-light"
						   href="#efbl-free-grid-upgrade"><?php esc_html_e( 'Copy Skin ID', 'easy-facebook-likebox' ); ?>
							<span class="dashicons dashicons-admin-page right"></span>
						</a>
					</div>
				</div>
			</div>

			<div class="card col efbl_single_skin efbl_single_skin_free s3">
				<a class="skin_free_full esf-modal-trigger"
				   href="#efbl-free-masonry-upgrade"></a>
				<div class="card-image ">
					<a class="esf-modal-trigger" href="#efbl-free-masonry-upgrade">
						<img class=""
							 src="<?php echo EFBL_PLUGIN_URL; ?>admin/assets/images/masonry.jpg">
					</a>
				</div>
				<div class="card-content">
					<a class="esf-modal-trigger" href="#efbl-free-masonry-upgrade">
						<span class="card-title  grey-text text-darken-4">
							<?php esc_html_e( 'Skin - Masonry layout', 'easy-facebook-likebox' ); ?>
						</span>
					</a>
				</div>
				<div class="efbl_cta_holder">
					<select class="efbl_selected_account" required>
						<?php echo $efbl_page_options; ?>
					</select>
					<label><?php esc_html_e( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page.)', 'easy-facebook-likebox' ); ?></label>
					<div class="efbl-skin-actions-holder">
						<a class="btn  efbl_skin_redirect_free  esf-modal-trigger"
						   href="#efbl-free-masonry-upgrade"><?php esc_html_e( 'Edit', 'easy-facebook-likebox' ); ?>
							<span class="dashicons dashicons-edit right"></span>
						</a>
						<a class="btn waves-effect efbl_copy_skin_id esf-modal-trigger  waves-light"
						   href="#efbl-free-masonry-upgrade"><?php esc_html_e( 'Copy Skin ID', 'easy-facebook-likebox' ); ?>
							<span class="dashicons dashicons-admin-page right"></span>
						</a>
					</div>
				</div>
			</div>

			<div class="card col efbl_single_skin efbl_single_skin_free s3">
				<a class="skin_free_full esf-modal-trigger"
				   href="#efbl-free-carousel-upgrade"></a>
				<div class="card-image ">
					<a class=" esf-modal-trigger"
					   href="#efbl-free-carousel-upgrade"> <img class=""
																src="<?php echo EFBL_PLUGIN_URL; ?>admin/assets/images/carousel.jpg">
					</a>
				</div>
				<div class="card-content">
					<a class=" esf-modal-trigger"
					   href="#efbl-free-carousel-upgrade"> <span
								class="card-title  grey-text text-darken-4"><?php esc_html_e( 'Skin - Carousel layout', 'easy-facebook-likebox' ); ?>
					</a>
				</div>
				<div class="efbl_cta_holder">
					<select class="efbl_selected_account" required>
						<?php echo $efbl_page_options; ?>
					</select>
					<label><?php esc_html_e( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page.)', 'easy-facebook-likebox' ); ?></label>
					<div class="efbl-skin-actions-holder">
						<a class="btn  efbl_skin_redirect_free  esf-modal-trigger"
						   href="#efbl-free-carousel-upgrade"><?php esc_html_e( 'Edit', 'easy-facebook-likebox' ); ?>
							<span class="dashicons dashicons-edit right"></span></a>
						<a class="btn waves-effect efbl_copy_skin_id esf-modal-trigger  waves-light"
						   href="#efbl-free-carousel-upgrade">
							<?php esc_html_e( 'Copy Skin ID', 'easy-facebook-likebox' ); ?>
							<span class="dashicons dashicons-admin-page right"></span>
						</a>
					</div>
				</div>

			</div>


		<?php } ?>
	</div>
</div>
