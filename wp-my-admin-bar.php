<?php
#ini_set("display_errors", "1");
#error_reporting(E_ALL | E_STRICT);
/**
 * Plugin Name: WP My Admin Bar | Admin Bar
 * Plugin URI: http://technerdia.com/projects/adminbar/plugin.html
 * Description: The WP My Admin Bar Plugin, replaces and expands the Wordpress Admin Bar, adding a new My Sites menu with extended options, a My Cache menu for quick cache access and My Tools for all WP Developers and Blogger needs.
 * Tags: myadmin, myadminbar, adminbar, admin bar, admin, bar, toolbar, tool bar, my sites, mysites, tools, cache, multisite, webtools, web tools, technerdia
 * Version: 1.0.3
 * License: GPL
 * Author: tribalNerd
 * Author URI: http://techNerdia.com/
 *
 * Created Feb 12, 2012
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, please visit: http://www.gnu.org/licenses/gpl.html
 *
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012-2015, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 1.0.3
 *
 */
if (count(get_included_files()) == 1){ exit(); }


/**
 * Define Constants
 * 
 * @return array
 */
if (function_exists('WPMyAdminBarConstants')) {
    WPMyAdminBarConstants(Array(
        'WPMAB_VERSION'         => '1.0.0',
        'WPMAB_WP_MIN_VERSION'  => '3.8',

        'WPMAB_PLUGIN_FILE'     => __FILE__,
        'WPMAB_PLUGIN_DIR'      => dirname(__FILE__),
        'WPMAB_PLUGIN_BASE'     => plugin_basename(__FILE__),

        'WPMAB_MENU_NAME'       => 'My Admin Bar',
        'WPMAB_PAGE_NAME'       => 'WPMyAdminBar',
        'WPMAB_PLUGIN_NAME'     => 'WP My Admin Bar',

        'WPMAB_PATH_CLASSES'    => dirname(__FILE__) . '/src/WPMyAdminBar',
        'WPMAB_PATH_TEMPLATES'  => dirname(__FILE__) . '/src/WPMyAdminBar/Admin/Templates'
    ));
}


/**
 * Loop Through Constants and Define
 * 
 * @param $constants_array Array of Constants
 * 
 * @return void
 */
function WPMyAdminBarConstants($constants_array)
{
    foreach ($constants_array as $name => $value) {
        define($name, $value, true);
    }
}


/**
 * Compare PHP Versions
 */
if (version_compare(PHP_VERSION, '5.4.0', '<'))
{
    wp_die(__('<pre>Sorry, the WP My Admin Bar Plugin Currently Requires PHP Version 5.4.0 or Higher to run.</pre>'));
}


/**
 * Include PSR-4 Autoloader
 */
require_once(WPMAB_PLUGIN_DIR . '/autoloader.php');


/**
 * Initialize Plugin
 */
add_action('plugins_loaded', array('\WPMyAdminBar\AdminBar', 'start' ), 0, 0);


/**
 * Wordpress Register Hooks
 */

// On Plugin Activation
register_activation_hook(WPMAB_PLUGIN_FILE, array('\WPMyAdminBar\Hooks', 'activate'));

// On Plugin Deactivation
register_deactivation_hook(WPMAB_PLUGIN_FILE, array('\WPMyAdminBar\Hooks', 'deactivate'));

// On Plugin Uninstall
register_uninstall_hook(WPMAB_PLUGIN_FILE, array('\WPMyAdminBar\Hooks', 'uninstall'));
