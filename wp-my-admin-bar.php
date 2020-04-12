<?php
/**
 * Plugin Name: WP My Admin Bar | Admin Bar
 * Plugin URI: https://github.com/ChrisWinters/wp-my-admin-bar
 * Description: The WP My Admin Bar Plugin, replaces and expands the WordPress Admin Bar, adding a new My Sites menu with extended options, a My Cache menu for quick cache access and My Tools for all WP Developers and Blogger needs.
 * Tags: myadmin, myadminbar, adminbar, admin bar, admin, bar, toolbar, tool bar, my sites, mysites, tools, cache, multisite, webtools, web tools, technerdia
 * Version: 3.1.0
 * License: GNU GPLv3
 * Copyright (c) 2012-2019 Chris Winters
 * Author: tribalNerd, Chris Winters
 * Author URI: https://github.com/ChrisWinters/
 * Text Domain: wp-my-admin-bar
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

define( 'WPMYADMINBAR_DIR', __DIR__ );
define( 'WPMYADMINBAR_FILE', __FILE__ );
define( 'WPMYADMINBAR_VERSION', '3.1.0' );
define( 'WPMYADMINBAR_PLUGIN_NAME', 'wp-my-admin-bar' );
define( 'WPMYADMINBAR_SETTING_PREFIX', 'wpmyadminbar_' );
define( 'WPMYADMINBAR_PLUGIN_DIR', dirname( __FILE__ ) );

require_once dirname( __FILE__ ) . '/sdk/wpmyadminbar-fs.php';
require_once dirname( __FILE__ ) . '/inc/autoload-classes.php';

/*
 * Hooks a function on to a specific action.
 * https://developer.wordpress.org/reference/functions/add_action/
 *
 * Hooks a function on to a specific action.
 * https://developer.wordpress.org/reference/functions/add_action/
 */
add_action(
	'plugins_loaded',
	array(
		'WpMyAdminBar\Translate',
		'init',
	)
);

add_action(
	'plugins_loaded',
	array(
		'WpMyAdminBar\WpMyAdminBar',
		'init',
	)
);

/*
 * Set the activation hook for a plugin.
 * https://developer.wordpress.org/reference/functions/register_activation_hook/
 */
register_activation_hook(
	__FILE__,
	array(
		'WpMyAdminBar\Plugin_Activate',
		'init',
	)
);

wpmyadminbar_fs()->add_action(
	'after_uninstall',
	array(
		'WpMyAdminBar\Plugin_Deactivate',
		'init',
	)
);
