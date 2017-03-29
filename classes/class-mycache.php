<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }

/**
 * @about My Cache Menu
 * @location classes/class-core.php
 * @call WpMyAdminBar_MyCache::instance();
 * 
 * @method init()           Init Menus
 * @method render()         Render Menu Parts
 * @method websites()       Menu Items | Website Listing
 * @method pluginCheck()    Option Check To Display My Cache Menu
 * @method cachePlugins()   Menu Items | Cache Plugin Links
 * @method instance()       Create Instance
 */
if( ! class_exists( 'WpMyAdminBar_MyCache' ) )
{
    class WpMyAdminBar_MyCache extends WpMyAdminBar_Extended
    {
        // Holds Instance Object
        protected static $instance = NULL;


        /**
         * @about Init Menu
         */
        final public function init()
        {
            add_action( 'admin_bar_menu', array( $this, 'render' ), 34, 0 );
        }


        /**
         * @about Render Menu Parts
         */
        final public function render()
        {
            global $wp_admin_bar;

            // Display Only If Plugin Selected
            if ( $this->pluginCheck() ) {
                // Menu Title - My Cache
                $wp_admin_bar->add_menu( array(
                    'id'    => 'my-cache',
                    'title' => __( 'My Cache', 'wp-my-admin-bar' ),
                    'href'  => false,
                ) );

                // Group - My Cache
                $wp_admin_bar->add_group( array(
                    'parent'    => 'my-cache',
                    'id'        => 'my-cache-group',
                    'meta'      => array( 'class' => 'ab-sub-secondary' )
                ) );

                if ( is_network_admin() ) {
                    // Menu Items | Website Listing
                    $this->websites( $wp_admin_bar );
                } else {
                    // Menu Items | Cache Plugin Links
                    $this->cachePlugins( false, $wp_admin_bar );
                }
            }
        }


        /**
         * @about Menu Items | Website Listing
         * @param object $wp_admin_bar
         */
        final private function websites( $wp_admin_bar )
        {
            foreach ( (array) $wp_admin_bar->user->blogs as $blog ) {
                switch_to_blog( $blog->userblog_id );

                // ption Check To Display My Cache Menu
                if ( ! $this->pluginCheck() ) { continue; }

                // Sub Menu - Websites
                $wp_admin_bar->add_menu( array(
                    'title'     => parent::getBlogname( $blog->blogname, $blog->userblog_id ),
                    'id'        => 'cache' . $blog->userblog_id,
                    'parent'    => 'my-cache-group',
                    'href'      => admin_url()
                ) );

                // Menu Item | Cache Plugin Links
                $this->cachePlugins( $blog->userblog_id, $wp_admin_bar );

                // Restore Website
                restore_current_blog();
            }
        }


        /**
         * @about Option Check To Display My Cache Menu
         */
        final private function pluginCheck()
        {
            if ( parent::option( 'total' ) || 
                parent::option( 'super' ) || 
                parent::option( 'comet' ) || 
                parent::option( 'fastest' ) ||
                parent::option( 'cssminify' ) || 
                parent::option( 'fastvelocity' ) || 
                parent::option( 'wpminify' ) ) {
                    return true;
            }
        }


        /**
         * @about Menu Items | Cache Plugin Links
         * @param int $blog_id ID of Website
         * @param object $wp_admin_bar
         */
        final private function cachePlugins( $blog_id = '', $wp_admin_bar )
        {
            // Menu Item: Total Cache
            if ( parent::option( 'total' ) ) {
                $wp_admin_bar->add_menu( array(
                    'parent'    => ( is_network_admin() ) ? 'cache' . $blog_id : 'my-cache-group',
                    'id'        => 'totalcache' . $blog_id,
                    'title'     => '&bull; ' . __( 'Total Cache', 'wp-my-admin-bar' ),
                    'href'      => ( is_multisite() ) ? network_admin_url( 'admin.php?page=w3tc_dashboard' ) : admin_url( 'admin.php?page=w3tc_dashboard' ),
                ) );
            }

            // Menu Item: Super Cache
            if ( parent::option( 'super' ) ) {
                $wp_admin_bar->add_menu( array(
                    'parent'    => ( is_network_admin() ) ? 'cache' . $blog_id : 'my-cache-group',
                    'id'        => 'supercache' . $blog_id,
                    'title'     => '&bull; ' . __( 'Super Cache', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'options-general.php?page=wpsupercache' ),
                ) );
            }

            // Menu Item: Comet Cache
            if ( parent::option( 'comet' ) ) {
                $wp_admin_bar->add_menu( array(
                    'parent'    => ( is_network_admin() ) ? 'cache' . $blog_id : 'my-cache-group',
                    'id'        => 'comet' . $blog_id,
                    'title'     => '&bull; ' . __( 'Comet Cache', 'wp-my-admin-bar' ),
                    'href'      => ( is_multisite() ) ? network_admin_url( 'admin.php?page=comet_cache' ) : admin_url( 'admin.php?page=comet_cache' ),
                ) );
            }

            // Menu Item: Fastest Cache
            if ( parent::option( 'fastest' ) ) {
                $wp_admin_bar->add_menu( array(
                    'parent'    => ( is_network_admin() ) ? 'cache' . $blog_id : 'my-cache-group',
                    'id'        => 'fastestcache' . $blog_id,
                    'title'     => '&bull; ' . __( 'Fastest Cache', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'admin.php?page=wpfastestcacheoptions' ),
                ) );
            }

            // Menu Item: CSS Minify
            if ( parent::option( 'cssminify' ) ) {
                $wp_admin_bar->add_menu( array(
                    'parent'    => ( is_network_admin() ) ? 'cache' . $blog_id : 'my-cache-group',
                    'id'        => 'cssminify' . $blog_id,
                    'title'     => '&bull; ' . __( 'CSS Minify', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'options-general.php?page=CSS+Minify' ),
                ) );
            }

            // Menu Item: Fast Velocity Minify
            if ( parent::option( 'fastvelocity' ) ) {
                $wp_admin_bar->add_menu( array(
                    'parent'    => ( is_network_admin() ) ? 'cache' . $blog_id : 'my-cache-group',
                    'id'        => 'fastvelocity' . $blog_id,
                    'title'     => '&bull; ' . __( 'Fast Velocity Minify', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'options-general.php?page=fastvelocity-min' ),
                ) );
            }

            // Menu Item: WP Minify Fix
            if ( parent::option( 'wpminify' ) ) {
                $wp_admin_bar->add_menu( array(
                    'parent'    => ( is_network_admin() ) ? 'cache' . $blog_id : 'my-cache-group',
                    'id'        => 'wpminify' . $blog_id,
                    'title'     => '&bull; ' . __( 'WP Minify Fix', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'options-general.php?page=wp-minify-fix' ),
                ) );
            }
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
