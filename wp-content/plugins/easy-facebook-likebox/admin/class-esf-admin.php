<?php
/*
* Stop execution if someone tried to get file directly.
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ESF_Admin' ) ) {

	class ESF_Admin {

		function __construct() {

			add_action(
				'admin_menu',
				array(
					$this,
					'esf_menu',
				)
			);

			add_action(
				'admin_head',
				array(
					$this,
					'esf_debug_token',
				)
			);

			add_action(
				'admin_enqueue_scripts',
				array(
					$this,
					'esf_admin_assets',
				)
			);

			add_action(
				'wp_ajax_esf_change_module_status',
				array(
					$this,
					'esf_change_module_status',
				)
			);

			add_action(
				'wp_ajax_esf_remove_access_token',
				array(
					$this,
					'esf_remove_access_token',
				)
			);

			add_action(
				'admin_notices',
				array(
					$this,
					'esf_admin_notice',
				)
			);

			add_action(
				'wp_ajax_esf_hide_rating_notice',
				array(
					$this,
					'esf_hide_rating_notice',
				)
			);

			add_action(
				'wp_ajax_esf_hide_row_notice',
				array(
					$this,
					'hide_row_notice',
				)
			);

			add_action(
				'wp_ajax_esf_hide_free_sidebar',
				array(
					$this,
					'hide_free_sidebar',
				)
			);

			add_action(
				'admin_head',
				array(
					$this,
					'esf_hide_notices',
				)
			);

			add_action(
				'admin_footer',
				array(
					$this,
					'add_affilates',
				)
			);

			add_action(
				'pre_get_posts',
				array(
					$this,
					'esf_exclude_demo_pages',
				),
				1
			);
		}

		public function esf_hide_notices() {

			$screen = get_current_screen();

			if ( $screen->base === 'admin_page_esf_welcome' ) {
				remove_all_actions( 'admin_notices' );
			}

			echo '<style>.toplevel_page_feed-them-all .wp-menu-image img{padding-top: 4px!important;}</style>';
		}

		/**
		 * Includes common admin scripts and styles for FB and Insta.
		 *
		 * @since 1.0.0
		 *
		 * @param $hook
		 */
		public function esf_admin_assets( $hook ) {
			// load plugin files only on it's pages
			if ( 'toplevel_page_feed-them-all' !== $hook
					&& 'easy-social-feed_page_mif' !== $hook
					&& 'easy-social-feed_page_easy-facebook-likebox' !== $hook
					&& 'admin_page_esf_welcome' !== $hook ) {
					return false;
			}

			wp_deregister_script( 'bootstrap.min' );
			wp_deregister_script( 'bootstrap' );
			wp_deregister_script( 'jquery-ui-tabs' );
			wp_enqueue_style(
				'esf-animations',
				FTA_PLUGIN_URL . 'admin/assets/css/esf-animations.css'
			);
			wp_enqueue_style(
				'esf-admin',
				FTA_PLUGIN_URL . 'admin/assets/css/esf-admin.css'
			);

			wp_enqueue_script( 'jquery-effects-slide' );
			wp_enqueue_script(
				'clipboard.min',
				FTA_PLUGIN_URL . 'admin/assets/js/clipboard.min.js',
				array(),
				false,
				true
			);
			wp_enqueue_script(
				'esf-admin',
				FTA_PLUGIN_URL . 'admin/assets/js/esf-admin.js',
				array( 'jquery' ),
				false,
				true
			);
			wp_localize_script(
				'esf-admin',
				'fta',
				array(
					'copied'   => __( 'Copied', 'easy-facebook-likebox' ),
					'deleting' => __( 'Deleting', 'easy-facebook-likebox' ),
					'error'    => __( 'Something went wrong!', 'easy-facebook-likebox' ),
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'nonce'    => wp_create_nonce( 'esf-ajax-nonce' ),
				)
			);
			wp_enqueue_script( 'thickbox' );
			wp_enqueue_style( 'thickbox' );
			wp_enqueue_script( 'media-upload' );
			wp_enqueue_script(
				'esf-image-uploader',
				FTA_PLUGIN_URL . 'admin/assets/js/esf-image-uploader.js',
				array(
					'jquery',
					'media-upload',
					'thickbox',
				),
				'1.0.0',
				true
			);
			wp_localize_script(
				'esf-image-uploader',
				'esf_image_uploader',
				array(
					'title'    => __( 'Select or Upload Image', 'easy-facebook-likebox' ),
					'btn_text' => __( 'Use this Image', 'easy-facebook-likebox' ),
				)
			);
			wp_enqueue_media();
			return false;
		}

		/**
		 * Add plugin menu
		 *
		 * @since 1.0.0
		 */
		public function esf_menu() {
			add_menu_page(
				__( 'Easy Social Feed', 'easy-facebook-likebox' ),
				__( 'Easy Social Feed', 'easy-facebook-likebox' ),
				'administrator',
				'feed-them-all',
				array(
					$this,
					'esf_page',
				),
				FTA_PLUGIN_URL . 'admin/assets/images/plugin_icon.png',
				25
			);

			add_submenu_page(
				null,
				__( 'Welcome', 'easy-facebook-likebox' ),
				__( 'Welcome', 'easy-facebook-likebox' ),
				'administrator',
				'esf_welcome',
				array(
					$this,
					'esf_welcome_page',
				)
			);

			$token_valid = $this->esf_access_token_valid();

			// If access token is inavlid show the notification counter
			if ( ! $token_valid['is_valid'] ) {
				global $menu;
				$menu_item = wp_list_filter( $menu, array( 2 => 'feed-them-all' ) );

				if ( ! empty( $menu_item ) ) {
					$menu_item_position              = key( $menu_item );
					$menu[ $menu_item_position ][0] .= ' <span class="awaiting-mod">1</span>';
				}
			}
		}

		/**
		 * Includes view of welcome page
		 *
		 * @since 1.0.0
		 */
		function esf_welcome_page() {
			include_once FTA_PLUGIN_DIR . 'admin/views/html-admin-page-wellcome.php';
		}

		/**
		 * Includes view of Easy Soical Feed page
		 *
		 * @since 1.0.0
		 */
		function esf_page() {
			include_once FTA_PLUGIN_DIR . 'admin/views/html-admin-page-easy-social-feed.php';
		}

		/**
		 * Changes the module status like enable or disable Facebook/Instagram modules
		 *
		 * @since 1.0.0
		 */
		function esf_change_module_status() {

			esf_check_ajax_referer();

			$module_name                                       = sanitize_text_field( $_POST['plugin'] );
			$module_status                                     = sanitize_text_field( $_POST['status'] );
			$Feed_Them_All                                     = new Feed_Them_All();
			$esf_settings                                      = $Feed_Them_All->fta_get_settings();
			$esf_settings['plugins'][ $module_name ]['status'] = $module_status;

			$status_updated = update_option( 'fta_settings', $esf_settings );

			if ( $module_status === 'activated' ) {
				$status = __( ' Activated', 'easy-facebook-likebox' );
			} else {
				$status = __( ' Deactivated', 'easy-facebook-likebox' );
			}

			if ( isset( $status_updated ) ) {
				wp_send_json_success(
					__( ucfirst( $module_name ) . $status . ' Successfully', 'easy-facebook-likebox' )
				);
			} else {
					wp_send_json_error( __( 'Something Went Wrong! Please try again.', 'easy-facebook-likebox' ) );
			}
		}

		/**
		 * Removes the access token and deletes users access to the app.
		 *
		 * @since 1.0.0
		 */
		function esf_remove_access_token() {

			esf_check_ajax_referer();

			$Feed_Them_All = new Feed_Them_All();
			$esf_settings  = $Feed_Them_All->fta_get_settings();

			$access_token = $esf_settings['plugins']['facebook']['access_token'];

			if ( isset( $esf_settings['plugins']['facebook']['approved_pages'] ) ) {
				unset( $esf_settings['plugins']['facebook']['approved_pages'] );
			}

			if ( isset( $esf_settings['plugins']['facebook']['approved_groups'] ) ) {
				unset( $esf_settings['plugins']['facebook']['approved_groups'] );
			}

			unset( $esf_settings['plugins']['facebook']['access_token'] );
			$esf_settings['plugins']['instagram']['selected_type'] = 'personal';
			$delted_data = update_option( 'fta_settings', $esf_settings );

			$response = wp_remote_request(
				'https://graph.facebook.com/v4.0/me/permissions?access_token=' . $access_token . '',
				array(
					'method' => 'DELETE',
				)
			);
			wp_remote_retrieve_body( $response );
			if ( $delted_data ) {
				wp_send_json_success( __( 'Deleted', 'easy-facebook-likebox' ) );
			} else {
				wp_send_json_error( __( 'Something Went Wrong! Please try again.', 'easy-facebook-likebox' ) );
			}
		}

		/**
		 * Displays the admin notices
		 *
		 * @since 1.0.0
		 *
		 * @throws \Exception
		 */
		public function esf_admin_notice() {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return false;
			}

			$Feed_Them_All = new Feed_Them_All();
			$install_date  = $Feed_Them_All->fta_get_settings( 'installDate' );
			$fta_settings  = $Feed_Them_All->fta_get_settings();
			$display_date  = date( 'Y-m-d h:i:s' );
			$datetime1     = new DateTime( $install_date );
			$datetime2     = new DateTime( $display_date );
			$diff_intrval  = round( ( $datetime2->format( 'U' ) - $datetime1->format( 'U' ) ) / ( 60 * 60 * 24 ) );
			if ( $diff_intrval >= 6 && get_site_option( 'fta_supported' ) !== 'yes' ) { ?>

				<div style="position:relative;padding-right:80px;background: #fff;" class="update-nag fta_msg fta_review">
					<p>
						<?php esc_html_e( 'Awesome, you have been using Easy Social Feed ', 'easy-facebook-likebox' ); ?>
						<?php esc_html_e( 'for more than a week. I would really appreciate it if you ', 'easy-facebook-likebox' ); ?>
						<b><?php esc_html_e( 'review and rate ', 'easy-facebook-likebox' ); ?></b>
						<?php esc_html_e( 'the plugin to help spread the word and ', 'easy-facebook-likebox' ); ?>
						<b><?php esc_html_e( 'encourage us to make it even better.', 'easy-facebook-likebox' ); ?></b>
					</p>
					<div class="fl_support_btns">
						<a href="https://wordpress.org/support/plugin/easy-facebook-likebox/reviews/?filter=5#new-post"
							class="esf_HideRating button button-primary"
							target="_blank">
							<?php esc_html_e( 'I Like Easy Social Feed - It increased engagement on my site', 'easy-facebook-likebox' ); ?>
						</a>
						<a href="javascript:void(0);"
							class="esf_HideRating button">
							<?php esc_html_e( 'I already rated it', 'easy-facebook-likebox' ); ?>
						</a>
						<br>
						<a style="margin-top:5px;float:left;"
							href="javascript:void(0);" class="esf_HideRating">
							<?php esc_html_e( 'No, not good enough, I do not like to rate it', 'easy-facebook-likebox' ); ?>
						</a>
						<div class="esf_HideRating" style="position:absolute;right:10px;cursor:pointer;top:4px;color: #029be4;">
							<div style="font-weight:bold;" class="dashicons dashicons-no-alt"></div>
							<span style="margin-left: 2px;">
								<?php esc_html_e( 'Dismiss', 'easy-facebook-likebox' ); ?>
							</span>
						</div>
					</div>
				</div>
				<script>
					jQuery('.esf_HideRating').click(function() {
					var data = {'action': 'esf_hide_rating_notice'};
						jQuery.ajax({
								url: "<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>",
								type: 'post',
								data: data,
								dataType: 'json',
								async: !0,
								success: function(e) {
								if(e === 'success'){
									jQuery('.fta_msg').slideUp('fast');
								}
								},
						});
						});
				</script>
				<?php
			}

			return false;
		}

		/**
		 * Hide rating notice permenately
		 *
		 * @since 1.0.0
		 */
		public function esf_hide_rating_notice() {
			update_site_option( 'fta_supported', 'yes' );
			echo wp_json_encode( array( 'success' ) );
			wp_die();
		}

		/**
		 * Hide row layout notice permenately
		 */
		public function hide_row_notice() {
			update_site_option( 'fta_row_layout_notice', 'yes' );
			echo wp_json_encode( array( 'success' ) );
			wp_die();
		}

		/**
		 * Hide sidebar for free users
		 *
		 * @since 6.2.3
		 */
		public function hide_free_sidebar() {

			esf_check_ajax_referer();

			$FTA                           = new Feed_Them_All();
			$fta_settings                  = $FTA->fta_get_settings();
			$id                            = sanitize_text_field( $_POST['id'] );
			$fta_settings[ 'hide_' . $id ] = true;
			$updated                       = update_option( 'fta_settings', $fta_settings );
			if ( isset( $updated ) && ! is_wp_error( $updated ) ) {
				wp_send_json_success( __( 'Updated!', 'easy-facebook-likebox' ) );
			} else {
				wp_send_json_error( __( 'Something went wrong! Please try again', 'easy-facebook-likebox' ) );
			}
		}


		/**
		 * Returns plugin install link
		 *
		 * @since 1.0.0
		 *
		 * @param $slug
		 *
		 * @return string
		 */
		function esf_get_plugin_install_link( $slug ) {
			$action       = 'install-plugin';
			$install_link = wp_nonce_url(
				add_query_arg(
					array(
						'action' => $action,
						'plugin' => $slug,
					),
					admin_url( 'update.php' )
				),
				$action . '_' . $slug
			);

			return $install_link;
		}

		/**
		 * Exclude demo pages from query
		 *
		 * @since 1.0.0
		 *
		 * @param $query
		 *
		 * @return mixed
		 */
		function esf_exclude_demo_pages( $query ) {
			if ( ! is_admin() ) {
				return $query;
			}
			global $pagenow;
			if ( 'edit.php' === $pagenow && ( get_query_var( 'post_type' ) && 'page' === get_query_var( 'post_type' ) ) ) {
				$fta_class    = new Feed_Them_All();
				$fta_settings = $fta_class->fta_get_settings();
				if ( isset( $fta_settings['plugins']['facebook']['default_page_id'] ) ) {
					$fb_id = $fta_settings['plugins']['facebook']['default_page_id'];
				}

				if ( isset( $fta_settings['plugins']['instagram']['default_page_id'] ) ) {
					$insta_id = $fta_settings['plugins']['instagram']['default_page_id'];
				}

				if ( $fb_id || $insta_id ) {
					$query->set( 'post__not_in', array( $fb_id, $insta_id ) );
				}
			}

			return $query;
		}

		/**
		 * Debug the token and save info in DB
		 */
		public function esf_debug_token() {

			if ( class_exists( 'Feed_Them_All' ) ) {

				$FTA = new Feed_Them_All();

				$fta_settings = $FTA->fta_get_settings();

				$access_token = '';

				$access_token_info = '';

				if ( isset( $fta_settings['plugins']['facebook']['access_token'] ) ) {

					$access_token = $fta_settings['plugins']['facebook']['access_token'];
				}

				if ( isset( $fta_settings['plugins']['facebook']['access_token_info'] ) ) {

					$access_token_info = $fta_settings['plugins']['facebook']['access_token_info'];
				}
			}

			if ( ! $access_token ) {
				return;
			}

			if ( $access_token_info ) {
				return;
			}

			/*
			 * Access token debug API endpoint
			 */
			$fb_token_debug_url = add_query_arg(
				array(
					'input_token'  => $access_token,
					'access_token' => $access_token,
				),
				'https://graph.facebook.com/v6.0/debug_token'
			);

			$fb_token_info = wp_remote_get( $fb_token_debug_url );

			if ( is_array( $fb_token_info ) && ! is_wp_error( $fb_token_info ) ) {

				$fb_token_info = json_decode( $fb_token_info['body'] );

				if ( isset( $fb_token_info->error ) ) {
					return;
				}

				if ( isset( $fb_token_info->data ) ) {

					$fta_settings['plugins']['facebook']['access_token_info']['data_access_expires_at'] = $fb_token_info->data->data_access_expires_at;

					$fta_settings['plugins']['facebook']['access_token_info']['expires_at'] = $fb_token_info->data->expires_at;

					$fta_settings['plugins']['facebook']['access_token_info']['is_valid'] = $fb_token_info->data->is_valid;

					$fta_settings['plugins']['facebook']['access_token_info']['issued_at'] = $fb_token_info->data->issued_at;

					$fta_settings['plugins']['facebook']['access_token_info']['app_id'] = $fb_token_info->data->app_id;

					update_option( 'fta_settings', $fta_settings );

					return;

				}
			}
		}

		/**
		 * Check the access token validity if exists.
		 *
		 * @return $return_arr and reason
		 */
		public function esf_access_token_valid() {

			if ( class_exists( 'Feed_Them_All' ) ) {

				$FTA = new Feed_Them_All();

				$fta_settings = $FTA->fta_get_settings();

				$access_token_info = '';

				if ( isset( $fta_settings['plugins']['facebook']['access_token_info'] ) ) {

					$access_token_info = $fta_settings['plugins']['facebook']['access_token_info'];

					$data_access_expires_at = $access_token_info['data_access_expires_at'];

					$expires_at = $access_token_info['expires_at'];

					$is_valid = $access_token_info['is_valid'];
				}
			}

			if ( ! $access_token_info ) {

				return array( 'is_valid' => true );
			}

			$return_arr = array( 'is_valid' => true );

			$current_timestamp = time();

			if ( $data_access_expires_at <= $current_timestamp ) {

				$return_arr = array(
					'is_valid'      => false,
					'reason'        => 'data_access_expired',
					'error_message' => __( 'Attention! Data access to the current access token is expired. Please re-authenticate the app.', 'easy-facebook-likebox' ),
				);

			}

			if ( ( $expires_at > 0 ) && ( $expires_at <= $current_timestamp ) ) {

				$return_arr = array(
					'is_valid'      => false,
					'reason'        => 'token_expired',
					'error_message' => __( 'Attention! Access token is expired. Please re-authenticate the app.', 'easy-facebook-likebox' ),
				);

			}

			return $return_arr;
		}

		public function mt_plugins_info() {

			$plugins = array();

			$plugins['floating-links'] = array(
				'name'            => 'Floating Links',
				'description'     => 'Displays social sharing icons along with fancy floating back to top and go to bottom links along with go to next post, previous post and random post links on post detail pages. Its tested and works with custom post types too. 
											Easy and free social media integration plugin to make your posts viral on the social network. It’s highly customisable, professional and responsive.',
				'active_installs' => '700+',

			);
			$plugins['wpoptin'] = array(
				'name'            => 'WPOptin',
				'description'     => 'The easiest and beginner friendly opt-in plugin to grow email subscribers list, sell more, get more phone calls, increase Facebook fan page likes and get more leads faster than ever.',
				'active_installs' => '200+',

			);
			$plugins['easy-tiktok-feed'] = array(
				'name'            => 'Easy TikTok Feed',
				'description'     => 'The easiest and beginner friendly TikTok feed plugin to display SEO friendly, responsive and highly customizeable videos from your TikTok account or Hashtag on your WordPress site. 
											A perfect way to monetise your TikTok videos on your website through Google Adsense and affiliates.',
				'active_installs' => 'Just Released',

			);

			return $plugins;
		}

		/**
		 * Get upgrade banner info from main site
		 * @return mixed|string[]
		 */
		public function esf_upgrade_banner() {

				$banner_info = array(
					'name'              => 'Easy Social Feed',
					'bold'              => 'PRO',
					'fb-description'    => 'Increase social followers, engage more users and get 10x traffic with 17% off on all plans (including monthly billings). So grab this offer now before it will go forever.',
					'insta-description' => 'Increase social followers, engage more users and get 10x traffic with 17% off on all plans (including monthly billings). So grab this offer now before it will go forever.',
					'discount-text'     => '',
					'coupon'            => 'ESPF17',
					'discount'          => '17%',
					'button-text'       => 'Upgrade Now',
					'button-url'        => efl_fs()->get_upgrade_url(),
					'target'            => '',
				);

				return $banner_info;
		}

		function mt_plugin_install_link( $slug ) {

			if ( ! is_plugin_active( $slug . '/' . $slug . '.php' ) ) {

				$esf_install_link = wp_nonce_url(
					add_query_arg(
						array(
							'action' => 'install-plugin',
							'plugin' => $slug,
						),
						admin_url( 'update.php' )
					),
					'install-plugin' . '_' . $slug
				);

			} else {

				$esf_install_link = '#';

			}

			return $esf_install_link;
		}

		/**
		 * Add affilate on the addons page
		 *
		 * @return false|void
		 */
		public function add_affilates() {
			$screen = get_current_screen();

			if ( $screen->id !== 'easy-social-feed_page_feed-them-all-addons' ) {
				return false;
			}
			?>
			<div class="esf-affilates-wrap" style="display: none;">
				<div class="esf-affilates">
					<div class="esf-affilates__logo">
						<img src="<?php echo FTA_PLUGIN_URL . 'admin/assets/images/accessibe-logo.svg'; ?>" alt="Affilates Logo">
					</div>
					<div class="esf-affilates__content">
						<h1 class="esf-affilates__title"><?php esc_html_e( 'Website Accessibility', 'easy-facebook-likebox' ); ?></h1>
						<p class="esf-affilates__desc"><?php esc_html_e( 'Fully automated web accessibility technology that complies with the WCAG 2.1 and keeps your website accessible at all times', 'easy-facebook-likebox' ); ?></p>
						<a class="button button-primary" href="https://accessibe.com/a/a2fxxop" target="_blank"><?php esc_html_e( 'Get it', 'easy-facebook-likebox' ); ?></a>
					</div>
				</div>
			</div>
			<script>
				jQuery(document).ready(function ($) {
					const html =  $('.esf-affilates-wrap').html();
					$('.easy-social-feed_page_feed-them-all-addons #poststuff').prepend(html);
				});
			</script>
			<style>
				.easy-social-feed_page_feed-them-all-addons #poststuff {
					display: flex;
				}
				.easy-social-feed_page_feed-them-all-addons .esf-affilates {
					max-width: 300px;
					padding: 20px;
					background-color: #fff;
					text-align: center;
					margin-top: 13px;
				}
				.easy-social-feed_page_feed-them-all-addons .esf-affilates .esf-affilates__title {
					font-weight: bold;
				}
				.easy-social-feed_page_feed-them-all-addons .esf-affilates .esf-affilates__logo,
				.easy-social-feed_page_feed-them-all-addons .esf-affilates .esf-affilates__title,
				.easy-social-feed_page_feed-them-all-addons .esf-affilates .esf-affilates__desc {
					padding-bottom: 20px;
					margin: 0;
				}
				.easy-social-feed_page_feed-them-all-addons .esf-affilates .esf-affilates__logo {
					max-width: 150px;
					float: none;
					margin: 0 auto;
				}
			</style>
			<?php
		}
	}

	new ESF_Admin();

}
