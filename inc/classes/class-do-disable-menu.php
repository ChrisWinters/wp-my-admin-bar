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
 * Maybe Disable An Adminbar Menu Item
 */
final class Do_Disable_Menu {
	/**
	 * Option Manager Class.
	 *
	 * @var object
	 */
	public $option_manager;


	/**
	 * Setup Class
	 *
	 * @param object $option_manager Settings Array Object.
	 */
	public function __construct( $option_manager = array() ) {
		if ( true === empty( $option_manager ) ) {
			return;
		}

		$this->option_manager = $option_manager;

		add_action( 'wp_before_admin_bar_render', array( $this, 'maybe_remove_menus' ) );
		add_action( 'wp_before_admin_bar_render', array( $this, 'maybe_remove_menu_items' ) );
	}//end __construct()


	/**
	 * Maybe Remove Menus
	 */
	public function maybe_remove_menus() {
		global $wp_admin_bar;

		if ( false === is_multisite() ) {
			$mysites_menu_status   = $this->option_manager->get_setting( 'mysites' );
			$site_name_menu_status = $this->option_manager->get_setting( 'site_name' );

			if ( ( true !== empty( $mysites_menu_status ) && 'disable' === $mysites_menu_status ) && ( true !== empty( $site_name_menu_status ) && 'disable' === $site_name_menu_status ) ) {
				$wp_admin_bar->remove_menu( 'site-name' );
			}
		} else {
			if ( true === is_network_admin() ) {
				$site_name_menu_status = $this->option_manager->get_site_setting( 'site_name' );
			} else {
				$site_name_menu_status = $this->option_manager->get_setting( 'site_name' );
			}

			if ( true !== empty( $site_name_menu_status ) && 'disable' === $site_name_menu_status ) {
				$wp_admin_bar->remove_menu( 'site-name' );
			}
		}
	}//end maybe_remove_menus()


	/**
	 * Maybe Remove Menu Items
	 */
	public function maybe_remove_menu_items() {
		global $wp_admin_bar;

		foreach ( $this->setting_names_menu_slugs() as $setting_name => $menu_slug ) {
			if ( true === is_multisite() ) {
				if ( true === is_network_admin() ) {
					$display_status = $this->option_manager->get_site_setting( $setting_name );
				} else {
					$display_status = $this->option_manager->get_setting( $setting_name );
				}
			} else {
				$display_status = $this->option_manager->get_setting( $setting_name );
			}

			if ( true !== empty( $display_status ) && 'disable' === $display_status ) {
				$wp_admin_bar->remove_menu( $menu_slug );
			}
		}
	}//end maybe_remove_menu_items()


	/**
	 * Setting Name Keys & Menu Slug Values
	 */
	public function setting_names_menu_slugs() {
		return array(
			'my_account'   => 'my-account',
			'user_actions' => 'user-actions',
			'user_info'    => 'user-info',
			'edit_profile' => 'edit-profile',
			'logout'       => 'logout',
			'updates'      => 'updates',
			'new_content'  => 'new-content',
			'comments'     => 'comments',
			'search'       => 'search',
			'customize'    => 'customize',
			'wp_logo'      => 'wp-logo',
			'wp_icon'      => 'wp-icon',
		);
	}//end setting_names_menu_slugs()
}//end class
