<?php
/**
 * WordPress Class
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
 * Plugin Activation
 */
final class Plugin_Activate {
	/**
	 * Validate Activation
	 */
	public static function init() {
		/*
		 * Retrieves the current WordPress version
		 * https://developer.wordpress.org/reference/functions/get_bloginfo/
		 */
		$wp_version = get_bloginfo( 'version' );

		if ( true === version_compare( $wp_version, 3.8, '<' ) ) {
			/*
			 * Kill WordPress execution and display HTML message with error message.
			 * https://developer.wordpress.org/reference/functions/wp_die/
			 *
			 * Escaping for HTML blocks.
			 * https://developer.wordpress.org/reference/functions/esc_html/
			 */
			wp_die( esc_html__( 'WordPress 3.8 is required. Please upgrade WordPress and try again.', 'wp-my-admin-bar' ) );
		}

		self::install();
	}//end init()

	/**
	 * Default Plugin Settings
	 */
	private static function settings() {
		return array(
			'frontend'     => 'enable',
			'backend'      => 'enable',
			'mysites'      => 'enable',
			'my_sites'     => 'disable',
			'siteids'      => 'enable',
			'wp_icon'      => 'enable',
			'site_link'    => 'enable',
			'site_name'    => 'disable',
			'my_account'   => 'enable',
			'user_actions' => 'enable',
			'user_info'    => 'enable',
			'edit_profile' => 'enable',
			'logout'       => 'enable',
			'wp_logo'      => 'enable',
			'updates'      => 'enable',
			'new_content'  => 'enable',
			'comments'     => 'enable',
			'search'       => 'enable',
			'customize'    => 'enable',
		);
	}

	/**
	 * Start Plugin Install
	 */
	private static function install() {
		if ( true === is_multisite() ) {
			/*
			 * Retrieve an option value for the current network based on name of option.
			 * https://developer.wordpress.org/reference/functions/get_site_option/
			 */
			$get_site_option = get_site_option( WPMYADMINBAR_PLUGIN_NAME );

			if ( true === empty( $get_site_option ) ) {
				/*
				 * Update the value of an option that was already added for the current network.
				 * https://developer.wordpress.org/reference/functions/update_site_option/
				 */
				update_site_option( WPMYADMINBAR_PLUGIN_NAME, self::settings() );
			}

			/*
			 * Whether the current request is for the network administrative interface.
			 * https://developer.wordpress.org/reference/functions/is_network_admin/
			 *
			 * Determines whether the current request is for an administrative interface page.
			 * https://developer.wordpress.org/reference/functions/is_admin/
			 */
			if ( true !== is_network_admin() && true === is_admin() ) {
				/*
				 * Retrieves an option value based on an option name.
				 * https://developer.wordpress.org/reference/functions/get_option/
				 */
				$get_option = get_option( WPMYADMINBAR_PLUGIN_NAME );

				if ( true === empty( $get_option ) ) {
					/*
					 * Update the value of an option that was already added.
					 * https://developer.wordpress.org/reference/functions/update_option/
					 */
					update_option( WPMYADMINBAR_PLUGIN_NAME, self::settings() );
				}
			}

			self::network_install();
		} else {
			/*
			 * Retrieves an option value based on an option name.
			 * https://developer.wordpress.org/reference/functions/get_option/
			 */
			$get_option = get_option( WPMYADMINBAR_PLUGIN_NAME );

			if ( true === empty( $get_option ) ) {
				/*
				 * Update the value of an option that was already added.
				 * https://developer.wordpress.org/reference/functions/update_option/
				 */
				update_option( WPMYADMINBAR_PLUGIN_NAME, self::settings() );
			}
		}
	}//end install()


	/**
	 * Maybe Upgade Robots.txt Manager Plugin
	 */
	private static function network_install() {
		/*
		 * Retrieves a list of sites matching requested arguments.
		 * https://developer.wordpress.org/reference/functions/get_sites/
		 */
		foreach ( get_sites() as $website ) {
			/*
			 * Switch the current blog.
			 * https://developer.wordpress.org/reference/functions/switch_to_blog/
			 */
			switch_to_blog( $website->blog_id );

			/*
			 * Retrieves an option value based on an option name.
			 * https://developer.wordpress.org/reference/functions/get_option/
			 */
			if ( false === get_option( WPMYADMINBAR_PLUGIN_NAME ) ) {
				/*
				 * Update the value of an option that was already added.
				 * https://developer.wordpress.org/reference/functions/update_option/
				 */
				update_option( WPMYADMINBAR_PLUGIN_NAME, self::settings() );
			}

			/*
			 * Restore the current blog, after calling switch_to_blog.
			 * https://developer.wordpress.org/reference/functions/restore_current_blog/
			 */
			restore_current_blog();
		}
	}//end network_install()
}//end class
