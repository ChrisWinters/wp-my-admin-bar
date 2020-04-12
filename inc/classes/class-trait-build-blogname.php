<?php
/**
 * Class Trait
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

/**
 * Build Blognames
 */
trait Trait_Build_Blogname {
	/**
	 * Blogname Menu Title
	 *
	 * @param string $blogname Blogname.
	 * @param int    $blogid   Blog ID.
	 * @param string $siteids  Plugin Setting.
	 * @param string $wp_icon  Plugin Setting.
	 *
	 * @return string
	 */
	final public function menu_title( $blogname, $blogid, $siteids = '', $wp_icon = '' ) {
		$title = $this->truncate( $blogname, 24 );

		$title = '<div class="blavatar"></div>' . $this->truncate( $blogname, 20 );

		if ( true === is_super_admin() ) {
			if ( ( true !== empty( $siteids ) && 'enable' === $siteids ) && ( true !== empty( $wp_icon ) && 'enable' === $wp_icon ) ) {
				$title = '<div class="blavatar"></div>(' . $blogid . ') ' . $this->truncate( $blogname, 17 );
			}

			if ( ( true !== empty( $siteids ) && 'disable' === $siteids ) && ( true !== empty( $wp_icon ) && 'enable' === $wp_icon ) ) {
				$title = '<div class="blavatar"></div>' . $this->truncate( $blogname, 20 );
			}

			if ( ( true !== empty( $siteids ) && 'enable' === $siteids ) && ( true !== empty( $wp_icon ) && 'disable' === $wp_icon ) ) {
				$title = '(' . $blogid . ') ' . $this->truncate( $blogname, 22 );
			}

			if ( ( true !== empty( $siteids ) && 'disable' === $siteids ) && ( true !== empty( $wp_icon ) && 'disable' === $wp_icon ) ) {
				$title = $this->truncate( $blogname, 24 );
			}
		}

		return $title;
	}//end menu_title()


	/**
	 * Truncate Blog Name
	 *
	 * @param string $blogname Blogname.
	 * @param int    $length   Character Count To Truncate.
	 *
	 * @return string
	 */
	final public function truncate( $blogname, $length = 24 ) {
		if ( strlen( $blogname ) > $length ) {
			$blogname = wp_html_excerpt( $blogname, $length, '&hellip;' );
		}

		return $blogname;
	}//end truncate()
}//end trait
