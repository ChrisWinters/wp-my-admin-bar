<?php
// Include Wordpress
require( './wp-blog-header.php' );

// Wordpress check
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }

// User Must Be Logged In And An Admin
if ( ! is_user_logged_in() || ! current_user_can( 'administrator' ) ) {
    wp_redirect( get_bloginfo( 'url' ));
    exit;
}

// Disable W3 Total Cache
define( 'DONOTMINIFY', true );
define( 'DONOTCDN', true );
define( 'DONOTCACHCEOBJECT', true );

add_filter('show_admin_bar', '__return_false');
show_admin_bar( false );

/**
 * Display Include Shortcode
 */
if ( ! class_exists( 'Include_Class' ) ) 
{
    class Include_Class
    {
        public static function init()
        {
            global $post;

            // Include Post Type Only
            if ( $post->post_type == 'include' ) {
                remove_filter( 'the_content', 'wpautop' );
                // Display Include Shortcode
                if ( filter_input( INPUT_GET, "type" ) == "include" ) {
                    echo do_shortcode( '[include id="' . $post->post_name . '"]' );

                // Display Coder Shortcode
                } elseif ( filter_input( INPUT_GET, "type" ) == "coder" ) {
                    echo do_shortcode( '[coder id="' . $post->post_name . '"]' );

                // Display Include Shortcode
                } else {
                    echo do_shortcode( '[include id="' . $post->post_name . '"]' );
                }
            }
        }
    }
}

// HTML to wrap around shortcodes
$html = explode( "{split}", get_option( 'incforwp_html' ) );?>
<!DOCTYPE html>
<html <?php language_attributes();?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' );?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head();?>
</head>
<body <?php body_class();?>>
<?php
if ( isset( $html[0] ) ) { echo $html[0]; }
Include_Class::init();
if ( isset( $html[1] ) ) { echo $html[1]; }
?>
<?php wp_footer();?>
</body>
</html>
