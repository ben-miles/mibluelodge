<?php
/**
 * Admin View: Tab - Authenticate
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$FTA = new Feed_Them_All();

$fta_settings = $FTA->fta_get_settings();

if ( isset( $_GET['access_token'] ) && ! empty( $_GET['access_token'] ) ) {
	$access_token = sanitize_text_field( $_GET['access_token'] );

	if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) { ?>

		<script>
		  jQuery(document).ready(function($) {

			function esfShowNotification(text, delay = 4000){

			  if(!text){

				text = fta.copied;
			  }

			  jQuery(".esf-notification-holder").html(' ').html(text).css('opacity', 1).animate({bottom: '0'});

			  setTimeout(function(){ jQuery(".esf-notification-holder").animate({bottom: '-=100%'}) }, delay);
			}

			function EFBLremoveURLParameter(url, parameter) {

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
			  else {
				return url;
			  }
			}

			/*
			* Show the dialog for Saving.
			*/
			esfShowNotification( 'Please wait! Authenticating...', 50000000 );

			var url = window.location.href;

			url = EFBLremoveURLParameter(url, 'access_token');

			url = EFBLremoveURLParameter(url, 'type');

			jQuery('#efbl_access_token').text('\'.$access_token.\'');

			var data = {
			  'action': 'efbl_save_fb_access_token',
			  'access_token': '<?php esc_html_e( $access_token ); ?>',
              'nonce' : '<?php echo wp_create_nonce( 'esf-ajax-nonce' ); ?>',
			};

			jQuery.ajax({

			  url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
			  type: 'post',
			  data: data,
			  dataType: 'json',
			  success: function(response) {
				window.history.pushState('newurl', 'newurl', url);
				 if (response.success) {
				  var pages_html = response.data['1'];
				  if (pages_html == null && response.data['4'] == 'page') {
					$('#fta-auth-error').addClass('open');
					return;
				  }

				  esfShowNotification( response.data['0'], 3000 );
				  jQuery('.efbl_all_pages').html(' ').html(response.data['1']);
				  jQuery('.fta_noti_holder').fadeOut('slow');

				}
				else {
				  esfShowNotification( response.data, 3000 );
				}
			  },
			});

		  });
		</script>
		<?php
	}
}

$app_ID = array( '468599428373231' );

$rand_app_ID = array_rand( $app_ID, '1' );

$u_app_ID = $app_ID[ $rand_app_ID ];

$authenticate_url = add_query_arg(
	array(
		'client_id'    => $u_app_ID,
		'redirect_uri' => 'https://maltathemes.com/efbl/app-' . $u_app_ID . '/index.php',
		'scope'        => 'pages_read_engagement,pages_read_user_content,business_management',
		'state'        => admin_url( 'admin.php?page=easy-facebook-likebox' ),
	),
	'https://www.facebook.com/dialog/oauth'
);

?>

<div id="efbl-authentication" class="col efbl_tab_c s12 slideLeft <?php echo esc_attr( $active_tab == 'efbl-authentication' ? 'active' : '' ); ?>">
	<h5><?php esc_html_e( "Let's connect your Facebook account with the plugin.", 'easy-facebook-likebox' ); ?></h5>
	<p><?php esc_html_e( 'Click the button below, log into your Facebook account and authorize the app to get access token.', 'easy-facebook-likebox' ); ?></p>
	<a class="efbl_authentication_btn btn"
	   href="<?php echo esc_url( $authenticate_url ); ?> "><img
				class="efb_icon left"
				src="<?php echo EFBL_PLUGIN_URL; ?>/admin/assets/images/facebook-icon.png"/><?php esc_html_e( 'Connect My Facebook Account', 'easy-facebook-likebox' ); ?>
	</a>
	<span class="efbl-or-placeholder"><?php esc_html_e( 'OR', 'easy-facebook-likebox' ); ?></span>
	<a class="efbl_authentication_btn btn efbl-connect-manually">
		<?php esc_html_e( 'Setup Manually', 'easy-facebook-likebox' ); ?>
	</a>
	<div class="row efbl-connect-manually-wrap">
		<form action="" method="get">
			<input type="hidden" name="page" value="easy-facebook-likebox">
			<div class="efbl-fields-wrap">
				<div class="input-field col s12 efbl_fields">
					<label for="efbl_access_token">
						<?php esc_html_e( 'Access Token', 'easy-facebook-likebox' ); ?>
						<a class="tooltip" target="_blank" href="https://easysocialfeed.com/custom-facebook-feed/page-token/">(?)</a>
					</label>
					<input id="efbl_access_token" name="access_token" required type="text">
				</div>
			</div>
			<input class="btn" value="<?php esc_html_e( 'Submit', 'easy-facebook-likebox' ); ?>" type="submit">
		</form>
	</div>
	<div class="row auth-row">
		<div class="efbl_all_pages col s12">
			<?php if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && ! empty( $fta_settings['plugins']['facebook']['approved_pages'] ) ) { ?>
				<ul class="collection with-header">
					<li class="collection-header">
						<h5><?php esc_html_e( 'Approved Page(s)', 'easy-facebook-likebox' ); ?>
						</h5>

						<a href="#fta-remove-at"
						   class="esf-modal-trigger fta-remove-at-btn tooltipped"
						   data-position="left" data-delay="50"
						   data-tooltip="<?php esc_html_e( 'Delete Access Token', 'easy-facebook-likebox' ); ?>">
							<span class="dashicons dashicons-trash"></span>
						</a>
					</li>

					<?php
					foreach ( $fta_settings['plugins']['facebook']['approved_pages'] as $efbl_page ) {

						if ( $efbl_page['id'] ) {
							if ( isset( $efbl_page['username'] ) ) {
								$efbl_username       = $efbl_page['username'];
								$efbl_username_label = __( 'Username:', 'easy-facebook-likebox' );
							} else {
								$efbl_username       = $efbl_page['id'];
								$efbl_username_label = __( 'ID:', 'easy-facebook-likebox' );

							}
							?>
							<li class="collection-item avatar li-<?php esc_attr_e( $efbl_page['id'] ); ?>">
								<a href="<?php echo esc_attr( esc_url( 'https://facebook.com/' . $efbl_page['id'] . '' ) ); ?>"
								   target="_blank">
									<img src="<?php echo  esc_attr( efbl_get_page_logo( $efbl_page['id'] ) ); ?>"
										 alt="" class="circle">
								</a>
								<div class="esf-bio-wrap">
								<?php if ( $efbl_page['name'] ) { ?>

									<span class="title"><?php esc_html_e( $efbl_page['name'] ); ?></span>

								<?php } ?>

								<p>
									<?php
									if ( $efbl_page['category'] ) {
										esc_html_e( $efbl_page['category'] );
									}
									?>
									<br>
									<?php
									if ( $efbl_username_label ) {
										esc_html_e( $efbl_username_label );
									}
									?>

									<?php
									if ( $efbl_username ) {
										esc_html_e( $efbl_username );
										?>

										<span class="dashicons dashicons-admin-page efbl_copy_id tooltipped"
										   data-position="right"
										   data-clipboard-text="<?php esc_attr_e( $efbl_username ); ?>"
										   data-delay="100"
										   data-tooltip="<?php esc_html_e( 'Copy', 'easy-facebook-likebox' ); ?>"></span>
									<?php } ?>
								</p>

								</div>

							</li>


							<?php
						}
					}
					?>

				</ul>
			<?php } ?>

		</div>
	</div>

	<p class="esf-notice"><?php esc_html_e( 'Please note: This does not give us permission to manage your Facebook pages or groups, it simply allows the plugin to see a list of the pages or groups you approved and retrieve an Access Token.', 'easy-facebook-likebox' ); ?></p>
</div>
