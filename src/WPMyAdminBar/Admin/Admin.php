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
 * Plugin Admin Area
 * 
 * @see src/WPMyAdminBar/WPMyAdminBar.php
 * 
 * @since 1.0.0
 */
class Admin extends Settings
{
    /**
     * Plugin page name slug
     *
     * @type string
     */
    const PAGE_SLUG = WPMAB_PAGE_NAME;

    /**
     * Path to admin area templates
     *
     * @type string
     */
    const TEMPLATES_PATH = WPMAB_PATH_TEMPLATES;


    /**
    * Start the Admin Area Display
    *
    * @since 1.0.0
    *
    * @return void
    */
    final static function display()
    {
        // Required: Force Location
        if ( static::PAGE_SLUG !== filter_input( INPUT_GET, 'page' ) ) { return; }

        // Filter Settings & Reset Post Items
        $settings = ( true === ( filter_input( INPUT_POST, 'settings' ) ) ) ? 'yes' : 'no';
        $reset = ( true === ( filter_input( INPUT_POST, 'reset' ) ) ) ? 'yes' : 'no';

        // Update/Reset The Option
        if ( $settings == 'yes' && check_admin_referer( 'mymab_action', 'mymab_nonce' ) ) {
            static::updateOption( $settings, $reset );
        }

        // Build Admin Area
        static::template( 'header' );
        static::template( 'content' );
        static::template( 'footer' );
    }


    /**
     * Plugin Admin Header Template
     * 
     * 
     * @param string $template The name of the template to load
     * @param array $value Foreach $value in radioForms() method
     * @return void
     */
    final static function template( $template, $value = false )
    {
        // Require Template
        if( !file_exists( static::TEMPLATES_PATH .'/'. $template .'.php' ) ) { return; }

        // Include Template
        if( $value != false ) {
            include( static::TEMPLATES_PATH .'/'. $template .'.php' );
        } else {
            include_once( static::TEMPLATES_PATH .'/'. $template .'.php' );
        }
    }


    /**
     * Get the primary option data based on the page slug name
     * 
     * @see src/WPMyAdminBar/Admin/Templates/radios.php
     * 
     * @return void
     */
    final static function get_option()
    {
        return maybe_unserialize( get_option( static::PAGE_SLUG ) );
    }


    /**
     * Update/Reset the Option Data
     * 
     * @value boolean $settings True if the form has been posted
     * @value boolean $reset True if the reset input was selected
     * 
     * @return void
     */
    final static function updateOption( $settings, $reset )
    {
        // Ignore if settings post has not happened
        if ( $settings != "yes" ) { return; }
        if ( $reset != "yes" && $reset != "no" ) { return; }
        if ( false === filter_input( INPUT_POST, 'mymab_nonce' ) ) { return; }

        // Build options array from form post
        if ( $reset == "no" ) { $options_array = static::buildPostArray(); }

        // Reset options array, get option data from settings
        if ( $reset == "yes" ) { $options_array = Settings::$OPTION_DEFAULTS; }

        // Delete cache and option
        delete_transient( "WPMyAdminBar" );
        delete_option( "WPMyAdminBar" );

        // Create the option
        add_option( "WPMyAdminBar", $options_array, '', 'no' );

        // Remove the update action
        remove_action( 'update_option', array( __CLASS__, 'updateOption' ), 1 );
    }


    /**
     * Form Post: Filter Posts from Plugin Admin Area
     * 
     * @return array
     */
    final static function buildPostArray()
    {
        $array = array();

        // Loop through allowed input names for form display
        foreach ( (array) static::$INPUT_NAMES as $value ) {
            // Get the post data based on allowed
            $input_value = filter_input( INPUT_POST, $value );

            // l33t sanitization
            if ( $input_value != "show" && $input_value != "hide" ) { return; }

            // Rebuild array value to use form input values.
            $array[$value] = $input_value;
        }

        // Returned serialized array
        return maybe_serialize( $array );
    }


    /**
     * Loops through and displays the form inputs
     * 
     * @param string $group The group id this block of forms belongs to.
     * @return string
     */
    final static function radioForms( $group )
    {
        // Required
        if ( !isset( $group ) ) { return; }

        // Loop through settings, display form data
        foreach ( (array) Settings::formSettings() as $value ) {
            // Skip WP Icon next to Sites in Menus if not Multisite
            if ( $value['option'] == 'wpicon' && MULTISITE != true ) { return; }

            // Group by group ID number, for display
            if ( $value['group'] == $group )
            {
                // Load the radios template
                // @param array $value from foreach
                echo static::template( 'radios', $value );
            }
        }

        return;
    }


    /**
     * Admin Area Tabs
     * 
     * @return string
     */
    final static function tabs()
    {
        // Get tab=$tab
        $get_tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );

        // Setting Tab Names
        $settings_tab_array = Settings::$TAB_NAMES;

        // Set current displayed tab
        $current = isset( $get_tab ) ? $get_tab : key( $settings_tab_array );

        // Tabs html
        foreach( (array) $settings_tab_array as $tab => $name ) {
            // Current tab class
            $class = ( $tab == $current ) ? ' nav-tab-active' : '';

            // Tab links
            echo '<a href="?page='. static::PAGE_SLUG .'&tab='. $tab .'" class="nav-tab'. $class .'">'. __( $name, 'WPMyAdminBar' ) .'</a>';
        }
    }
}