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
 * Menu Item Arrays
 */
trait Trait_Menu_Item_Arrays {
	/**
	 * Merged Menu Arrays
	 */
	final public function menu_arrays() {
		return array_merge(
			$this->menu_parent_array(),
			$this->menu_comment_array(),
			$this->menu_content_array(),
			$this->menu_post_page_array(),
			$this->menu_admin_array(),
			$this->menu_logout_array()
		);
	}//end menu_arrays()


	/**
	 * Menu Items Array
	 */
	final public function menu_parent_array() {
		$array = [
			'wpdashboard' => [
				'menu_id' => 'wpdashboard',
				'title'   => '&bull; ' . __( 'Dashboard', 'wp-my-admin-bar' ),
				'href'    => admin_url(),
			],
		];

		if ( true === is_admin() ) {
			$array = [
				'viewsite' => [
					'menu_id' => 'viewsite',
					'title'   => '&bull; ' . __( 'Visit Site', 'wp-my-admin-bar' ),
					'href'    => home_url( '/' ),
				],
			];
		}

		return $array;
	}//end menu_parent_array()


	/**
	 * Menu Items Array
	 */
	final public function menu_comment_array() {
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
	final public function menu_content_array() {
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
	final public function menu_post_page_array() {
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
	final public function menu_admin_array() {
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
	 * Network Menu Items Array
	 */
	final public function menu_network_array() {
		return [
			'managenetwork' => [
				'menu_id' => 'managenetwork',
				'title'   => '<span style="color:#fff;">' . __( 'Manage Network', 'wp-my-admin-bar' ) . '</span>',
				'href'    => false,
			],
			'editthissite'  => [
				'menu_id' => 'editthissite',
				'title'   => '&bull; ' . __( 'Edit This Site', 'wp-my-admin-bar' ),
				'href'    => network_admin_url( 'site-info.php?id=' . get_current_blog_id() ),
			],
			'addsite'       => [
				'menu_id' => 'addsite',
				'title'   => '&bull; ' . __( 'Add Website', 'wp-my-admin-bar' ),
				'href'    => network_admin_url( 'site-new.php' ),
			],
			'addplugin'     => [
				'menu_id' => 'addplugin',
				'title'   => '&bull; ' . __( 'Add Plugin', 'wp-my-admin-bar' ),
				'href'    => network_admin_url( 'plugin-install.php' ),
			],
			'adduser'       => [
				'menu_id' => 'adduser',
				'title'   => '&bull; ' . __( 'Add User', 'wp-my-admin-bar' ),
				'href'    => network_admin_url( 'user-new.php' ),
			],
			'networkadmins' => [
				'menu_id' => 'networkadmins',
				'title'   => '<span style="color:#fff;">' . __( 'Network Admins', 'wp-my-admin-bar' ) . '</span>',
				'href'    => false,
			],
			'sitesadmin'    => [
				'menu_id' => 'sitesadmin',
				'title'   => '&bull; ' . __( 'Sites Admin', 'wp-my-admin-bar' ),
				'href'    => network_admin_url( 'sites.php' ),
			],
			'usersadmin'    => [
				'menu_id' => 'usersadmin',
				'title'   => '&bull; ' . __( 'Users Admin', 'wp-my-admin-bar' ),
				'href'    => network_admin_url( 'users.php' ),
			],
			'themesadmin'   => [
				'menu_id' => 'themesadmin',
				'title'   => '&bull; ' . __( 'Themes Admin', 'wp-my-admin-bar' ),
				'href'    => network_admin_url( 'themes.php' ),
			],
			'pluginsadmin'  => [
				'menu_id' => 'pluginsadmin',
				'title'   => '&bull; ' . __( 'Plugins Admin', 'wp-my-admin-bar' ),
				'href'    => network_admin_url( 'plugins.php' ),
			],
			'settingsadmin' => [
				'menu_id' => 'settingsadmin',
				'title'   => '&bull; ' . __( 'Settings Admin', 'wp-my-admin-bar' ),
				'href'    => network_admin_url( 'settings.php' ),
			],
		];
	}//end menu_network_array()


	/**
	 * Menu Items Array
	 */
	final public function menu_logout_array() {
		return [
			'logout' => [
				'menu_id' => 'logout',
				'title'   => '&bull; ' . __( 'Logout', 'wp-my-admin-bar' ),
				'href'    => home_url( '/wp-login.php?action=logout' ),
			],
		];
	}//end menu_logout_array()
}//end class
