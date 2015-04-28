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
 * Admin Area Footer Template
 *
 * @see src/WPMyAdminBar/Admin/Admin.php
 */
?>
</div>
<div id="postbox-container-1" class="postbox-container"><?php static::template( 'sidebar' );?></div>
<br class="clear" />
</div></div>
<p style="text-align:right;"><small><?php _e( '<b>Created by</b>: <a href="http://technerdia.com/" target="_blank">techNerdia</a>', 'WPMyAdminBar' );?></small></p>
</div>
<br class="clear" />
