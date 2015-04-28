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
 * Register Hooks: Activate, Deactivate & Uninstall
 * 
 * @see src/WPMyAdminBar/WPMyAdminBar.php
 *
 * @since 1.0.0
 */
class Hooks extends Settings
{
    /**
     * Activate Plugin
     * 
     * @return void
     */
    final public static function activate()
    {
        global $wp_version;

        // Version Check
        if( version_compare( $wp_version, WPMAB_WP_MIN_VERSION, "<" ) )
        {
            wp_die( 'This plugin requires WordPress '. WPMAB_WP_MIN_VERSION .' or higher. Please Upgrade Wordpress, then try activating this plugin again.' );
        }

        // Remove cache
        static::delCache( 'all' );

        // Add option, if not found
        if ( !get_option( "WPMyAdminBar" ) )
        {
            // Default (activation) Settings for the plugin
            // @see classes/Settings.php
            $options_array = Settings::$DEFAULT_OPTION_SETTINGS;

            // Add default option
            add_option( "WPMyAdminBar", serialize( $options_array ), '', 'no' );
        }

        // Upgrade the WP My Admin Bar Plugin
        // @see src/WPMyAdminBar/Upgrade.php
        if ( get_option( 'wp_myadminbar' ) )
        {
            // Init Class
            $pluginUpgrade = new \WPMyAdminBar\Upgrade();
            $pluginUpgrade->start();
        }
    }


    /**
     * Deactivate Plugin
     * 
     * @return void
     */
    final public static function deactivate()
    {
        // Remove cache
        static::delCache( 'all' );

        // Cleanup Multisite Network Sites
        static::cleanNetwork( 'cache' );
    }


    /**
     * Uninstall Plugin
     * 
     * @return void
     */
    final public static function uninstall()
    {
        // Remove cache
        static::delCache( 'all' );

        // Remove option
        static::delOption( 'all' );

        // Cleanup Multisite Network Sites
        static::cleanNetwork( 'all' );
    }


    /**
     * Cleanup Multisite Network Sites
     * 
     * @param $action string
     * @return void
     */
    final public static function cleanNetwork( $action )
    {
        // Multisite Only
        if ( function_exists('is_multisite') && is_multisite() )
        {
            global $wpdb;

            // Get blog ID's
            $site_list = $wpdb->get_results( 'SELECT blog_id FROM '. $wpdb->blogs .'  ORDER BY blog_id' );

            // Loop through sites
            foreach ( $site_list as $site ) {
                if ( empty( $site ) ) { continue; }

                // Remove cache
                static::delCache( $action );

                // Remove option
                static::delOption( $action );
            }

            // Return to original blog
            restore_current_blog();
        }
    }


    /**
     * Delete the transient cache
     * 
     * @param $action string
     * @return void
     */
    final public static function delCache( $action )
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
     * @param $action string
     * @return void
     */
    final public static function delOption( $action )
    {
        if ( $action == 'cache' ) { return; }

        // Delete option
        if ( get_option( "WPMyAdminBar" ) )
        {
            delete_option( "WPMyAdminBar" );
        }
    }
}
