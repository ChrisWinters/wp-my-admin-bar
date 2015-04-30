<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012-2015, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 1.0.3
 */

/**
 * Declared Namespace
 */
namespace WPMyAdminBar;

// Traits
use \WPMyAdminBar\Options;

// Required To Run
if (count(get_included_files()) == 1){ exit(); }


/**
 * Register Hooks: Activate, Deactivate & Uninstall
 * 
 * @see wp-my-admin-bar.php
 */
class Hooks extends Settings
{
    use Options;

    /**
     * @var array Option Data
     */
    protected $OPTION_ARRAY = array();

    /**
     * @var array Settings Array for Option
     */
    protected $DEFAULT_OPTION_ARRAY = array();

    
    /**
     * Define Class Variables
     * 
     * @return void
     */
    public function __construct() {
        // Define Option Var
        // @see src/WPMyAdminBar/Options.php
        $this->OPTION_ARRAY = $this->getOption();

        // Default Reset / Install Option Var
        // @see src/WPMyAdminBar/Settings.php
        $this->DEFAULT_OPTION_ARRAY = Settings::$DEFAULT_OPTION_SETTINGS;
    }


    /**
     * Activate Plugin
     * 
     * @return void
     */
    final public static function activate()
    {
        global $wp_version;

        // Version Check
        if(version_compare($wp_version, WPMAB_WP_MIN_VERSION, "<")) {
            wp_die(__('This plugin requires WordPress ' . WPMAB_WP_MIN_VERSION . ' or higher. Please Upgrade Wordpress, then try activating this plugin again. '));
        }

        // Remove cache, if found
        Options::delCache('all');

        // Add option, if not found
        if(! get_option('WPMyAdminBar')) {
            // Default (activation) Settings for the plugin
            // @see classes/Settings.php
            $options_array = Settings::$DEFAULT_OPTION_SETTINGS;

            // If Multisite and Update Network clicked, Update the Network
            static::updateOption($options_array);

            // If Multisite and Update Network clicked, Update the Network
            static::updateOptionNetwork($options_array);
        }

        // Upgrade the WP My Admin Bar Plugin
        // @see src/WPMyAdminBar/Upgrade.php
        if(get_option('wp_myadminbar')) {
            // Init Class
            $pluginUpgrade = new \WPMyAdminBar\Upgrade();
            $pluginUpgrade->start();
        }
    }


    /**
     * Deactivate Plugin
     * 
     * @return void
     */
    final public static function deactivate()
    {
        // Delete cache
        Options::delCache('all');

        // Cleanup Multisite Network Sites
        static::delOptionNetwork('cache');
    }


    /**
     * Uninstall Plugin
     * 
     * @return void
     */
    final public static function uninstall()
    {
        // Delete cache and option
        Options::delCache('all');
        Options::delOption('all');

        // Cleanup Multisite Network Sites
        static::delOptionNetwork('all');
    }


    /**
     * Cleanup Multisite Network Sites
     * 
     * @param $action string
     * @return void
     */
    final public static function delOptionNetwork( $action )
    {
        if(empty($action)) { return; }

        // Multisite Only
        if(function_exists('is_multisite') && is_multisite()) {
            // Loop through the sites
            foreach (wp_get_sites() as $value) {
                // Switch between blogs
                switch_to_blog($value['blog_id']);

                // Delete cache and option
                Options::delCache('all');
                Options::delOption('all');
            }

            // Return to original blog
            restore_current_blog();
        }
    }
}
