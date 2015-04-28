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
 * Required Methods
 * 
 * @see src/WPMyAdminBar/AdminBar/Remove/Backend.php
 * @see src/WPMyAdminBar/AdminBar/Remove/Features.php
 * @see src/WPMyAdminBar/AdminBar/Remove/Frontend.php
 *
 * @since 1.0.0
 */
interface Interfacer
{
    /**
     * Remove Features
     * 
     * @return void
     */
    public function remove();


    /**
     * Check if menu is allowed to display
     * 
     * @return void
     */
    public static function security( $slug );


    /**
     * Start Actions
     * 
     * @return void
     */
    static function start();
}