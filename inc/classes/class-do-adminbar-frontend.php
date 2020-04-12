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
 * Maybe Remove Adminbar From Frontend
 */
final class Do_Adminbar_Frontend {
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

		if ( true === is_admin() ) {
			return;
		}

		$this->option_manager = $option_manager;

		add_action( 'init', array( $this, 'maybe_disable_adminbar' ) );
	}//end __construct()


	/**
	 * Maybe Init
	 */
	public function maybe_disable_adminbar() {
		$display_status = $this->option_manager->get_setting( 'frontend' );

		if ( true !== empty( $display_status ) && 'disable' === $display_status ) {
			$this->disable_adminbar();

			add_action( 'wp_before_admin_bar_render', array( $this, 'disable_menu_items' ) );
		}
	}//end maybe_disable_adminbar()


	/**
	 * Disable Frontend Adminbar
	 */
	private function disable_adminbar() {
		add_filter( 'show_admin_bar', '__return_false' );
	}//end disable_adminbar()


	/**
	 * Disable Adminbar Menu Items
	 */
	public function disable_menu_items() {
		global $wp_admin_bar;

		$wp_admin_bar->remove_menu( 'my-sites' );
		$wp_admin_bar->remove_menu( 'site-name' );
		$wp_admin_bar->remove_menu( 'my-account' );
		$wp_admin_bar->remove_menu( 'user-actions' );
		$wp_admin_bar->remove_menu( 'user-info' );
		$wp_admin_bar->remove_menu( 'edit-profile' );
		$wp_admin_bar->remove_menu( 'logout' );
		$wp_admin_bar->remove_menu( 'updates' );
		$wp_admin_bar->remove_menu( 'new-content' );
		$wp_admin_bar->remove_menu( 'comments' );
		$wp_admin_bar->remove_menu( 'search' );
		$wp_admin_bar->remove_menu( 'customize' );
		$wp_admin_bar->remove_menu( 'wp-logo' );
		$wp_admin_bar->remove_menu( 'wp-icon' );
	}//end disable_menu_items()
}//end class
