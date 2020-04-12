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

use WpMyAdminBar\Trait_Query_String as TraitQueryString;
use WpMyAdminBar\Option_Manager as OptionManager;

/**
 * Load WordPress Plugin Admin Area
 */
final class Plugin_Admin {
	use TraitQueryString;

	/**
	 * Init Admin Display
	 */
	public function __construct() {
		/*
		 * Fires before the administration menu loads in the admin.
		 * https://developer.wordpress.org/reference/hooks/admin_menu/
		 */
		add_action(
			'admin_menu',
			array(
				$this,
				'menu',
			)
		);

		/*
		 * Fires before the administration menu loads in the Network Admin.
		 * https://developer.wordpress.org/reference/hooks/network_admin_menu/
		 */
		add_action(
			'network_admin_menu',
			array(
				$this,
				'menu',
			)
		);

		if ( $this->query_string( 'page' ) === WPMYADMINBAR_PLUGIN_NAME ) {
			/*
			 * Enqueue Scripts For Plugin Admin
			 * https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
			 */
			add_action(
				'admin_enqueue_scripts',
				array(
					$this,
					'enqueue',
				)
			);
		}
	}//end __construct()


	/**
	 * Generate Settings Menu
	 */
	public function menu() {
		/*
		 * Add Settings Page Options
		 * https://developer.wordpress.org/reference/functions/add_submenu_page/
		 */
		add_submenu_page(
			'options-general.php',
			WPMYADMINBAR_PLUGIN_NAME,
			__( 'WP My Admin Bar', 'wp-my-admin-bar' ),
			'manage_options',
			WPMYADMINBAR_PLUGIN_NAME,
			array(
				$this,
				'templates',
			)
		);

		/*
		 * Add Settings Page Options
		 * https://developer.wordpress.org/reference/functions/add_submenu_page/
		 */
		add_submenu_page(
			'settings.php',
			WPMYADMINBAR_PLUGIN_NAME,
			__( 'WP My Admin Bar', 'wp-my-admin-bar' ),
			'manage_options',
			WPMYADMINBAR_PLUGIN_NAME,
			array(
				$this,
				'templates',
			)
		);
	}//end menu()


	/**
	 * Enqueue Stylesheet and jQuery
	 */
	public function enqueue() {
		/*
		 * Enqueue a CSS stylesheet.
		 * https://developer.wordpress.org/reference/functions/wp_enqueue_style/
		 *
		 * Retrieves a URL within the plugins directory.
		 * https://developer.wordpress.org/reference/functions/plugins_url/
		 */
		wp_enqueue_style(
			WPMYADMINBAR_PLUGIN_NAME,
			plugins_url( '/assets/css/style.min.css', WPMYADMINBAR_FILE ),
			'',
			gmdate( 'YmdHis', time() ),
			'all'
		);
	}//end enqueue()


	/**
	 * Display Admin Templates
	 */
	public function templates() {
		$dir = dirname( WPMYADMINBAR_FILE );
		$tab = $this->query_string( 'tab' );

		$option = new OptionManager();

		// Network Admin.
		if ( true === function_exists( 'is_network_admin' ) && true === is_network_admin() ) {
			$frontend     = $option->get_site_setting( 'frontend' );
			$backend      = $option->get_site_setting( 'backend' );
			$mysites      = $option->get_site_setting( 'mysites' );
			$my_sites     = $option->get_site_setting( 'my_sites' );
			$siteids      = $option->get_site_setting( 'siteids' );
			$site_link    = $option->get_site_setting( 'site_link' );
			$site_name    = $option->get_site_setting( 'site_name' );
			$my_account   = $option->get_site_setting( 'my_account' );
			$user_actions = $option->get_site_setting( 'user_actions' );
			$user_info    = $option->get_site_setting( 'user_info' );
			$edit_profile = $option->get_site_setting( 'edit_profile' );
			$logout       = $option->get_site_setting( 'logout' );
			$updates      = $option->get_site_setting( 'updates' );
			$new_content  = $option->get_site_setting( 'new_content' );
			$comments     = $option->get_site_setting( 'comments' );
			$search       = $option->get_site_setting( 'search' );
			$customize    = $option->get_site_setting( 'customize' );
			$wp_logo      = $option->get_site_setting( 'wp_logo' );
			$wp_icon      = $option->get_site_setting( 'wp_icon' );
		}

		// Website Admin.
		if ( true === function_exists( 'is_network_admin' ) && true !== is_network_admin() || true !== function_exists( 'is_network_admin' ) ) {
			$frontend     = $option->get_setting( 'frontend' );
			$backend      = $option->get_setting( 'backend' );
			$mysites      = $option->get_setting( 'mysites' );
			$my_sites     = $option->get_setting( 'my_sites' );
			$siteids      = $option->get_setting( 'siteids' );
			$site_link    = $option->get_setting( 'site_link' );
			$site_name    = $option->get_setting( 'site_name' );
			$my_account   = $option->get_setting( 'my_account' );
			$user_actions = $option->get_setting( 'user_actions' );
			$user_info    = $option->get_setting( 'user_info' );
			$edit_profile = $option->get_setting( 'edit_profile' );
			$logout       = $option->get_setting( 'logout' );
			$updates      = $option->get_setting( 'updates' );
			$new_content  = $option->get_setting( 'new_content' );
			$comments     = $option->get_setting( 'comments' );
			$search       = $option->get_setting( 'search' );
			$customize    = $option->get_setting( 'customize' );
			$wp_logo      = $option->get_setting( 'wp_logo' );
			$wp_icon      = $option->get_setting( 'wp_icon' );
		}

		include_once $dir . '/inc/templates/header.php';
		include_once $dir . '/inc/templates/settings.php';
		include_once $dir . '/inc/templates/footer.php';
	}//end templates()


	/**
	 * Display Admin Area Tabs
	 *
	 * @return string $html Tab Display
	 */
	public function tabs() {
		/*
		 * Escaping for HTML blocks.
		 * https://developer.wordpress.org/reference/functions/esc_html__/
		 */
		$admin_tabs = array(
			'settings' => esc_html__( 'Settings', 'wp-my-admin-bar' ),
		);

		$html = '<h2 class="nav-tab-wrapper">';

		if ( true !== empty( $this->query_string( 'tab' ) ) ) {
			$current_tab = $this->query_string( 'tab' );
		} else {
			$current_tab = key( $admin_tabs );
		}

		$pagename = $this->query_string( 'page' );

		$posttype = '';
		if ( WPMYADMINBAR_PLUGIN_NAME === $this->query_string( 'post_type' ) ) {
			$posttype = '&post_type=' . $this->query_string( 'post_type' );
		}

		foreach ( $admin_tabs as $tab => $name ) {
			$class = '';
			if ( $tab === $current_tab ) {
				$class = ' nav-tab-active';
			}

			$html .= '<a href="?page=' . $pagename .
			'&tab=' . $tab . $posttype .
			'" class="nav-tab' . $class . '">' . $name . '</a>';
		}

		$html .= '</h2><br />';

		return $html;
	}//end tabs()
}//end class
