<?php
/**
 * Manager Class
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
 * Plugin Admin Area Notices
 */
final class Plugin_Admin_Notices {
	/**
	 * Notice Messages.
	 *
	 * @var array
	 */
	public $message = array();


	/**
	 * Set Class Params
	 *
	 * @return void
	 */
	public function __construct() {
		$this->notice = '';
	}//end __construct()


	/**
	 * Return Message Based On Key.
	 *
	 * @param string $message Message Key To Return.
	 */
	private function messages( $message = '' ) {
		$messages = array(
			'update_success'   => __(
				'Settings Saved.',
				'wp-my-admin-bar'
			),
			'update_error'     => __(
				'Settings Update Failed.',
				'wp-my-admin-bar'
			),
			'delete_success'   => __(
				'Plugin Settings Deleted.',
				'wp-my-admin-bar'
			),
			'upgraded_already' => __(
				'Plugin has already been upgraded.',
				'wp-my-admin-bar'
			),
			'upgrade_success'  => __(
				'Plugin upgraded.',
				'wp-my-admin-bar'
			),
		);

		if ( true !== empty( $messages[ $message ] ) ) {
			return $messages[ $message ];
		}
	}//end messages()


	/**
	 * Display Admin Notice
	 *
	 * @param string $type    Message Type (success|error).
	 * @param string $message Message Key To Get.
	 * @param string $network Set to network to use network_admin_notices.
	 */
	public function add_notice( $type = '', $message = '', $network = '' ) {
		if ( false === method_exists( $this, $type ) ) {
			return;
		}

		if ( true === empty( $message ) ) {
			return;
		}

		if ( true === empty( $this->messages( $message ) ) ) {
			return;
		}

		$admin_notice_type = 'admin_notices';

		if ( true !== empty( $network ) && 'network' === $network ) {
			$admin_notice_type = 'network_admin_notices';
		}

		// Set Notice Message.
		$this->notice = $this->messages( $message );

		/*
		 * Prints admin screen notices.
		 * https://developer.wordpress.org/reference/hooks/admin_notices/
		 */
		add_action(
			$admin_notice_type,
			array(
				$this,
				$type,
			)
		);
	}//end add_notice()


	/**
	 * Success Message HTML
	 */
	public function success() {
		if ( true === empty( $this->notice ) ) {
			return;
		}

		/*
		 * Sanitizes content for allowed HTML tags for post content.
		 * https://developer.wordpress.org/reference/functions/wp_kses_post/
		 */
		echo wp_kses_post( '<div class="notice notice-success is-dismissible"><p>' . $this->notice . '</p></div>' );
	}//end success()


	/**
	 * Error Message HTML
	 */
	public function error() {
		if ( true === empty( $this->notice ) ) {
			return;
		}

		/*
		 * Sanitizes content for allowed HTML tags for post content.
		 * https://developer.wordpress.org/reference/functions/wp_kses_post/
		 */
		echo wp_kses_post( '<div class="notice notice-error is-dismissible"><p>' . $this->notice . '</p></div>' );
	}//end error()
}//end class
