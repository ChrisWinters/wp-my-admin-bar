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
final class Do_Menu_My_Sites {
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

		add_action( 'admin_bar_menu', array( $this, 'add_menu' ), 25, 0 );
		add_action( 'wp_before_admin_bar_render', array( $this, 'remove_nodes' ) );
	}//end __construct()


	/**
	 * Maybe Remove Menu Item Nodes
	 */
	public function remove_nodes() {
		if ( false === is_multisite() ) {
			return;
		}

		$display_status = $this->option_manager->get_setting( 'mysites' );

		if ( true === empty( $display_status ) || ( true !== empty( $display_status ) && 'disable' === $display_status ) ) {
			return;
		}

		global $wp_admin_bar;

		$wp_admin_bar->remove_node( 'network-admin' );

		foreach ( (array) $wp_admin_bar->user->blogs as $blog ) {
			switch_to_blog( $blog->userblog_id );

			$wp_admin_bar->remove_node( 'blog-' . $blog->userblog_id );

			restore_current_blog();
		}
	}//end remove_nodes()


	/**
	 * Add Custom Menu
	 */
	public function add_menu() {
		if ( false === is_multisite() ) {
			return;
		}

		$display_status = $this->option_manager->get_setting( 'mysites' );

		if ( true === empty( $display_status ) || ( true !== empty( $display_status ) && 'disable' === $display_status ) ) {
			return;
		}

		global $wp_admin_bar;

		$wp_admin_bar->add_menu(
			array(
				'id'    => 'my-sites',
				'title' => __( 'My Sites', 'wp-my-admin-bar' ),
				'href'  => admin_url( 'my-sites.php' ),
			)
		);

		if ( true === is_super_admin() ) {
			$wp_admin_bar->add_group(
				array(
					'parent' => 'my-sites',
					'id'     => 'superadmin',
				)
			);

			$wp_admin_bar->add_menu(
				array(
					'parent' => 'superadmin',
					'id'     => 'networkadmin',
					'title'  => __( 'Network Admin', 'wp-my-admin-bar' ),
					'href'   => network_admin_url(),
				)
			);

			$wp_admin_bar->add_menu(
				array(
					'parent' => 'networkadmin',
					'id'     => 'networkdash',
					'title'  => '&bull; ' . __( 'Dashboard', 'wp-my-admin-bar' ),
					'href'   => network_admin_url(),
				)
			);

			foreach ( $this->menu_network_array() as $array ) {
				$wp_admin_bar->add_menu(
					array(
						'parent' => 'networkadmin',
						'id'     => $array['menu_id'],
						'title'  => $array['title'],
						'href'   => $array['href'],
					)
				);
			}
		}

		$wp_admin_bar->add_group(
			array(
				'parent' => 'my-sites',
				'id'     => 'current-group',
				'meta'   => array( 'class' => 'ab-sub-secondary' ),
			)
		);

		$site_link = $this->option_manager->get_setting( 'site_link' );

		if ( true !== empty( $site_link ) && 'enable' === $site_link ) {
			if ( true === is_admin() ) {
				$wp_admin_bar->add_menu(
					array(
						'parent' => 'current-group',
						'id'     => 'currentsite',
						'title'  => '&bull; ' . __( 'Visit Website', 'wp-my-admin-bar' ),
						'href'   => home_url( '/' ),
					)
				);
			} else {
				$wp_admin_bar->add_menu(
					array(
						'parent' => 'current-group',
						'id'     => 'currentsite',
						'title'  => '&bull; ' . __( 'Dashboard', 'wp-my-admin-bar' ),
						'href'   => admin_url( '/' ),
					)
				);
			}
		}

		$wp_admin_bar->add_group(
			array(
				'parent' => 'my-sites',
				'id'     => 'mysites-group',
				'meta'   => array( 'class' => 'ab-sub-secondary' ),
			)
		);

		$wp_icon = $this->option_manager->get_setting( 'wp_icon' );
		$siteids = $this->option_manager->get_setting( 'siteids' );

		foreach ( (array) $wp_admin_bar->user->blogs as $blog ) {
			switch_to_blog( $blog->userblog_id );

			$wp_admin_bar->add_menu(
				array(
					'parent' => 'mysites-group',
					'id'     => 'mysites' . $blog->userblog_id,
					'title'  => $this->menu_title( $blog->blogname, $blog->userblog_id, $siteids, $wp_icon ),
					'href'   => admin_url(),
				)
			);

			foreach ( (array) $this->menu_arrays() as $array ) {
				$wp_admin_bar->add_menu(
					array(
						'parent' => 'mysites' . $blog->userblog_id,
						'id'     => $array['menu_id'] . $blog->userblog_id,
						'title'  => $array['title'],
						'href'   => $array['href'],
					)
				);
			}

			restore_current_blog();
		}
	}//end add_menu()
}//end class
