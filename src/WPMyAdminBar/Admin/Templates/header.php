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
 * Admin Area Header Template
 *
 * @see src/WPMyAdminBar/Admin/Admin.php
 */
?>
<div class="wrap">
<div id="icon-themes" class="icon32"><br /></div><h2><?php _e( WPMAB_PLUGIN_NAME, 'WPMyAdminBar' );?></h2>
<div id="icon-edit-pages" class="icon32"><br /></div>
<h2 class="nav-tab-wrapper"><?php echo static::tabs();?></h2><br />
<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2"><div id="post-body-content">
