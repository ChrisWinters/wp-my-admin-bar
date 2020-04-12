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

use WpMyAdminBar\Trait_Menu_Item_Arrays as TraitMenuItemArrays;
use WpMyAdminBar\Trait_Build_Blogname as BuildBlogname;

/**
 * Custom My Sites Website Menu
 */
final class Do_Menu_Site_Name {
	use TraitMenuItemArrays;
	use BuildBlogname;

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

		add_action( 'admin_bar_menu', array( $this, 'maybe_render_menu' ), 999, 0 );
		add_action( 'wp_before_admin_bar_render', array( $this, 'remove_nodes' ) );
	}//end __construct()


	/**
	 * Maybe Remove Menu Item Nodes
	 */
	public function remove_nodes() {
		$display_status = $this->option_manager->get_setting( 'mysites' );

		if ( true === empty( $display_status ) || ( true !== empty( $display_status ) && 'disable' === $display_status ) ) {
			return;
		}

		global $wp_admin_bar;

		$wp_admin_bar->remove_node( 'dashboard' );
		$wp_admin_bar->remove_node( 'view-site' );
		$wp_admin_bar->remove_node( 'logout' );
		$wp_admin_bar->remove_node( 'themes' );
		$wp_admin_bar->remove_node( 'widgets' );
		$wp_admin_bar->remove_node( 'menus' );
	}//end remove_nodes()


	/**
	 * Maybe Render Menu
	 */
	public function maybe_render_menu() {
		$display_status = $this->option_manager->get_setting( 'mysites' );

		if ( true === empty( $display_status ) || ( true !== empty( $display_status ) && 'disable' === $display_status ) ) {
			return;
		}

		$this->add_menu();
	}//end maybe_render_menu()


	/**
	 * Build Menu Title
	 */
	private function blogname() {
		$title = get_bloginfo( 'name' );

		if ( true === empty( $title ) ) {
			$title = preg_replace( '#^(https?://)?(www.)?#', '', get_home_url() );
		}

		return $title;
	}//end blogname()


	/**
	 * Add Custom Menu
	 */
	private function add_menu() {
		global $wp_admin_bar;

		$wp_icon = $this->option_manager->get_setting( 'wp_icon' );
		$siteids = $this->option_manager->get_setting( 'siteids' );

		$wp_admin_bar->add_menu(
			array(
				'id'    => 'site-name',
				'title' => $this->blogname(),
				'href'  => ( is_admin() || ! current_user_can( 'read' ) ) ? home_url( '/' ) : admin_url(),
			)
		);

		$wp_admin_bar->add_group(
			array(
				'parent' => 'site-name',
				'id'     => 'sitename',
				'meta'   => array( 'class' => 'ab-sub-secondary' ),
			)
		);

		foreach ( (array) $this->menu_arrays() as $array ) {
			$wp_admin_bar->add_menu(
				array(
					'parent' => 'sitename',
					'id'     => $array['menu_id'],
					'title'  => $array['title'],
					'href'   => $array['href'],
				)
			);
		}
	}//end add_menu()
}//end class
