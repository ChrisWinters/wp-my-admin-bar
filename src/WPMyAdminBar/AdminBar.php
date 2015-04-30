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
 */
namespace WPMyAdminBar;

// Required To Run
if (count(get_included_files()) == 1){ exit(); }


/**
 * Start Plugin
 * 
 * @see wp-my-admin-bar.php
 */
class AdminBar
{
    /**
     * @var object Singleton
     */
    protected static $INSTANCE = NULL;


    /**
     * Start Plugin Features
     * 
     * @return void
     */
    public function __construct()
    {
        /**
         * Local Methods
         */
        
        // Define Plugin Textdomain for Translations
        add_action('plugins_loaded', array(&$this, 'textDomain'), 1, 0);

        // Website Settings Menu Item
        add_action('admin_menu', array(&$this, 'optionsPage'), 10, 0);

        // Network Settings Menu Item
        add_action('network_admin_menu', array(&$this, 'submenuPage'), 10, 0);


        /**
         * Admin Area Methods
         */
        // Notices in the Plugin Admin
        add_action('admin_notices', array('\WPMyAdminBar\Admin\Admin', 'pluginNotice'), 10, 0);

        // Show a notice within the Network Admin
        add_action('network_admin_notices', array('\WPMyAdminBar\Admin\Admin', 'networkNotice'), 10, 0);

        // Auto Setup New Network Websites
        add_action('plugins_loaded', array('\WPMyAdminBar\Admin\Admin', 'updateNewSite'), 10, 0);

        // Plugin links within Plugin Admin
        add_filter('plugin_row_meta', array('\WPMyAdminBar\Admin\Admin', 'pluginLinks'), 10, 2);


        /**
         * Custom My Menus
         */

        // Custom My Sites Menu
        add_action('after_setup_theme', array('\WPMyAdminBar\AdminBar\Menus\MySites', 'start'), 20, 0);

        // Custom My Cache Menu
        add_action('after_setup_theme', array('\WPMyAdminBar\AdminBar\Menus\MyCache', 'start'), 20, 0);

        // Custom My Tools Menu
        add_action('after_setup_theme', array('\WPMyAdminBar\AdminBar\Menus\MyTools', 'start'), 20, 0);


        /**
         * Remove Admin Bar Features
         */

        // Disable Admin Bar Features
        add_action('after_setup_theme', array('\WPMyAdminBar\AdminBar\Remove\Features', 'start'), 20, 0);

        // Remove Admin Bar from Website Frontend
        add_action('after_setup_theme', array('\WPMyAdminBar\AdminBar\Remove\Frontend', 'start'), 20, 0);

        // Remove Admin Bar from WP Admin
        add_action('after_setup_theme', array('\WPMyAdminBar\AdminBar\Remove\Backend', 'start'), 20, 0);
    }


    /**
     * Load Translated Strings
     * 
     * @see https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
     * 
     * @return void
     */
    final public function textDomain() {
        load_plugin_textdomain('WPMyAdminBar', false, dirname(plugin_basename(__FILE__)) . '/lang');
    }


    /**
     * Add Settings Menu Item to /wp-admin/ Admin
     * 
     * @see https://codex.wordpress.org/Function_Reference/add_options_page
     * 
     * @return void
     */
    final public function optionsPage()
    {
        // Required
        if ( ! is_admin()  ) { return; }
        if ( ! is_user_logged_in() ) { return; }
        if ( ! is_user_member_of_blog() ) { return; }

        // Settings Menu Item
        // @params $page_title | $menu_title | $capability | $menu_slug | $function
        add_options_page(WPMAB_MENU_NAME, WPMAB_MENU_NAME, 'manage_options', WPMAB_PAGE_NAME, array('\WPMyAdminBar\Admin\Admin', 'display'));
    }


    /**
     * Add Settings Menu Item to Network Admin
     * 
     * @see https://codex.wordpress.org/Function_Reference/add_submenu_page
     * 
     * @return void
     */
    final public function submenuPage()
    {
        // Required
        if ( ! is_super_admin() ) { return; }
        if ( ! is_user_logged_in() ) { return; }
        if ( ! is_network_admin() ) { return; }
        if ( ! is_plugin_active_for_network( WPMAB_PLUGIN_BASE ) ) { return; }

        // Network Settings Menu Item
        // @params $parent_slug | $page_title | $menu_title | $capability | $menu_slug | $function
        add_submenu_page('settings.php', WPMAB_PLUGIN_NAME, WPMAB_MENU_NAME, 'manage_options', WPMAB_PAGE_NAME, array('\WPMyAdminBar\Admin\Admin', 'display'));
    }


    /**
     * Start instance object within class
     *
     * @return object
     */
    final public static function start()
    {
        // Create the object
        if (null === self::$INSTANCE) {
            self::$INSTANCE = new self;
        }

        // Return this object
        return self::$INSTANCE;
    }
}
