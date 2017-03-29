<?php
if( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }

/**
 * Plugin Admin Sidebar
 */
?>
<div class="postbox">
    <h3><span><?php _e( 'Includes For Wordpress', 'includes-for-wordpress' );?></span></h3>
<div class="inside" style="clear:both;padding-top:1px;"><div class="para">

    <ul>
        <li>&bull; <a href="http://technerdia.com/ifw/" target="_blank"><?php _e( 'Plugin Home Page', 'includes-for-wordpress' );?></a></li>
        <li>&bull; <a href="http://technerdia.com/help/" target="_blank"><?php _e( 'Contact Support', 'includes-for-wordpress' );?></a></li>
        <li>&bull; <a href="http://msrtm.technerdia.com/feedback/" target="_blank"><?php _e( 'Submit Feedback', 'includes-for-wordpress' );?></a></li>
        <li>&bull; <a href="http://technerdia.com/projects/" target="_blank"><?php _e( 'More Plugins!', 'includes-for-wordpress' );?></a></li>
    </ul>

</div></div> <!-- end inside-pad & inside -->
</div> <!-- end postbox -->