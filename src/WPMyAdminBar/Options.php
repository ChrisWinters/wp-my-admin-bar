<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012-2015, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 1.0.3
 */

/**
 * Declared Namespace
 *
 * @since 1.0.3
 */
namespace WPMyAdminBar;

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
     * Get the Option Data from the Database
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
     * Update/Reset the Option Data
     * 
     * @value boolean $settings True if the form has been posted
     * @value boolean $reset True if the reset input was selected
     * 
     * @return void
     */
    public static function updateOption( $options_array )
    {
        if ( is_admin() )
        {
            // Delete cache and option
            static::delCache('all');
            static::delOption('all');

            // Create the option
            add_option( "WPMyAdminBar", $options_array, '', 'no' );

            // Remove the update action
            remove_action( 'update_option', array( __CLASS__, 'updateOption' ), 1 );
        }
    }


    /**
     * Update the options on Multisite Networks
     * 
     * @value boolean $options_array $_POST from from
     * 
     * @return void
     */
    public static function updateOptionNetwork( $options_array )
    {
        // Multisite Only
        if ( function_exists('is_multisite') && is_multisite() ) {
            // Loop through the sites
            foreach ( wp_get_sites() as $value ) {
                // Switch between blogs
                switch_to_blog( $value['blog_id'] );

                // Delete cache and option
                static::delCache('all');
                static::delOption('all');

                // Create the option
                add_option( "WPMyAdminBar", $options_array, '', 'no' );
            }

            // Return to original blog
            restore_current_blog();
        }
    }


    /**
     * Delete the transient cache
     * 
     * @param $action string all or cache
     * 
     * @return void
     */
    public static function delCache( $action )
    {
        if ( empty( $action ) ) { return; }

        // Delete Cache
        if ( get_transient( "WPMyAdminBar" ) )
        {
            delete_transient( "WPMyAdminBar" );
        }
    }


    /**
     * Delete the option
     * 
     * @param $action string all or cache
     * 
     * @return void
     */
    public static function delOption( $action )
    {
        if ( $action == 'cache' ) { return; }

        // Delete option
        if ( get_option( "WPMyAdminBar" ) )
        {
            delete_option( "WPMyAdminBar" );
        }
    }
}