<?php
/**
 * Class Trait
 *
 * @package    WordPress
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace WpMyAdminBar;

if ( false === defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Form Validation
 */
trait Trait_Security_Check {
	/**
	 * Do Simple Security Checks
	 */
	final public function security_check() {
		$message = __( 'You are not authorized to perform this action.', 'wp-my-admin-bar' );

		if ( filter_input( INPUT_GET, 'page' ) !== WPMYADMINBAR_PLUGIN_NAME ) {
			/*
			 * Kill WordPress execution with message.
			 * https://developer.wordpress.org/reference/functions/wp_die/
			 */
			wp_die( esc_html( $message ) );
		}

		/*
		 * Whether the current user has a specific capability.
		 * https://developer.wordpress.org/reference/functions/current_user_can/
		 */
		if ( false === current_user_can( 'manage_options' ) ) {
			/*
			 * Kill WordPress execution and display message.
			 * https://developer.wordpress.org/reference/functions/wp_die/
			 */
			wp_die( esc_html( $message ) );
		}

		/*
		 * Makes sure that a user was referred from another admin page.
		 * https://developer.wordpress.org/reference/functions/check_admin_referer/
		 */
		if ( false === check_admin_referer(
			WPMYADMINBAR_SETTING_PREFIX . 'action',
			WPMYADMINBAR_SETTING_PREFIX . 'nonce'
		)
		) {
			/*
			 * Kill WordPress execution and display message.
			 * https://developer.wordpress.org/reference/functions/wp_die/
			*/
			wp_die( esc_html( $message ) );
		}
	}//end security_check()
}//end trait
