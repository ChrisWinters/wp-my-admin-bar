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
 * Custom My Sites Website Menu
 */
final class Do_Site_Name_Menu {
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
	public function __construct( $option_manager = [] ) {
		if ( true === empty( $option_manager ) ) {
			return;
		}

		$this->option_manager = $option_manager;

		add_action( 'admin_bar_menu', [ $this, 'maybe_render_menu' ], 999, 0 );
	}//end __construct()


	/**
	 * Maybe Render Menu
	 */
	public function maybe_render_menu() {
		$display_status = $this->option_manager->get_setting( 'my_sites' );

		if ( true !== empty( $display_status ) && 'disable' === $display_status ) {
			return;
		}

		$this->add_menu();
	}//end maybe_render_menu()


	/**
	 * Build Menu Title
	 */
	private function menu_title() {
		$title = get_bloginfo( 'name' );

		if ( true === empty( $title ) ) {
			$title = preg_replace( '#^(https?://)?(www.)?#', '', get_home_url() );
		}

		return wp_html_excerpt( $title, 40, '&hellip;' );
	}//end menu_title()


	/**
	 * Add Custom Menu
	 */
	private function add_menu() {
		global $wp_admin_bar;

		$wp_admin_bar->add_menu(
			[
				'id'    => 'site-name',
				'title' => $this->menu_title(),
				'href'  => ( is_admin() || ! current_user_can( 'read' ) ) ? home_url( '/' ) : admin_url(),
			]
		);

		$wp_admin_bar->add_group(
			[
				'parent' => 'site-name',
				'id'     => 'sitename',
				'meta'   => [ 'class' => 'ab-sub-secondary' ],
			]
		);

		$wp_admin_bar->remove_node( 'view-site' );
		$wp_admin_bar->remove_node( 'logout' );

		$merged_array = array_merge(
			$this->menu_parent_array(),
			$this->menu_comment_array(),
			$this->menu_content_array(),
			$this->menu_post_page_array(),
			$this->menu_admin_array(),
			$this->menu_logout_array()
		);

		foreach ( $merged_array as $array ) {
			$wp_admin_bar->add_menu(
				[
					'parent' => 'sitename',
					'id'     => $array['menu_id'],
					'title'  => $array['title'],
					'href'   => $array['href'],
				]
			);
		}
	}//end add_menu()


	/**
	 * Menu Items Array
	 */
	private function menu_parent_array() {
		return [
			'dashboard' => [
				'menu_id' => 'dashboard',
				'title'   => '&bull; ' . __( 'Dashboard', 'wp-my-admin-bar' ),
				'href'    => admin_url(),
			],
			'view-site' => [
				'menu_id' => 'view-site',
				'title'   => '&bull; ' . __( 'Visit Site', 'wp-my-admin-bar' ),
				'href'    => home_url( '/' ),
			],
		];
	}//end menu_parent_array()


	/**
	 * Menu Items Array
	 */
	private function menu_comment_array() {
		if ( false === current_user_can( 'edit_posts' ) ) {
			return [];
		}

		return [
			'comments' => [
				'menu_id' => 'view-comments',
				'title'   => '&bull; ' . __( 'View Comments', 'wp-my-admin-bar' ),
				'href'    => admin_url( 'edit-comments.php' ),
			],
		];
	}//end menu_comment_array()


	/**
	 * Menu Items Array
	 */
	private function menu_content_array() {
		if ( false === current_user_can( get_post_type_object( 'post' )->cap->create_posts ) ) {
			return [];
		}

		return [
			'addcontent' => [
				'menu_id' => 'addcontent-break',
				'title'   => '<span style="color:#fff;">' . __( 'Add Content', 'wp-my-admin-bar' ) . '</span>',
				'href'    => false,
			],
			'addpost'    => [
				'menu_id' => 'addpost',
				'title'   => '&bull; ' . __( 'Add Post', 'wp-my-admin-bar' ),
				'href'    => admin_url( 'post-new.php' ),
			],
			'addpage'    => [
				'menu_id' => 'addpage',
				'title'   => '&bull; ' . __( 'Add Page', 'wp-my-admin-bar' ),
				'href'    => admin_url( 'post-new.php?post_type=page' ),
			],
			'addmedia'   => [
				'menu_id' => 'addmedia',
				'title'   => '&bull; ' . __( 'Add Media', 'wp-my-admin-bar' ),
				'href'    => admin_url( 'media-new.php' ),
			],
		];
	}//end menu_content_array()


	/**
	 * Menu Items Array
	 */
	private function menu_post_page_array() {
		if ( false === current_user_can( 'edit_posts' ) ) {
			return [];
		}

		return [
			'postspages' => [
				'menu_id' => 'postspages-break',
				'title'   => '<span style="color:#fff;">' . __( 'Posts and Pages', 'wp-my-admin-bar' ) . '</span>',
				'href'    => false,
			],
			'viewposts'  => [
				'menu_id' => 'viewposts',
				'title'   => '&bull; ' . __( 'Add Post', 'wp-my-admin-bar' ),
				'href'    => admin_url( 'edit.php' ),
			],
			'viewdrafts' => [
				'menu_id' => 'viewdrafts',
				'title'   => '&bull; ' . __( 'Add Page', 'wp-my-admin-bar' ),
				'href'    => admin_url( 'edit.php?post_status=draft&post_type=post' ),
			],
			'viewpages'  => [
				'menu_id' => 'viewpages',
				'title'   => '&bull; ' . __( 'Add Media', 'wp-my-admin-bar' ),
				'href'    => admin_url( 'edit.php?post_type=page' ),
			],
		];
	}//end menu_post_page_array()


	/**
	 * Menu Items Array
	 */
	private function menu_admin_array() {
		if ( false === current_user_can( 'manage_options' ) ) {
			return [];
		}

		return [
			'admin-break'     => [
				'menu_id' => 'admin-break',
				'title'   => '<span style="color:#fff;">' . __( 'Administration', 'wp-my-admin-bar' ) . '</span>',
				'href'    => false,
			],
			'appearance-item' => [
				'menu_id' => 'appearance-item',
				'title'   => '&bull; ' . __( 'Appearance Admin', 'wp-my-admin-bar' ),
				'href'    => admin_url( 'themes.php' ),
			],
			'plugins-item'    => [
				'menu_id' => 'plugins-item',
				'title'   => '&bull; ' . __( 'Plugins Admin', 'wp-my-admin-bar' ),
				'href'    => admin_url( 'plugins.php' ),
			],
			'users-item'      => [
				'menu_id' => 'users-item',
				'title'   => '&bull; ' . __( 'Users Admin', 'wp-my-admin-bar' ),
				'href'    => admin_url( 'users.php' ),
			],
			'settings-item'   => [
				'menu_id' => 'settings-item',
				'title'   => '&bull; ' . __( 'Settings Admin', 'wp-my-admin-bar' ),
				'href'    => admin_url( 'options-general.php' ),
			],
		];
	}//end menu_admin_array()


	/**
	 * Menu Items Array
	 */
	private function menu_logout_array() {
		return [
			'logout' => [
				'menu_id' => 'logout',
				'title'   => '&bull; ' . __( 'Logout', 'wp-my-admin-bar' ),
				'href'    => home_url( '/wp-login.php?action=logout' ),
			],
		];
	}//end menu_logout_array()
}//end class
