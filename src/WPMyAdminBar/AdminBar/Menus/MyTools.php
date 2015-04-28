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
 * My Tools Menu Display
 * 
 * @see src/WPMyAdminBar/WPMyAdminBar.php
 *
 * @since 1.0.0
 */
class MyTools extends Settings implements Interfacer
{
    use Options;
    use Blogname;

    /**
     * @var array Menu Slug Name
     */
    protected static $SECURITY_MENU_SLUG = 'my-tools';

    /**
     * @var array Option Data for Security Checks
     */
    protected static $SECURITY_OPTION = array();

    /**
     * @var array Option Data
     */
    protected $OPTION_ARRAY = array();

    /**
     * @var array Groups for My Tools Menu
     */
    protected $SETTING_TOOL_GROUPS;

    /**
     * @var array Listing of keyword tools
     */
    protected $SETTING_TOOLS_KEYWORDS;

    /**
     * @var array Listing of ranking tools
     */
    protected $SETTING_TOOLS_RANKING;

    /**
     * @var array Listing of seo tools
     */
    protected $SETTING_TOOLS_SEO;

    /**
     * @var array Listing of validator tools
     */
    protected $SETTING_TOOLS_VALIDATE;

    /**
     * @var array Listing of web monitoring tools
     */
    protected $SETTING_TOOLS_MONITOR;

    /**
     * @var array Listing of web related tools
     */
    protected $SETTING_TOOLS_WEB;

    /**
     * @var array Listing of word/text tools
     */
    protected $SETTING_TOOLS_WORDS;

    /**
     * @var array Array of all Tools to display
     */
    protected $TOOLS_LIST_ARRAY;

    /**
     * @var string Current Website URL
     */
    protected $WEBSITE_URL;

    /**
     * @var string Current Website/Theme CSS URL
     */
    protected $CSS_URL;

    /**
     * @var string Current Website/Theme FEED URL
     */
    protected $FEED_URL;

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

        // Define Tool Groups
        // @see src/WPMyAdminBar/AdminBar/Menus/Settings.php
        $this->SETTING_TOOL_GROUPS = Settings::toolGroups();

        // Tool Listing
        // @see src/WPMyAdminBar/AdminBar/Menus/Settings.php
        $this->SETTING_TOOLS_KEYWORDS   = Settings::toolsKeywords();
        $this->SETTING_TOOLS_RANKING    = Settings::toolsRanking();
        $this->SETTING_TOOLS_SEO        = Settings::toolsSeo();
        $this->SETTING_TOOLS_VALIDATE   = Settings::toolsValidate();
        $this->SETTING_TOOLS_MONITOR    = Settings::toolsMonitor();
        $this->SETTING_TOOLS_WEB        = Settings::toolsWeb();
        $this->SETTING_TOOLS_WORDS      = Settings::toolsWords();

        // Create Tools Listing Array
        $this->TOOLS_LIST_ARRAY = array_merge (
            $this->SETTING_TOOLS_KEYWORDS, 
            $this->SETTING_TOOLS_RANKING, 
            $this->SETTING_TOOLS_SEO, 
            $this->SETTING_TOOLS_VALIDATE, 
            $this->SETTING_TOOLS_MONITOR, 
            $this->SETTING_TOOLS_WEB, 
            $this->SETTING_TOOLS_WORDS
        );

        // Parse url to domain.com
        $site_url = site_url();
        $parsed_url = parse_url( $site_url );
        $this->WEBSITE_URL = $parsed_url['host'];

        // URL to Validate CSS
        $this->CSS_URL = ''. get_bloginfo( 'template_url' ) .'/style.css';

        // URL to Validate Feed
        $this->FEED_URL = get_bloginfo( 'rss2_url' );

        // Start Menu Render
        add_action( 'admin_bar_menu', array( &$this, 'renderMenu' ), 20, 0 );
    }


    /**
     * Display the My Tools Menu
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

        // Custom My Tools Menu
        $this->menuTitle( __( 'My Tools', 'WPMyAdminBar' ), "toolsmenu", $wp_admin_bar );

        // Loop through Tool Groups
        // @see src/WPMyAdminBar/AdminBar/Menus/Settings.php
        foreach ( (array) $this->SETTING_TOOL_GROUPS as $id => $name ) {	
            $this->menuOption( $name, $id, "toolsmenu", $wp_admin_bar );
        }

        // Loop through Cache Plugins
        // @see src/WPMyAdminBar/AdminBar/Menus/Settings.php
        foreach ( (array) $this->TOOLS_LIST_ARRAY as $keys => $arrays ) {
            $this->menuItem( $keys, $arrays['title'], $arrays['url'], $arrays['group'], $wp_admin_bar );
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
    final public function menuOption( $name, $id, $root_menu, $wp_admin_bar )
    {
        $wp_admin_bar->add_group( array(
            'parent'    => $root_menu,
            'id'        => 'my_tool_list',
            'meta'      => array( 'class' => 'ab-sub-secondary' ) )
        );

        $wp_admin_bar->add_menu( array(
            'title'     => $name,
            'id' 	=> $id,
            'parent'    => 'my_tool_list',
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
        // Strip/Replace {$var} within Tools links
        $url = $this->rebuildLinks( $link );

        // Add the menu
        $wp_admin_bar->add_menu( array(
            'id' 	=> 'tools'. $id,
            'title' 	=> '&bull; '. $name .' &raquo;',
            'href' 	=> $url,
            'parent'    => $root_menu,
            'meta'      => array( 'target' => '_blank' ) )
        );
    }
    

    /**
     * Strip/Replace {$var} within Tools links
     * 
     * @credits http://stackoverflow.com/a/15066308
     *
     * @param string $link Link to filter
     * 
     * @return string $link Filtered link
     */
    final public function rebuildLinks( $link )
    {
        // Localize Vars
        $website = $this->WEBSITE_URL;
        $css_url = $this->CSS_URL;
        $feed_url = $this->FEED_URL;

        // Require
        if ( empty( $website ) && empty( $css_url ) && empty( $feed_url ) ) { return; }

        // Match all {$var}
        $matches = array();
        preg_match_all( '~\{\$(.*?)\}~si', $link, $matches );

        // If first array value found
        if ( isset( $matches[0][0] ) ) {
            // Assign vars to values
            $item = compact( $matches[1][0] );

            // Loop through the items
            foreach ( $item as $var => $value ) {
                // Replace {$var} from the $item key, with the $value directly
                $link = str_replace( '{$'.$var.'}', $value, $link );
            }
        }
        
        return $link;
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
        return $askSecurity->getReponse();
    }
    

    /**
     * Start instance object within class
     *
     * @return src/WPMyAdminBar/AdminBar/Menus/MyTools.php
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