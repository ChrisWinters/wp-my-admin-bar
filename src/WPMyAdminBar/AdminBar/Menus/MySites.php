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
 * My Sites Menu Display
 * 
 * @see src/WPMyAdminBar/WPMyAdminBar.php
 *
 * @since 1.0.0
 */
class MySites implements Interfacer
{
    use Options;
    use Blogname;

    /**
     * @var array Menu Slug Name
     */
    protected static $SECURITY_MENU_SLUG = 'my-sites';

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
     * Active the Menu
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

        // Menu Title for: Custom My Sites Menu / Multisite Site Menu
        if ( function_exists('is_multisite') && is_multisite() )
        {
            $title = __( 'My Sites', 'WPMyAdminBar' );
        } else {
            $title = wp_html_excerpt( get_bloginfo('name'), 40, '&hellip;' );
        }

        // Create Menu Title
        $this->menuTitle( $title, "titlemenu", $wp_admin_bar );

        // Add Sites to Dropdown if Multisite
        foreach ( (array) $wp_admin_bar->user->blogs as $blog ) {
            $blog_name = ( ! empty( $blog->blogname ) ) ? $blog->blogname : 'url';
            $blog_id = $blog->userblog_id;

            // Create default blogname if no blogname found
            // @see src/WPMyAdminBar/Common/Blogname.php
            $blogname = $this->getBlogname( $blog_name, $this->OPTION_ARRAY, $blog_id );

            // Build Site List in Menu for Multisite Network
            $this->ifMultisite( $blogname, $blog_id, $wp_admin_bar );
        }
    }


    /**
     * Display Menu Items
     * 
     * @return void
     */
    final public function menuDropdown( $blogname, $menu_id, $wp_admin_bar )
    {
        // Multisite Site Name Menu
        if ( function_exists('is_multisite') && is_multisite() )
        {
            // Network Admin Menu
            if ( is_super_admin() ) {
                $this->networkAdmin( network_admin_url(), "networkmenu", "titlemenu", $wp_admin_bar );
                $this->menuItem( "na01", __('Dashboard', 'WPMyAdminBar'), network_admin_url(), "networkmenu", $wp_admin_bar );
                $this->menuItem( "na02", __('Network Home', 'WPMyAdminBar'), network_home_url( 'wp-admin/' ), "networkmenu", $wp_admin_bar );
                $this->menuItem( "na03", __('Edit This Site', 'WPMyAdminBar'), network_admin_url( "site-info.php?id=$menu_id" ), "networkmenu", $wp_admin_bar );
                $this->menuItem( "na04", __('Show Sites', 'WPMyAdminBar'), network_admin_url( 'sites.php' ), "networkmenu", $wp_admin_bar );
                $this->menuItem( "na05", __('Users Admin', 'WPMyAdminBar'), network_admin_url( 'users.php' ), "networkmenu", $wp_admin_bar );
                $this->menuItem( "na06", __('Themes Admin', 'WPMyAdminBar'), network_admin_url( 'themes.php' ), "networkmenu", $wp_admin_bar );
                $this->menuItem( "na07", __('Plugins Admin', 'WPMyAdminBar'), network_admin_url( 'plugins.php' ), "networkmenu", $wp_admin_bar );
                $this->menuItem( "na08", __('Settings Admin', 'WPMyAdminBar'), network_admin_url( 'settings.php' ), "networkmenu", $wp_admin_bar );
                $this->menuItem( "na09", __('Log Out', 'WPMyAdminBar'), get_home_url( $menu_id, '/wp-login.php?action=logout' ), "networkmenu", $wp_admin_bar );
            }

            $this->menuSites( $blogname, $menu_id, "titlemenu", $wp_admin_bar );
        }

        // Dashboard & Visit Site Links
        $this->menuItem( 'Dashboard-'. $menu_id .'-m', __('Dashboard', 'WPMyAdminBar'), get_admin_url( $menu_id ), $menu_id, $wp_admin_bar );
        $this->menuItem( 'VisitSite-'. $menu_id .'-m', __('Visit Site', 'WPMyAdminBar'), get_home_url( $menu_id, '/' ), $menu_id, $wp_admin_bar );

        // View Comments
        if ( current_user_can( 'edit_posts' ) )
        {
            $this->menuItem( 'Comments-'. $menu_id .'-m', __('View Comments', 'WPMyAdminBar'), get_admin_url( $menu_id, 'edit-comments.php' ), $menu_id, $wp_admin_bar );
        }

        // Add Posts, Pages & Media
        if ( current_user_can( get_post_type_object( 'post' )->cap->create_posts ) )
        {
            $this->menuItem( 'AddContent-'. $menu_id .'-m', __('Add Content', 'WPMyAdminBar'), "", $menu_id, $wp_admin_bar );
            $this->menuItem( 'AddPost-'. $menu_id .'-m', __('Add Post', 'WPMyAdminBar'), get_admin_url( $menu_id, 'post-new.php' ), $menu_id, $wp_admin_bar );
            $this->menuItem( 'AddPage-'. $menu_id .'-m', __('Add Page', 'WPMyAdminBar'), get_admin_url( $menu_id, 'post-new.php?post_type=page' ), $menu_id, $wp_admin_bar );
            $this->menuItem( 'AddMedia-'. $menu_id .'-m', __('Add Media', 'WPMyAdminBar'), get_admin_url( $menu_id, 'media-new.php' ), $menu_id, $wp_admin_bar );
        }

        // Edit Post, Pages & Drafts
        if ( current_user_can( 'edit_posts' ) )
        {
            $this->menuItem( 'PostsandPages-'. $menu_id .'-m', __('Posts and Pages', 'WPMyAdminBar'), "", $menu_id, $wp_admin_bar );
            $this->menuItem( 'ViewPosts-'. $menu_id .'-m', __('View Posts', 'WPMyAdminBar'), get_admin_url( $menu_id, 'edit.php' ), $menu_id, $wp_admin_bar );
            $this->menuItem( 'ViewDrafts-'. $menu_id .'-m', __('View Drafts', 'WPMyAdminBar'), get_admin_url( $menu_id, 'edit.php?post_status=draft&post_type=post' ), $menu_id, $wp_admin_bar );
            $this->menuItem( 'ViewPages-'. $menu_id .'-m', __('View Pages', 'WPMyAdminBar'), get_admin_url( $menu_id, 'edit.php?post_type=page' ), $menu_id, $wp_admin_bar );
        }

        // WP Admin Menu Links
        if ( current_user_can('manage_options') )
        {
            $this->menuItem( 'Administration-'. $menu_id .'-m', __('Administration', 'WPMyAdminBar'), "", $menu_id, $wp_admin_bar );
            $this->menuItem( 'AppearanceAdmin-'. $menu_id .'-m', __('Appearance Admin', 'WPMyAdminBar'), get_admin_url( $menu_id, 'themes.php' ), $menu_id, $wp_admin_bar );
            $this->menuItem( 'PluginsAdmin-'. $menu_id .'-m', __('Plugins Admin', 'WPMyAdminBar'), get_admin_url( $menu_id, 'plugins.php' ), $menu_id, $wp_admin_bar );
            $this->menuItem( 'UsersAdmin-'. $menu_id .'-m', __('Users Admin', 'WPMyAdminBar'), get_admin_url( $menu_id, 'users.php' ), $menu_id, $wp_admin_bar );
            $this->menuItem( 'SettingsAdmin-'. $menu_id .'-m', __('Settings Admin', 'WPMyAdminBar'), get_admin_url( $menu_id, 'options-general.php' ), $menu_id , $wp_admin_bar);
        }

        // Logout Link
        $this->menuItem( 'Log Out'. $menu_id .'-m', __('Log Out', 'WPMyAdminBar'), get_home_url( $menu_id, '/wp-login.php?action=logout' ), $menu_id, $wp_admin_bar );
    }


    /**
     * Create Menu Title
     * 
     * @return void
     */
    final public function menuTitle( $name, $id, $wp_admin_bar )
    {
        $wp_admin_bar->add_menu( array(
            'title'     => $name,
            'id'        => $id,
            'href'      => FALSE )
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
            'id'        => 'my_site_list',
            'meta'      => array( 'class' => 'ab-sub-secondary' ) )
        );

        $wp_admin_bar->add_menu( array(
            'title' 	=> $name,
            'id' 	=> $id,
            'parent'    => 'my_site_list',
            'href' 	=> FALSE )
        );
    }


    /**
     * Sub Menu to Item
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
            'meta' 	=> FALSE )
        );
    }


    /**
     * Network Admin Menu Item
     * 
     * @return void
     */
    final public function networkAdmin( $href, $id, $root_menu, $wp_admin_bar )
    {
        $wp_admin_bar->add_menu( array(
            'title' 	=> __('Network Admin', 'WPMyAdminBar'),
            'id' 	=> $id,
            'parent'    => $root_menu,
            'href' 	=> $href )
        );
    }


    /**
     * Network Admin Site Menu Link
     * 
     * @return void
     */
    final public function networkSite( $href, $id, $root_menu, $wp_admin_bar )
    {
        $wp_admin_bar->add_menu( array(
            'title' 	=> ''. __('Visit This Website', 'WPMyAdminBar') .' &raquo;',
            'href' 	=> $href,
            'id' 	=> $id,
            'parent'    => $root_menu,
            'meta' 	=> array( 'target' => '_blank' ) )
        );
    }


    /**
     * Sub Menu Manage Options
     * 
     * @return void
     */
    final public function menuManage( $name, $id, $root_menu, $wp_admin_bar )
    {
        $wp_admin_bar->add_group( array(
            'parent'    => $root_menu,
            'id'        => 'menumanage' )
        );

        $wp_admin_bar->add_menu( array(
            'title' 	=> $name,
            'id' 	=> $id,
            'parent' 	=> "menumanage" )
        );
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
            $this->menuDropdown( $blogname, $blog_id, $wp_admin_bar );

            // Return to original blog
            restore_current_blog();
        } else {
            // Standalone Wordpress Menu
            $this->menuDropdown( __( 'Website', 'WPMyAdminBar' ), "titlemenu", $wp_admin_bar );
        }
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