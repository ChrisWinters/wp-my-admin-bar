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
 * Display translated text that has been escaped for safe use in HTML output.
 * https://developer.wordpress.org/reference/functions/esc_html_e/
 */
?>
<div class="wrap">
<h2><span class="dashicons dashicons-hammer mt-1 pt-1"></span> <?php esc_html_e( 'WP My Admin Bar', 'wp-my-admin-bar' ); ?> &#8594; <small><?php esc_html_e( 'A simple WordPress Admin Bar manager plugin.', 'wp-my-admin-bar' ); ?></small></h2>
<?php
// Temp Removed require_once dirname( WPMYADMINBAR_FILE ) . '/inc/templates/upgrade.php';.

/*
 * Sanitizes content for allowed HTML tags for post content.
 * https://developer.wordpress.org/reference/functions/wp_kses_post/
 */
echo wp_kses_post( $this->tabs() );
?>

<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2"><div id="post-body-content">
<div class="postbox"><div class="inside">
