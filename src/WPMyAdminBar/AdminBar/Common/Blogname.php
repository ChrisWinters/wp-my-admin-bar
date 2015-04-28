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
namespace WPMyAdminBar\AdminBar\Common;

// Required To Run
if( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Builds the Blogname for Menus
 * 
 * @see src/WPMyAdminBar/AdminBar/Menus/MyCache.php
 * @see src/WPMyAdminBar/AdminBar/Menus/MySites.php
 *
 * @since 1.0.0
 */
trait Blogname
{
    /**
     * @var string The html for the mini Wordpress Logo
     */
    protected $miniLogo;


    /**
     * 16x16 Wordpress Menu Logo
     * 
     * @return string
     */
    public function miniWPLogo()
    {
        return '<img src="' . esc_url( includes_url( 'images/wpmini-blue.png' ) ) . '" alt="WP" width="16" height="16" class="blavatar"/>';
    }


    /**
     * Build Blogname
     * 
     * @return string
     */
    public function getBlogname( $blogname, array $option, $blog_id )
    {
        // Create default blogname from website url if no name was passed in
        $blog_name = ( $blogname == 'url' ) ? preg_replace( '#^(https?://)?(www.)?#', '', get_home_url() ) : $blogname;

        // Define Mini Logo
        $this->miniLogo = $this->miniWPLogo();

        // Required to further customize the Blog Name
        if ( ! isset( $option[ 'wpicon' ] ) ) { return $this->miniLogo . $blog_name; }
        if ( ! isset( $option[ 'siteids' ] ) ) { return $this->miniLogo . $blog_name; }
 
        // Hide WP Icon & Hide Site ID's, return default blogname
        if ( $option[ 'wpicon' ] == 'hide' && $option[ 'siteids' ] == 'hide' ) { return $blog_name; }

        // Hide WP Icon & Show Site ID's
        if ( $option[ 'wpicon' ] == 'hide' && $option[ 'siteids' ] == 'show' ) { return '('. $blog_id .')'. $blog_name; }

        // Show WP Icon & Show Site ID's
        if ( $option[ 'wpicon' ] == 'show' && $option[ 'siteids' ] == 'show' ) { return $this->miniLogo .'('. $blog_id .')'. $blog_name; }

        // Show WP Icon & Hide Site ID's
        if ( $option[ 'wpicon' ] == 'show' && $option[ 'siteids' ] == 'hide' ) { return $this->miniLogo . $blog_name; }

        // Something is wrong, return default $blog_name
        return $blog_name;
    }
}