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
 * Remove Admin Bar from Display from the Backend
 * 
 * @see src/WPMyAdminBar/WPMyAdminBar.php
 *
 * @since 1.0.0
 */
class Backend implements Interfacer
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
     * @var object Singleton
     */
    protected static $INSTANCE = NULL;


    /**
     * Start Actions
     * 
     * @return void
     */
    public function __construct()
    {
        // Define Option Var
        // @see src/WPMyAdminBar/AdminBar/Common/Options.php
        $this->OPTION_ARRAY = $this->getOption();

        // Static var for security()
        static::$SECURITY_OPTION = $this->OPTION_ARRAY;

        add_action( 'admin_init', array( &$this, 'remove' ) );
    }


    /**
     * Start Admin Bar Removal
     * 
     * @return void
     */
    final public function remove()
    {
        // Required to Run
        if ( empty( $this->OPTION_ARRAY ) ) { return; }

        // Yes, remove the Admin Bar from the Admin Area
        if ( $this->OPTION_ARRAY[ 'admin-bar-admin' ] == 'hide' ) {
            add_action( 'init', array( &$this, 'removeAdminBar' ) );
            add_filter( 'admin_head', array( &$this, 'removeStyles' ) );
        }
    }


    /**
     * Remove Admin Bar from Display from the Backend
     * 
     * @return void
     */
    final public function removeAdminBar()
    {
        // Wordpress
        wp_deregister_script( 'admin-bar' );
        wp_deregister_style( 'admin-bar' );
        remove_action( 'init', '_wp_admin_bar_init' );
        remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 );
        remove_action( 'admin_footer', 'wp_admin_bar_render', 1000 );
    }


    /**
     * Add CSS to Remove Admin Bar
     * 
     * @return string
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
     * Check if menu is allowed to display
     * 
     * @see src/WPMyAdminBar/Common/Security.php
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