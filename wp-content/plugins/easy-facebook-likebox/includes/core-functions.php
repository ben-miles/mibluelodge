<?php
/**
 * Define all the global functions for ESF modules
 */

/**
 * Check if elementor is active and in preview mode
 *
 * @since 6.3.0
 *
 * @return bool
 */
if ( ! function_exists( 'esf_is_elementor_preview' ) ) {
	function esf_is_elementor_preview() {
		if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Convert caption links to actual links
 *
 * @since 6.3.2
 *
 * @return $text
 */
if ( ! function_exists( 'esf_convert_to_hyperlinks' ) ) {
	function esf_convert_to_hyperlinks(
		$value, $protocols = array(
			'http',
			'mail',
			'https',
		), array $attributes = array()
	) {
		// Link attributes
		$attr = '';
		foreach ( $attributes as $key => $val ) {
			$attr .= ' ' . $key . '="' . htmlentities( $val ) . '"';
		}

		$links = array();

		// Extract existing links and tags
		$value = preg_replace_callback(
			'~(<a .*?>.*?</a>|<.*?>)~i',
			function ( $match ) use ( &$links ) {
				return '<' . array_push( $links, $match[1] ) . '>';
			},
			$value
		);

		// Extract text links for each protocol
		foreach ( (array) $protocols as $protocol ) {
			switch ( $protocol ) {
				case 'http':
				case 'https':
					$value = preg_replace_callback(
						'~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i',
						function ( $match ) use ( $protocol, &$links, $attr ) {
							if ( $match[1] ) {
								$protocol = $match[1];
							}
							$link = $match[2] ?: $match[3];

							return '<' . array_push( $links, "<a $attr href=\"$protocol://$link\">$link</a>" ) . '>';
						},
						$value
					);
					break;
				case 'mail':
					$value = preg_replace_callback(
						'~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~',
						function ( $match ) use ( &$links, $attr ) {
							return '<' . array_push( $links, "<a $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>" ) . '>';
						},
						$value
					);
					break;
				case 'twitter':
					$value = preg_replace_callback(
						'~(?<!\w)[@#](\w++)~',
						function ( $match ) use ( &$links, $attr ) {
							return '<' . array_push( $links, "<a $attr href=\"https://twitter.com/" . ( $match[0][0] == '@' ? '' : 'search/%23' ) . $match[1] . "\">{$match[0]}</a>" ) . '>';
						},
						$value
					);
					break;
				default:
					$value = preg_replace_callback(
						'~' . preg_quote( $protocol, '~' ) . '://([^\s<]+?)(?<![\.,:])~i',
						function ( $match ) use ( $protocol, &$links, $attr ) {
							return '<' . array_push( $links, "<a $attr href=\"$protocol://{$match[1]}\">{$match[1]}</a>" ) . '>';
						},
						$value
					);
					break;
			}
		}

		// Insert all link
		return preg_replace_callback(
			'/<(\d+)>/',
			function ( $match ) use ( &$links ) {
				return $links[ $match[1] - 1 ];
			},
			$value
		);
	}
}

if ( ! function_exists( 'jws_fetchUrl' ) ) {
	//Get JSON object of feed data
	function jws_fetchUrl( $url ) {

		$args     = array(
			'timeout'   => 150,
			'sslverify' => false,
		);
		$feedData = wp_remote_get( $url, $args );

		if ( $feedData && ! is_wp_error( $feedData ) ) {
			return $feedData['body'];
		} else {
			return $feedData;
		}
	}
}

if ( ! function_exists( 'esf_get_uploads_directory' ) ) {
	/**
	 * Return the modules uploads directory
	 *
	 * @param string $module
	 *
	 * @return string
	 *
	 * @since 6.4.4
	 */
	function esf_get_uploads_directory( $module = 'facebook' ) {
		$upload_dir = wp_upload_dir();
		$upload_dir = $upload_dir['basedir'];
		return $upload_dir . '/esf-' . esc_attr( $module );

	}
}
if ( ! function_exists( 'esf_serve_media_locally' ) ) {
	/**
	 * Save media locally
	 *
	 * @param        $id
	 * @param        $url
	 * @param string $module
	 *
	 * @return false|string|void
	 */
	function esf_serve_media_locally( $id, $url, $module = 'facebook' ) {

		if ( ! $id || ! $url ) {
			return false;
		}

		$directory = esf_get_uploads_directory( $module );
		$file      = $directory . '/' . esc_attr( $id ) . '.jpg';

		$upload_dir = wp_upload_dir();
		$upload_url = $upload_dir['baseurl'];
		$img_url   = $upload_url . '/esf-' . esc_attr( $module ) . '/' . esc_attr( $id ) . '.jpg';

		if ( ! file_exists( $file ) ) {
			$response = wp_remote_get( $url );

			if ( ! is_wp_error( $response ) ) {
				$image_data = wp_remote_retrieve_body( $response );
				$saved      = file_put_contents( $file, $image_data );

				if ( false === $saved ) {
					return false;
				} else {
					return $img_url;
				}
			}
		} else {
			return $img_url;
		}
	}
}

if ( ! function_exists( 'esf_delete_media' ) ) {
	/**
	 * Delete media locally
	 *
	 * @param        $id
	 * @param string $module
	 *
	 * @return bool
	 */
	function esf_delete_media( $id, $module = 'facebook' ) {
		if ( ! $id ) {
			return false;
		}

		$directory = esf_get_uploads_directory( $module );
		$file      = $directory . '/' . esc_attr( $id ) . '.jpg';

		if ( file_exists( $file ) ) {
			unlink( $file );
		} else {
			return false;
		}
	}
}
if ( ! function_exists( 'esf_delete_media_folder' ) ) {
	/**
	 * Delete media local folder
	 *
	 * @param        $id
	 * @param string $module
	 *
	 * @return bool
	 */
	function esf_delete_media_folder( $module = 'facebook' ) {
		$directory = esf_get_uploads_directory( $module );
		require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
		require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';
		$file_system_direct = new WP_Filesystem_Direct( false );
		$file_system_direct->rmdir( $directory, true );
	}
}

if ( ! function_exists( 'esf_sort_by_created_time' ) ) {
	/**
	 * Sort data to created_time
	 *
	 * @param null $data
	 *
	 * @return false|mixed
	 *
	 * @since 6.4.9
	 */
	function esf_sort_by_created_time( $data = null ) {

		if( ! $data ) {
			return false;
		}
		$order = array();
		foreach ( $data as $single_post ){
			$order[] = strtotime($single_post->created_time);
		}
		array_multisort($order, SORT_DESC, $data);
		return $data;
	}
}

if( ! function_exists( 'esf_check_ajax_referer' ) ) {
	/**
	 * Check ajax referer
	 *
	 * @since 6.5.0
	 */
	function esf_check_ajax_referer() {
		if ( ! check_ajax_referer( 'esf-ajax-nonce', 'nonce', false ) || ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( __( "Nonce not verified or you don't have appropriate permissions", "easy-facebook-likebox" ) );
		}

	}
}