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
namespace WPMyAdminBar;

// Required To Run
if( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Default Plugin Settings
 * 
 * @since 1.0.0
 */
class Settings
{
    /**
     * Default (activation) Settings for the plugin
     * 
     * @see src/WPMyAdminBar/RegisterHooks.php
     *
     * @var type array
     */
    protected static $DEFAULT_OPTION_SETTINGS = array(
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
}