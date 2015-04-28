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
 * Remove Admin Bar from Display from the Frontend
 * 
 * @see src/WPMyAdminBar/WPMyAdminBar.php
 *
 * @since 1.0.0
 */
class Frontend implements Interfacer
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

        add_filter( 'show_admin_bar', array( &$this, 'remove' ) );
    }


    /**
     * Start Admin Bar Removal
     * 
     * @return boolean
     */
    final public function remove()
    {
        // Required to Run
        if ( empty( $this->OPTION_ARRAY ) ) { return; }

        // Set true if admin bar should be shown on frontend
        if ( $this->OPTION_ARRAY[ 'admin-bar-front' ] == 'show' ) { return true; }

        return false;
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