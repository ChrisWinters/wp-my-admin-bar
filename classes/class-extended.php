<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }

/**
 * @about Manager Class
 * 
 * @method __construct()    Set Parent Variables
 * @method option()         Get Saved Option Data For Inputs/Display
 * @method field()          Fields for network.php
 * @method getBlogname()    Build Blogname
 * @method qString()        Get Query String Item
 * @method validate()       Form Validation
 */
if( ! class_exists( 'WpMyAdminBar_Extended' ) )
{
    class WpMyAdminBar_Extended
    {
        // Website URL
        public $base_url;

        // The plugin-slug-name
        public $plugin_name;
        
        // Plugin Page Title
        public $plugin_title;
        
        // Plugin filename.php
        public $plugin_file;
        
        // Current Plugin Version
        public $plugin_version;
        
        // Plugin Menu Name
        public $menu_name;
        
        // Path To Plugin Templates
        public $templates;

        // Base Option Name
        public $option_name;


        /**
         * @about Set Class Vars
         */
        function __construct()
        {
            // Set Vars
            $this->base_url         = WP_MY_ADMIN_BAR_BASE_URL;
            $this->plugin_name      = WP_MY_ADMIN_BAR_PLUGIN_NAME;
            $this->plugin_title     = WP_MY_ADMIN_BAR_PAGE_NAME;
            $this->plugin_file      = WP_MY_ADMIN_BAR_PLUGIN_FILE;
            $this->plugin_version   = WP_MY_ADMIN_BAR_VERSION;
            $this->menu_name        = WP_MY_ADMIN_BAR_MENU_NAME;
            $this->templates        = WP_MY_ADMIN_BAR_TEMPLATES;
            $this->option_name      = WP_MY_ADMIN_BAR_OPTION_NAME;
        }


        /**
         * @about Get Saved Option Data For Inputs/Display
         * @call echo $this->option( 'frontend' );
         * @param string $option The Option Name
         */
        final public function option( $option = '' )
        {
            return get_option( $this->option_name . $option );
        }


        /**
         * @about Fields for network.php
         * @call echo $this->field( 'frontend' );
         * @param string $option The Option Name
         */
        final public function field( $option = '' )
        {
            $data = get_option( $this->option_name . 'network' );
            return ( isset( $data[$this->option_name . $option] ) ) ? $data[$this->option_name . $option] : '';
        }


        /**
         * @about Build Blogname
         */
        final public function getBlogname( $blogname, $blog_id )
        {
            // Hide WP Icon & Hide Site ID's, return default blogname
            if ( $this->option( 'wpicon' ) && ! $this->option( 'siteids' ) ) { $title = $blogname; }

            // Hide WP Icon & Show Site ID's
            if ( $this->option( 'wpicon' ) && $this->option( 'siteids' ) ) { $title = '('. $blog_id .') '. $blogname; }

            // Show WP Icon & Show Site ID's
            if ( ! $this->option( 'wpicon' ) && $this->option( 'siteids' ) ) { $title = '<div class="blavatar"></div>' .'('. $blog_id .') '. $blogname; }

            // Show WP Icon & Hide Site ID's
            if ( ! $this->option( 'wpicon' ) && ! $this->option( 'siteids' ) ) { $title = '<div class="blavatar"></div>' . $blogname; }

            // Return New Title
            return $title;
        }


        /**
         * @about Get Query String Item
         * @param string $get Query String Get Item
         * @return string Query String Item Sanitized
         */
        final public function qString( $get )
        {
            // Lowercase & Sanitize String
            $filter = strtolower( filter_input( INPUT_GET, $get, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK ) );

            // Return No Spaces/Tabs, Stripped/Cleaned String
            return sanitize_text_field( preg_replace( '/\s/', '', $filter ) );
        }


        /**
         * @about Form Validation
         */
        final public function validate()
        {
            // Plugin Admin Area Only
            if ( filter_input( INPUT_POST, 'type' ) && filter_input( INPUT_GET, 'page', FILTER_UNSAFE_RAW ) != $this->plugin_name ) {
                wp_die( __( 'You are not authorized to perform this action.', 'wp-my-admin-bar' ) );
            }

            // Validate Nonce Action
            if( ! check_admin_referer( $this->option_name . 'action', $this->option_name . 'nonce' ) ) {
                wp_die( __( 'You are not authorized to perform this action.', 'wp-my-admin-bar' ) );
            }
        }
    }
}
