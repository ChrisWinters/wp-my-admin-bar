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
namespace WPMyAdminBar\Admin;

// Traits
use \WPMyAdminBar\Options;

// Required To Run
if (count(get_included_files()) == 1){ exit(); }


/**
 * Plugin Admin Area
 * 
 * @see src/WPMyAdminBar/WPMyAdminBar.php
 */
class Admin extends Settings
{
    use Options;

    /**
     * Plugin page name slug
     *
     * @type string
     */
    const PAGE_SLUG = WPMAB_PAGE_NAME;

    /**
     * Path to admin area templates
     *
     * @type string
     */
    const TEMPLATES_PATH = WPMAB_PATH_TEMPLATES;


    /**
    * Start the Admin Area Display
    *
    * @since 1.0.0
    *
    * @return void
    */
    final public static function display()
    {
        // Required: Force Location
        if (static::PAGE_SLUG !== filter_input(INPUT_GET, 'page')) { return; }

        // Filter Settings & Reset Post Items
        $settings = (true == (filter_input(INPUT_POST, 'settings'))) ? 'yes' : 'no';
        $reset = (true == (filter_input(INPUT_POST, 'reset'))) ? 'yes' : 'no';

        // Update/Reset The Option
        if ($settings == 'yes' && check_admin_referer('mymab_action', 'mymab_nonce')) {
            static::update($settings, $reset);
        }

        // Build Admin Area
        static::template('header');
        static::template('content');
        static::template('footer');
    }


    /**
     * Plugin Admin Header Template
     * 
     * 
     * @param string $template The name of the template to load
     * @param array $value Foreach $value in radioForms() method
     * @return void
     */
    final public static function template($template, $value = false)
    {
        // Require Template
        if(! file_exists(static::TEMPLATES_PATH . '/' . $template . '.php')) { return; }

        // Include Template
        if($value != false) {
            include(static::TEMPLATES_PATH . '/' . $template . '.php');
        } else {
            include_once(static::TEMPLATES_PATH . '/' . $template . '.php');
        }
    }


    /**
     * Update/Reset the Option Data
     * 
     * @value boolean $settings True if the form has been posted
     * @value boolean $reset True if the reset input was selected
     * 
     * @return void
     */
    final public static function update($settings, $reset)
    {
        // Ignore if settings post has not happened
        if ($settings != "yes") { return; }
        if ($reset != "yes" && $reset != "no") { return; }
        if (false == filter_input(INPUT_POST, 'mymab_nonce')) { return; }

        // Build options array from form post
        if ($reset == "no") { $options_array = static::buildPostArray(); }

        // Reset options array, get option data from settings
        if ($reset == "yes") { $options_array = Settings::$OPTION_DEFAULTS; }
        
        // If Multisite and Update Network clicked, Update the Network
        Options::updateOption($options_array);

        // If Multisite and Update Network clicked, Update the Network
        Options::updateOptionNetwork($options_array);

        // Remove the update action
        remove_action('update_option', array(__CLASS__, 'updateOption'), 1);
    }


    /**
     * Form Post: Filter Posts from Plugin Admin Area
     * 
     * @return array
     */
    final public static function buildPostArray()
    {
        $array = array();

        // Loop through allowed input names for form display
        foreach ((array) static::$INPUT_NAMES as $value) {
            // Get the post data based on allowed
            $input_value = filter_input(INPUT_POST, $value);

            // l33t sanitization
            if ($input_value != "show" && $input_value != "hide") { return; }

            // Rebuild array value to use form input values.
            $array[$value] = $input_value;
        }

        // Returned serialized array
        return maybe_serialize($array);
    }


    /**
     * Loops through and displays the form inputs
     * 
     * @param string $group The group id this block of forms belongs to.
     * @return string
     */
    final public static function radioForms($group)
    {
        // Required
        if (! isset($group)) { return; }

        // Loop through settings, display form data
        foreach ((array) Settings::formSettings() as $value) {
            // Skip WP Icon next to Sites in Menus if not Multisite
            if ($value['option'] == 'wpicon' && MULTISITE != true) { return; }

            // Group by group ID number, for display
            if ($value['group'] == $group)
            {
                // Load the radios template
                // @param array $value from foreach
                echo static::template('radios', $value);
            }
        }

        return;
    }


    /**
     * Admin Area Tabs
     * 
     * @return string
     */
    final public static function tabs()
    {
        // Get tab=$tab
        $get_tab = filter_input(INPUT_GET, 'tab', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        // Setting Tab Names
        $settings_tab_array = Settings::$TAB_NAMES;

        // Set current displayed tab
        $current = isset($get_tab) ? $get_tab : key($settings_tab_array);

        // Tabs html
        foreach ((array) $settings_tab_array as $tab => $name) {
            // Current tab class
            $class = ($tab == $current) ? ' nav-tab-active' : '';

            // Tab links
            echo '<a href="?page=' . static::PAGE_SLUG . '&tab=' . $tab . '" class="nav-tab' . $class . '">' . __($name, 'WPMyAdminBar') . '</a>';
        }
    }


    /**
     * Display Notices/Messages within the Plugin Admin
     * 
     * @return string
     */
    final public static function pluginNotice()
    {
        // Required - Plugin Admin
        if (filter_input(INPUT_GET, 'page') != WPMAB_PAGE_NAME) { return; }
        if (null === filter_input(INPUT_POST, 'settings')) { return; }

        // Get tab=$tab
        $get_tab = filter_input(INPUT_GET, 'tab', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        // Build tab for admin url, if set
        $tab = isset($get_tab) ? '&tab=' . $get_tab : '';

        // Message to display
        $message = sprintf(__('Notice: The WP My Admin Bar settings have been updated. -- <a href="?page=%s">Refresh To View Changes!</a>', 'WPMyAdminBar'), WPMAB_PAGE_NAME . $tab);

        // Return message
        echo '<div class="updated" id="message" onclick="this.parentNode.removeChild(this)"><p><strong><em>' . $message . '</a></em></strong></p></div>';

        // Remove Notice Action
        remove_action('admin_notices', array(__CLASS__, 'pluginNotice'));
    }


    /**
     * Network Update Notice
     * 
     * @return void
     */
    final public static function networkNotice()
    {
        // Multisite Only
        if (function_exists('is_multisite') && is_multisite()) {
            // Network Admin Required
            if (! is_network_admin()) { return; }

            // Required - Sites Admin
            if (filter_input(INPUT_GET, 'action') != 'add-site') { return; }
            if (null === filter_input(INPUT_GET, 'id')) { return; }
            if (null === filter_input(INPUT_GET, 'update')) { return; }

            // Message to display
            $message = __('Notice: The WP My Admin Bar settings have been duplicated to the new website for you. ', 'WPMyAdminBar');

            // Return Notice
            echo '<div class="updated" id="message" onclick="this.parentNode.removeChild(this)"><p><em>' . __($message, 'WPMyAdminBar') . '</em></p></div>';
        }

        // Remove Notice Action
        remove_action('network_admin_notices', array(__CLASS__, 'networkNotice'));
    }


    /**
     * Auto Update New Network Websites
     * 
     * @return void
     */
    final public static function updateNewSite()
    {
        if (function_exists('is_multisite') && is_multisite()) {
            // Network Admin Required
            if (! is_network_admin()) { return; }

            // Required - Sites Admin
            if (filter_input(INPUT_GET, 'action') != 'add-site') { return; }
            if (null === filter_input(INPUT_GET, 'id')) { return; }
            if (null === filter_input(INPUT_GET, 'update')) { return; }
            
            // Switch to Network Root
            switch_to_blog('1');

            // If a network option isn't set, then use default settings and set the option
            if (! get_option('WPMyAdminBar')) {
                // Default Option Values
                // @see src/WPMyAdminBar/Admin/Settings.php
                $options_array = Settings::$OPTION_DEFAULTS;

                // Create the option
                // @see src/WPMyAdminBar/Options.php
                Options::updateOption($options_array);
            }

            // Now the option should always be set, let's get the option array
            if (get_option('WPMyAdminBar')) {
                $options_array = Options::getOption();
            }

            // Get the site ID
            $site_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

            // Switch to the New Website
            switch_to_blog($site_id);

            // Create the option only if it doesn't already exist
            if (! get_option('WPMyAdminBar')) {
                // @see src/WPMyAdminBar/Options.php
                Options::updateOption($options_array);
            }

            // Return to original blog
            restore_current_blog();
        }
    }


    /**
     * Plugin Related Links in Plugin Admin
     * 
     * @param array $links The current array of links to attach to
     * @param string $file Plugin file base path
     * 
     * @return array
     */
    final public static function pluginLinks($links, $file) {
        // Force display to proper plugin
        if ($file == WPMAB_PLUGIN_BASE) {
            // Wp-Admin Plugin Admin
            if (is_user_admin()) {
                $links[] = '<a href="options-general.php?page=' . static::PAGE_SLUG . '">' . __('Settings', 'WPMyAdminBar') . '</a>';
            }

            // Network Plugin Admin
            if (is_network_admin()) {
                $links[] = '<a href="settings.php?page=' . static::PAGE_SLUG . '">' . __('Settings', 'WPMyAdminBar') . '</a>';
            }

            // External Links
            $links[] = '<a href="http://technerdia.com/projects/adminbar/faq.html">' . __('F.A.Q. ', 'WPMyAdminBar') . '</a>';
            $links[] = '<a href="http://technerdia.com/projects/adminbar/plugin.html">' . __('Support', 'WPMyAdminBar') . '</a>';
            $links[] = '<a href="http://technerdia.com/feedback.html">' . __('Feedback', 'WPMyAdminBar') . '</a>';
            $links[] = '<a href="http://technerdia.com/projects/contribute.html">' . __('Donations', 'WPMyAdminBar') . '</a>';
        }

        return $links;
    }
}
