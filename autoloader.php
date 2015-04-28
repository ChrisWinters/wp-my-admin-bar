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
if( count( get_included_files() ) == 1 ){ exit(); }

/**
 * Register Autoloader
 * 
 * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
 * 
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register( function ( $class )
{
    // project-specific namespace prefix
    $prefix = 'WPMyAdminBar\\';

    // base directory for the namespace prefix
    $base_dir = WPMAB_PATH_CLASSES .'/';

    // does the class use the namespace prefix?
    $len = strlen( $prefix );
    if ( strncmp( $prefix, $class, $len ) !== 0 )
    {
       // no, move to the next registered autoloader
       return;
    }

    // get the relative class name
    $relative_class = substr( $class, $len );

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace( '\\', '/', $relative_class ) . '.php';

    // if the file exists, require it
    if ( file_exists( $file ) )
    {
       require $file;
    }
} );