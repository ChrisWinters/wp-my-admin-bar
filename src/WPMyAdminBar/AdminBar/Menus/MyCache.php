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
namespace WPMyAdminBar\AdminBar\Menus;

// Traits
use \WPMyAdminBar\AdminBar\Common\Options;
use \WPMyAdminBar\AdminBar\Common\Blogname;

// Required To Run
if( count( get_included_files() ) == 1 ){ exit(); }


/**
 * My Cache Menu Display
 * 
 * @see src/WPMyAdminBar/WPMyAdminBar.php
 *
 * @since 1.0.0
 */
class MyCache extends Settings implements Interfacer
{
    use Options;
    use Blogname;

    /**
     * @var array Menu Slug Name
     */
    protected static $SECURITY_MENU_SLUG = 'my-cache';

    /**
     * @var array Option Data for Security Checks
     */
    protected static $SECURITY_OPTION = array();

    /**
     * @var array Option Data
     */
    protected $OPTION_ARRAY = array();

    /**
     * @var array Listing of Cache Plugins
     */
    protected $SETTING_CACHE_PLUGINS;

    /**
     * @var object Singleton
     */
    protected static $INSTANCE = NULL;


    /**
     * Active the Menu
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

        // Define Cache Plugins
        // @see src/WPMyAdminBar/AdminBar/Menus/Settings.php
        $this->SETTING_CACHE_PLUGINS = Settings::cachePlugins();

        // Start Menu Render
        add_action( 'admin_bar_menu', array( &$this, 'renderMenu' ), 20, 0 );
    }


    /**
     * Display the My Cache Menu
     * 
     * @return void
     */
    final public function renderMenu()
    {
        // Required to Display
        if ( empty( $this->OPTION_ARRAY ) ) { return; }

        // Validate Menu Display
        if ( static::security() === false ) { return; }

        global $wp_admin_bar;

        // Custom My Cache Menu
        $this->menuTitle( __( 'My Cache', 'WPMyAdminBar' ), "cachemenu", $wp_admin_bar );

        // Default Cache Menu Name/ID, resets in foreach > if multisite
        $menu_root_name = "cachemenu";

        // Menu Items
        foreach ( (array) $wp_admin_bar->user->blogs as $blog ) {
            $blog_name = ( ! empty( $blog->blogname ) ) ? $blog->blogname : 'url';
            $blog_id = $blog->userblog_id;

            // Create default blogname if no blogname found
            // @see src/WPMyAdminBar/Common/Blogname.php
            $blogname = $this->getBlogname( $blog_name, $this->OPTION_ARRAY, $blog_id );

            // Build Site List in Menu for Multisite Network
            $this->ifMultisite( $blogname, $blog_id, $wp_admin_bar );

            // Reset root menu name to have site id's
            $menu_root_name = "'cache-'. $blog_id";

            // Loop through Cache Plugins
            // @see src/WPMyAdminBar/Menus/Settings.php
            foreach ( (array) $this->SETTING_CACHE_PLUGINS as $key => $value ) {
                if ( $this->OPTION_ARRAY[ $key ] == 'show' )
                {
                    // Create Menu Items
                    $this->menuItem( $key .'-'. $blog_id .'', $value[0], get_admin_url( $blog_id, $value[1] ), $menu_root_name, $wp_admin_bar );
                }
            }
        }
    }


    /**
     * Build Site List in Menu for Multisite Network
     * 
     * @param string $blogname The built blogname
     * @param int $blog_id The ID # for the current blog
     * @param array $wp_admin_bar Wordpress Internal Object
     * 
     * @return string $menu_root_name 
     */
    final public function ifMultisite( $blogname, $blog_id, $wp_admin_bar )
    {
        // Run only if Multisite Network
        if ( function_exists('is_multisite') && is_multisite() )
        {
            // Multisite Switch Blog ID's
            switch_to_blog( $blog_id );

            // Mulitiste Ready Wordpress Menu
            $this->menuSites( $blogname, 'cache-'. $blog_id, "cachemenu", $wp_admin_bar );

            // Return to original blog
            restore_current_blog();
        }
    }


    /**
     * Create Menu Title
     * 
     * @return void
     */
    final public function menuTitle( $name, $id, $wp_admin_bar )
    {
        $wp_admin_bar->add_menu( array(
            'title' 	=> $name,
            'id' 	=> $id,
            'href' 	=> FALSE )
        );
    }


    /**
     * Group Sites and Sites Menu
     * 
     * @return void
     */
    final public function menuSites( $name, $id, $root_menu, $wp_admin_bar )
    {
        $wp_admin_bar->add_group( array(
            'parent'    => $root_menu,
            'id'        => 'my_cache_sites',
            'meta'      => array( 'class' => 'ab-sub-secondary' ) )
        );

        $wp_admin_bar->add_menu( array(
            'title'     => $name,
            'id' 	=> $id,
            'parent'    => 'my_cache_sites',
            'href' 	=> FALSE )
        );
    }


    /**
     * Create Item Links
     * 
     * @return void
     */
    final public function menuItem( $id, $name, $link, $root_menu, $wp_admin_bar )
    {
        $wp_admin_bar->add_menu( array(
            'id' 	=> $id,
            'title' 	=> '<span style="display:none;">'. $root_menu .'</span>&bull; '. $name .' &raquo;',
            'href' 	=> $link,
            'parent'    => $root_menu,
            'meta'      => array( 'target' => '_blank' ) )
        );
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
    final public static function security() {
        // Local Vars
        $slug = static::$SECURITY_MENU_SLUG;
        $option = static::$SECURITY_OPTION;

        // Init Class
        $askSecurity = new \WPMyAdminBar\AdminBar\Common\Security( $slug, $option );

        // Ask Security for a Response
        return $askSecurity->getReponse();
    }
    

    /**
     * Start instance object within class
     *
     * @return src/WPMyAdminBar/AdminBar/Menus/MyCache.php
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