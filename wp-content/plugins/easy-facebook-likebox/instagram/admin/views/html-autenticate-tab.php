<?php
/**
 * Admin View: Tab - Authenticate
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $fta_settings['plugins']['instagram']['instagram_connected_account'] ) ) {

	$mif_personal_connected_accounts = $fta_settings['plugins']['instagram']['instagram_connected_account'];

} else {

	$mif_personal_connected_accounts = array();

}
if ( ( isset( $_GET['access_token'] ) && ! empty( $_GET['access_token'] ) ) || ( isset( $_GET['mif_access_token'] ) && ! empty( $_GET['mif_access_token'] ) ) ) {

	if ( ! empty( $_GET['access_token'] ) ) {
		$access_token = sanitize_text_field( $_GET['access_token'] );
		$action       = 'mif_save_business_access_token';
		$remove_pram  = 'access_token';
	}

	if ( ! empty( $_GET['mif_access_token'] ) ) {
		$access_token = sanitize_text_field( $_GET['mif_access_token'] );
		$action       = 'mif_save_access_token';
		$remove_pram  = 'mif_access_token';
	}

	if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) { ?>

		<script>
			jQuery(document).ready(function() {
			function MIFremoveURLParameter(url, parameter) {
				var urlparts = url.split('?');
				if (urlparts.length >= 2) {
				var prefix = encodeURIComponent(parameter) + '=';
				var pars = urlparts[1].split(/[&;]/g);
				for (var i = pars.length; i-- > 0;) {
					if (pars[i].lastIndexOf(prefix, 0) !== -1) {
					pars.splice(i, 1);
					}
				}
				url = urlparts[0] + '?' + pars.join('&');
				return url;
				}
				else { return url; }
			}

			esfRemoveNotification();
			/*
			 * Show the dialog for Saving.
			 */
			esfShowNotification('Please wait! Authenticating...', 50000000);

			var url = window.location.href;

			url = MIFremoveURLParameter(url, "<?php echo $remove_pram; ?>");

			jQuery('#efbl_access_token').text("<?php echo $access_token; ?>");

			var data = {
				'action': '<?php echo esc_html( $action ); ?>',
				'access_token': '<?php echo esc_html( $access_token ); ?>',
				'id': 'insta',
				'nonce' : '<?php echo wp_create_nonce( 'esf-ajax-nonce' ); ?>',
			};

			jQuery.ajax({
				url: "<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>",
				type: 'post',
				data: data,
				dataType: 'json',
				success: function(response) {

				window.history.pushState('newurl', 'newurl', url);

				if (response.success) {

					var pages_html = response.data['1'];
					esfShowNotification(response.data['0'], 3000);
					jQuery('.efbl_all_pages').
						html(' ').
						html(response.data['1']).
						slideDown('slow');
					jQuery('.fta_noti_holder').fadeOut('slow');
				}
				else {
					esfShowNotification(response.data, 3000);
				}
				},
			});

			});
		</script>
		<?php
	}
}
?>
<div id="mif-general" class="mif_tab_c slideLeft <?php echo $active_tab == 'mif-general' ? 'active' : ''; ?>">
	<h5><?php esc_html_e( "Let's connect your account with plugin", 'easy-facebook-likebox' ); ?></h5>
	<p><?php esc_html_e( 'Click the button below, log into your Instagram account and authorize the app to get access token.', 'easy-facebook-likebox' ); ?></p>
	<a class="mif_auth_btn mif_auth_btn_st btn  esf-modal-trigger"
		href="#mif-authentication-modal">
		<img src="<?php echo ESF_INSTA_PLUGIN_URL; ?>/admin/assets/images/insta-logo.png"/><?php esc_html_e( 'Connect My Instagram Account', 'easy-facebook-likebox' ); ?>
	</a>
	<span class="mif-or-placeholder"><?php esc_html_e( 'OR', 'easy-facebook-likebox' ); ?></span>
	<a class="mif_auth_btn mif_auth_btn_st btn mif-connect-manually">
		<?php esc_html_e( 'Setup Manually', 'easy-facebook-likebox' ); ?>
	</a>
	<div class="row mif-connect-manually-wrap">
		<form action="" method="get">
			<div class="mif-fields-wrap">
				<input type="hidden" name="page" value="mif">
				<div class="input-field col s12 mif_fields">
					<label for="mif_access_token">
						<?php esc_html_e( 'Access Token', 'easy-facebook-likebox' ); ?>
						<a class="tooltip" target="_blank" href="https://easysocialfeed.com/custom-facebook-feed/page-token/">(?)</a>
					</label>
					<input id="mif_access_token" name="access_token" required type="text">
				</div>
			</div>
			<input class="btn" value="<?php esc_html_e( 'Submit', 'easy-facebook-likebox' ); ?>" type="submit">
		</form>
	</div>
	<div class="row auth-row">
			<div class="efbl_all_pages col s12 " 
			<?php
			if ( ! esf_insta_has_connected_account() ) {
				?>
				style="display: none;" <?php } ?>>

			<?php
			if ( $mif_personal_connected_accounts && esf_insta_instagram_type() == 'personal' ) {

				foreach ( $mif_personal_connected_accounts as $personal_id => $mif_personal_connected_account ) {
					?>

					<ul class="collection with-header">
						<li class="collection-header">
							<h5><?php esc_html_e( 'Connected Instagram Account', 'easy-facebook-likebox' ); ?></h5>
							<a href="#mif-remove-at"
								class="esf-modal-trigger fta-remove-at-btn tooltipped"
								data-type="personal" data-position="left"
								data-delay="50"
								data-tooltip="<?php esc_html_e( 'Delete Access Token', 'easy-facebook-likebox' ); ?>"><span class="dashicons dashicons-trash"></span></a>
						</li>
						<li class="collection-item li-<?php esc_attr_e( $personal_id ); ?>">
							<div class="esf-bio-wrap">
							<span class="title"><?php esc_html_e( $mif_personal_connected_account['username'] ); ?></span>

							<p><?php esc_html_e( 'ID', 'easy-facebook-likebox' ); ?>
								: <?php esc_html_e( $personal_id ); ?> <span
										class="dashicons dashicons-admin-page efbl_copy_id "
										data-clipboard-text="<?php esc_attr_e( $personal_id ); ?>"></span>
							</p>
							</div>
						</li>
					</ul>

					<?php
				}
			} elseif ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && ! empty( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {


				?>

					<ul class="collection with-header">
						<li class="collection-header">
							<h5><?php esc_html_e( 'Connected Instagram Account', 'easy-facebook-likebox' ); ?></h5>
							<a href="#fta-remove-at"
								class="esf-modal-trigger fta-remove-at-btn tooltipped"
								data-position="left" data-delay="50"
								data-tooltip="<?php esc_html_e( 'Delete Access Token', 'easy-facebook-likebox' ); ?>"><span class="dashicons dashicons-trash"></span></a>
						</li>

						<?php
						foreach ( $fta_settings['plugins']['facebook']['approved_pages'] as $efbl_page ) {

							if ( isset( $efbl_page['instagram_connected_account'] ) ) {

								$fta_insta_connected_account = $efbl_page['instagram_connected_account'];


								if ( isset( $fta_insta_connected_account->ig_id ) && ! empty( $fta_insta_connected_account->ig_id ) ) {
										$insta_id        = $fta_insta_connected_account->id;
										$page_id         = $efbl_page['id'];
										$profile_pic_url = esf_insta_get_logo( $insta_id, $page_id );

									if ( ! $profile_pic_url ) {
										$profile_pic_url = $fta_insta_connected_account->profile_picture_url;
									}
									?>

									<li class="collection-item avatar fta_insta_connected_account li-<?php esc_attr_e( $fta_insta_connected_account->ig_id ); ?>">

										<a href="https://www.instagram.com/<?php esc_attr_e( $fta_insta_connected_account->username ); ?>"
											target="_blank">
											<img src="<?php echo esc_url( $profile_pic_url ); ?>"
												alt="" class="circle">
										</a>
										<div class="esf-bio-wrap">
										<span class="title"><?php esc_html_e( $fta_insta_connected_account->name ); ?></span>
										<p><?php esc_html_e( $fta_insta_connected_account->username ); ?>
											<br> <?php esc_html_e( 'ID', 'easy-facebook-likebox' ); ?>
											: <?php esc_html_e( $fta_insta_connected_account->id ); ?>
											<span class="dashicons dashicons-admin-page efbl_copy_id tooltipped"
												data-position="right"
												data-clipboard-text="<?php esc_attr_e( $fta_insta_connected_account->id ); ?>"
												data-delay="100"
												data-tooltip="<?php esc_html_e( 'Copy', 'easy-facebook-likebox' ); ?>"></span>
										</p>
										</div>
									</li>
									<?php
								}
							}
						}
						?>
					</ul>

					<?php

			}
			?>

		</div>
	</div>

	<p class="mif-notice"><?php esc_html_e( 'Please note: This does not give us permission to manage your Instagram accounts, It simply allows the plugin to retrieve access token and show feeds to your website.', 'easy-facebook-likebox' ); ?></p>
</div>
<div id="mif-authentication-modal" class="mif-authentication-modal esf-modal fadeIn">
	<div class="modal-content">

		<div class="mif-modal-content">
			<h6><?php esc_html_e( 'Are you connecting a Personal or Business Instagram Profile?', 'easy-facebook-likebox' ); ?></h6>

			<div class="mif-auth-btn-holder">

				<input class="with-gap" name="mif_login_type"
						data-url="<?php echo esc_url( $personal_auth_url ); ?>"
						value="basic" type="radio" id="mif_basic_type" checked/>
				<label for="mif_basic_type"><?php esc_html_e( 'Personal', 'easy-facebook-likebox' ); ?></label>
				<a href="#" class="mif_info_link">
					<span class="dashicons dashicons-info-outline"></span>
				</a>
				<div class="mif_auth_info_holder">
					<p><?php esc_html_e( 'The "Personal" option can display feeds from personal Instagram account. It is limited to display only pictures, videos, username and caption.', 'easy-facebook-likebox' ); ?></p>
				</div>
			</div>
			<div class="mif-auth-btn-holder">
				<input class="with-gap" name="mif_login_type"
						data-url="<?php echo esc_url( $auth_url ); ?>" value="business"
						type="radio" id="mif_business_type"/>
				<label for="mif_business_type"><?php esc_html_e( 'Business', 'easy-facebook-likebox' ); ?></label>
				<a href="#" class="mif_info_link">
					<span class="dashicons dashicons-info-outline"></span>
				</a>
				<div class="mif_auth_info_holder">
					<p><?php esc_html_e( 'Used for displaying a user feed from a "Business" or "Creator" Instagram account. A Business or Creator account is required for displaying avatar,bio,comments and likes. See this ', 'easy-facebook-likebox' ); ?>
						<a href="<?php echo esc_url( 'https://easysocialfeed.com/documentation/how-to-connect-instagram-account-with-facebook-page/' ); ?>"
							target="_blank"> <?php esc_html_e( 'support guide', 'easy-facebook-likebox' ); ?> </a><?php esc_html_e( 'to convert personal account to business account.', 'easy-facebook-likebox' ); ?>
					</p>
				</div>
			</div>
			<a href="<?php echo esc_url( $personal_auth_url ); ?>"
				class=" btn mif-auth-modal-btn"><?php esc_html_e( 'Connect', 'easy-facebook-likebox' ); ?></a>

		</div>
	</div>

</div>
