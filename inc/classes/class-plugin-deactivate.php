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
 * Plugin Dectivation
 */
final class Plugin_Deactivate {
	/**
	 * Init Uninstall
	 */
	public static function init() {
		if ( true === is_multisite() ) {
			/*
			 * Removes a option by name for the current network.
			 * https://developer.wordpress.org/reference/functions/delete_site_option/
			 */
			delete_site_option( WPMYADMINBAR_PLUGIN_NAME );

			self::network_uninstall();
		} else {
			/*
			 * Removes option by name. Prevents removal of protected WordPress options.
			 * https://developer.wordpress.org/reference/functions/delete_option/
			 */
			delete_option( WPMYADMINBAR_PLUGIN_NAME );
		}
	}//end init()


	/**
	 * Uninstall Network
	 */
	private static function network_uninstall() {
		global $wpdb;

		$site_list = $wpdb->get_results( "SELECT blog_id FROM $wpdb->blogs ORDER BY blog_id" );

		foreach ( $site_list as $site ) {
			/*
			 * Switch the current blog.
			 * https://developer.wordpress.org/reference/functions/switch_to_blog/
			 */
			switch_to_blog( $site->blog_id );

			/*
			 * Removes option by name. Prevents removal of protected WordPress options.
			 * https://developer.wordpress.org/reference/functions/delete_option/
			 */
			delete_option( WPMYADMINBAR_PLUGIN_NAME );

			/*
			 * Restore the current blog, after calling switch_to_blog.
			 * https://developer.wordpress.org/reference/functions/restore_current_blog/
			 */
			restore_current_blog();
		}
	}//end network_uninstall()
}//end class
