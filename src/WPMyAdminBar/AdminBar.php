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
 * Start Plugin
 * 
 * @since 1.0.0
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
        add_action( 'plugins_loaded', array( &$this, 'textDomain' ), 1, 0 );

        // Website Settings Menu Item
        add_action( 'admin_menu', array( &$this, 'optionsPage' ), 10, 0 );

        // Network Settings Menu Item
        add_action( 'network_admin_menu', array( &$this, 'submenuPage' ), 10, 0 );

        // Notices in the Plugin Admin
        add_action( 'admin_notices', array( &$this, 'pluginNotice' ), 10, 0 );

        // Notices in the Network Admin
        add_action( 'network_admin_notices', array( &$this, 'networkNotice' ), 10, 0 );

        // Plugin links within Plugin Admin
        add_filter( 'plugin_row_meta', array( &$this, 'pluginLinks' ), 10, 2 );


        /**
         * Custom My Menus
         */

        // Custom My Sites Menu
        add_action( 'after_setup_theme', array( '\WPMyAdminBar\AdminBar\Menus\MySites', 'start' ), 20, 0 );

        // Custom My Cache Menu
        add_action( 'after_setup_theme', array( '\WPMyAdminBar\AdminBar\Menus\MyCache', 'start' ), 20, 0 );

        // Custom My Tools Menu
        add_action( 'after_setup_theme', array( '\WPMyAdminBar\AdminBar\Menus\MyTools', 'start' ), 20, 0 );


        /**
         * Remove Admin Bar Features
         */

        // Disable Admin Bar Features
        add_action( 'after_setup_theme', array( '\WPMyAdminBar\AdminBar\Remove\Features', 'start' ), 20, 0 );

        // Remove Admin Bar from Website Frontend
        add_action( 'after_setup_theme', array( '\WPMyAdminBar\AdminBar\Remove\Frontend', 'start' ), 20, 0 );

        // Remove Admin Bar from WP Admin
        add_action( 'after_setup_theme', array( '\WPMyAdminBar\AdminBar\Remove\Backend', 'start' ), 20, 0 );

        
        /**
         * Wordpress Register Hooks
         */
        
        // On Plugin Activation
        register_activation_hook( WPMAB_PLUGIN_FILE, array( '\WPMyAdminBar\Hooks', 'activate' ) );
        
        // On Plugin Deactivation
        register_deactivation_hook( WPMAB_PLUGIN_FILE, array( '\WPMyAdminBar\Hooks', 'deactivate' ) );
            
        // On Plugin Uninstall
        register_uninstall_hook( WPMAB_PLUGIN_FILE, array( '\WPMyAdminBar\Hooks', 'uninstall' ) );
    }


    /**
     * Load Translated Strings
     * 
     * @see https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
     * 
     * @return void
     */
    function textDomain() {
        load_plugin_textdomain( 'WPMyAdminBar', false, dirname( plugin_basename( __FILE__ ) ) .'/lang' );
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
        if( !is_admin()  ) { return; }
        if( !is_user_logged_in() ) { return; }
        if( !is_user_member_of_blog() ) { return; }

        // Settings Menu Item
        // @params $page_title | $menu_title | $capability | $menu_slug | $function
        add_options_page( WPMAB_MENU_NAME, WPMAB_MENU_NAME, 'manage_options', WPMAB_PAGE_NAME, array( '\WPMyAdminBar\Admin\Admin', 'display' ) );
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
        if( !is_super_admin() ) { return; }
        if( !is_user_logged_in() ) { return; }
        if( !is_network_admin() ) { return; }

        // Network Settings Menu Item
        // @params $parent_slug | $page_title | $menu_title | $capability | $menu_slug | $function
        add_submenu_page( 'settings.php', WPMAB_PLUGIN_NAME, WPMAB_MENU_NAME, 'manage_options', WPMAB_PAGE_NAME, array( '\WPMyAdminBar\Admin\Admin', 'display' ) );
    }


    /**
     * Display Notices/Messages within the Plugin Admin
     * 
     * @return string
     */
    final public function pluginNotice()
    {
        // Required - Plugin Admin
        if ( filter_input( INPUT_GET, 'page' ) != WPMAB_PAGE_NAME ) { return; }
        if ( null === filter_input( INPUT_POST, 'settings' ) ) { return; }

        // Get tab=$tab
        $get_tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );

        // Build tab for admin url, if set
        $tab = isset( $get_tab ) ? '&tab='. $get_tab : '';

        // Message to display
        $message = sprintf( __( 'Notice: The WP My Admin Bar settings have been updated. -- <a href="?page=%d">Resfresh To View Changes!</a>', 'WPMyAdminBar' ), WPMAB_PAGE_NAME . $tab );

        // Return message
        echo '<div class="updated" id="message" onclick="this.parentNode.removeChild(this)"><p><strong><em>'. $message .'</a></em></strong></p></div>';

        // Remove Notice Action
        remove_action( 'admin_notices', array( __CLASS__, 'pluginNotice' ) );
    }


    /**
     * Network Update Notice
     * 
     * @return void
     */
    final public function networkNotice()
    {
        // Required - Sites Admin
        if ( filter_input( INPUT_GET, 'action' ) != 'add-site' ) { return; }
        if ( null === filter_input( INPUT_GET, 'id' ) ) { return; }
        if ( null === filter_input( INPUT_GET, 'update' ) ) { return; }

        // Message to display
        $message = __( 'Notice: The WP My Admin Bar settings have been duplicated to the new website for you.', 'WPMyAdminBar' );

        // Return Notice
        echo '<div class="updated" id="message" onclick="this.parentNode.removeChild(this)"><p><em>'. __( $message, 'WPMyAdminBar' ) .'</em></p></div>';

        // Remove Notice Action
        remove_action( 'network_admin_notices', array( __CLASS__, 'networkNotice' ) );
    }


    /**
     * Plugin Related Links in Plugin Admin
     * 
     * @param array $links The current array of links to attach to
     * @param string $file Plugin file base path
     * 
     * @return array
     */
    final public function pluginLinks( $links, $file ) {
        // Force display to proper plugin
        if ( $file == WPMAB_PLUGIN_BASE ) {
            // Wp-Admin Plugin Admin
            if ( is_user_admin() ) {
                $links[] = '<a href="options-general.php?page=my_admin_bar.php">'. __( 'Settings', 'WPMyAdminBar' ) .'</a>';
            }

            // Network Plugin Admin
            if ( is_network_admin() ) {
                $links[] = '<a href="settings.php?page=my_admin_bar.php">'. __( 'Settings', 'WPMyAdminBar' ) .'</a>';
            }

            // External Links
            $links[] = '<a href="http://technerdia.com/projects/adminbar/faq.html">'. __( 'F.A.Q.', 'WPMyAdminBar' ) .'</a>';
            $links[] = '<a href="http://technerdia.com/projects/adminbar/plugin.html">'. __( 'Support', 'WPMyAdminBar' ) .'</a>';
            $links[] = '<a href="http://technerdia.com/feedback.html">'. __( 'Feedback', 'WPMyAdminBar' ) .'</a>';
            $links[] = '<a href="http://technerdia.com/projects/contribute.html">'. __( 'Donations', 'WPMyAdminBar' ) .'</a>';
        }

        return $links;
    }


    /**
     * Start instance object within class
     *
     * @return src/WPMyAdminBar/WPMyAdminBar.php
     */
    final public static function start()
    {
        // Create the object
        if ( null === self::$INSTANCE ) {
            self::$INSTANCE = new self;
        }

        // Return this object
        return self::$INSTANCE;
    }
}