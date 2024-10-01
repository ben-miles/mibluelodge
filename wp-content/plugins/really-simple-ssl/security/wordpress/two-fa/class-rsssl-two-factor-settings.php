<?php
/**
 * Holds the request parameters for a specific action.
 * This class holds the request parameters for a specific action.
 * It is used to store the parameters and pass them to the functions.
 *
 * @package REALLY_SIMPLE_SSL
 */

namespace RSSSL\Security\WordPress\Two_Fa;

use WP_User;

/**
 * Class Rsssl_Two_Factor_Settings
 *
 * This class handles the settings for the Two-Factor Authentication plugin.
 */
class Rsssl_Two_Factor_Settings {
	/**
	 * The class instance.
	 *
	 * @var Rsssl_Two_Factor_Settings
	 */
	private static $instance;

	/**
	 * The forced roles for 2FA.
	 *
	 * @var array $forced_roles
	 */
	public static $forced_roles;

	/**
	 * The enabled roles for TOTP.
	 *
	 * @var $enabled_roles_totp
	 */
	public static $enabled_roles_totp;

	/**
	 * The forced roles for TOTP dynamically generated by logic.
	 *
	 * @var $forced_roles_totp
	 */
	public static $forced_roles_totp; // @codingStandardsIgnoreLine It is dynamically generated by logic.

	/**
	 * The enabled roles for Email dynamically generated by logic.
	 *
	 * @var $enabled_roles_totp
	 */
	public static $forced_roles_email; // @codingStandardsIgnoreLine It is dynamically generated by logic.

	/**
	 * The enabled roles for Email.
	 *
	 * @var array $enabled_roles_email
	 */
	public static $enabled_roles_email;

	/**
	 * If the previous roles variables are loaded or not.
	 *
	 * @var bool $roles_loaded
	 */
	private static $roles_loaded = false;

	/**
	 * The user meta enabled providers key.
	 *
	 * @type string
	 */
	const RSSSL_ENABLED_PROVIDERS_USER_META_KEY = 'rsssl_two_fa_providers';

	/**
	 * Class constructor.
	 *
	 * Checks if the class instance has already been initialized. If so, returns
	 * immediately. Otherwise, assigns the class instance to the static variable
	 * "self::$instance".
	 */
	public function __construct() {
		if ( isset( self::$instance ) ) {
			return;
		}

		self::$instance = $this;
	}


	/**
	 * Get user roles for a user, cross multisite.
	 *
	 * @param int $user_id //the user id to get the roles for.
	 *
	 * @return array
	 */
	public static function get_user_roles( int $user_id ): array {
		if ( is_multisite() ) {
            return array_values(self::get_strictest_role_across_sites($user_id, ['totp', 'email']));
		}

		$user  = get_userdata( $user_id );
		$roles = $user->roles;
		if ( ! is_array( $roles ) ) {
			$roles = array();
		}
		return $roles;
	}

	/**
	 * Generate a one-time login URL for a user.
	 *
	 * @param int  $user_id //the user ID.
	 * @param bool $disable_two_fa //whether to disable two-factor authentication.
	 *
	 * @return string //the generated URL.
	 */
	public static function rsssl_one_time_login_url( int $user_id, bool $disable_two_fa = false ): string {

		$token = bin2hex( openssl_random_pseudo_bytes( 16 ) ); // 16 bytes * 8 bits/byte = 128 bits.
		set_transient( 'skip_two_fa_token_' . $user_id, $token, 2 * MINUTE_IN_SECONDS );

		$obfuscated_user_id = self::obfuscate_user_id( $user_id );

		$nonce = wp_create_nonce( 'one_time_login_' . $user_id );

		$args = array(
			'rsssl_one_time_login' => $obfuscated_user_id,
			'token'                => $token,
			'_wpnonce'             => $nonce,
		);

		if ( $disable_two_fa ) {
			$args['rsssl_two_fa_disable'] = true;
		}

		// Return the URL with the added query arguments.
		return add_query_arg( $args, admin_url() );
	}


	/**
	 * Get the {method}_role_status. The role with the most weighing status will be returned. empty, optional or forded. Where forced is the most weighing.
	 *
	 * @param string $method //the method to check.
	 * @param int    $user_id //the user id to get the roles for.
	 *
	 * @return string
	 */
	public static function get_role_status( string $method, int $user_id ): string {
        if (is_multisite()) {
            $roles = self::get_strictest_role_across_sites($user_id, [$method]);
            $roles = array_values($roles); // Flatten the array to get the strictest role
        } else {
            $roles = self::get_user_roles($user_id);
        }

		$provider = 'email' === $method ? '_email' : '_' . self::sanitize_method( $method );

		// Check if the method is enabled.
		$enabled = rsssl_get_option( "two_fa_enabled_roles$provider" );

		$forced  = false;

		if ( ! $enabled ) {
			$return = 'empty';
		}

		// if the role is forced, return forced.
		if ( self::contains_role_of_type( $method, $roles, 'forced' ) ) {
			$return = 'forced';
			$forced = true;
		}
		// if the role is enabled, return optional.
		if ( self::contains_role_of_type( $method, $roles, 'enabled' ) && ! $forced ) {
			$return = 'optional';
		}

		if ( empty( $return ) ) {
			$return = 'empty';
		}

		return $return;
	}

	/**
	 * Get required 2fa action for a user.
	 *
	 * @param int|null $user_id //the user id to get the roles for.
	 * @return string //email, totp, onboarding or login
	 */
	public static function get_login_action( int $user_id = null ): string {
		if ( null === $user_id ) {
			$user_id = get_current_user_id();
		}

		$user = get_userdata( $user_id );

		$totp = Rsssl_Two_Factor_Totp::get_instance();

		if ( $totp::is_enabled( $user ) ) {
			// first, check TOTP.
			$user_status = self::get_user_status( 'totp', $user_id );
			$role_status = self::get_role_status( 'totp', $user_id );

			// if it's active, it's simple: the user should enter the code.
			if ( 'active' === $user_status ) {
				// Check the role status, in case the admin has disabled this for this role.
				if ( 'forced' === $role_status || 'optional' === $role_status ) {
					return 'totp';
				}
			}
			if ( 'open' === $user_status ) {
				// if the status is open, the user should get onboarding if the role status either forced or optional.
				if ( 'forced' === $role_status || 'optional' === $role_status ) {
					// The role is forced. So check if the grace period is over.
					$grace_period = self::is_user_in_grace_period( $user );

					if ( $grace_period > 0 &&  'forced' === $role_status ) {
						return 'onboarding';
					}

                    if ('optional' === $role_status) {
                        return 'onboarding';
                    }

                    return 'expired';
				}
				// if empty, nothing is currently activated for this role, so check if there's an email method enabled.
				return self::get_email_method_action( $user_id );
			}

			// Check if the role_status is not 'forced' currently. If so, show onboarding TODO: test this code below.
			$role_status = self::get_role_status( 'totp', $user_id );
			if ( 'forced' === $role_status && 'disabled' !== $user_status ) {
				return 'onboarding';
			}
		}

		return self::get_email_method_action( $user_id );
	}

	/**
	 * Get required action for the email 2fa method.
	 *
	 * @param int $user_id //the user id to get the roles for.
	 *
	 * @return string //email, onboarding or login
	 */
	public static function get_email_method_action( int $user_id ): string {
		$email = Rsssl_Two_Factor_Email::get_instance();
        $grace_period = self::is_user_in_grace_period( get_userdata( $user_id ) );
		$return = 'login';

		if ( $email::is_enabled( get_userdata( $user_id ) ) ) {

			$user_status = self::get_user_status( 'email', $user_id );
			$role_status = self::get_role_status( 'email', $user_id );

			if ( 'active' === $user_status ) {
				// Also check the role status, in case the admin has disabled this for this role.
				if ( 'forced' === $role_status || 'optional' === $role_status ) {
					$return = 'email';
				}
			}

			if ( 'open' === $user_status ) {
				// if the role status is forced or optional, we show onboarding.
				if ( 'forced' === $role_status || 'optional' === $role_status ) {

                    // The role is forced. So check if the grace period is over.
                    if ( $grace_period > 0 &&  'forced' === $role_status ) {
                        return 'onboarding';
                    }

                    if ('optional' === $role_status) {
                        return 'onboarding';
                    }

                    return 'expired';
				}
			}
		}

		// if we're here, the email method is not enabled, so we show login.
		return $return;
	}

	/**
	 * Validate if the role status and user status are valid.
	 *
	 * @param string $role_status // The role status to check.
	 * @param string $user_status // The user status to check.
	 *
	 * @return bool // Returns true if the role status and user status are valid, otherwise false.
	 */
	public static function is_role_and_user_status_valid( string $role_status, string $user_status ): bool {
		return ( 'forced' === $role_status || 'optional' === $role_status ) && ( 'active' === $user_status || 'open' === $user_status );
	}

	/**
	 * Get the status for a user, based on the method.
	 *
	 * @param string $method //the method to check.
	 * @param int    $user_id //the user id to get the roles for.
	 *
	 * @return string //open, active or disabled
	 */
	public static function get_user_status( string $method, int $user_id ): string {
		$method = 'email' === $method ? '' : '_' . self::sanitize_method( $method );

		// first check if a user meta rsssl_two_fa_status is set.
		$status = get_user_meta( $user_id, "rsssl_two_fa_status$method", true );

		return self::sanitize_status( $status );
	}

	/**
	 * Get the roles for a user, based on the method and type.
	 *
	 * @param string $method //the method to check.
	 * @param string $type //the type to check.
	 *
	 * @return array
	 */
	private static function get_dynamic_roles_variable( string $method, string $type ): array {
		// store these roles, as this function can be used in large loops.
		if ( ! self::$roles_loaded ) {
			// if the option is a boolean we convert it to an array.
			self::$enabled_roles_totp  = rsssl_get_option( 'two_fa_enabled_roles_totp', [] );
			self::$enabled_roles_email = rsssl_get_option( 'two_fa_enabled_roles_email', [] );
			self::$forced_roles        = rsssl_get_option( 'two_fa_forced_roles', [] );
			self::$roles_loaded        = true;
		}

		$method = 'email' === $method ? '_email' : '_' . self::sanitize_method( $method );
		$type   = 'enabled' === $type ? 'enabled' : 'forced';

		$name           = $type . '_roles' . $method;
		$roles_to_check = 'enabled_roles' . $method;

		// if the type is forced, use the forced roles.
		if ( 'forced' === $type ) {
			// Intersect the roles with the enabled roles.
			self::$$name = array_intersect( self::$forced_roles, self::$$roles_to_check );
			if ( property_exists( self::class, $name ) ) {
				$roles = self::$$name;
				if ( ! is_array( $roles ) ) {
					$roles = array();
				}
				return $roles;
			}
		}

		// if the type is enabled, use the enabled roles.
		if ( 'enabled' === $type ) {
			self::$$name = array_merge( self::$$roles_to_check );
			if ( property_exists( self::class, $name ) ) {
				$roles = self::$$name;
				if ( ! is_array( $roles ) ) {
					$roles = array();
				}
				return $roles;
			}
		}

		return array();
	}

	/**
	 * Check if the array of roles contains a role of type $type, forced or optional.
	 *
	 * @param string $method //the method to check.
	 * @param array  $roles //the roles to check.
	 * @param string $type //the type to check.
	 *
	 * @return bool
	 */
	public static function contains_role_of_type( string $method, array $roles, string $type ): bool {
		$roles_to_check = self::get_dynamic_roles_variable( $method, $type );
		foreach ( $roles as $role ) {
			if ( in_array( $role, $roles_to_check, true ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Check if a role is of a certain type, optional or forced
	 *
	 * @param string $method //the method to check.
	 * @param string $role //the role to check.
	 * @param string $type //the type to check.
	 *
	 * @return bool
	 */
	public static function role_is_of_type( string $method, string $role, string $type ): bool {
		return self::contains_role_of_type( $method, array( $role ), $type );
	}


	/**
	 * Get the user meta enabled providers key.
	 *
	 * @param string $status //the status to filter by.
	 *
	 * @return string //the user meta key.
	 */
	protected static function sanitize_status( string $status ): string {
		return in_array( $status, array( 'open', 'active', 'disabled' ), true ) ? $status : 'open';
	}

	/**
	 * Get the user meta enabled providers key.
	 *
	 * @param string $method //the method to sanitize.
	 *
	 * @return string
	 */
	public static function sanitize_method( string $method ): string {
		return in_array( $method, array( 'email', 'totp' ), true ) ? $method : 'email';
	}

	/**
	 * Check if a user is forced to use 2FA based on their roles.
	 *
	 * @param  int $user_id  // the ID of the user to check.
	 *
	 * @return bool // true if the user is forced to use 2FA, false otherwise.
	 */
	public static function is_user_forced_to_use_2fa( int $user_id ): bool {
		$roles        = self::get_user_roles( $user_id );
		$forced_roles = rsssl_get_option( 'two_fa_forced_roles', [] );
		foreach ( $roles as $role ) {
			if ( in_array( $role, $forced_roles, true ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Check if a user is in the grace period for two-factor authentication.
	 *
	 * @param  WP_User $user  The user to check.
	 *
	 * @return int|false The number of days remaining in the grace period, or false if the user is not in the grace period.
	 */
	public static function is_user_in_grace_period( WP_User $user ) {

		$grace_period = rsssl_get_option( 'two_fa_grace_period');

		// if the grace period is not set, return false.
		if ( ! self::is_user_forced_to_use_2fa( $user->ID ) ) {
			return false;
		}

		$last_login = get_user_meta( $user->ID, 'rsssl_two_fa_last_login', true );


		if ( $last_login ) {
			$last_login = strtotime( $last_login );
			$now        = time();
			$diff       = $now - $last_login;
			$days       = floor( $diff / ( 60 * 60 * 24 ) );

			if ( $days < $grace_period ) {
				$end_date = gmdate( 'Y-m-d', $last_login );
				// We add the grace period to the last login date.
				$end_date = date( 'Y-m-d', strtotime( $end_date . ' + ' . $grace_period . ' days' ) );
				$today = gmdate('Y-m-d', $now);
				// If the end date is today, return 1.
				if ($end_date === $today) {
					return 1;
				}

				return $grace_period - $days;
			}
			// it is now equal or greater, so return false.
			return false;
		}
		// if the last login is not set, return the grace period. but also set the user meta.
		update_user_meta( $user->ID, 'rsssl_two_fa_last_login', gmdate( 'Y-m-d H:i:s' ) );

		return $grace_period;
	}

	/**
	 * Get the enabled roles for a user.
	 *
	 * @param  int $user_id  // The ID of the user.
	 *
	 * @return array // The array of enabled roles for the user.
	 */
 	public static function get_enabled_roles( int $user_id ): array {
		$roles         = self::get_user_roles( $user_id );
        if(defined('rsssl_pro') && rsssl_pro ) {
            $totp          = rsssl_get_option( 'two_fa_enabled_roles_totp', [] );
        } else {
            $totp          = [];
        }

		$email         = rsssl_get_option( 'two_fa_enabled_roles_email', [] );
		$enabled_roles = array_merge( $totp, $email );
		return array_intersect( $roles, $enabled_roles );
	}

	/**
	 * Get the enabled roles for a user.
	 * This function is used to get the roles that are enabled for a user.
	 *
	 * @param int $user_id //the user ID to obfuscate.
	 *
	 * @return string
	 */
	public static function obfuscate_user_id( int $user_id ): string {
		// Convert the user ID to a string with some noise.
		$obfuscated = 'user-' . $user_id . '-id';
		// Encode the string using base64.
		return base64_encode( $obfuscated );
	}

	/**
	 * Deobfuscate the user ID for use in URL.
	 *
	 * @param string $data //the data to deobfuscate.
	 *
	 * @return string|null
	 */
	public static function deobfuscate_user_id( string $data ): ?string {
		// Decode from base64.
		$decoded = base64_decode( $data );
		// Remove the noise to get the user ID.
		if ( preg_match( '/user-(\d+)-id/', $decoded, $matches ) ) {
			return $matches[1];
		}

		return null;
	}

	/**
	 * Based on the roles enabled return the method for the current user.
	 * If both methods are enabled, return the string not set.
	 * If only one method is enabled, return that method as a string.
	 * If no method is enabled, return the string None.
	 *
	 * @param int $user_id //the user ID to get the roles for.
	 *
	 * @return string
	 */
	public static function get_enabled_method( int $user_id ): string {
		$user_id       = absint( $user_id ); // make sure an integer and not a float, negative value.
		$enabled_roles = self::get_enabled_roles( $user_id ) ?? array();
		$enabled_totp  = rsssl_get_option( 'two_fa_enabled_roles_totp', [] );
		$enabled_email = rsssl_get_option( 'two_fa_enabled_roles_email', [] );

		$totp  = array_intersect( $enabled_roles, $enabled_totp );
		$email = array_intersect( $enabled_roles, $enabled_email );

		if ( ! empty( $totp ) && ! empty( $email ) ) {
			$enabled_method = __( 'not set', 'really-simple-ssl' );
		}

		if ( ! empty( $totp ) ) {
			$enabled_method = __( 'Authenticator App', 'really-simple-ssl' );
		}

		if ( ! empty( $email ) ) {
			$enabled_method = __( 'Email', 'really-simple-ssl' );
		}

		if ( ! isset( $enabled_method ) ) {
			$enabled_method = __( 'None', 'really-simple-ssl' );
		}

		return $enabled_method;
	}

	/**
	 * Get the configured provider for a user based on their ID.
	 *
	 * @param int $user_id The ID of the user.
	 *
	 * @return string The configured provider.
	 */
	public static function get_configured_provider( int $user_id ): string {
		// With 2 providers, TOTP and Email we check both options and get the one that is not disabled.
		$totp_meta  = get_user_meta( $user_id, 'rsssl_two_fa_status_totp', true );
		$email_meta = get_user_meta( $user_id, 'rsssl_two_fa_status', true );
		$provider   = __( 'None', 'really-simple-ssl' );
		// if the status is active, return the method.
		if ( 'active' === $totp_meta ) {
			$provider = Rsssl_Two_Factor_Totp::NAME;
		}
		if ( 'active' === $email_meta ) {
			$provider = Rsssl_Two_Factor_Email::NAME;
		}
		return $provider;
	}

	/**
	 * Get the backup codes for a user.
	 *
	 * @param int $user_id // The user ID.
	 *
	 * @return array // An array of backup codes.
	 */
	public static function get_backup_codes( int $user_id ): array {
		$codes = get_transient( 'rsssl_two_factor_backup_codes_' . $user_id );
		if ( ! is_array( $codes ) ) {
			$codes = array();
		}
		return $codes;
	}

	/**
	 * Check if the last login date for a user is today.
	 *
	 * @param WP_User $user //the user.
	 *
	 * @return bool //true if last login date is today, false otherwise.
	 */
	public static function is_today( WP_User $user ): bool {
		return (1 === (int) self::is_user_in_grace_period( $user  ));
	}


    /**
     * Ensure that the default roles are first in the array
     *
     * @param array $roles
     *
     * @return array
     */
    protected static function sort_roles_by_default_first( array $roles ): array {
        $default_roles = array( 'administrator', 'editor', 'author', 'contributor', 'subscriber' );
        $sorted_roles  = array();
        foreach ( $default_roles as $default_role ) {
            if ( in_array( $default_role, $roles, true ) ) {
                $sorted_roles[] = $default_role;
            }
        }
        foreach ( $roles as $role ) {
            if ( ! in_array( $role, $sorted_roles, true ) ) {
                $sorted_roles[] = $role;
            }
        }
        return $sorted_roles;
    }

    /**
     * Get the strictest role across all sites for a given user
     *
     * @param int $user_id //the ID of the user.
     *
     * @return array|null //returns the strictest role or null if no roles found.
     */
    public static function get_strictest_role_across_sites(int $user_id, $methods ): ?array
    {
        $sites = get_sites();
        $all_roles = [];

        foreach ($sites as $site) {
            switch_to_blog($site->blog_id);
            $user = get_userdata($user_id);
            if ($user) {
                foreach($user->roles as $role){
                    $all_roles[] = $role;
                }
            }

            restore_current_blog();
        }
        $all_roles = array_unique($all_roles);

        return self::get_strictest_role($methods, $all_roles);
    }

    /**
     * Get the strictest role from a list of roles
     *
     * @param array $methods
     * @param array $roles // The list of roles
     *
     * @return array // The strictest role
     */
    protected static function get_strictest_role(array $methods, array $roles): array
    {
        $result = [];
        if (is_multisite()) {
            $roles = self::sort_roles_by_default_first($roles);
            $forced_roles = rsssl_get_option('two_fa_forced_roles', []);
            // if there are forced roles, prioritize them by removing all other roles
            if (!empty($forced_roles)) {
                $roles = array_intersect($roles, $forced_roles);
            }
        }

        foreach ($methods as $method) {
            // First, prioritize forced roles using the default-first sorting method
            if (self::contains_role_of_type($method, $roles, 'forced')) {
                foreach ($roles as $role) {
                    if (self::role_is_of_type($method, $role, 'forced')) {
                        // If forced role is found, assign it to the method and continue to the next method
                        $result[$method] = $role;
                        continue 2;
                    }
                }
            }

            // If no forced role, check for optional roles
            if (self::contains_role_of_type($method, $roles, 'enabled')) {
                foreach ($roles as $role) {
                    if (self::role_is_of_type($method, $role, 'enabled')) {
                        // If optional role is found, assign it to the method and continue to the next method
                        $result[$method] = $role;
                        continue 2;
                    }
                }
            }

            // If no role was found, assign an empty string
            $result[$method] = '';
        }
        //remove empty values
        return array_values(array_unique(array_filter($result)));
    }

    /**
     * Get the user status per method
     *
     * @param int $user_id // The ID of the user.
     *
     * @return array // The user status per method
     */
    public static function get_user_status_per_method(int $user_id): array
    {
        $methods = self::get_available_methods();
        $result = [];
        foreach ($methods as $method) {
            $result[$method] = self::get_user_status($method, $user_id);
        }
        return $result;
    }

    private static function get_available_methods(): array
    {
        if(defined('rsssl_pro') && !rsssl_pro ) {
            return ['totp', 'email'];
        }
        return ['email'];
    }
}

new Rsssl_Two_Factor_Settings();
