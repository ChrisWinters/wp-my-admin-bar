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
namespace WPMyAdminBar\AdminBar\Menus;

// Required To Run
if( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Required Methods
 * 
 * @see src/WPMyAdminBar/AdminBar/Menus/MyCache.php
 * @see src/WPMyAdminBar/AdminBar/Menus/MySites.php
 * @see src/WPMyAdminBar/AdminBar/Menus/MyTools.php
 *
 * @since 1.0.0
 */
interface Interfacer
{
    /**
     * Display the Menu
     * 
     * @return void
     */
    public function renderMenu();


    /**
     * Create Menu Title
     * 
     * @return void
     */
    public function menuTitle( $name, $id, $wp_admin_bar );


    /**
     * Sub Menu to Item
     * 
     * @return void
     */
    public function menuItem( $id, $name, $link, $root_menu, $wp_admin_bar );


    /**
     * Check if menu is allowed to display
     * 
     * @return void
     */
    public static function security();


    /**
     * Start Object
     * 
     * @return void
     */
    public static function start();
}