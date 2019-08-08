<?php
/**
 * Public Facing Class Instances
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
 * Plugin Core
 */
final class WpMyAdminBar {
	/**
	 * Init Plugin
	 */
	public static function init() {
		// Get Plugin Settings.
		$option_manager = new \WpMyAdminBar\Option_Manager();

		// Disable WordPress Menus.
		$disable_menus = new \WpMyAdminBar\Do_Disable_Menu( $option_manager );

		/*
		 * If Multisite is enabled.
		 * https://developer.wordpress.org/reference/functions/is_multisite/
		 */
		if ( true === is_multisite() ) {
			/*
			 * Whether the current request is for the network administrative interface.
			 * https://developer.wordpress.org/reference/functions/is_network_admin/
			 */
			if ( true === is_network_admin() ) {
				// Network Facing.
				$my_sites_network = new \WpMyAdminBar\Do_Menu_My_Sites_Network( $option_manager );
			} else {
				// Website Facing.
				$my_sites_website = new \WpMyAdminBar\Do_Menu_My_Sites( $option_manager );
			}
		} else {
			// Website - No Network.
			$my_sites_menu = new \WpMyAdminBar\Do_Menu_Site_Name( $option_manager );
		}

		/*
		 * Determines whether the current request is for an administrative interface page.
		 * https://developer.wordpress.org/reference/functions/is_admin/
		 */
		if ( true !== is_admin() ) {
			// Maybe Remove Adminbar From Frontend.
			$adminbar_frontend = new \WpMyAdminBar\Do_Adminbar_Frontend( $option_manager );
		}

		/*
		 * Determines whether the current request is for an administrative interface page.
		 * https://developer.wordpress.org/reference/functions/is_admin/
		 */
		if ( true === is_admin() ) {
			// Loads Translated Strings.
			$translate = new \WpMyAdminBar\Translate();

			// Display Plugin Admin.
			$plugin_admin = new \WpMyAdminBar\Plugin_Admin();

			// Manage Admin Updates.
			$plugin_admin_post = new \WpMyAdminBar\Plugin_Admin_Post();
			$post_object       = $plugin_admin_post->get_post_object();

			// Save Plugin Settings.
			$do_save_settings = new \WpMyAdminBar\Do_Save_Settings( $post_object );
			$do_save_settings->init();

			// Maybe Remove Adminbar From Backend.
			$adminbar_backend = new \WpMyAdminBar\Do_Adminbar_Backend( $option_manager );
		}
	}
}
