<?php
/**
 * Freemius
 *
 * @package    WordPress
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

if ( false === file_exists( dirname( WPMYADMINBAR_FILE ) . '/sdk/freemius/start.php' ) ) {
	return;
}

if ( true === function_exists( 'wpmyadminbar_fs' ) ) {
	wpmyadminbar_fs()->set_basename( true, WPMYADMINBAR_FILE );
} elseif ( false === function_exists( 'wpmyadminbar_fs' ) ) {
	/**
	 * Freemius Integration
	 */
	function wpmyadminbar_fs() {
		global $wpmyadminbar_fs;

		if ( false === isset( $wpmyadminbar_fs ) ) {
			if ( false === defined( 'WP_FS__PRODUCT_4231_MULTISITE' ) ) {
				define( 'WP_FS__PRODUCT_4231_MULTISITE', true );
			}

			require_once dirname( WPMYADMINBAR_FILE ) . '/sdk/freemius/start.php';

			if ( true === is_network_admin() ) {
				$slug = array(
					'slug' => 'settings.php',
				);
			} else {
				$slug = array(
					'slug' => 'options-general.php',
				);
			}

			$wpmyadminbar_fs = fs_dynamic_init(
				array(
					'id'             => '4231',
					'slug'           => 'wp-my-admin-bar',
					'type'           => 'plugin',
					'public_key'     => 'pk_0b2af908e967339854ed6bc8012d8',
					'is_premium'     => false,
					'has_addons'     => false,
					'has_paid_plans' => false,
					'is_live'        => true,
					'menu'           => array(
						'slug'    => 'wp-my-admin-bar',
						'account' => true,
						'contact' => false,
						'support' => false,
						'network' => true,
						'parent'  => $slug,
					),
				)
			);
		}

		return $wpmyadminbar_fs;
	}//end wpmyadminbar_fs()

	wpmyadminbar_fs();
	do_action( 'wpmyadminbar_fs_loaded' );
}
