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
namespace WPMyAdminBar\AdminBar\Common;

// Required To Run
if( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Ensure Menus & Menu Features can be modified
 * 
 * @see src/WPMyAdminBar/AdminBar/Menus/MyCache.php
 * @see src/WPMyAdminBar/AdminBar/Menus/MySites.php
 * @see src/WPMyAdminBar/AdminBar/Menus/MyTools.php
 * @see src/WPMyAdminBar/AdminBar/Remove/Features.php
 *
 * @since 1.0.0
 */
class Security
{
    /**
     * @var string Menu Slug
     */
    protected $menu_slug;

    /**
     * @var array Wordpress Option Data
     */
    protected $option = array();


    /**
     * Define Class Variables
     * 
     * @return void
     */
    public function __construct( $menu_slug, array $option ) {
        $this->menu_slug = $menu_slug;
        $this->option = $option;
    }


    /**
     * True required to display menus / remove menu items
     * 
     * @param string $menu_name my-cache, my-sites, my-tools
     * @param array $option The WPMyAdminBar Option Array
     * 
     * @return boolean false = fail, true = passed security checks
     */
    final public function getReponse()
    {
        // Required
        if ( ! $this->menu_slug ) { return false; }
        if ( ! $this->option ) { return false; }
        
        // Make it silent
        if ( empty( $this->option[ $this->menu_slug ] ) ) { return false; }

        // Return if Backend Adminbar is disabled
        if ( $this->option[ 'admin-bar-admin' ] == 'hide' ) { return false; }

        // Return if custom menu should not show
        if ( $this->option[ $this->menu_slug ] == 'hide' ) { return false; }

        // Wordpress Checks
        if ( ! is_user_logged_in() ) { return false; }
        if ( ! is_user_member_of_blog() ) { return false; }
        if ( ! current_user_can( 'manage_options' ) ) { return false; }

        // All good, return true
        return true;
    }
}