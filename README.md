# Wp My Admin Bar #
* **Plugin Name:** WP My Admin Bar | Admin Bar
* **Contributors:** tribalNerd, Chris Winters
* **Tags:** myadminbar, wpmyadminbar, plugin, admin, administration, adminbar, admin-bar, toolbar, toolbars, bar, network, multisite, tools, cache, sites, technerdia, tribalnerd
* **Requires at least:** 3.8
* **Tested up to:** 4.7.3
* **Stable tag:** 2.0.0
* **License:** GNU GPLv3
* **License URI:** https://github.com/tribalNerd/multisite-robotstxt-manager/blob/master/LICENSE

The Wp My Admin Bar Plugin expands on the default Wordpress Admin Bar, adding 3 new custom menus, the ability to show / hide every feature on the Admin Bar, and even the Admin Bar itself.


## Description

The 'Wp My Admin Bar' Plugin expands on the default Wordpress Admin Bar. Adding three new custom menus (My Sites, My Cache & My Tools), along with the ability to show / hide every feature on the Admin Bar, and even the Admin Bar itself.

Works on both Standalone Wordpress Installs and Multisite Networks.


= For Support & Bugs =

Please [contact us directly](http://technerdia.com/help/) if you need assistance or have found a bug. The WordPress Support forum does not notify us of new support tickets, no idea why, so contact us directly. Or, view on [Github!](https://github.com/tribalNerd/multisite-robotstxt-manager/) and clone/fork yourself a copy, report a bug or submit a ticket & pull request!

### 3 New Menus:

* My Sites / Site Name Menu: Extended menu options, posts, pages, media, plugins, settings, etc...
* My Cache Menu: Allows for quick access to selected Cache Plugins.
* My Tools Menu: Web tools for WP Developers and Bloggers.

### Other Features Include:

* Mobile / Portable Device Friendly
* Expands the My Site / Current Site menu with many quick access links.
* Remove the Wordpress Logo from the Admin Bar.
* Remove the Howdy Dropdown, disable the dropdown, or remove features within the dropdown.
* Disable the dropdown on the Howdy menu.
* Remove Update Notices, Content menus and the Search Icon from the Frontend.
* Disable the Admin Bar on the Backend and/or the Frontend.

### Plugin works with and has been tested on:

* Multisite - Network Activated
* Multisite - Site Activated
* Standalone Installs (non-multisite)


## Installation

### Install through the Wordpress Admin

* It is recommended that you use the built in Wordpress installer to install plugins.
	* Multisite Networks: Network Admin > Plugins Menu > Add New Button
	* Standalone Wordpress: Site Dashboard > Plugins Menu > Add New Button
* In the Search box, enter: My Admin Bar
* Click Install Now and proceed through the plugin setup process.
	* Activate / Network Activate the plugin when asked.
	* If you have returned to the Plugin Admin, locate "WP My Admin Bar" Plugin and click the Activate link.

### Upload and Install

* If uploading, upload the /wp-my-admin-bar/ folder to /wp-content/plugins/ folder for your Worpdress install.
* Then open the Wordpress Admin:
	* Multisite Networks: Network Admin > Plugins Menu
	* Standalone Wordpress: Site Dashboard > Plugins Menu
* Locate the WP My Admin Bar Plugin in your listing of plugins. (sort by Inactive)
* Click the Activate link to start the plugin.


### To Configure:

* Multisite Network: Access the Network Admin > Settings > WP Admin Bar - Network settings adjust all Websites within the Network.
* Multisite Standalone Website: Site Dashboard > Settings > WP Admin Bar - Only adjusts this Websites settings but can be overwritten by Network admin.
* Standalone Wordpress: Site Dashboard > Settings > WP Admin Bar - Adjusts the Websites Admin Bar settings.


## Frequently Asked Questions

= Q) Which Wordpress Setups does the WP My Admin Bar work with? =

A) It works with, all Multisite Setups (not multi-user at this time), and Standalone Wordpress.org Installs.


= Q) Does the plugin have a Network Settings page? =

A) Yes, you can access it via the Network Admin > Settings > Admin Bar


= Q) Does changing the Network Settings override the Website Settings? =

A) Yes! After you Network Activate the plugin, adjust the settings within the Network Admin. Then don't touch them again! After that, if a Website is missing a feature or needs a feature, access that websites admin bar settings page to adjust that Website only.


= Q) I don't have a Cache Plugin installed, should I use one of the listed Plugins? =

A) Yes!!! Links to each of the plugins are within the admin and ordered by experience/preference.


= Q) If I disable/delete the plugin are the plugin settings deleted? =

A) No! However you can disable the plugin and delete all plugin settings within the admin area of the plugin.


= Q) If I upgrade from Standalone Wordpress to Multisite, will I lose my settings? =

A) I'm not sure, however it's only one Website, setting it back will only take a few seconds.


= Q) If I activate the Plugin via a Network Website, then Network activate it, will I lose my Websites settings? =

A) No, not until you update the Network Admin Settings directly.


= Q) Does the Plugin automatically populate a new Website when it's created in the Network Admin? =

A) Yes!


## Changelog

= 2.0.1 =
* Tested: Wordpress Version 4.7.4
* Update: New feature to populate Admin Bar settings for newly added Network Websites.

= 2.0.0 =
* Update: Complete rewrite of the plugin

= 1.0.3 =
* Changed: Moved the activation, deactivation, uninstall hooks to wp-my-admin-bar.php
* Changed: Moved all option get/set methods to \WPMyAdminBar\Options
* Changed: Adjusted Admin, Hooks, MyCache, MySites, & My Tools to new Options location & methods
* Changed: Set a Network message in \WPMyAdminBar\Admin\Templates\content.php
* Changed: Moved Site & Network notices and plugin links from AdminBar.php to Admin.php
* Changed: Created new updateNewSite() method in \WPMyAdminBar\Admin\Templates\Admin
* Changed: Modified method name get_option to getOption, adjusted in radios.php template
* Changed: Improved the PSR1-4 Standards within everything

= 1.0.2 =
* Changed: Added in PHP Version Compare
* Changed: Modified compare statements

= 1.0.0 =
* Changed: Restructured the classes, used some old stuff, built some new stuff: In short, made it less stupid.
* Moved the project to Github: https://github.com/tribalNerd/wp-my-admin-bar

Alpha Release
= 0.2.0 =
* Changed: Added delete_site_transient when new Websites are created via the Network Admin.
* Changed: Readme file updated.

= 0.1.9 =
* Changed: Modified prepare() statements.
* Fixed: Corrected missing menu ID's.
* Changed: Modified add_options statements.
* Changed: Removed Add Links Link under My Sites Menu.
* Changed: Added View Comments Link under My Sites Menu.
* Changed: Improved current_user_can for lower Admins.
* Changed: PHP Debug and WP Debug checked.

= 0.1.7 =
* Changed: Created new option wp_myadminbar_nw to allow site id 1 and network admin to use different settings.
* Changed: Created new option wp_cache_nw to allow site id 1 and network admin to use different settings.
* Fixed: settings_sites.php template, corrected php debug index errors.
* Fixed: settings_network.php template, corrected php debug index errors.
* Fixed: settings_sites.class.php corrected php debug index errors.
* Changed: settings_network.class.php adjusted $my_menus to use new wp_myadminbar_nw option.
* Changed: settings_network.class.php adjusted $my_cache to use new wp_cache_nw option.
* Fixed: settings_network.class.php corrected php debug index errors.
* Changed: my_tools.class.php adjusted to allow menu to display for non-super admins.
* Fixed: my_sites.class.php adjusted sitename in dropdown to use get_bloginfo('name').
* Changed: my_sites.class.php adjusted to allow non-super admins to manage options.
* Changed: Added new calls for wp_myadminbar_nw and wp_myadminbar_nw_status in my_admin_bar.class.php.
* Changed: Added new calls for wp_cache_nw and wp_cache_nw_status in my_admin_bar.class.php.
* Changed: functions.class.php settingsPage class to allow non-super admins to manage settings page.
* Changed: functions_wp_myadminbar_nw and wp_myadminbar_nw_status added to function.class.php.
* Changed: functions_wp_cache_nw and wp_cache_nw_status added to function.class.php.
* Changed: Adjusted uninstall.php and activate.php to contain new wp_myadminbar_nw and wp_cache_nw options.

= 0.1.6 =
* Fixed: Corrected menu link: My Sites > Visit This Site > View Posts - Now opens the proper edit.php page.
* Fixed: Corrected issue with admin bar menu options displaying to logged in users.
* Fixed: Removed ob_gzhandler

= 0.1.5 =
* Fixed: Files missing in repository.
* Fixed: Corrected deleted files.

= 0.1.4 =
* Fixed: Added wp_nonce_field and check_admin_referer to setting pages & templates.
* Fixed: Corrected Network Menu var that made the Network Dashboard link not appear.
* Fixed: Added is_admin and is_network_admin rather than parsing the urls.
* Fixed: Made sure setting pages & links only load within admins, for proper users.
* Changed: my_sites, cache & tools menus, made menu calls simpler.
* Changed: Removed default Site Menu and replaced with Visit This Website in main My Sites menu.
* Changed: Adjusted My Sites menu name on non-multisite Installs.
* Changed: Cleaned gettext calls for various menu text options.
* Update: Added new SEO Tool
* Update: Sidebar: Added newly used functions and some new text.
* Update: Added tabs to Network Admin, creating a Custom Settings tab.
* Update: Made settings tab display for Network active, multisite per-site active and standalone wp installs.
* Update: Expanded settings_network.php & settings_sites.php to include new tab.
* Update: New custom settings: hide/show the Wordpress Logo, Howdy, Handle, WP Icon in Menus and display Site ID's next to Sites.
* Update: Added new 'Visit this Website' menu with extended 'This Site' menu options.
* Update: Created log-out links within: My Network Admin menu, the Visit this Website menu, and on Standalone WP installs.
* Changed:Made several variable names and calls more descriptive, added more comments.
* Changed: Modified my_admin_bar.classes.php to become my_admin_bar.class.php - adding a new class call the my_sites, cache and tools menu.
* Fixed: Corrected issue with uninstall and deactivation not working on multisite standalone site activations.
* Update: Better functionality for standalone wordpress installs.
* Update: Created new file: function.class.php which contains repeat used functions and standalone classes.
* Fixed: Adjusted repeat calls in the code to use the repeat functions in the new function.class.php file.
* Update: Created upgrade.php: Auto upgrades old option value names to the new names, only runs once.

= 0.1.3 =
* Fixed: Screenshot correction, again.
* Fixed: Added release tag to main file.

= 0.1.2 =
* Fixed: Added root Site Name display back to Admin Bar.
* Update: Generated POT file and set domain for gettext calls.
* Changed: Added link to Plugin in settings_sidebar template.
* Fixed: Screenshot added, I think.

= 0.1.1 =
* Note: Testing how the svn works.
* Fixed: Corrected display of New Post Option under My Sites menu.
* Fixed: Corrected wp_blogs to use $wpdb->blogs
* Fixed: Updates to: Spelling, readme.txt layout, plugin url added.

= 0.1 =
* Created: Feb 12, 2012


## Screenshots

1. [Plugin Admin Area Pointing Out The Admin Link & 3 New Menus](https://github.com/tribalNerd/wp-my-admin-bar/blob/master/svn/assets/screenshot-1.png)

2. [New "Site Name" Admin Area Menu Being Displayed](https://github.com/tribalNerd/wp-my-admin-bar/blob/master/svn/assets/screenshot-2.png)

3. [New My Sites Menu For Multisite Networks](https://github.com/tribalNerd/wp-my-admin-bar/blob/master/svn/assets/screenshot-3.png)

4. [Network Admin Area Pointing Out Admin Link](https://github.com/tribalNerd/wp-my-admin-bar/blob/master/svn/assets/screenshot-4.png)
