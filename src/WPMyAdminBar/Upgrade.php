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
 * Upgrade the WP My Admin Bar
 *
 * @since 1.0.0
 */
class Upgrade
{
    final public static function start()
    {
        if ( get_option( 'wp_myadminbar' ) )
        {
            $wp_myadminbar = unserialize( get_option( 'wp_myadminbar' ) );
            $old_my_sites = $wp_myadminbar['my_sites'];
            $old_my_cache = $wp_myadminbar['my_cache'];
            $old_my_tools = $wp_myadminbar['my_tools'];
        }

        if ( get_option( 'wp_mycache' ) )
        {
            $wp_mycache = unserialize( get_option( 'wp_mycache' ) );
            
            $old_dbcache = $wp_mycache['dbcache'];
            $old_widget = $wp_mycache['widget'];
            $old_minify = $wp_mycache['minify'];
            $old_super = $wp_mycache['super'];
            $old_total = $wp_mycache['total'];

        }

        if ( get_option( 'wp_mycustom' ) )
        {
            $wp_mycache = unserialize( get_option( 'wp_mycustom' ) );
            
            $old_wplogo = $wp_mycache['wplogo'];
            $old_howdy = $wp_mycache['howdy'];
            $old_wpicon = $wp_mycache['wpicon'];
            $old_siteids = $wp_mycache['siteids'];

        }

        if ( get_option( 'WPMyAdminBar' ) )
        {
            $WPMyAdminBar = unserialize( get_option( 'WPMyAdminBar' ) );
        }

        // Array Values
        $my_sites = ( empty( $old_my_sites ) ) ? $WPMyAdminBar['my-sites'] : $old_my_sites;
        $siteids = ( empty( $old_siteids ) ) ? $WPMyAdminBar['siteids'] : $old_siteids;
        $my_cache = ( empty( $old_my_cache ) ) ? $WPMyAdminBar['my-cache'] : $old_my_cache;
        $dbcache = ( empty( $old_dbcache ) ) ? $WPMyAdminBar['dbcache'] : $old_dbcache;
        $super = ( empty( $old_super ) ) ? $WPMyAdminBar['super'] : $old_super;
        $total = ( empty( $old_total ) ) ? $WPMyAdminBar['total'] : $old_total;
        $widget = ( empty( $old_widget ) ) ? $WPMyAdminBar['widget'] : $old_widget;
        $minify = ( empty( $old_minify ) ) ? $WPMyAdminBar['minify'] : $old_minify;
        $my_tools = ( empty( $old_my_tools ) ) ? $WPMyAdminBar['my-tools'] : $old_my_tools;
        $my_account = ( empty( $old_howdy ) ) ? $WPMyAdminBar['my-account'] : $old_howdy;
        $wp_logo = ( empty( $old_wplogo ) ) ? $WPMyAdminBar['wp-logo'] : $old_wplogo;
        $wpicon = ( empty( $old_wpicon ) ) ? $WPMyAdminBar['wpicon'] : $old_wpicon;

        // Option Array
        $options_array = array(
            'admin-bar-front'   => $WPMyAdminBar['admin-bar-front'],
            'admin-bar-admin'   => $WPMyAdminBar['admin-bar-admin'],

            'my-sites'          => $my_sites,
            'siteids'           => $siteids,
            'site-name'         => $WPMyAdminBar['site-name'],

            'my-cache'          => $my_cache,
            'dbcache'           => $dbcache,
            'super'             => $super,
            'total'             => $total,
            'widget'            => $widget,
            'minify'            => $minify,

            'my-tools'          => $my_tools,

            'my-account'        => $my_account,
            'user-actions'      => $WPMyAdminBar['user-actions'],
            'user-info'         => $WPMyAdminBar['user-info'],
            'edit-profile'      => $WPMyAdminBar['edit-profile'],
            'logout'            => $WPMyAdminBar['logout'],

            'updates'           => $WPMyAdminBar['updates'],
            'new-content'       => $WPMyAdminBar['new-content'],
            'comments'          => $WPMyAdminBar['comments'],
            'search'            => $WPMyAdminBar['search'],

            'wp-logo'           => $wp_logo,
            'wpicon'            => $wpicon
        );

        // Multisite else Standalone
        if ( function_exists('is_multisite') && is_multisite() )
        {
            global $wpdb;

            // Get blog ID's
            $blog_id_list = $wpdb->get_results( 'SELECT blog_id FROM '. $wpdb->blogs .'  ORDER BY blog_id' );

            // Loop through sites
            foreach ( $blog_id_list as $blog_id ) {
                if ( empty( $blog_id ) ) { continue; }
                
                // Multisite Switch Blog ID's
                switch_to_blog( $blog_id );

                // Delete current cache and option
                delete_transient( 'WPMyAdminBar' );
                delete_site_transient( 'multisite_site_list' );
                delete_option( 'WPMyAdminBar' );

                // Delete old cache and options
                delete_transient( 'multisite_site_list' );
                delete_site_transient( 'multisite_site_list' );
                delete_option( 'wp_myadminbar' );
                delete_option( 'wp_mycache' );
                delete_option( 'wp_mycustom' );

                // Rebuild Option
                add_option( 'WPMyAdminBar', serialize( $options_array ), '', 'no' );
            }

            // Return to original blog
            restore_current_blog();
	} else {
            // Delete current cache and option
            delete_transient( 'WPMyAdminBar' );
            delete_site_transient( 'multisite_site_list' );
            delete_option( 'WPMyAdminBar' );

            // Delete old cache and options
            delete_transient( 'multisite_site_list' );
            delete_site_transient( 'multisite_site_list' );
            delete_option( 'wp_myadminbar' );
            delete_option( 'wp_mycache' );
            delete_option( 'wp_mycustom' );

            // Rebuild Option
            add_option( 'WPMyAdminBar', serialize( $options_array ), '', 'no' );
        }
    }
}