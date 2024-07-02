<?php
/*
* Stop execution if someone tried to get file directly.
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
* Returns the Instagram API type to get data
*/
if ( ! function_exists( 'esf_insta_instagram_type' ) ) :

	function esf_insta_instagram_type() {

		$mif_personal_connected_accounts = 'personal';

		/*
		*  Getting the Plugin main object.
		*/
		$Feed_Them_All = new Feed_Them_All();

		/*
		*  Getting the FTA Plugin settings.
		*/
		$fta_settings = $Feed_Them_All->fta_get_settings();

		if ( isset( $fta_settings['plugins']['instagram']['selected_type'] ) ) {
			$mif_personal_connected_accounts = $fta_settings['plugins']['instagram']['selected_type'];
		} else {

			if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && ! empty( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {
				$mif_has_business_insta = false;

				$approved_pages = $fta_settings['plugins']['facebook']['approved_pages'];

				if ( $approved_pages ) {
					foreach ( $approved_pages as $key => $approved_page ) :
						if ( array_key_exists( 'instagram_connected_account', $approved_page ) ) {
							$mif_has_business_insta = true;
						}
					endforeach;
				}

				if ( $mif_has_business_insta ) {
					$mif_personal_connected_accounts = 'business';
				}
			}
		}

		return $mif_personal_connected_accounts;
	}

endif;

/*
* Returns the personal Instagram accounts
*/
if ( ! function_exists( 'esf_insta_personal_account' ) ) :

	function esf_insta_personal_account() {

		$mif_personal_connected_accounts = '';

		/*
		*  Getting the Plugin main object.
		*/
		$Feed_Them_All = new Feed_Them_All();

		/*
		*  Getting the FTA Plugin settings.
		*/
		$fta_settings = $Feed_Them_All->fta_get_settings();

		if ( isset( $fta_settings['plugins']['instagram']['instagram_connected_account'] ) && ! empty( $fta_settings['plugins']['instagram']['instagram_connected_account'] ) ) {
			$mif_personal_connected_accounts = $fta_settings['plugins']['instagram']['instagram_connected_account'];
		}

		return $mif_personal_connected_accounts;
	}
endif;

/*
* Return Default account ID
*/
if ( ! function_exists( 'esf_insta_default_id' ) ) {

	function esf_insta_default_id() {

		$mif_default_id = '';

		/*
		 *  Getting the Plugin main object.
		 */
		$Feed_Them_All = new Feed_Them_All();

		/*
		*  Getting the FTA Plugin settings.
		*/
		$fta_settings = $Feed_Them_All->fta_get_settings();

		$mif_instagram_type = esf_insta_instagram_type();

		$mif_personal_account = esf_insta_personal_account();

		if ( isset( $mif_instagram_type ) && $mif_instagram_type == 'personal' && $mif_personal_account ) {

			foreach ( $mif_personal_account as $personal_id => $mif_personal_connected_account ) {

				$mif_default_id = $personal_id;
			}
		} else {

			$mif_business_accounts = array_reverse( esf_insta_business_accounts() );
			if ( $mif_business_accounts ) {
				foreach ( $mif_business_accounts as $mif_insta_single_account ) {

					$mif_default_id = $mif_insta_single_account->id;

				}
			}
		}

		return $mif_default_id;
	}
}

if ( ! function_exists( 'esf_insta_demo_page_id' ) ) {
	/**
	 * Get Customizer demo page ID
	 *
	 * @return mixed|string
	 * @since 6.2.0
	 */
	function esf_insta_demo_page_id() {

		$demo_page_id = '';

		$FTA = new Feed_Them_All();

		$fta_settings = $FTA->fta_get_settings();

		if ( isset( $fta_settings['plugins']['instagram']['default_page_id'] ) && ! empty( $fta_settings['plugins']['instagram']['default_page_id'] ) ) {

			$demo_page_id = $fta_settings['plugins']['instagram']['default_page_id'];
		}

		return $demo_page_id;
	}
}

/*
* Return the business accounts
*/
if ( ! function_exists( 'esf_insta_business_accounts' ) ) {

	function esf_insta_business_accounts() {

		$mif_insta_business_accounts = array();

		/*
		*  Getting the Plugin main object.
		*/
		$Feed_Them_All = new Feed_Them_All();

		/*
		*  Getting the FTA Plugin settings.
		*/
		$fta_settings = $Feed_Them_All->fta_get_settings();

		$authenticated_accounts = $fta_settings['plugins']['facebook'];

		if ( isset( $authenticated_accounts['approved_pages'] ) && ! empty( $authenticated_accounts['approved_pages'] ) ) {
			$mif_business_accounts = $authenticated_accounts['approved_pages'];

			if ( $mif_business_accounts ) {
				foreach ( $mif_business_accounts as $key => $mif_business_account ) {

					if ( isset( $mif_business_account['instagram_connected_account'] ) && isset( $mif_business_account['instagram_connected_account']->id ) ) {

						$mif_insta_business_accounts[ $key ] = $mif_business_account['instagram_connected_account'];

					}
				}
			}
		}

		return $mif_insta_business_accounts;
	}
}

/*
* Return the default business Instagram accounts
*/
if ( ! function_exists( 'esf_insta_default_business_id' ) ) {

	function esf_insta_default_business_id() {

		/*
		*  Getting the Plugin main object.
		*/
		$Feed_Them_All = new Feed_Them_All();

		/*
		*  Getting the FTA Plugin settings.
		*/
		$fta_settings = $Feed_Them_All->fta_get_settings();

		$authenticated_accounts = $fta_settings['plugins']['facebook'];

		if ( isset( $authenticated_accounts['approved_pages'] ) && ! empty( $authenticated_accounts['approved_pages'] ) ) {

			$approved_pages = $authenticated_accounts['approved_pages'];

			if ( isset( $approved_pages[ array_keys( $approved_pages )['0'] ]['instagram_accounts']->connected_instagram_account->id ) ) :

				$mif_business_user_id = $approved_pages[ array_keys( $approved_pages )['0'] ]['instagram_accounts']->connected_instagram_account->id;

			endif;
		}

		return $mif_business_user_id;
	}
}

if ( ! function_exists( 'esf_insta_readable_count' ) ) {

	function esf_insta_readable_count( $number ) {

		$number = number_format( $number );

		$number_count = substr_count( $number, ',' );

		if ( $number_count != '0' ) {

			if ( $number_count == '1' ) {

				return substr( $number, 0, - 4 ) . __( 'K', 'easy-facebook-likebox' );

			} elseif ( $number_count == '2' ) {

				return substr( $number, 0, - 8 ) . __( 'M', 'easy-facebook-likebox' );

			} elseif ( $number_count == '3' ) {

				return substr( $number, 0, - 12 ) . __( 'B', 'easy-facebook-likebox' );

			} else {

				return;
			}
		} else {
			return $number;
		}
	}
}

if ( ! function_exists( 'esf_insta_readable_time' ) ) {
	function esf_insta_readable_time( $date, $granularity = 2 ) {
		$retval            = '';
		$date_time_strings = array(
			'second'  => __( 'second', 'easy-facebook-likebox' ),
			'seconds' => __( 'seconds', 'easy-facebook-likebox' ),
			'minute'  => __( 'minute', 'easy-facebook-likebox' ),
			'minutes' => __( 'minutes', 'easy-facebook-likebox' ),
			'hour'    => __( 'hour', 'easy-facebook-likebox' ),
			'hours'   => __( 'hours', 'easy-facebook-likebox' ),
			'day'     => __( 'day', 'easy-facebook-likebox' ),
			'days'    => __( 'days', 'easy-facebook-likebox' ),
			'week'    => __( 'week', 'easy-facebook-likebox' ),
			'weeks'   => __( 'weeks', 'easy-facebook-likebox' ),
			'month'   => __( 'month', 'easy-facebook-likebox' ),
			'months'  => __( 'months', 'easy-facebook-likebox' ),
			'year'    => __( 'year', 'easy-facebook-likebox' ),
			'years'   => __( 'years', 'easy-facebook-likebox' ),
			'decade'  => __( 'decade', 'easy-facebook-likebox' ),
		);

		$ago_text = __( 'ago', 'easy-facebook-likebox' );

		$date = strtotime( $date );

		$difference = time() - $date;

		$periods = array(
			'decade' => 315360000,
			'year'   => 31536000,
			'month'  => 2628000,
			'week'   => 604800,
			'day'    => 86400,
			'hour'   => 3600,
			'minute' => 60,
			'second' => 1,
		);

		foreach ( $periods as $key => $value ) {

			if ( $difference >= $value ) {
				$time        = floor( $difference / $value );
				$difference %= $value;
				$retval     .= ( $retval ? ' ' : '' ) . $time . ' ';
				$retval     .= ( ( $time > 1 ) ? $date_time_strings[ $key . 's' ] : $date_time_strings[ $key ] );
				$granularity --;
			}
			if ( $granularity == '0' ) {
				break;
			}
		}

		return '' . $retval . ' ' . $ago_text;
	}
}
if ( ! function_exists( 'esf_insta_convert_to_hashtag' ) ) {
	function esf_insta_convert_to_hashtag( $content ) {

		$regex = '/#+([a-zA-Z0-9_]+)/';

		$content = preg_replace( $regex, '<a target="_blank" href="https://www.instagram.com/explore/tags/$1">$0</a>', $content );

		return ( $content );
	}
}

if ( ! function_exists( 'esf_insta_makeClickableLinks' ) ) {
	function esf_insta_makeClickableLinks(
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

if ( ! function_exists( 'esf_insta_get_cache_seconds' ) ) {

	/**
	 * Convert cache time span into seconds
	 * @param $instance
	 *
	 * @since 6.1.0
	 *
	 * @return false|float|int
	 */
	function esf_insta_get_cache_seconds( $instance ) {

		if ( ! isset( $instance ) && ! is_array( $instance ) ) {
			return false;
		}

		if ( ! isset( $instance['cache_unit'] ) || $instance['cache_unit'] < 1 ) {
			$cache_unit = 1;
		}
		//Calculate the cache time in seconds
		if ( $instance['cache_duration'] == 'minutes' ) {
			$cache_duration = 60;
		}
		if ( $instance['cache_duration'] == 'hours' ) {
			$cache_duration = 60 * 60;
		}
		if ( $instance['cache_duration'] == 'days' ) {
			$cache_duration = 60 * 60 * 24;
		}

		$cache_seconds = $cache_duration * $instance['cache_unit'];

		return $cache_seconds;
	}
}

if ( ! function_exists( 'esf_insta_has_connected_account' ) ) {

	/**
	 * Check if any Instagram account is connected
	 *
	 * @since 6.2.2
	 *
	 * @return bool
	 */
	function esf_insta_has_connected_account() {

		$FTA = new Feed_Them_All();

		$fta_settings = $FTA->fta_get_settings();

		$instagram_account_connected = null;

		if ( isset( $fta_settings['plugins']['instagram']['instagram_connected_account'] ) ) {

			$mif_personal_connected_accounts = $fta_settings['plugins']['instagram']['instagram_connected_account'];

		} else {

			$mif_personal_connected_accounts = array();

		}

		if ( $mif_personal_connected_accounts && esf_insta_instagram_type() == 'personal' ) {
			return true;
		}

		if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && ! empty( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {

			$instagram_account_connected = false;

			foreach ( $fta_settings['plugins']['facebook']['approved_pages'] as $efbl_page ) {
				if ( isset( $efbl_page['instagram_connected_account'] ) ) {
					$instagram_account_connected = true;
				}
			}
		}
		return $instagram_account_connected;
	}
}

if ( ! function_exists( 'esf_insta_get_logo' ) ) {

	/**
	 * Get Instagram Logo
	 *
	 * @since 6.3.7
	 *
	 * @param null $id
	 * @param null $page_id
	 *
	 * @return false|string|void
	 */
	function esf_insta_get_logo( $id = null, $page_id = null ) {

		if ( $id ) {

			$page_logo_trasneint_name = 'esf_insta_logo_' . $id;

			$auth_img_src = get_transient( $page_logo_trasneint_name );

			$check_status = wp_remote_retrieve_body( wp_remote_get( $auth_img_src ) );

			if ( $check_status == 'URL signature expired' ) {
				$auth_img_src = '';
			}

			if ( $auth_img_src && ! empty( $auth_img_src ) && ! isset( $auth_img_src->error ) ) {
				return $auth_img_src;
			} else {

				$FTA = new Feed_Them_All();

				$fta_settings = $FTA->fta_get_settings();

				if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) || isset( $fta_settings['plugins']['facebook']['approved_groups'] ) ) {

					$pages = $fta_settings['plugins']['facebook']['approved_pages'];

					if ( ! $page_id ) {
						$page_id = esf_insta_get_page_id( $id );
					} else {
						$page_id = false;
					}

					if ( isset( $pages[ $page_id ] ) ) {
						$page_exists = $pages[ $page_id ];
					} else {
						$page_exists = '';
					}

					if ( $page_exists ) {

						$accesstoken = $pages[ $page_id ]['access_token'];

					} else {

						$accesstoken = $fta_settings['plugins']['facebook']['access_token'];
					}

					$auth_img_src = 'https://graph.facebook.com/' . $id . '?fields=profile_picture_url&access_token=' . $accesstoken;

					$auth_img_src = json_decode( jws_fetchUrl( $auth_img_src ) );

					if ( isset( $auth_img_src->profile_picture_url ) && ! isset( $auth_img_src->error ) ) {

						$auth_img_src = $auth_img_src->profile_picture_url;

						$auth_img_src = esf_serve_media_locally( $id, $auth_img_src, 'instagram' );
						//Store in a transient for 1 month
						set_transient( $page_logo_trasneint_name, $auth_img_src, 30 * 60 * 60 * 24 );

						return $auth_img_src;
					}
				}
			}
		} else {

			return false;
		}

	}
}

if ( ! function_exists( 'esf_insta_get_page_id' ) ) {

	/**
	 * Get Page ID by instagram account ID
	 *
	 * @since 6.3.7
	 *
	 * @param null $id
	 *
	 * @return false|int|string
	 */
	function esf_insta_get_page_id( $id = null ) {

		if ( $id ) {

			$FTA          = new Feed_Them_All();
			$fta_settings = $FTA->fta_get_settings();
			$page_id      = false;

			if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) || isset( $fta_settings['plugins']['facebook']['approved_groups'] ) ) {
				$pages = $fta_settings['plugins']['facebook']['approved_pages'];
				if ( $pages ) {
					foreach ( $pages as $key => $page ) {
						if ( isset( $page['instagram_connected_account']->id ) && $page['instagram_connected_account']->id == $id ) {
							$page_id = $key;
						}
					}
				}
			}

			return $page_id;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'esf_insta_get_shoppable_settings' ) ) {

	/**
	 * Get shoppable setting if enabled
	 *
	 * @param null $user_id
	 * @param null $story_id
	 *
	 * @since 6.3.7
	 *
	 * @return array
	 */
	function esf_insta_get_shoppable_settings( $user_id = null, $story_id = null ) {

		$settings = array();

		if( ! $user_id && ! $story_id ) {
			return $settings;
		}

		$FTA = new Feed_Them_All();

		$fta_settings = $FTA->fta_get_settings();
		$insta = $fta_settings['plugins']['instagram'];

		// Check if shoppable is enabled
		if ( isset( $insta['shoppable'][$user_id] ) && !empty( $insta['shoppable'][$user_id] ) ) {
			$setting = $insta['shoppable'][$user_id];

			// Get story related settings
			if( isset( $setting[$story_id]['source'] ) && !empty( $setting[$story_id]['source'] ) ) {
				$source = $setting[$story_id]['source'];
				$settings['source'] = $source;
				if( $source == 'custom' ) {
					$settings['permalink'] = $setting[$story_id]['custom_url'];
				} else {
					if( $source !== 'caption' ) {
						$cpt_id = $setting[$story_id]['cpt_id'];
						if( $cpt_id ) {
							$settings['permalink'] = get_permalink( $cpt_id );
						}
					}
				}
			}

			if( isset( $source ) && $source !== 'caption' ) {
				// Get global settings
				$settings['link_text'] = $setting['global']['link_text'];
				$settings['click_behaviour'] = $setting['global']['click_behaviour'];
			}

			// Get story settings
			if( isset( $setting[$story_id]['link_text'] ) && ! empty( $setting[$story_id]['link_text'] ) ) {
				$settings['link_text'] = $setting[$story_id]['link_text'];
			}

			if( isset( $setting[$story_id]['click_behaviour'] ) && ! empty( $setting[$story_id]['click_behaviour'] ) ) {
				$settings['click_behaviour'] = $setting[$story_id]['click_behaviour'];
			}
		}

		return $settings;
	}

}
