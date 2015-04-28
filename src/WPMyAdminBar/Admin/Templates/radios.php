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
 * Forms: Radio Inputs
 *
 * @see src/WPMyAdminBar/Admin/Admin.php
 */

// Selected options
$check_show = static::get_option()[ $value['option'] ] == "show" ? " checked=\"checked\" " : "";
$check_hide = static::get_option()[ $value['option'] ] == "hide" ? " checked=\"checked\" " : "";

// Radio Inputs
$show_form = '<input type="radio" name="'. $value['option'] .'" id="'. $value['option'] .'Show" value="show"'. $check_show .' /> <label for="'. $value['option'] .'Show">['. __( 'show', 'WPMyAdminBar' ) .']</label>';
$hide_form = '<input type="radio" name="'. $value['option'] .'" id="'. $value['option'] .'Hide" value="hide"'. $check_hide .'/> <label for="'. $value['option'] .'Hide">['. __( 'hide', 'WPMyAdminBar' ) .']</label>';

// Foreach?>
<tr><th scope="row">
<small><?php echo _e( $value["title"], 'WPMyAdminBar' );?></small>
</th><td>
<?php echo $show_form;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $hide_form;?>
</td></tr>
