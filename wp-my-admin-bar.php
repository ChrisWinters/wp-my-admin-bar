<?php
/**
 * Plugin Name: WP My Admin Bar | Admin Bar
 * Plugin URI: https://github.com/tribalNerd/wp-my-admin-bar
 * Description: The WP My Admin Bar Plugin, replaces and expands the Wordpress Admin Bar, adding a new My Sites menu with extended options, a My Cache menu for quick cache access and My Tools for all WP Developers and Blogger needs.
 * Tags: myadmin, myadminbar, adminbar, admin bar, admin, bar, toolbar, tool bar, my sites, mysites, tools, cache, multisite, webtools, web tools, technerdia
 * Version: 2.0.0
 * License: GNU GPLv3
 * Copyright (c) 2017 Chris Winters
 * Author: tribalNerd, Chris Winters
 * Author URI: http://techNerdia.com/
 * Text Domain: wp-my-admin-bar
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }


/**
 * @about Define Constants
 */
if( function_exists( 'WpMyAdminBarConstants' ) )
{
    WpMyAdminBarConstants( Array(
        'WP_MY_ADMIN_BAR_BASE_URL'          => get_bloginfo( 'url' ),
        'WP_MY_ADMIN_BAR_VERSION'           => '2.0.0',
        'WP_MY_ADMIN_BAR_WP_MIN_VERSION'    => '3.8',

        'WP_MY_ADMIN_BAR_PLUGIN_FILE'       => __FILE__,
        'WP_MY_ADMIN_BAR_PLUGIN_DIR'        => dirname( __FILE__ ),
        'WP_MY_ADMIN_BAR_PLUGIN_BASE'       => plugin_basename( __FILE__ ),

        'WP_MY_ADMIN_BAR_MENU_NAME'         => __( 'My Admin Bar', 'wp-my-admin-bar' ),
        'WP_MY_ADMIN_BAR_PAGE_NAME'         => __( 'WP My Admin Bar', 'wp-my-admin-bar' ),
        'WP_MY_ADMIN_BAR_OPTION_NAME'       => 'wpmyadminbar_',
        'WP_MY_ADMIN_BAR_PLUGIN_NAME'       => 'wp-my-admin-bar',

        'WP_MY_ADMIN_BAR_CLASSES'           => dirname( __FILE__ ) .'/classes',
        'WP_MY_ADMIN_BAR_TEMPLATES'         => dirname( __FILE__ ) .'/templates'
    ) );
}


/**
 * @about Loop Through Constants
 */
function WpMyAdminBarConstants( $constants_array )
{
    foreach( $constants_array as $name => $value ) {
        define( $name, $value, true );
    }
}


/**
 * @about Register Classes & Include
 */
spl_autoload_register( function ( $class )
{
    if( strpos( $class, 'WpMyAdminBar_' ) !== false ) {
        $class_name = str_replace( 'WpMyAdminBar_', "", $class );

        // If the Class Exists, Include the Class
        if( file_exists( WP_MY_ADMIN_BAR_CLASSES .'/class-'. strtolower( $class_name ) .'.php' ) ) {
            include_once( WP_MY_ADMIN_BAR_CLASSES .'/class-'. strtolower( $class_name ) .'.php' );
        }
    }
} );


/**
 * @about Run Plugin
 */
if( ! class_exists( 'wp_my_admin_bar' ) )
{
    class wp_my_admin_bar
    {
        // Holds Instance Object
        protected static $instance = NULL;


        /**
         * @about Initiate Plugin
         */
        final public function init()
        {
            // Activate Plugin
            register_activation_hook( __FILE__, array( $this, 'activate' ) );

            // Inject Plugin Links
            add_filter( 'plugin_row_meta', array( $this, 'links' ), 10, 2 );

            // Load Admin Area
            WpMyAdminBar_AdminArea::instance();

            // Manage Settings
            WpMyAdminBar_Settings::instance();

            // Manage Form Posts Outside of Settings
            WpMyAdminBar_Process::instance();

            // Core Admin Bar Manager
            WpMyAdminBar_Core::instance();
        }


        /**
         * @about Activate Plugin
         */
        final public function activate()
        {
            // Wordpress Version Check
            global $wp_version;

            // Version Check
            if( version_compare( $wp_version, WP_MY_ADMIN_BAR_WP_MIN_VERSION, "<" ) ) {
                wp_die( __( '<b>Activation Failed</b>: The ' . WP_MY_ADMIN_BAR_PAGE_NAME . ' plugin requires WordPress version ' . WP_MY_ADMIN_BAR_WP_MIN_VERSION . ' or higher. Please Upgrade Wordpress, then try activating this plugin again.', 'wp-my-admin-bar' ) );
            }
        }


        /**
         * @about Inject Links Into Plugin Admin
         * @param array $links Default links for this plugin
         * @param string $file The name of the plugin being displayed
         * @return array $links The links to inject
         */
        final public function links( $links, $file )
        {
            // Get Current URL
            $request_uri = filter_input( INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL );

            // Links To Inject
            if ( $file == WP_MY_ADMIN_BAR_PLUGIN_BASE && strpos( $request_uri, "plugins.php" ) !== false ) {
                $links[] = '<a href="options-general.php?page=' . WP_MY_ADMIN_BAR_PLUGIN_NAME . '">'. __( 'Website Settings', 'wp-my-admin-bar' ) .'</a>';
                $links[] = '<a href="http://technerdia.com/wpmab/#faq" target="_blank">'. __( 'F.A.Q.', 'wp-my-admin-bar' ) .'</a>';
                $links[] = '<a href="http://technerdia.com/help/" target="_blank">'. __( 'Support', 'wp-my-admin-bar' ) .'</a>';
                $links[] = '<a href="http://technerdia.com/feedback/" target="_blank">'. __( 'Feedback', 'wp-my-admin-bar' ) .'</a>';
                $links[] = '<a href="http://technerdia.com/donate/" target="_blank">'. __( 'Donations', 'wp-my-admin-bar' ) .'</a>';
                $links[] = '<a href="http://technerdia.com/wpmab/" target="_blank">'. __( 'PRO Details', 'wp-my-admin-bar' ) .'</a>';
            }

            return $links;
        }


        /**
        * @about Create Instance
        */
        final public static function instance()
        {
            if ( ! self::$instance ) {
                self::$instance = new self();
                self::$instance->init();
            }

            return self::$instance;
        }
    }
}

add_action( 'after_setup_theme', array( 'wp_my_admin_bar', 'instance' ), 0 );
