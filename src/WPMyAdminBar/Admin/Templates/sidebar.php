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
if( count( get_included_files() ) == 1 ){ exit(); }

/**
 * Sidebar Template
 *
 * @see src/WPMyAdminBar/Admin/Admin.php
 */
?>
<div class="inner-sidebar">

<div class="postbox">
    <h3><span><?php _e('The WP My Admin Bar', 'WPMyAdminBar');?></span></h3>
    <div class="inside">
        <ul>
        <li>&bull; <a href="http://technerdia.com/projects/adminbar/plugin.html" target="_blank"><?php _e('Plugin Home Page', 'WPMyAdminBar');?></a> : <?php _e('Project Details', 'WPMyAdminBar');?></li>
        <li>&bull; <a href="http://wordpress.org/extend/plugins/wp-my-admin-bar/" target="_blank"><?php _e('Plugin at Wordpress.org', 'WPMyAdminBar');?></a> : <?php _e('WP My Admin Bar', 'WPMyAdminBar');?></li>
        <li>&bull; <a href="http://technerdia.com/feedback.html" target="_blank"><?php _e('Contact Form', 'WPMyAdminBar');?></a> : <?php _e('Problems, Questions?', 'WPMyAdminBar');?></li>
        </ul>
    </div>
</div>

<div class="postbox">
    <h3><span><?php _e('Show Some Love', 'WPMyAdminBar');?>!</span></h3>
    <div class="inside">
        <ul>
        <li><strong>&raquo; <a href="http://wordpress.org/extend/plugins/wp-my-admin-bar/" target="_blank"><?php _e('Please Rate This Plugin!', 'WPMyAdminBar');?></a></strong><br /><?php _e('It only takes a few seconds to <a href="http://wordpress.org/extend/plugins/wp-my-admin-bar/" target="_blank">rate this plugin</a>! Your rating helps create motivation for future developments!', 'WPMyAdminBar' );?></li>
        <li style="text-align:center;"><br /><p><strong><?php _e('Thank You For Your Support', 'WPMyAdminBar');?>!</strong></p>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="ZC85KWHZDA9DQ">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="Donate">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
        <p><small><?php _e('Donate To The Wp My Tool Bar Project Directly!', 'WPMyAdminBar');?></small></p></li>
        </ul>
    </div>
</div>

<div class="postbox">
    <h3><span><?php _e('Notice', 'WPMyAdminBar');?></span></h3>
    <div class="inside">
        <ul>
        <li><?php _e('Disabling this plugin does NOT delete the plugin settings. Deleting the plugin, through Wordpress, deletes all plugin settings.', 'WPMyAdminBar');?></li>
        </ul>
    </div>
</div>

</div>
