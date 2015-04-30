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
 * Get Option Data from Options DB Table
 * 
 * @see src/WPMyAdminBar/AdminBar/Menus/MyCache.php
 * @see src/WPMyAdminBar/AdminBar/Menus/MySites.php
 * @see src/WPMyAdminBar/AdminBar/Menus/MyTools.php
 *
 * @since 1.0.0
 */
trait Options
{
    /**
     * Get the Option
     * 
     * @return array Unserialize settings option
     */
    public function getOption()
    {
        // Check if Option Data is in Cache, if so return transient data
        if ( false === ( $current_option_data = get_transient( 'WPMyAdminBar' ) ) )
        {
            // No transient, get option directly
            $current_option_data = get_option( 'WPMyAdminBar' );

            // Set the Cache
            set_transient( 'WPMyAdminBar', $current_option_data, 0 );
        }

        // Return if not set, show default admin bar settings
        if ( empty( $current_option_data ) ) { return; }

        // Return the unserialize data
        return maybe_unserialize( $current_option_data );
    }


    /**
     * Update the options on Multisite Networks
     * 
     * @value boolean $options_array $_POST from from
     * 
     * @return void
     */
    public function updateMultisite( $options_array )
    {
        if ( function_exists('is_multisite') && is_multisite() ) {
            global $wpdb;

            // Get blog ID's
            $blog_ids = $wpdb->get_results( $wpdb->prepare( "SELECT blog_id FROM %d WHERE public = '1' AND archived = '0' AND spam = '0' AND deleted = '0' ORDER BY blog_id", $wpdb->siteid ) );
 
            // Loop through sites
            foreach ( $blog_ids as $blog_id ) {
                if ( empty( $blog_id ) ) { continue; }

                // Delete cache and option
                delete_transient( "WPMyAdminBar" );
                delete_option( "WPMyAdminBar" );

                // Create the option
                add_option( "WPMyAdminBar", $options_array, '', 'no' );
            }

            // Return to original blog
            restore_current_blog();
        }
    }
}