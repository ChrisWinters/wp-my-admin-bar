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
 * Admin Area Content Body Template
 *
 * @see classes/Admin.php
 *
 * @since 1.0.0
 */

// Reset Alert Notice
$alert = __( 'Notice: Resetting will replace the current settings with default settings.', 'WPMyAdminBar' );
?>
<div class="postbox"><div class="inside">
    <p><?php _e('The WP My Admin Bar Plugin, expands the Wordpress Administration Bar, adding a new My Sites menu with extended menu options, a My Cache menu for quick cache access and My Tools menu loaded with handy tools for web developers.', 'WPMyAdminBar');?></p>
</div></div>

<div  class="postbox"><div class="inside">
    <h2><?php _e('Menu Display Options', 'WPMyAdminBar');?>:</h2>
    <p><?php _e('Select [show] to enable the item. Select [hide] to disable the item. Click the Save button at the bottom to save the form. After saving click the Refresh Link that appears to reload the Wordpress Admin Bar.', 'WPMyAdminBar');?>

    <form method="post" action="">
        <?php wp_nonce_field('mymab_action','mymab_nonce');?>

        <table class="form-table">
        <tbody>
        <tr><th colspan="2">
            &bull; <u><?php _e('Default Admin Bar Display', 'WPMyAdminBar');?></u><br />
            <p class="description"><?php _e('Control the display of the Wordpress Admin Bar.', 'WPMyAdminBar');?></p>
         </th></tr>
        <?php echo static::radioForms( "1" );?>
        <tr><td colspan="2"><hr /></td></tr>

        <tr><th colspan="2">
            &bull; <u><?php _e('My Sites / Sites Menu', 'WPMyAdminBar');?></u><br />
            <p class="description"><?php _e('Custom My Sites menu with extended admin area sub-menu links.', 'WPMyAdminBar');?></p>
        </th></tr>
        <?php echo static::radioForms( "2" );?>
        <tr><td colspan="2"><hr /></td></tr>

        <tr><th colspan="2">
            &bull; <u><?php _e('My Cache Menu &amp; Plugins', 'WPMyAdminBar');?></u><br />
            <p class="description"><?php _e('Custom My Cache menu with links to the listed cache plugins.', 'WPMyAdminBar');?></p>
        </th></tr>
        <?php echo static::radioForms( "3" );?>
        <tr><td colspan="2"><hr /></td></tr>

        <tr><th colspan="2">
            &bull; <u><?php _e('My Tools Menu', 'WPMyAdminBar');?></u><br />
            <p class="description"><?php _e('Custom My Tools menu featuring helpful web developer tools.', 'WPMyAdminBar');?></p>
        </th></tr>
        <?php echo static::radioForms( "4" );?>
        <tr><td colspan="2"><hr /></td></tr>

        <tr><th colspan="2">
            &bull; <u><?php _e('Howdy Menu / My Account Items', 'WPMyAdminBar');?></u><br />
            <p class="description"><?php _e('Manage the Howdy menu and related dropdown items.', 'WPMyAdminBar');?></p>
        </th></tr>
        <?php echo static::radioForms( "5" );?>
        <tr><td colspan="2"><hr /></td></tr>

        <tr><th colspan="2">
            &bull; <u><?php _e('Other Menu Items', 'WPMyAdminBar');?></u><br />
            <p class="description"><?php _e('Other Wordpress Created Menus.', 'WPMyAdminBar');?></p>
        </th></tr>
        <?php echo static::radioForms( "6" );?>
        <tr><td colspan="2"><hr /></td></tr>

        <tr><th colspan="2">
            &bull; <u><?php _e('Wordpress Logos', 'WPMyAdminBar');?></u><br />
            <p class="description"><?php _e('Wordpress logo control.', 'WPMyAdminBar');?></p>
        </th></tr>
        <?php echo static::radioForms( "7" );?>
        <tr><td colspan="2"><hr /></td></tr>
        </tbody>
        </table>

        <p><input type="submit" name="settings" id="save" class="button button-primary" value=" <?php echo is_network_admin() ? __( 'Save', 'WPMyAdminBar' ) : __( 'Global Save', 'WPMyAdminBar' );?> " /></p>

        <br /><br /><br />
        <p class="alignright"><input type="checkbox" name="reset" value="1" id="reset" onclick="alert( <?php echo $alert;?> );" /> <label for="reset"><small><?php _e('Reset to default settings.', 'WPMyAdminBar');?></small></label></p>
        <br class="clear" />
    </form>

</div></div>
