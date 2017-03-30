<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }

/**
 * @about My Sites Menu
 * @location classes/class-core.php
 * @call WpMyAdminBar_MySites::instance();
 * 
 * @method init()       Init Menus
 * @method render()     Render Menu Parts
 * @method menuTitle()  Build Menu Title
 * @method superadmin() Network Admin Menu
 * @method website()    Menu Items | Unique Website
 * @method websites()   Menu Items | Website Listing
 * @method menuItems()  Unique Menu Items
 * @method instance()   Create Instance
 
 */
if( ! class_exists( 'WpMyAdminBar_MySites' ) )
{
    class WpMyAdminBar_MySites extends WpMyAdminBar_Extended
    {
        // Holds Instance Object
        protected static $instance = NULL;


        /**
         * @about Init Menu
         */
        final public function init()
        {
            add_action( 'admin_bar_menu', array( $this, 'render' ), 25, 0 );
        }


        /**
         * @about Render Menu Parts
         */
        final public function render()
        {
            global $wp_admin_bar;

            // Menu Link
            $network = ( is_network_admin() ) ? network_admin_url( '/sites.php' ) : home_url( '/' );
            $href = ( is_admin() || ! current_user_can( 'read' ) ) ? $network : admin_url();

            // Menu Title - My Sites
            $wp_admin_bar->add_menu( array(
                'id'    => 'mysites',
                'title' => $this->menuTitle(),
                'href'  => $href,
            ) );

            // Network Enabled
            if ( is_multisite() ) {
                // Menu Items | Website Listing
                $this->superadmin( $wp_admin_bar );

                // Menu Items | Website Listing
                $this->websites( $wp_admin_bar );

            // No Network
            } else {
                // Menu Items | Unique Website
                $this->website( $wp_admin_bar );
            }
        }


        /**
         * @about Build Menu Title
         */
        final public function menuTitle()
        {
            // Multisite Title
            if ( is_multisite() ) {
                $title = __( 'My Sites', 'wp-my-admin-bar' );
            } else {
                // Default Blog Name
                $title = get_bloginfo( 'name' );

                // Build Title If Blog Name Not Defined
                if ( ! $title ) {
                    $title = preg_replace( '#^(https?://)?(www.)?#', '', get_home_url() );
                }
            }

            return wp_html_excerpt( $title, 40, '&hellip;' );
        }


        /**
         * @about Network Admin Menu
         */
        final private function superadmin( $wp_admin_bar )
        {
            if ( is_super_admin() ) {
                $wp_admin_bar->add_group( array(
                    'parent' => 'mysites',
                    'id'     => 'superadmin',
                ) );

                // Menu Item: 
                $wp_admin_bar->add_menu( array(
                    'parent' => 'superadmin',
                    'id'     => 'networkadmin',
                    'title'  => __( 'Network Admin', 'wp-my-admin-bar' ),
                    'href'   => network_admin_url(),
                ) );

                // Menu Item: Dashboard
                $wp_admin_bar->add_menu( array(
                    'parent' => 'networkadmin',
                    'id'     => 'networkdash',
                    'title'  => '&bull; ' . __( 'Dashboard', 'wp-my-admin-bar' ),
                    'href'   => network_admin_url(),
                ) );

                // Menu Item: Manage Network
                $wp_admin_bar->add_menu( array(
                    'parent' => 'networkadmin',
                    'id'     => 'managenetwork',
                    'title'  => '<span style="color:#fff;">' . __( 'Manage Network', 'wp-my-admin-bar' ) . '</span>',
                    'href'   => false,
                ) );

                // Website Display
                if ( ! is_network_admin() ) {
                    // Menu Item: Edit This Site
                    $wp_admin_bar->add_menu( array(
                        'parent' => 'networkadmin',
                        'id'     => 'editthissite',
                        'title'  => '&bull; ' . __( 'Edit This Site', 'wp-my-admin-bar' ),
                        'href'   => network_admin_url( 'site-info.php?id=' . get_current_blog_id() ),
                    ) );
                }

                // Menu Item: Add Website
                $wp_admin_bar->add_menu( array(
                    'parent' => 'networkadmin',
                    'id'     => 'addsite',
                    'title'  => '&bull; ' . __( 'Add Website', 'wp-my-admin-bar' ),
                    'href'   => network_admin_url( 'site-new.php' ),
                ) );

                // Menu Item: Add Plugin
                $wp_admin_bar->add_menu( array(
                    'parent' => 'networkadmin',
                    'id'     => 'addplugin',
                    'title'  => '&bull; ' . __( 'Add Plugin', 'wp-my-admin-bar' ),
                    'href'   => network_admin_url( 'plugin-install.php' ),
                ) );

                // Menu Item: Add User
                $wp_admin_bar->add_menu( array(
                    'parent' => 'networkadmin',
                    'id'     => 'adduser',
                    'title'  => '&bull; ' . __( 'Add User', 'wp-my-admin-bar' ),
                    'href'   => network_admin_url( 'user-new.php' ),
                ) );

                // Menu Item: Manage Network
                $wp_admin_bar->add_menu( array(
                    'parent' => 'networkadmin',
                    'id'     => 'networkadmins',
                    'title'  => '<span style="color:#fff;">' . __( 'Network Admins', 'wp-my-admin-bar' ) . '</span>',
                    'href'   => false,
                ) );

                // Menu Item: Sites Admin
                $wp_admin_bar->add_menu( array(
                    'parent' => 'networkadmin',
                    'id'     => 'sitesadmin',
                    'title'  => '&bull; ' . __( 'Sites Admin', 'wp-my-admin-bar' ),
                    'href'   => network_admin_url( 'sites.php' ),
                ) );

                // Menu Item: Users Admin
                $wp_admin_bar->add_menu( array(
                    'parent' => 'networkadmin',
                    'id'     => 'usersadmin',
                    'title'  => '&bull; ' . __( 'Users Admin', 'wp-my-admin-bar' ),
                    'href'   => network_admin_url( 'users.php' ),
                ) );

                // Menu Item: Themes Admin
                $wp_admin_bar->add_menu( array(
                    'parent' => 'networkadmin',
                    'id'     => 'themesadmin',
                    'title'  => '&bull; ' . __( 'Themes Admin', 'wp-my-admin-bar' ),
                    'href'   => network_admin_url( 'themes.php' ),
                ) );

                // Menu Item: Plugins Admin
                $wp_admin_bar->add_menu( array(
                    'parent' => 'networkadmin',
                    'id'     => 'pluginsadmin',
                    'title'  => '&bull; ' . __( 'Plugins Admin', 'wp-my-admin-bar' ),
                    'href'   => network_admin_url( 'plugins.php' ),
                ) );

                // Menu Item: Settings Admin
                $wp_admin_bar->add_menu( array(
                    'parent' => 'networkadmin',
                    'id'     => 'settingsadmin',
                    'title'  => '&bull; ' . __( 'Settings Admin', 'wp-my-admin-bar' ),
                    'href'   => network_admin_url( 'settings.php' ),
                ) );
            }
        }


        /**
         * @about Menu Items | Unique Website
         * @param object $wp_admin_bar
         */
        final private function website( $wp_admin_bar )
        {
            // Group - My Sites
            $wp_admin_bar->add_group( array(
                'parent'    => 'mysites',
                'id'        => 'mysites' . get_current_blog_id(),
                'meta'      => array( 'class' => 'ab-sub-secondary' )
            ) );

            // Menu Item | Admin Area Links
            $this->menuItems( get_current_blog_id(), $wp_admin_bar );
        }


        /**
         * @about Menu Items | Website Listing
         * @param object $wp_admin_bar
         */
        final private function websites( $wp_admin_bar )
        {
            // Group - My Sites
            $wp_admin_bar->add_group( array(
                'parent'    => 'mysites',
                'id'        => 'mysites-group',
                'meta'      => array( 'class' => 'ab-sub-secondary' )
            ) );

            foreach ( (array) $wp_admin_bar->user->blogs as $blog ) {
                switch_to_blog( $blog->userblog_id );

                // Sub Menu - Websites
                $wp_admin_bar->add_menu( array(
                    'title'     => parent::getBlogname( $blog->blogname, $blog->userblog_id ),
                    'id'        => 'mysites' . $blog->userblog_id,
                    'parent'    => 'mysites-group',
                    'href'      => admin_url()
                ) );

                // Menu Item | Admin Area Links
                $this->menuItems( $blog->userblog_id, $wp_admin_bar );

                // Restore Website
                restore_current_blog();
            }
        }


        /**
         * @about Unique Menu Items
         * @param int $menu_id The ID # for the current blog
         * @param array $wp_admin_bar
         */
        final public function menuItems( $blog_id, $wp_admin_bar )
        {
            // Menu Item: Dashboard
            $wp_admin_bar->add_menu( array(
                'parent'    => 'mysites' . $blog_id,
                'id'        => 'dashboard' . $blog_id,
                'title'     => '&bull; ' . __( 'Dashboard', 'wp-my-admin-bar' ),
                'href'      => admin_url(),
            ) );

            // Menu Item: Visit Site
            $wp_admin_bar->add_menu( array(
                'parent'    => 'mysites' . $blog_id,
                'id'        => 'visit' . $blog_id,
                'title'     => '&bull; ' . __( 'Visit Site', 'wp-my-admin-bar' ),
                'href'      => home_url( '/' ),
            ) );

            // Menu Item: View Comments
            if ( current_user_can( 'edit_posts' ) ) {
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'comments' . $blog_id,
                    'title'     => '&bull; ' . __( 'View Comments', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'edit-comments.php' ),
                ) );
            }

            // User Can Create Posts
            if ( current_user_can( get_post_type_object( 'post' )->cap->create_posts ) ) {
                // Menu Item: Add Content Section
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'addcontent' . $blog_id,
                    'title'     => '<span style="color:#fff;">' . __( 'Add Content', 'wp-my-admin-bar' ) . '</span>',
                    'href'      => false,
                ) );

                // Menu Item: Add Post
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'addpost' . $blog_id,
                    'title'     => '&bull; ' . __( 'Add Post', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'post-new.php' ),
                ) );

                // Menu Item: Add Page
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'addpage' . $blog_id,
                    'title'     => '&bull; ' . __( 'Add Page', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'post-new.php?post_type=page' ),
                ) );

                // Menu Item: Add Media
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'addmedia' . $blog_id,
                    'title'     => '&bull; ' . __( 'Add Media', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'media-new.php' ),
                ) );
            }

            // User Can Edit Posts
            if ( current_user_can( 'edit_posts' ) ) {
                // Menu Item: Posts & Pages Section
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'postspages' . $blog_id,
                    'title'     => '<span style="color:#fff;">' . __( 'Posts and Pages', 'wp-my-admin-bar' ) . '</span>',
                    'href'      => false,
                ) );

                // Menu Item: View Posts
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'viewposts' . $blog_id,
                    'title'     => '&bull; ' . __( 'View Posts', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'edit.php' ),
                ) );

                // Menu Item: View Drafts
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'viewdrafts' . $blog_id,
                    'title'     => '&bull; ' . __( 'View Drafts', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'edit.php?post_status=draft&post_type=post' ),
                ) );

                // Menu Item: View Pages
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'viewpages' . $blog_id,
                    'title'     => '&bull; ' . __( 'View Pages', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'edit.php?post_type=page' ),
                ) );
            }

            // User Can Manage Options
            if ( current_user_can( 'manage_options' ) ) {
                // Menu Item: Administration Section
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'administration' . $blog_id,
                    'title'     => '<span style="color:#fff;">' . __( 'Administration', 'wp-my-admin-bar' ) . '</span>',
                    'href'      => false,
                ) );

                // Menu Item: Appearance Admin
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'appearance' . $blog_id,
                    'title'     => '&bull; ' . __( 'Appearance Admin', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'themes.php' ),
                ) );

                // Menu Item: Plugins Admin
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'plugins' . $blog_id,
                    'title'     => '&bull; ' . __( 'Plugins Admin', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'plugins.php' ),
                ) );

                // Menu Item: Users Admin
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'users' . $blog_id,
                    'title'     => '&bull; ' . __( 'Users Admin', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'users.php' ),
                ) );

                // Menu Item: Settings Admin
                $wp_admin_bar->add_menu( array(
                    'parent'    => 'mysites' . $blog_id,
                    'id'        => 'settings' . $blog_id,
                    'title'     => '&bull; ' . __( 'Settings Admin', 'wp-my-admin-bar' ),
                    'href'      => admin_url( 'options-general.php' ),
                ) );
            }

            // Menu Item: Logout
            $wp_admin_bar->add_menu( array(
                'parent'    => 'mysites' . $blog_id,
                'id'        => 'logout' . $blog_id,
                'title'     => '&bull; ' . __( 'Logout', 'wp-my-admin-bar' ),
                'href'      => home_url( '/wp-login.php?action=logout' ),
            ) );
        }


        /**
         * @about Create Instance
         */
        public static function instance()
        {
            if ( ! self::$instance ) {
                self::$instance = new self();
                self::$instance->init();
            }

            return self::$instance;
        }
    }
}
