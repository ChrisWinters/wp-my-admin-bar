<?php
/**
 * Plugin Admin Template
 *
 * @package    WordPress
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace WpMyAdminBar;

if ( false === defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Retrieve the translation of $text and escapes it for safe use in HTML output.
 * https://developer.wordpress.org/reference/functions/esc_html__/
 *
 * Checks and cleans a URL.
 * https://developer.wordpress.org/reference/functions/esc_url/
 *
 * Display translated text.
 * https://developer.wordpress.org/reference/functions/esc_html_e/
 *
 * Echoes a submit button, with provided text and appropriate class( es ).
 * https://developer.wordpress.org/reference/functions/submit_button/
 *
 * Outputs the html checked attribute.
 * https://developer.wordpress.org/reference/functions/checked/
 */
?>
<form enctype="multipart/form-data" method="post" action="">
<?php
/*
 * Retrieve or display nonce hidden field for forms.
 * https://developer.wordpress.org/reference/functions/wp_nonce_field/
 */
wp_nonce_field(
	WPMYADMINBAR_SETTING_PREFIX . 'action',
	WPMYADMINBAR_SETTING_PREFIX . 'nonce'
);
?>
<input type="hidden" name="action" value="update" />

<table class="form-table">
	<tbody>
<?php if ( true === is_multisite() && true === is_network_admin() ) { ?>
		<tr>
		<td colspan="2">
			<div class="text-dark font-weight-bold p-0 mt-4 h5"><?php esc_html_e( 'Custom Menu', 'wp-my-admin-bar' ); ?></div>
			<p class="description"><?php esc_html_e( 'Custom My Sites menu with extended admin area sub-menu links.', 'wp-my-admin-bar' ); ?></p>
		</td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'New My Sites Menu', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="mysites" value="enable" id="mysites-enable" <?php checked( $mysites, 'enable' ); ?> /><label for="mysites-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="mysites" value="disable" id="mysites-disable" <?php checked( $mysites, 'disable' ); ?> /><label for="mysites-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'Site Ids Next To Site Names', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="siteids" value="enable" id="siteids-enable" <?php checked( $siteids, 'enable' ); ?> /><label for="siteids-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="siteids" value="disable" id="siteids-disable" <?php checked( $siteids, 'disable' ); ?> /><label for="siteids-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'WP Icon next to Site in Menu', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="wp_icon" value="enable" id="wp_icon-enable" <?php checked( $wp_icon, 'enable' ); ?> /><label for="wp_icon-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="wp_icon" value="disable" id="wp_icon-disable" <?php checked( $wp_icon, 'disable' ); ?> /><label for="wp_icon-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
<?php } else { ?>
		<tr>
		<td colspan="2">
			<div class="text-dark font-weight-bold p-0 mt-4 h5"><?php esc_html_e( 'Custom Menu', 'wp-my-admin-bar' ); ?></div>
			<p class="description"><?php esc_html_e( 'Custom Site menu with extended admin area sub-menu links.', 'wp-my-admin-bar' ); ?></p>
		</td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'New Site Menu', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="mysites" value="enable" id="mysites-enable" <?php checked( $mysites, 'enable' ); ?> /><label for="mysites-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="mysites" value="disable" id="mysites-disable" <?php checked( $mysites, 'disable' ); ?> /><label for="mysites-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
<?php } ?>
		<tr>
		<td colspan="2">
			<div class="text-dark font-weight-bold p-0 mt-4 h5"><?php esc_html_e( 'Admin Bar Display', 'wp-my-admin-bar' ); ?></div>
			<p class="description"><?php esc_html_e( 'Control the display of the WordPress Admin Bar.', 'wp-my-admin-bar' ); ?></p>
		</td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'Frontend Admin Bar Display', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="frontend" value="enable" id="frontend-enable" <?php checked( $frontend, 'enable' ); ?> /><label for="frontend-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="frontend" value="disable" id="frontend-disable" <?php checked( $frontend, 'disable' ); ?> /><label for="frontend-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><label for="backend"><?php esc_html_e( 'Backend Admin Bar Display', 'wp-my-admin-bar' ); ?></label></th>
		<td class="p-1"><input type="radio" name="backend" value="enable" id="backend-enable" <?php checked( $backend, 'enable' ); ?> /><label for="backend-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="backend" value="disable" id="backend-disable" <?php checked( $backend, 'disable' ); ?> /><label for="backend-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<td colspan="2">
<?php if ( true === is_multisite() && true === is_network_admin() ) { ?>
			<div class="text-dark font-weight-bold p-0 mt-4 h5"><?php esc_html_e( 'WordPress My Sites Menu', 'wp-my-admin-bar' ); ?></div>
			<p class="description"><?php esc_html_e( 'The default WordPress My Sites dropdown menu and WordPress current site menu.', 'wp-my-admin-bar' ); ?></p>
<?php } else { ?>
			<div class="text-dark font-weight-bold p-0 mt-4 h5"><?php esc_html_e( 'WordPress Site Menu', 'wp-my-admin-bar' ); ?></div>
			<p class="description"><?php esc_html_e( 'The default WordPress current site dropdown menu.', 'wp-my-admin-bar' ); ?></p>
<?php } ?>
		</td>
		</tr>
<?php if ( true === is_multisite() && true === is_network_admin() ) { ?>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'My Sites Menu', 'wp-my-admin-bar' ); ?></th>		<td class="p-1"><input type="radio" name="my_sites" value="enable" id="my_sites-enable" <?php checked( $my_sites, 'enable' ); ?> /><label for="my_sites-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="my_sites" value="disable" id="my_sites-disable" <?php checked( $my_sites, 'disable' ); ?> /><label for="my_sites-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'Current Site Menu', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="site_name" value="enable" id="site_name-enable" <?php checked( $site_name, 'enable' ); ?> /><label for="site_name-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="site_name" value="disable" id="site_name-disable" <?php checked( $site_name, 'disable' ); ?> /><label for="site_name-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
<?php } else { ?>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'Current Site Menu', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="site_name" value="enable" id="site_name-enable" <?php checked( $site_name, 'enable' ); ?> /><label for="site_name-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="site_name" value="disable" id="site_name-disable" <?php checked( $site_name, 'disable' ); ?> /><label for="site_name-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
<?php } ?>

<?php if ( true === is_multisite() && true === is_network_admin() ) { ?>
<?php } ?>

		<tr>
		<td colspan="2">
			<div class="text-dark font-weight-bold p-0 mt-4 h5"><?php esc_html_e( 'Howdy Menu / My Account Items', 'wp-my-admin-bar' ); ?></div>
			<p class="description"><?php esc_html_e( 'Manage the Howdy menu and related dropdown items.', 'wp-my-admin-bar' ); ?></p>
		</td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'Howdy, Menu on Admin Bar', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="my_account" value="enable" id="my_account-enable" <?php checked( $my_account, 'enable' ); ?> /><label for="my_account-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="my_account" value="disable" id="my_account-disable" <?php checked( $my_account, 'disable' ); ?> /><label for="my_account-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'Howdy, Menu Dropdown Only', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="user_actions" value="enable" id="user_actions-enable" <?php checked( $user_actions, 'enable' ); ?> /><label for="user_actions-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="user_actions" value="disable" id="user_actions-disable" <?php checked( $user_actions, 'disable' ); ?> /><label for="user_actions-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'Avatar & Username within Dropdown', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="user_info" value="enable" id="user_info-enable" <?php checked( $user_info, 'enable' ); ?> /><label for="user_info-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="user_info" value="disable" id="user_info-disable" <?php checked( $user_info, 'disable' ); ?> /><label for="user_info-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'Edit Profile Link within Dropdown', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="edit_profile" value="enable" id="edit_profile-enable" <?php checked( $edit_profile, 'enable' ); ?> /><label for="edit_profile-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="edit_profile" value="disable" id="edit_profile-disable" <?php checked( $edit_profile, 'disable' ); ?> /><label for="edit_profile-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'Logout Link within Dropdown', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="logout" value="enable" id="logout-enable" <?php checked( $logout, 'enable' ); ?> /><label for="logout-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="logout" value="disable" id="logout-disable" <?php checked( $logout, 'disable' ); ?> /><label for="logout-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>

		<tr>
		<td colspan="2">
			<div class="text-dark font-weight-bold p-0 mt-4 h5"><?php esc_html_e( 'Other Menu Items', 'wp-my-admin-bar' ); ?></div>
			<p class="description"><?php esc_html_e( 'Other WordPress Created Menus.', 'wp-my-admin-bar' ); ?></p>
		</td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'WordPress Logo on Admin Bar', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="wp_logo" value="enable" id="wp_logo-enable" <?php checked( $wp_logo, 'enable' ); ?> /><label for="wp_logo-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="wp_logo" value="disable" id="wp_logo-disable" <?php checked( $wp_logo, 'disable' ); ?> /><label for="wp_logo-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'Update Notices Menu', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="updates" value="enable" id="updates-enable" <?php checked( $updates, 'enable' ); ?> /><label for="updates-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="updates" value="disable" id="updates-disable" <?php checked( $updates, 'disable' ); ?> /><label for="updates-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'New Content Menu', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="new_content" value="enable" id="new_content-enable" <?php checked( $new_content, 'enable' ); ?> /><label for="new_content-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="new_content" value="disable" id="new_content-disable" <?php checked( $new_content, 'disable' ); ?> /><label for="new_content-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'Comments Menu', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="comments" value="enable" id="comments-enable" <?php checked( $comments, 'enable' ); ?> /><label for="comments-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="comments" value="disable" id="comments-disable" <?php checked( $comments, 'disable' ); ?> /><label for="comments-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'Search Icon on Frontend', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="search" value="enable" id="search-enable" <?php checked( $search, 'enable' ); ?> /><label for="search-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="search" value="disable" id="search-disable" <?php checked( $search, 'disable' ); ?> /><label for="search-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
		<tr>
		<th scope="row" class="p-1"><?php esc_html_e( 'Customizer Menu on Frontend', 'wp-my-admin-bar' ); ?></th>
		<td class="p-1"><input type="radio" name="customize" value="enable" id="customize-enable" <?php checked( $customize, 'enable' ); ?> /><label for="customize-enable"><?php esc_html_e( 'enable', 'wp-my-admin-bar' ); ?></label>&nbsp;&nbsp;<input type="radio" name="customize" value="disable" id="customize-disable" <?php checked( $customize, 'disable' ); ?> /><label for="customize-disable"><?php esc_html_e( 'disable', 'wp-my-admin-bar' ); ?></label></td>
		</tr>
	</tbody>
</table>

	<div class="mt-4">
		<?php submit_button( esc_html__( 'update settings', 'wp-my-admin-bar' ) ); ?>
<?php if ( true === is_network_admin() ) { ?>
		<br /><input type="checkbox" name="publish" value="1" id="publish" /><label for="publish" class="description"> <?php esc_html_e( 'Publish settings to all network websites.', 'wp-my-admin-bar' ); ?></label>
<?php } ?>
	</div>
</form>

<br /><br /><hr />

<form enctype="multipart/form-data" method="post" action="">
<?php
/*
 * Retrieve or display nonce hidden field for forms.
 * https://developer.wordpress.org/reference/functions/wp_nonce_field/
 */
wp_nonce_field(
	WPMYADMINBAR_SETTING_PREFIX . 'action',
	WPMYADMINBAR_SETTING_PREFIX . 'nonce'
);

if ( true === is_network_admin() ) {
	$delete_message = __( 'WARNING: Delete plugin settings for network admin only.', 'wp-my-admin-bar' );
} else {
	$delete_message = __( 'WARNING: Delete plugin settings for this website only.', 'wp-my-admin-bar' );
}
?>
<table class="form-table">
	<tbody>
		<tr>
		<td class="text-right"><span class="description"><?php echo esc_html( $delete_message ); ?></span> <input type="radio" name="action" value="delete" /></td>
		</tr>
	</tbody>
</table>

<p class="textright"><input type="submit" name="submit" value=" submit " onclick="return confirm( 'Are You Sure?' );" /></p>
</form>
