<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }

/**
 * @about Manager Class
 * @location classes/wp-my-admin-bar.php
 * @call WpMyAdminBar_Core::instance();
 * 
 * @method init()           Set Parent Variables
 * @method enqueue()        Public Admin Bar Styles
 * @method removeItems()    Remove Menu Items
 * @method adminbar()       Remove Admin Bar Backend
 * @method removeStyles()   Add CSS to Remove Admin Bar
 * @method instance()       Class Instance
 */
if( ! class_exists( 'WpMyAdminBar_Core' ) )
{
    class WpMyAdminBar_Core extends WpMyAdminBar_Extended
    {
        // Holds Instance Object
        protected static $instance = NULL;

        // Item Names For Removal
        protected $removes = array(
            'site-name',
            'my-account',
            'user-actions',
            'user-info',
            'edit-profile',
            'logout',
            'updates',
            'new-content',
            'comments',
            'search',
            'wp-logo'
        );


        /**
         * @about Core Admin Bar Manager
         */
        final public function init()
        {
            if ( parent::option( 'disable' ) ) { return; }

            // Public Admin Bar CSS
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

            // Remove Admin Bar From Backend
            if ( parent::option( 'backend' ) ) {
                add_action( 'admin_init', array( $this, 'adminbar' ) );
            }

            // Remove Admin Bar From Frontend
            if ( parent::option( 'frontend' ) ) {
                add_filter( 'show_admin_bar', '__return_false' );
            }

            // Unique Items To Remove
            add_action( 'wp_before_admin_bar_render', array( $this, 'removeItems' ), 0 );

            // Render My Sites Menu
            if ( parent::option( 'mysites' ) ) {
                WpMyAdminBar_MySites::instance();
            }

            // Render My Cache Menu
            if ( parent::option( 'mycache' ) ) {
                WpMyAdminBar_MyCache::instance();
            }

            // Render My Tools Menu
            if ( parent::option( 'mytools' ) ) {
                WpMyAdminBar_MyTools::instance();
            }
        }


        /**
         * @about Public Admin Bar Styles
         */
        final public function enqueue()
        {
            wp_enqueue_style( 'wpmyadminbar', plugins_url( '/assets/style.css', $this->plugin_file ), '', $this->plugin_version, 'all' );
        }


        /**
         * @about Remove Menu Items
         */
        final public function removeItems()
        {
            global $wp_admin_bar;

            // Authorized Item Names For Removal
            foreach ( (array) $this->removes as $item ) {
                // If Option Is Set, Remove Item
                if ( parent::option( $item ) ) {
                    $wp_admin_bar->remove_menu( $item );
                }
            }

            // Only Multisite Networks has default My Sites
            if ( function_exists('is_multisite') && is_multisite() ) {
                // Remove default my-sites menu, if Custom My Sites is showing
                if ( parent::option( 'mysites' ) ) {
                    $wp_admin_bar->remove_menu('my-sites');
                }
            }
        }


        /**
         * @about Remove Admin Bar Backend
         */
        final public function adminbar()
        {
            wp_deregister_script( 'admin-bar' );
            wp_deregister_style( 'admin-bar' );
            remove_action( 'init', '_wp_admin_bar_init' );
            remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 );
            remove_action( 'admin_footer', 'wp_admin_bar_render', 1000 );
            add_filter( 'admin_head', array( $this, 'removeStyles' ) );
        }


        /**
         * @about Add CSS to Remove Admin Bar
         */
        final public function removeStyles()
        {
            echo '<style type="text/css">'
                . '#wpadminbar { display:none; }'
                . 'html.wp-toolbar { padding-top: 0px; }'
                . ' @media screen and (max-width: 782px) { html.wp-toolbar { padding-top: 0px; }'
                . '</style>';
        }


        /**
         * @about Create Instance
         */
        public static function instance()
        {
            if ( ! self::$instance ) {
                self::$instance = new self();
                self::$instance->init();
            }

            return self::$instance;
        }
    }
}
