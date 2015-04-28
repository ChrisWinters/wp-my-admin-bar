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
namespace WPMyAdminBar\AdminBar\Remove;

// Required To Run
if( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Features authorized to be removed
 * 
 * @see src/WPMyAdminBar/AdminBar/Remove/Features.php
 * 
 * @since 1.0.0
 */
class Settings
{
    /**
     * Allowed Features To Remove
     * 
     * @type array 
     */
    protected static $FEATURES_TO_REMOVE = array(
        'my-sites',
        'site-name',
        'my-account',
        'user-actions',
        'user-info',
        'edit-profile',
        'logout',
        'updates',
        'comments',
        'new-content',
        'search',
        'wp-logo'
    );
}