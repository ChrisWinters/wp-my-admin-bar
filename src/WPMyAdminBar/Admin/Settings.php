<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012-2015, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 1.0.0
 */

/**
 * Declared Namespace
 */
namespace WPMyAdminBar\Admin;

// Required To Run
if( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Settings for the Plugin Admin Area
 * 
 * @see src/WPMyAdminBar/Admin/Admin.php
 * 
 * @since 1.0.0
 */
class Settings
{
    /**
     * Tabs names within the plugin admin
     *
     * @type array 
     */
    protected static $TAB_NAMES = array( 'settings' => 'Settings' );

    /**
     * Input names for form display
     * 
     * @about Add/Remove values within the array to automatically populate
     *          the form display within the plugin admin AND they're used to
     *          populate the option 'WPMyAdminBar' with the proper key values.
     *
     * @type array 
     */
    protected static $INPUT_NAMES = array(
        'admin-bar-front',
        'admin-bar-admin',
        'my-sites',
        'siteids',
        'site-name',
        'my-cache',
        'dbcache',
        'super',
        'total',
        'widget',
        'minify',
        'my-tools',
        'my-account',
        'user-actions',
        'user-info',
        'edit-profile',
        'logout',
        'updates',
        'new-content',
        'comments',
        'search',
        'wp-logo',
        'wpicon'
    );

    /**
     * Default values for options, keys must match $INPUT_NAMES
     * 
     * @type array 
     */
    protected static $OPTION_DEFAULTS = array(
        'admin-bar-front'   => 'show',
        'admin-bar-admin'   => 'show',

        'my-sites'          => 'show',
        'siteids'           => 'show',
        'site-name'         => 'hide',

        'my-cache'          => 'hide',
        'dbcache'           => 'hide',
        'super'             => 'hide',
        'total'             => 'hide',
        'widget'            => 'hide',
        'minify'            => 'hide',

        'my-tools'          => 'show',

        'my-account'        => 'show',
        'user-actions'      => 'show',
        'user-info'         => 'show',
        'edit-profile'      => 'show',
        'logout'            => 'show',

        'updates'           => 'show',
        'new-content'       => 'show',
        'comments'          => 'show',
        'search'            => 'show',

        'wp-logo'           => 'show',
        'wpicon'            => 'hide'
    );

    /**
     * Default values for form groups & form inputs, option value must match $INPUT_NAMES
     * 
     * @return array 
     */
    final public static function formSettings() {
        return array(
            array( 'group' => '1', 'option' => 'admin-bar-front', 'name' => 'admin_bar_front', 'title' => __( 'Display Admin Bar on Frontend', 'WPMyAdminBar' ) ),
            array( 'group' => '1', 'option' => 'admin-bar-admin', 'name' => 'admin_bar_admin', 'title' => __( 'Display Admin Bar on Backend', 'WPMyAdminBar' ) ),

            array( 'group' => '2', 'option' => 'my-sites', 'name' => 'my_sites', 'title' => __( 'Custom My Sites Menu', 'WPMyAdminBar' ) ),
            array( 'group' => '2', 'option' => 'siteids', 'name' => 'siteids', 'title' => __( 'Site IDs next to Sites in Menus', 'WPMyAdminBar' ) ),
            array( 'group' => '2', 'option' => 'site-name', 'name' => 'site_name', 'title' => __( 'Local Site Menu on Admin Bar', 'WPMyAdminBar' ) ),

            array( 'group' => '3', 'option' => 'my-cache', 'name' => 'my_cache', 'title' => __( 'Custom My Cache Menu', 'WPMyAdminBar' ) ),
            array( 'group' => '3', 'option' => 'dbcache', 'name' => 'dbcache', 'title' => __( '<a href="http://wordpress.org/extend/plugins/db-cache-reloaded-fix/" target="_blank">DB Cache</a> Settings Link', 'WPMyAdminBar' ) ),
            array( 'group' => '3', 'option' => 'super', 'name' => 'super', 'title' => __( '<a href="http://wordpress.org/extend/plugins/wp-super-cache/" target="_blank">Super Cache</a> Settings Link', 'WPMyAdminBar' ) ),
            array( 'group' => '3', 'option' => 'total', 'name' => 'total', 'title' => __( '<a href="http://wordpress.org/extend/plugins/w3-total-cache/" target="_blank">Total Cache</a> Settings Link', 'WPMyAdminBar' ) ),
            array( 'group' => '3', 'option' => 'widget', 'name' => 'widget', 'title' => __( '<a href="http://wordpress.org/extend/plugins/wp-widget-cache/" target="_blank">Widget Cache</a> Settings Link', 'WPMyAdminBar' ) ),
            array( 'group' => '3', 'option' => 'minify', 'name' => 'minify', 'title' => __( '<a href="http://wordpress.org/extend/plugins/wp-minify/" target="_blank">Wp Minify</a> Settings Link', 'WPMyAdminBar' ) ),

            array( 'group' => '4', 'option' => 'my-tools', 'name' => 'my_tools', 'title' => __( 'Custom My Tools Menu', 'WPMyAdminBar' ) ),

            array( 'group' => '5', 'option' => 'my-account', 'name' => 'my_account', 'title' => __( 'Howdy, Menu on Admin Bar', 'WPMyAdminBar' ) ),
            array( 'group' => '5', 'option' => 'user-actions', 'name' => 'user_actions', 'title' => __( 'Manage the Howdy, Dropdown Only', 'WPMyAdminBar' ) ),
            array( 'group' => '5', 'option' => 'user-info', 'name' => 'user_info', 'title' => __( 'Display Avatar &amp; Username within Dropdown', 'WPMyAdminBar' ) ),
            array( 'group' => '5', 'option' => 'edit-profile', 'name' => 'edit_profile', 'title' => __( 'Display Edit Profile Link within Dropdown', 'WPMyAdminBar' ) ),
            array( 'group' => '5', 'option' => 'logout', 'name' => 'logout', 'title' => __( 'Display Logout Link within Dropdown', 'WPMyAdminBar' ) ),

            array( 'group' => '6', 'option' => 'updates', 'name' => 'updates', 'title' => __( 'Update Notices on Admin Bar', 'WPMyAdminBar' ) ),
            array( 'group' => '6', 'option' => 'new-content', 'name' => 'new_content', 'title' => __( 'New Content Menu on Admin Bar', 'WPMyAdminBar' ) ),
            array( 'group' => '6', 'option' => 'comments',  'name' => 'comments', 'title' => __( 'Comments Menu on Admin Bar', 'WPMyAdminBar' ) ),
            array( 'group' => '6', 'option' => 'search',  'name' => 'search', 'title' => __( 'Search Icon on Frontend Admin Bar', 'WPMyAdminBar' ) ),

            array( 'group' => '7', 'option' => 'wp-logo', 'name' => 'wp_logo', 'title' => __( 'Wordpress Logo on Admin Bar', 'WPMyAdminBar' ) ),
            array( 'group' => '7', 'option' => 'wpicon', 'name' => 'wpicon', 'title' => __( 'WP Icon next to Sites in Menus', 'WPMyAdminBar' ) )
        );
    }
}