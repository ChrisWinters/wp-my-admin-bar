<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }

/**
 * @about Process Form Updates
 * @location classes/wp-my-admin-bar.php
 * @call WpMyAdminBar_Process::instance();
 * 
 * @method init()           Start Admin Bar Manager
 * @method networkSave()    Save Network Array Option
 * @method updateGlobal()   Update Options On All Network Websites
 * @method qString()        Get Query String Item
 * @method message()        Display Messages To User
 * @method updateWebsite()  Update Website
 * @method deleteNetwork()  Delete All Settings Across Network
 * @method updateNetwork()  Update Network
 * @method manageNetwork()  Enable/Disable/Delete Network
 * @method instance()       Create Instance
 */
if( ! class_exists( 'WpMyAdminBar_Process' ) )
{
    class WpMyAdminBar_Process extends WpMyAdminBar_Extended
    {
        // Holds Instance Object
        protected static $instance = NULL;


        /**
         * @about Start Admin Bar Manager
         */
        final public function init()
        {
            // Process Plugin Disable/Enable, Delete Settings
            if ( filter_input( INPUT_POST, 'type' ) && parent::qString( 'page' ) == $this->plugin_name ) {
                // Form Security Check
                parent::validate();

                if ( is_network_admin() ) {
                    add_action( 'admin_init', array( $this, 'updateNetwork') );
                } else {
                    add_action( 'admin_init', array( $this, 'updateWebsite') );
                }
            }

            // Global Option Update
            add_action( 'network_admin_edit_wpmyadminbar', array( $this, 'networkSave' ), 10, 0 );
        }


        /**
         * @about Save Network Array Option
         */
        final public function networkSave()
        {
            // Form Security Check
            parent::validate();

            // Get Post
            $post = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );

            // Delete Site Option
            if ( empty( $post['network'] ) ) {
                delete_option( $this->option_name . 'network' );
            }

            // Update Site Option
            if ( ! empty( $post['network'] ) ) {
                update_option( $this->option_name . 'network', $post['network'] );
            }
 
            $this->updateGlobal( $post['network'] );
        }


        /**
         * @about Update Options On All Network Websites
         * @param array $post Network Array of Saved Options
         */
        final public function updateGlobal( $post )
        {

            global $wpdb;

            // Get blog ID's
            $site_list = $wpdb->get_results( "SELECT blog_id FROM $wpdb->blogs WHERE public = '1' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted = '0' ORDER BY blog_id" );

            // Update Network
            foreach ( $site_list as $site ) {
                // Swich To Current Website
                switch_to_blog( $site->blog_id );

                // Update Admin Bar Settings
                if ( isset( $post['wpmyadminbar_frontend'] ) ) { update_option( $this->option_name . 'frontend', true ); } else { delete_option( $this->option_name . 'frontend' ); }
                if ( isset( $post['wpmyadminbar_backend'] ) ) { update_option( $this->option_name . 'frontend', true ); } else { delete_option( $this->option_name . 'frontend' ); }

                // Update My Sites Settings
                if ( isset( $post['wpmyadminbar_mysites'] ) ) { update_option( $this->option_name . 'mysites', true ); } else { delete_option( $this->option_name . 'mysites' ); }
                if ( isset( $post['wpmyadminbar_siteids'] ) ) { update_option( $this->option_name . 'siteids', true ); } else { delete_option( $this->option_name . 'siteids' ); }
                if ( isset( $post['wpmyadminbar_site-name'] ) ) { update_option( $this->option_name . 'site-name', true ); } else { delete_option( $this->option_name . 'site-name' ); }

                // Update My Cache Settings
                if ( isset( $post['wpmyadminbar_mycache'] ) ) { update_option( $this->option_name . 'mycache', true ); } else { delete_option( $this->option_name . 'mycache' ); }
                if ( isset( $post['wpmyadminbar_total'] ) ) { update_option( $this->option_name . 'total', true ); } else { delete_option( $this->option_name . 'total' ); }
                if ( isset( $post['wpmyadminbar_super'] ) ) { update_option( $this->option_name . 'super', true ); } else { delete_option( $this->option_name . 'super' ); }
                if ( isset( $post['wpmyadminbar_comet'] ) ) { update_option( $this->option_name . 'comet', true ); } else { delete_option( $this->option_name . 'comet' ); }
                if ( isset( $post['wpmyadminbar_fastest'] ) ) { update_option( $this->option_name . 'fastest', true ); } else { delete_option( $this->option_name . 'fastest' ); }
                if ( isset( $post['wpmyadminbar_cssminify'] ) ) { update_option( $this->option_name . 'cssminify', true ); } else { delete_option( $this->option_name . 'cssminify' ); }
                if ( isset( $post['wpmyadminbar_wpminify'] ) ) { update_option( $this->option_name . 'wpminify', true ); } else { delete_option( $this->option_name . 'wpminify' ); }
                if ( isset( $post['wpmyadminbar_fastvelocity'] ) ) { update_option( $this->option_name . 'fastvelocity', true ); } else { delete_option( $this->option_name . 'fastvelocity' ); }

                // Update My Tools Settings
                if ( isset( $post['wpmyadminbar_mytools'] ) ) { update_option( $this->option_name . 'mytools', true ); } else { delete_option( $this->option_name . 'mytools' ); }

                // Update Howdy Settings
                if ( isset( $post['wpmyadminbar_my-account'] ) ) { update_option( $this->option_name . 'my-account', true ); } else { delete_option( $this->option_name . 'my-account' ); }
                if ( isset( $post['wpmyadminbar_user-actions'] ) ) { update_option( $this->option_name . 'user-actions', true ); } else { delete_option( $this->option_name . 'user-actions' ); }
                if ( isset( $post['wpmyadminbar_user-info'] ) ) { update_option( $this->option_name . 'user-info', true ); } else { delete_option( $this->option_name . 'user-info' ); }
                if ( isset( $post['wpmyadminbar_edit-profile'] ) ) { update_option( $this->option_name . 'edit-profile', true ); } else { delete_option( $this->option_name . 'edit-profile' ); }
                if ( isset( $post['wpmyadminbar_logout'] ) ) { update_option( $this->option_name . 'logout', true ); } else { delete_option( $this->option_name . 'logout' ); }

                // Update Other Settings
                if ( isset( $post['wpmyadminbar_updates'] ) ) { update_option( $this->option_name . 'updates', true ); } else { delete_option( $this->option_name . 'updates' ); }
                if ( isset( $post['wpmyadminbar_new-content'] ) ) { update_option( $this->option_name . 'new-content', true ); } else { delete_option( $this->option_name . 'new-content' ); }
                if ( isset( $post['wpmyadminbar_comments'] ) ) { update_option( $this->option_name . 'comments', true ); } else { delete_option( $this->option_name . 'comments' ); }
                if ( isset( $post['wpmyadminbar_search'] ) ) { update_option( $this->option_name . 'search', true ); } else { delete_option( $this->option_name . 'search' ); }

                // Update Logo Settings
                if ( isset( $post['wpmyadminbar_wp-logo'] ) ) { update_option( $this->option_name . 'wp-logo', true ); } else { delete_option( $this->option_name . 'wp-logo' ); }
                if ( isset( $post['wpmyadminbar_wpicon'] ) ) { update_option( $this->option_name . 'wpicon', true ); } else { delete_option( $this->option_name . 'wpicon' ); }
    
                // Restore Website
                restore_current_blog();
            }

            // Redirect To Admin
            wp_redirect( add_query_arg( array( 'page' => $this->plugin_name, 'updated' => 'true' ), network_admin_url( 'settings.php' ) ) );
            exit();
        }

        /**
         * @about Display Messages To User
         * @param string $slug Which switch to load
         * @param string $notice_type Either updated/error
         */
        final public function message( $slug, $notice_type = false )
        {
            // Clear Message
            $message = '';

            // Message Switch
            switch ( $slug ) {
                case 'websiteenable':
                    $message = __( '<u>Website Enabled</u>: Please <a href="javascript:window.location.reload(true)">refresh</a> to update the admin bar view.', 'wp-my-admin-bar' );
                break;

                case 'websitedisable':
                    $message = __( '<u>Website Disabled</u>: Please <a href="javascript:window.location.reload(true)">refresh</a> to update the admin bar view.', 'wp-my-admin-bar' );
                break;

                case 'websitedelete':
                    $message = __( '<u>Website Settings Deleted</u>: All WP My Admin Bar settings have been deleted on this website.', 'wp-my-admin-bar' );
                break;

                case 'networkenable':
                    $message = __( '<u>Network Enabled</u>: Please <a href="javascript:window.location.reload(true)">refresh</a> to update the admin bar view.', 'wp-my-admin-bar' );
                break;

                case 'networkdisable':
                    $message = __( '<u>Network Disabled</u>: Please <a href="javascript:window.location.reload(true)">refresh</a> to update the admin bar view.', 'wp-my-admin-bar' );
                break;

                case 'networkdelete':
                    $message = __( '<u>Network Settings Deleted</u>: All settings related to the WP My Admin Bar plugin have been deleted.', 'wp-my-admin-bar' );
                break;
            }

            // Throw Message
            if ( ! empty( $message ) ) {
                // Set Message Type, Default Error
                $type = ( $notice_type == "updated" ) ? "updated" : "error";

                // Return Message
                add_settings_error( $slug, $slug, $message, $type );
            }
        }


        /**
         * @about Update Website
         */
        final public function updateWebsite()
        {

            // Enable Plugin
            if ( filter_input( INPUT_POST, 'type' ) == "enable" ) {
                delete_option( $this->option_name . 'disable' );
 
                // Display Message
                $this->message( 'websiteenable', 'updated' );
            }

            // Disable Plugin
            if ( filter_input( INPUT_POST, 'type' ) == "disable" ) {
                update_option( $this->option_name . 'disable', true );
 
                // Display Message
                $this->message( 'websitedisable', 'updated' );
            }

            // Delete Settings
            if ( filter_input( INPUT_POST, 'type' ) == "delete" ) {
                foreach( wp_load_alloptions() as $option => $value ) {
                    if ( strpos( $option, $this->option_name ) === 0 ) {
                        delete_option( $option );
                    }
                }

                // Display Message
                $this->message( 'websitedelete', 'updated' );
            }
        }


        /**
         * @about Delete All Settings Across Network
         */
        final private function deleteNetwork()
        {
            // Switch to root website
            switch_to_blog( '1' );

            // Delete Options
            foreach( wp_load_alloptions() as $option => $value ) {
                if ( strpos( $option, $this->option_name ) === 0 ) {
                    delete_option( $option );
                }
            }

            global $wpdb;

            // Get blog ID's
            $site_list = $wpdb->get_results( "SELECT blog_id FROM $wpdb->blogs WHERE public = '1' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted = '0' ORDER BY blog_id" );

            // Update Network
            foreach ( $site_list as $site ) {
                // Ignore If Site Empty
                if ( empty( $site ) ) { continue; }

                // Switch To Each Website
                switch_to_blog( $site->blog_id );

                // Delete Options
                foreach( wp_load_alloptions() as $option => $value ) {
                    if ( strpos( $option, $this->option_name ) === 0 ) {
                        delete_option( $option );
                    }
                }

                // Return To Root Site
                restore_current_blog();
            }
 
            // Display Message
            parent::message( 'networkdelete', 'updated' );
        }


        /**
         * @about Update Network
         */
        final public function updateNetwork()
        {
            // Enable Plugin
            if ( filter_input( INPUT_POST, 'type' ) == "enable" ) {
                delete_option( $this->option_name . 'disable' );

                $this->manageNetwork( 'enable' );
            }

            // Disable Plugin
            if ( filter_input( INPUT_POST, 'type' ) == "disable" ) {
                update_option( $this->option_name . 'disable', true );

                $this->manageNetwork( 'disable' );
            }

            // Delete Settings
            if ( filter_input( INPUT_POST, 'type' ) == "delete" ) {
                $this->manageNetwork( 'delete' );
            }
        }


        /**
         * @about Enable/Disable/Delete Network
         */
        final private function manageNetwork( $action )
        {
            // Switch to root website
            switch_to_blog( '1' );

            global $wpdb;

            // Get blog ID's
            $site_list = $wpdb->get_results( "SELECT blog_id FROM $wpdb->blogs WHERE public = '1' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted = '0' ORDER BY blog_id" );

            // Update Network
            foreach ( $site_list as $site ) {
                // Ignore If Site Empty
                if ( empty( $site ) ) { continue; }

                // Switch To Each Website
                switch_to_blog( $site->blog_id );

                // Enable Network
                if ( $action == 'enable' ) {
                    delete_option( $this->option_name . 'disable' );
                }

                // Disable Network
                if ( $action == 'disable' ) {
                    update_option( $this->option_name . 'disable', true );
                }

                // Delete Network Options
                if ( $action == 'delete' ) {
                    foreach( wp_load_alloptions() as $option => $value ) {
                        if ( strpos( $option, $this->option_name ) === 0 ) {
                            delete_option( $option );
                        }
                    }
                }

                // Return To Root Site
                restore_current_blog();
            }

            // Enable Network
            if ( $action == 'enable' ) {
                // Display Message
                $this->message( 'networkenable', 'updated' );
            }

            // Disable Network
            if ( $action == 'disable' ) {
                // Display Message
                $this->message( 'networkdisable', 'updated' );
            }

            // Delete Network Options
            if ( $action == 'delete' ) {
                // Display Message
                $this->message( 'networkdelete', 'updated' );
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
