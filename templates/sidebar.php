<?php
if( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }

/**
 * Plugin Admin Sidebar
 */
?>
<div class="postbox">
    <h3><span><?php _e( 'WP My Admin Bar', 'wp-my-admin-bar' );?></span></h3>
<div class="inside" style="clear:both;padding-top:1px;"><div class="para">

    <ul>
        <li>&bull; <a href="https://github.com/tribalNerd/wp-my-admin-bar" target="_blank"><?php _e( 'Plugin Home Page', 'wp-my-admin-bar' );?></a></li>
        <li>&bull; <a href="https://github.com/tribalNerd/wp-my-admin-bar/issues" target="_blank"><?php _e( 'Bugs & Feature Requests', 'wp-my-admin-bar' );?></a></li>
        <li>&bull; <a href="http://technerdia.com/help/" target="_blank"><?php _e( 'Contact Support', 'wp-my-admin-bar' );?></a></li>
        <li>&bull; <a href="http://technerdia.com/feedback/" target="_blank"><?php _e( 'Submit Feedback', 'wp-my-admin-bar' );?></a></li>
        <li>&bull; <a href="http://technerdia.com/projects/" target="_blank"><?php _e( 'More Plugins!', 'wp-my-admin-bar' );?></a></li>
    </ul>

</div></div> <!-- end inside-pad & inside -->
</div> <!-- end postbox -->

<p><a href="https://wordpress.org/plugins/wp-my-admin-bar/" target="_blank"><img src="<?php echo WP_MY_ADMIN_BAR_BASE_URL;?>/wp-content/plugins/wp-my-admin-bar/assets/sidebar_rate-plugin.gif" alt="<?php _e( 'Please Rate This Plugin At Wordpress.org!', 'wp-my-admin-bar' );?>" /></a></p>
