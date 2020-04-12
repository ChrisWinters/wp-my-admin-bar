<?php
/**
 * Manager Class
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

use WpMyAdminBar\Trait_Security_Check as TraitSecurityCheck;
use WpMyAdminBar\Plugin_Admin_Notices as PluginAdminNotices;
use WpMyAdminBar\Option_Manager as OptionManager;

/**
 * Save Plugin Settings
 */
final class Do_Save_Settings {
	use TraitSecurityCheck;

	/**
	 * Plugin Admin Post Object.
	 *
	 * @var array
	 */
	public $post_object = array();

	/**
	 * Post Action To Take.
	 *
	 * @var string
	 */
	public $post_action = array();

	/**
	 * Option_Manager Class.
	 *
	 * @var object
	 */
	public $option_manager = array();

	/**
	 * Plugin_Admin_Notices Class
	 *
	 * @var object
	 */
	public $admin_notices = array();


	/**
	 * Setup Class
	 *
	 * @param array $post_object Cleaned Post Object.
	 */
	public function __construct( $post_object = array() ) {
		if ( true === empty( $post_object ) || true === empty( $post_object['action'] ) ) {
			return;
		}

		$this->post_object    = $post_object;
		$this->post_action    = $this->post_object['action'];
		$this->option_manager = new OptionManager();
		$this->admin_notices  = new PluginAdminNotices();
	}//end __construct()


	/**
	 * Init Update Action
	 */
	public function init() {
		if ( true === empty( $this->post_object ) ) {
			return;
		}

		/*
		 * Fires as an admin screen or script is being initialized.
		 * https://developer.wordpress.org/reference/hooks/admin_init/
		 */
		add_action(
			'admin_init',
			array(
				$this,
				'update',
			)
		);
	}//end init()


	/**
	 * Security Check & Update On Action
	 */
	public function update() {
		$this->security_check();

		// Update Plugin Settings.
		if ( 'update' === $this->post_action ) {
			$this->save();
		}

		// Delete Plugin Settings.
		if ( 'delete' === $this->post_action ) {
			$this->delete();
		}
	}//end update()


	/**
	 * Save Settings
	 */
	private function save() {
		if ( true === empty( $this->post_object ) || true === empty( $this->admin_notices ) ) {
			$this->admin_notices->add_notice( 'success', 'update_error' );
			return;
		}

		if ( true !== empty( $this->post_object['action'] ) ) {
			unset( $this->post_object['action'] );
		}

		$allowed = array(
			'frontend'     => '',
			'backend'      => '',
			'mysites'      => '',
			'my_sites'     => '',
			'siteids'      => '',
			'site_link'    => '',
			'site_name'    => '',
			'my_account'   => '',
			'user_actions' => '',
			'user_info'    => '',
			'edit_profile' => '',
			'logout'       => '',
			'updates'      => '',
			'new_content'  => '',
			'comments'     => '',
			'search'       => '',
			'customize'    => '',
			'wp_logo'      => '',
			'wp_icon'      => '',
			'publish'      => '',
		);

		foreach ( $this->post_object as $key => $value ) {
			if ( true !== array_key_exists( $key, $allowed ) ) {
				unset( $this->post_object[ $key ] );
			}

			if ( true === empty( $value ) ) {
				unset( $this->post_object[ $key ] );
			}
		}

		$maybe_publish = false;
		if ( true !== empty( $this->post_object['publish'] ) && '1' === $this->post_object['publish'] ) {
			unset( $this->post_object['publish'] );
			$maybe_publish = true;
		}

		$message = false;

		if ( true === is_multisite() ) {
			if ( true === is_network_admin() ) {
				$message = $this->network_save( $this->post_object );
			} else {
				$message = $this->website_save( $this->post_object );
			}
		} else {
			$message = $this->website_save( $this->post_object );
		}

		if ( true === $maybe_publish ) {
			$this->maybe_publish();
		}

		if ( true === $message ) {
			$this->admin_notices->add_notice( 'success', 'update_success' );
		} else {
			$this->admin_notices->add_notice( 'success', 'update_error' );
		}
	}//end save()


	/**
	 * Publish Nework Settings
	 */
	private function maybe_publish() {
		$network_settings = $this->option_manager->get_site_option();

		if ( true === empty( $network_settings ) ) {
			$network_settings = array();
		}

		/*
		 * Retrieves a list of sites matching requested arguments.
		 * https://developer.wordpress.org/reference/functions/get_sites/
		 */
		foreach ( get_sites() as $website ) {
			/*
			 * Switch the current blog.
			 * https://developer.wordpress.org/reference/functions/switch_to_blog/
			 */
			switch_to_blog( $website->blog_id );

			$this->option_manager->delete_option();
			$this->option_manager->update_option( $network_settings );

			/*
			 * Restore the current blog, after calling switch_to_blog.
			 * https://developer.wordpress.org/reference/functions/restore_current_blog/
			 */
			restore_current_blog();
		}
	}//end maybe_publish()


	/**
	 * Save Network Settings
	 *
	 * @param array $post_object Post Object Array.
	 *
	 * @return bool
	 */
	private function network_save( $post_object = array() ) {
		// Save No Settings.
		if ( true === empty( $post_object ) ) {
			$this->option_manager->delete_site_option();

			if ( true === empty( $this->option_manager->get_site_option() ) ) {
				return true;
			} else {
				return false;
			}
		}

		// Force Disale My Sites If Custom Menu Selected.
		if ( true !== empty( $post_object['mysites'] ) && 'enable' === $post_object['mysites'] ) {
			$post_object['my_sites'] = 'disable';
		}

		// Save Selected Settings.
		if ( true !== empty( $post_object ) ) {
			$this->option_manager->update_site_option( $post_object );

			if ( true !== empty( $this->option_manager->get_site_option() ) ) {
				return true;
			} else {
				return false;
			}
		}

		return false;
	}//end network_save()


	/**
	 * Save Website Settings
	 *
	 * @param array $post_object Post Object Array.
	 *
	 * @return bool
	 */
	private function website_save( $post_object = array() ) {
		// Save No Settings.
		if ( true === empty( $post_object ) ) {
			$this->option_manager->delete_option();

			if ( true === empty( $this->option_manager->get_option() ) ) {
				return true;
			} else {
				return false;
			}
		}

		if ( true !== empty( $post_object['mysites'] ) && 'enable' === $post_object['mysites'] ) {
			if ( true === is_multisite() ) {
				$post_object['my_sites'] = 'disable';
			} else {
				$post_object['site_name'] = 'disable';
			}
		}

		// Save Selected Settings.
		if ( true !== empty( $post_object ) ) {
			$this->option_manager->update_option( $post_object );

			if ( true !== empty( $this->option_manager->get_option() ) ) {
				return true;
			} else {
				return false;
			}
		}

		return false;
	}//end website_save()


	/**
	 * Delete Plugin Settings
	 */
	private function delete() {
		if ( true === empty( $this->post_object ) || true === empty( $this->admin_notices ) ) {
			$this->admin_notices->add_notice( 'success', 'update_error' );
			return;
		}

		$message = false;

		if ( true === is_multisite() ) {
			if ( true === is_network_admin() ) {
				$this->option_manager->delete_site_option();
				$message = true;
			}

			if ( true === is_admin() && true !== is_network_admin() ) {
				$this->option_manager->delete_option();
				$message = true;
			}
		} elseif ( true === is_admin() ) {
			$this->option_manager->delete_option();
			$message = true;
		}

		if ( true === $message ) {
			$this->admin_notices->add_notice( 'success', 'delete_success' );
		} else {
			$this->admin_notices->add_notice( 'success', 'update_error' );
		}
	}//end delete()
}//end class
