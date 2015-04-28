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
namespace WPMyAdminBar\AdminBar\Remove;

// Traits
use \WPMyAdminBar\AdminBar\Common\Options;

// Required To Run
if( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Removes items from the WP Admin Bar
 * 
 * @see src/WPMyAdminBar/WPMyAdminBar.php
 *
 * @since 1.0.0
 */
class Features extends Settings implements Interfacer
{
    use Options;

    /**
     * @var array Option Data for Security Checks
     */
    protected static $SECURITY_OPTION = array();

    /**
     * @var array Option Data
     */
    protected $OPTION_ARRAY = array();

    /**
     * @var array Authorized features to remove
     */
    protected $SETTING_REMOVE_FEATURES;

    /**
     * @var object Singleton
     */
    protected static $INSTANCE = NULL;


    /**
     * Start Removal Action
     * 
     * @return void
     */
    //final static function action()
    public function __construct()
    {
        // Define Option Var
        // @see src/WPMyAdminBar/AdminBar/Common/Options.php
        $this->OPTION_ARRAY = $this->getOption();

        // Static var for security()
        static::$SECURITY_OPTION = $this->OPTION_ARRAY;

        // Authorized features to remove
        // @see src/WPMyAdminBar/AdminBar/Menus/Settings.php
        $this->SETTING_REMOVE_FEATURES = Settings::$FEATURES_TO_REMOVE;

        // Remove menu items before the admin bar renders
        add_action( 'wp_before_admin_bar_render', array( &$this, 'remove' ), 0 );
    }


    /**
     * Remove Admin Bar Features & Items
     * 
     * @return void
     */
    final public function remove()
    {
        // Required to Run
        if ( empty( $this->OPTION_ARRAY ) ) { return; }

        global $wp_admin_bar;

        // Loop through allowed features to remove
        // @see src/WPMyAdminBar/AdminBar/Menus/Settings.php
        foreach ( (array) $this->SETTING_REMOVE_FEATURES as $item ) {
            // Silent missing settings, continue if setting is NOT missing
            if ( true === static::security( $this->OPTION_ARRAY[ $item ] ) ) { continue; }

            // Require show to be set, to continue
            if ( $this->OPTION_ARRAY[ $item ] == "show" ) { continue; }

            // Hook in the items to remove
            $wp_admin_bar->remove_menu( $item );
        }

        // Only Multisite has the default My Sites menu
        if ( function_exists('is_multisite') && is_multisite() )
        {
            // Remove default my-sites menu, if Custom My Sites is showing
            if ( $this->OPTION_ARRAY[ 'my-sites' ] == 'show' )
            {
                // Hook the item to remove
                $wp_admin_bar->remove_menu('my-sites');
            }
        }
    }


    /**
     * Check if menu is allowed to display
     * 
     * @see src/WPMyAdminBar/AdminBar/Common/Security.php
     * 
     * @param string $SECURITY_MENU_SLUG my-sites, my-cache, or my-tools
     * @param array $OPTION The unserialized option array
     * 
     * @return boolean True is allowed, False is not authorized
     */
    final public static function security( $slug ) {
        // Local Vars
        $option = static::$SECURITY_OPTION;

        // Init Class
        $askSecurity = new \WPMyAdminBar\AdminBar\Common\Security( $slug, $option );
        return $askSecurity->getReponse();
    }
    

    /**
     * Start instance object within class
     *
     * @return src/WPMyAdminBar/AdminBar/Menus/MySites.php
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