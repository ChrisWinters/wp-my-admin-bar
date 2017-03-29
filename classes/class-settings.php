<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }


/**
 * @about Admin Area Settings
 * @location wp-my-admin-bar.php
 * @call WpMyAdminBar_Settings::instance();
 *
 * @method init()           Start Form Settings
 * @method sections()       Add Setting Sections
 * @method fields()         Add Setting Fields
 * @method instance()       Create Instance
 * @method settings()       Register Settings
 * @method adminbarAbout()  Section Description
 * @method mysitesAbout()   Section Description
 * @method mytoolsAbout()   Section Description
 * @method howdyAbout()     Section Description
 * @method otherAbout()     Section Description
 * @method logosAbout()     Section Description
 * @method cbFrontend()     Display Checkbox
 * @method cbBackend()      Display Checkbox
 * @method cbMysites()      Display Checkbox
 * @method cbSiteids()      Display Checkbox
 * @method cbLocalsite()    Display Checkbox
 * @method cbMycache()      Display Checkbox
 * @method cbTotalcache()   Display Checkbox
 * @method cbSupercache()   Display Checkbox
 * @method cbComet()        Display Checkbox
 * @method cbFastestcache() Display Checkbox
 * @method cbCssminify()    Display Checkbox
 * @method cbFastvelocity() Display Checkbox
 * @method cbWpminify()     Display Checkbox
 * @method cbMyTools()      Display Checkbox
 * @method cbHowdy()        Display Checkbox
 * @method cbHowdydrop()    Display Checkbox
 * @method cbAvataruser()   Display Checkbox
 * @method cbEditlink()     Display Checkbox
 * @method cbLogout()       Display Checkbox
 * @method cbUpdates()      Display Checkbox
 * @method cbContent()      Display Checkbox
 * @method cbComments()     Display Checkbox
 * @method cbSearch()       Display Checkbox
 * @method cbWplogo()       Display Checkbox
 * @method cbwpicon()       Display Checkbox
 * @method sanitizeCb()     Sanitize Checkbox
 * @method instance()       Create Instance
 */
if ( ! class_exists( 'WpMyAdminBar_Settings' ) )
{
    class WpMyAdminBar_Settings extends WpMyAdminBar_Extended
    {
        // Holds Instance Object
        protected static $instance = NULL;


        /**
         * @about Start Form Settings
         */
        final public function init()
        {
            add_action( 'admin_init', array( $this, 'sections' ) );
            add_action( 'admin_init', array( $this, 'fields' ) );
            add_action( 'admin_init', array( $this, 'settings' ) );
        }


        /**
         * @about Add Setting Sections
         * @args $id, $title, $callback, $page
         * @codex https://codex.wordpress.org/Function_Reference/add_settings_section
         */
        final public function sections()
        {
            add_settings_section( 'adminbar_section', __( 'Default Admin Bar Display', 'wp-my-admin-bar' ), array( $this, 'adminbarAbout' ), 'adminbar_group' );
            add_settings_section( 'mysites_section', __( 'My Sites / Sites Menu', 'wp-my-admin-bar' ), array( $this, 'mysitesAbout' ), 'mysites_group' );
            add_settings_section( 'mycache_section', __( 'My Cache Menu & Plugins', 'wp-my-admin-bar' ), array( $this, 'mycacheAbout' ), 'mycache_group' );
            add_settings_section( 'mytools_section', __( 'My Tools Menu', 'wp-my-admin-bar' ), array( $this, 'mytoolsAbout' ), 'mytools_group' );
            add_settings_section( 'howdy_section', __( 'Howdy Menu / My Account Items', 'wp-my-admin-bar' ), array( $this, 'howdyAbout' ), 'howdy_group' );
            add_settings_section( 'other_section', __( 'Other Menu Items', 'wp-my-admin-bar' ), array( $this, 'otherAbout' ), 'other_group' );
            add_settings_section( 'logos_section', __( 'Wordpress Logo', 'wp-my-admin-bar' ), array( $this, 'logosAbout' ), 'logos_group' );
        }


        /**
         * @about Add Setting Fields
         * @args $id, $title, $callback, $page, $section, $args
         * @codex https://codex.wordpress.org/Function_Reference/add_settings_field
         */
        final public function fields()
        {
            add_settings_field( $this->option_name . 'frontend', __( 'Admin Bar on Frontend', 'wp-my-admin-bar' ), array( $this, 'cbFrontend' ), 'adminbar_group', 'adminbar_section' );
            add_settings_field( $this->option_name . 'backend', __( 'Admin Bar on Backend', 'wp-my-admin-bar' ), array( $this, 'cbBackend' ), 'adminbar_group', 'adminbar_section' );

            add_settings_field( $this->option_name . 'mysites', __( 'Custom My Sites Menu', 'wp-my-admin-bar' ), array( $this, 'cbMySites' ), 'mysites_group', 'mysites_section' );
            if ( is_multisite() ) {
                add_settings_field( $this->option_name . 'siteids', __( 'Site Ids Next To Site Names', 'wp-my-admin-bar' ), array( $this, 'cbSiteids' ), 'mysites_group', 'mysites_section' );
            }
            add_settings_field( $this->option_name . 'site-name', __( 'Local/Current Site Menu', 'wp-my-admin-bar' ), array( $this, 'cbLocalsite' ), 'mysites_group', 'mysites_section' );

            add_settings_field( $this->option_name . 'mycache', __( 'Custom My Cache Menu', 'wp-my-admin-bar' ), array( $this, 'cbMycache' ), 'mycache_group', 'mycache_section' );
            add_settings_field( $this->option_name . 'total', __( 'Total Cache', 'wp-my-admin-bar' ), array( $this, 'cbTotalcache' ), 'mycache_group', 'mycache_section' );
            add_settings_field( $this->option_name . 'super', __( 'Super Cache', 'wp-my-admin-bar' ), array( $this, 'cbSupercache' ), 'mycache_group', 'mycache_section' );
            add_settings_field( $this->option_name . 'comet', __( 'Comet Cache', 'wp-my-admin-bar' ), array( $this, 'cbComet' ), 'mycache_group', 'mycache_section' );
            add_settings_field( $this->option_name . 'fastest', __( 'Fastest Cache', 'wp-my-admin-bar' ), array( $this, 'cbFastestcache' ), 'mycache_group', 'mycache_section' );
            add_settings_field( $this->option_name . 'cssminify', __( 'CSS Minify', 'wp-my-admin-bar' ), array( $this, 'cbCssminify' ), 'mycache_group', 'mycache_section' );
            add_settings_field( $this->option_name . 'wpminify', __( 'WP Minify Fix', 'wp-my-admin-bar' ), array( $this, 'cbWpminify' ), 'mycache_group', 'mycache_section' );
            add_settings_field( $this->option_name . 'fastvelocity', __( 'Fast Velocity Minify', 'wp-my-admin-bar' ), array( $this, 'cbFastvelocity' ), 'mycache_group', 'mycache_section' );

            add_settings_field( $this->option_name . 'mytools', __( 'Custom My Tools Menu', 'wp-my-admin-bar' ), array( $this, 'cbMytools' ), 'mytools_group', 'mytools_section' );

            add_settings_field( $this->option_name . 'my-account', __( 'Howdy, Menu on Admin Bar', 'wp-my-admin-bar' ), array( $this, 'cbHowdy' ), 'howdy_group', 'howdy_section' );
            add_settings_field( $this->option_name . 'user-actions', __( 'Howdy, Menu Dropdown Only', 'wp-my-admin-bar' ), array( $this, 'cbHowdydrop' ), 'howdy_group', 'howdy_section' );
            add_settings_field( $this->option_name . 'user-info', __( 'Avatar & Username within Dropdown', 'wp-my-admin-bar' ), array( $this, 'cbAvataruser' ), 'howdy_group', 'howdy_section' );
            add_settings_field( $this->option_name . 'edit-profile', __( 'Edit Profile Link within Dropdown', 'wp-my-admin-bar' ), array( $this, 'cbEditlink' ), 'howdy_group', 'howdy_section' );
            add_settings_field( $this->option_name . 'logout', __( 'Logout Link within Dropdown', 'wp-my-admin-bar' ), array( $this, 'cbLogout' ), 'howdy_group', 'howdy_section' );

            add_settings_field( $this->option_name . 'updates', __( 'Update Notices Menu', 'wp-my-admin-bar' ), array( $this, 'cbUpdates' ), 'other_group', 'other_section' );
            add_settings_field( $this->option_name . 'new-content', __( 'New Content Menu', 'wp-my-admin-bar' ), array( $this, 'cbContent' ), 'other_group', 'other_section' );
            add_settings_field( $this->option_name . 'comments', __( 'Comments Menu', 'wp-my-admin-bar' ), array( $this, 'cbComments' ), 'other_group', 'other_section' );
            add_settings_field( $this->option_name . 'search', __( 'Search Icon on Frontend', 'wp-my-admin-bar' ), array( $this, 'cbSearch' ), 'other_group', 'other_section' );

            add_settings_field( $this->option_name . 'wp-logo', __( 'Wordpress Logo on Admin Bar', 'wp-my-admin-bar' ), array( $this, 'cbWplogo' ), 'logos_group', 'logos_section' );
            if ( is_multisite() ) {
                add_settings_field( $this->option_name . 'wpicon', __( 'WP Icon next to Sites in Menus', 'wp-my-admin-bar' ), array( $this, 'cbwpicon' ), 'logos_group', 'logos_section' );
            }
        }


        /**
         * @about Register Settings
         * @args $option_group, $option_name, $sanitize_callback
         * @codex https://codex.wordpress.org/Function_Reference/register_setting
         */
        final public function settings()
        {
            register_setting( 'adminbar_section', $this->option_name . 'frontend', array( $this, 'sanitizeCb' ) );
            register_setting( 'adminbar_section', $this->option_name . 'backend', array( $this, 'sanitizeCb' ) );

            register_setting( 'mysites_section', $this->option_name . 'mysites', array( $this, 'sanitizeCb' ) );
            if ( is_multisite() ) {
                register_setting( 'mysites_section', $this->option_name . 'siteids', array( $this, 'sanitizeCb' ) );
            }
            register_setting( 'mysites_section', $this->option_name . 'site-name', array( $this, 'sanitizeCb' ) );

            register_setting( 'mycache_section', $this->option_name . 'mycache', array( $this, 'sanitizeCb' ) );
            register_setting( 'mycache_section', $this->option_name . 'total', array( $this, 'sanitizeCb' ) );
            register_setting( 'mycache_section', $this->option_name . 'super', array( $this, 'sanitizeCb' ) );
            register_setting( 'mycache_section', $this->option_name . 'comet', array( $this, 'sanitizeCb' ) );
            register_setting( 'mycache_section', $this->option_name . 'fastest', array( $this, 'sanitizeCb' ) );
            register_setting( 'mycache_section', $this->option_name . 'cssminify', array( $this, 'sanitizeCb' ) );
            register_setting( 'mycache_section', $this->option_name . 'wpminify', array( $this, 'sanitizeCb' ) );
            register_setting( 'mycache_section', $this->option_name . 'fastvelocity', array( $this, 'sanitizeCb' ) );

            register_setting( 'mytools_section', $this->option_name . 'mytools', array( $this, 'sanitizeCb' ) );

            register_setting( 'howdy_section', $this->option_name . 'my-account', array( $this, 'sanitizeCb' ) );
            register_setting( 'howdy_section', $this->option_name . 'user-actions', array( $this, 'sanitizeCb' ) );
            register_setting( 'howdy_section', $this->option_name . 'user-info', array( $this, 'sanitizeCb' ) );
            register_setting( 'howdy_section', $this->option_name . 'edit-profile', array( $this, 'sanitizeCb' ) );
            register_setting( 'howdy_section', $this->option_name . 'logout', array( $this, 'sanitizeCb' ) );

            register_setting( 'other_section', $this->option_name . 'updates', array( $this, 'sanitizeCb' ) );
            register_setting( 'other_section', $this->option_name . 'new-content', array( $this, 'sanitizeCb' ) );
            register_setting( 'other_section', $this->option_name . 'comments', array( $this, 'sanitizeCb' ) );
            register_setting( 'other_section', $this->option_name . 'search', array( $this, 'sanitizeCb' ) );

            register_setting( 'logos_section', $this->option_name . 'wp-logo', array( $this, 'sanitizeCb' ) );
            if ( is_multisite() ) {
                register_setting( 'logos_section', $this->option_name . 'wpicon', array( $this, 'sanitizeCb' ) );
            }
        }


        /**
         * @about Section Description
         */
        final public function adminbarAbout()
        {
            echo __( 'Control the display of the Wordpress Admin Bar.', 'wp-my-admin-bar' );
        }


        /**
         * @about Section Description
         */
        final public function mysitesAbout()
        {
            echo __( 'Custom My Sites menu with extended admin area sub-menu links.', 'wp-my-admin-bar' );
        }


        /**
         * @about Section Description
         */
        final public function mycacheAbout()
        {
            echo __( 'Custom My Cache menu with links to the listed cache plugins.', 'wp-my-admin-bar' );
        }


        /**
         * @about Section Description
         */
        final public function mytoolsAbout()
        {
            echo __( 'Custom My Tools menu featuring helpful web developer tools.', 'wp-my-admin-bar' );
        }


        /**
         * @about Section Description
         */
        final public function howdyAbout()
        {
            echo __( 'Manage the Howdy menu and related dropdown items.', 'wp-my-admin-bar' );
        }


        /**
         * @about Section Description
         */
        final public function otherAbout()
        {
            echo __( 'Other Wordpress Created Menus.', 'wp-my-admin-bar' );
        }


        /**
         * @about Section Description
         */
        final public function logosAbout()
        {
            echo __( 'Wordpress logo control.', 'wp-my-admin-bar' );
        }


        /**
         * @about Display Checkbox
         */
        final public function cbFrontend()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>frontend" value="1" id="<?php echo $this->option_name;?>frontend" <?php checked( parent::option( 'frontend' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>frontend"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbBackend()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>backend" value="1" id="<?php echo $this->option_name;?>backend" <?php checked( parent::option( 'backend' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>backend"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbMysites()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>mysites" value="1" id="<?php echo $this->option_name;?>mysites" <?php checked( parent::option( 'mysites' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>mysites"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbSiteids()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>siteids" value="1" id="<?php echo $this->option_name;?>siteids" <?php checked( parent::option( 'siteids' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>siteids"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbLocalsite()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>site-name" value="1" id="<?php echo $this->option_name;?>site-name" <?php checked( parent::option( 'site-name' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>site-name"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbMycache()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>mycache" value="1" id="<?php echo $this->option_name;?>mycache" <?php checked( parent::option( 'mycache' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>mycache"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbTotalcache()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>total" value="1" id="<?php echo $this->option_name;?>total" <?php checked( parent::option( 'total' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>total"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/w3-total-cache/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbSupercache()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>super" value="1" id="<?php echo $this->option_name;?>super" <?php checked( parent::option( 'super' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>super"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/wp-super-cache/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbComet()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>comet" value="1" id="<?php echo $this->option_name;?>comet" <?php checked( parent::option( 'comet' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>comet"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/comet-cache/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbFastestcache()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>fastest" value="1" id="<?php echo $this->option_name;?>fastest" <?php checked( parent::option( 'fastest' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>fastest"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/wp-fastest-cache/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbCssminify()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>cssminify" value="1" id="<?php echo $this->option_name;?>cssminify" <?php checked( parent::option( 'cssminify' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>cssminify"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/search/CSS+Minify/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbFastvelocity()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>fastvelocity" value="1" id="<?php echo $this->option_name;?>fastvelocity" <?php checked( parent::option( 'fastvelocity' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>fastvelocity"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/fast-velocity-minify/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbWpminify()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>wpminify" value="1" id="<?php echo $this->option_name;?>wpminify" <?php checked( parent::option( 'wpminify' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>wpminify"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/wp-minify-fix/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbMyTools()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>mytools" value="1" id="<?php echo $this->option_name;?>mytools" <?php checked( parent::option( 'mytools' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>mytools"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbHowdy()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>my-account" value="1" id="<?php echo $this->option_name;?>my-account" <?php checked( parent::option( 'my-account' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>my-account"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbHowdydrop()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>user-actions" value="1" id="<?php echo $this->option_name;?>user-actions" <?php checked( parent::option( 'user-actions' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>user-actions"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbAvataruser()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>user-info" value="1" id="<?php echo $this->option_name;?>user-info" <?php checked( parent::option( 'user-info' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>user-info"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbEditlink()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>edit-profile" value="1" id="<?php echo $this->option_name;?>edit-profile" <?php checked( parent::option( 'edit-profile' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>edit-profile"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbLogout()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>logout" value="1" id="<?php echo $this->option_name;?>logout" <?php checked( parent::option( 'logout' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>logout"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbUpdates()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>updates" value="1" id="<?php echo $this->option_name;?>updates" <?php checked( parent::option( 'updates' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>updates"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbContent()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>new-content" value="1" id="<?php echo $this->option_name;?>new-contentnew-content" <?php checked( parent::option( 'new-content' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>new-content"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbComments()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>comments" value="1" id="<?php echo $this->option_name;?>comments" <?php checked( parent::option( 'comments' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>comments"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbSearch()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>search" value="1" id="<?php echo $this->option_name;?>search" <?php checked( parent::option( 'search' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>search"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }

        /**
         * @about Display Checkbox
         */
        final public function cbWplogo()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>wp-logo" value="1" id="<?php echo $this->option_name;?>wp-logo" <?php checked( parent::option( 'wp-logo' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>wp-logo"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Display Checkbox
         */
        final public function cbwpicon()
        {?>
            <input type="checkbox" name="<?php echo $this->option_name;?>wpicon" value="1" id="<?php echo $this->option_name;?>wpicon" <?php checked( parent::option( 'wpicon' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>wpicon"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label>
        <?php }


        /**
         * @about Sanitize Checkbox
         * @param bool $input Checkbox Selection
         */
        final public function sanitizeCb( $input )
        {
            return (bool) $input;
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
