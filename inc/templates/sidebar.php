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
 * Retrieve or display nonce hidden field for forms.
 * https://developer.wordpress.org/reference/functions/wp_nonce_field/
 *
 * Display translated text.
 * https://developer.wordpress.org/reference/functions/esc_html_e/
 *
 * Escaping for HTML attributes.
 * https://developer.wordpress.org/reference/functions/esc_attr/
 *
 * Checks and cleans a URL.
 * https://developer.wordpress.org/reference/functions/esc_url/
 */
?>
<div class="postbox">
	<div class="h5 p-1 font-weight-bold"><?php esc_html_e( 'WP My Admin Bar', 'wp-my-admin-bar' ); ?></div>
<div class="inside" style="clear:both;padding-top:1px;"><div class="para">
	<ul>
		<li>&bull; <a href="https://github.com/ChrisWinters/wp-my-admin-bar" target="_blank"><?php esc_html_e( 'Plugin Home Page', 'wp-my-admin-bar' ); ?></a></li>
		<li>&bull; <a href="https://github.com/ChrisWinters/wp-my-admin-bar/issues" target="_blank"><?php esc_html_e( 'Bugs & Feature Requests', 'wp-my-admin-bar' ); ?></a></li>
		<li>&bull; <a href="https://wordpress.org/support/plugin/wp-my-admin-bar/" target="_blank"><?php esc_html_e( 'WordPress Forum', 'wp-my-admin-bar' ); ?></a></li>
	</ul>
</div></div> <!-- end inside-pad & inside -->
</div> <!-- end postbox -->

<p><a href="https://wordpress.org/support/plugin/wp-my-admin-bar/reviews/?rate=5#new-post" target="_blank"><img src="<?php echo esc_url( home_url() ); ?>/wp-content/plugins/wp-my-admin-bar/assets/images/sidebar_rate-plugin.gif" alt="<?php esc_html_e( 'Please Rate This Plugin At WordPress.org!', 'wp-my-admin-bar' ); ?>" /></a></p>
