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
 * Maybe Remove Adminbar From Backend
 */
final class Do_Adminbar_Backend {
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

		add_action( 'admin_init', array( $this, 'maybe_disable_adminbar' ) );
	}//end __construct()


	/**
	 * Maybe Init
	 */
	public function maybe_disable_adminbar() {
		if ( true !== is_admin() ) {
			return;
		}

		$display_status = $this->option_manager->get_setting( 'backend' );

		if ( true === is_multisite() ) {
			if ( true === is_network_admin() ) {
				$display_status = $this->option_manager->get_site_setting( 'backend' );
			}
		}

		if ( true !== empty( $display_status ) && 'disable' === $display_status ) {
			$this->disable_adminbar();

			add_action( 'wp_before_admin_bar_render', array( $this, 'disable_menu_items' ) );
		}
	}//end maybe_disable_adminbar()


	/**
	 * Disable Backend Adminbar
	 */
	private function disable_adminbar() {
		add_action( 'admin_enqueue_scripts', array( $this, 'deregister' ) );

		remove_action( 'init', '_wp_admin_bar_init' );
		remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 );
		remove_action( 'admin_footer', 'wp_admin_bar_render', 1000 );

		add_filter( 'admin_print_scripts', array( $this, 'styles' ) );
	}//end disable_adminbar()


	/**
	 * Deregister Adminbar Script & Style
	 */
	public function deregister() {
		wp_deregister_script( 'admin-bar' );
		wp_deregister_style( 'admin-bar' );
	}//end deregister()


	/**
	 * Inject Backend Adminbar Spacing
	 */
	public function styles() {
		echo '<style type="text/css">'
				. '#wpadminbar { display:none; }'
				. 'html.wp-toolbar { padding-top: 0px; }'
				. ' @media screen and (max-width: 782px) { html.wp-toolbar { padding-top: 0px; } }'
				. '</style>';
	}//end styles()


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
