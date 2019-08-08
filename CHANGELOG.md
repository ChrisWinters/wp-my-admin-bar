# Changelog

# 3.0.1
**2019-08-08 - Hotfix**

* Corrected site-name menu not disabling correctly

# 3.0.0
**2019-08-01 - Release**

* Major plugin upgrade
* Wordpress Version 5.2.2


# 2.0.2
**2017-09-06**

* Wordpress Version 4.8


# 2.0.1
**2017-23-04**

* Wordpress Version 4.7.4
* New feature to populate Admin Bar settings for newly added Network Websites.


# 2.0.0

* Complete rewrite of the plugin


# 1.0.3

* Moved the activation, deactivation, uninstall hooks to wp-my-admin-bar.php
* Moved all option get/set methods to \WPMyAdminBar\Options
* Adjusted Admin, Hooks, MyCache, MySites, & My Tools to new Options location & methods
* Set a Network message in \WPMyAdminBar\Admin\Templates\content.php
* Moved Site & Network notices and plugin links from AdminBar.php to Admin.php
* Created new updateNewSite() method in \WPMyAdminBar\Admin\Templates\Admin
* Modified method name get_option to getOption, adjusted in radios.php template
* Improved the PSR1-4 Standards within everything


# 1.0.2

* Added in PHP Version Compare
* Modified compare statements


# 1.0.0

* Restructured the classes, used some old stuff, built some new stuff: In short, made it less stupid.
* Moved the project to Github: https://github.com/ChrisWinters/wp-my-admin-bar


# 0.2.0

* Added delete_site_transient when new Websites are created via the Network Admin.
* Readme file updated.


# 0.1.9

* Modified prepare() statements.
* Corrected missing menu ID's.
* Modified add_options statements.
* Removed Add Links Link under My Sites Menu.
* Added View Comments Link under My Sites Menu.
* Improved current_user_can for lower Admins.
* PHP Debug and WP Debug checked.


# 0.1.7

* Created new option wp_myadminbar_nw to allow site id 1 and network admin to use different settings.
* Created new option wp_cache_nw to allow site id 1 and network admin to use different settings.
* settings_sites.php template, corrected php debug index errors.
* settings_network.php template, corrected php debug index errors.
* settings_sites.class.php corrected php debug index errors.
* settings_network.class.php adjusted $my_menus to use new wp_myadminbar_nw option.
* settings_network.class.php adjusted $my_cache to use new wp_cache_nw option.
* settings_network.class.php corrected php debug index errors.
* my_tools.class.php adjusted to allow menu to display for non-super admins.
* my_sites.class.php adjusted sitename in dropdown to use get_bloginfo('name').
* my_sites.class.php adjusted to allow non-super admins to manage options.
* Added new calls for wp_myadminbar_nw and wp_myadminbar_nw_status in my_admin_bar.class.php.
* Added new calls for wp_cache_nw and wp_cache_nw_status in my_admin_bar.class.php.
* functions.class.php settingsPage class to allow non-super admins to manage settings page.
* functions_wp_myadminbar_nw and wp_myadminbar_nw_status added to function.class.php.
* functions_wp_cache_nw and wp_cache_nw_status added to function.class.php.
* Adjusted uninstall.php and activate.php to contain new wp_myadminbar_nw and wp_cache_nw options.


# 0.1.6

* Corrected menu link: My Sites > Visit This Site > View Posts - Now opens the proper edit.php page.
* Corrected issue with admin bar menu options displaying to logged in users.
* Removed ob_gzhandler


# 0.1.5

* Files missing in repository.
* Corrected deleted files.


# 0.1.4

* Added wp_nonce_field and check_admin_referer to setting pages & templates.
* Corrected Network Menu var that made the Network Dashboard link not appear.
* Added is_admin and is_network_admin rather than parsing the urls.
* Made sure setting pages & links only load within admins, for proper users.
* my_sites, cache & tools menus, made menu calls simpler.
* Removed default Site Menu and replaced with Visit This Website in main My Sites menu.
* Adjusted My Sites menu name on non-multisite Installs.
* Cleaned gettext calls for various menu text options.
* Added new SEO Tool
* Sidebar: Added newly used functions and some new text.
* Added tabs to Network Admin, creating a Custom Settings tab.
* Made settings tab display for Network active, multisite per-site active and standalone wp installs.
* Expanded settings_network.php & settings_sites.php to include new tab.
* New custom settings: hide/show the Wordpress Logo, Howdy, Handle, WP Icon in Menus and display Site ID's next to Sites.
* Added new 'Visit this Website' menu with extended 'This Site' menu options.
* Created log-out links within: My Network Admin menu, the Visit this Website menu, and on Standalone WP installs.
* Changed:Made several variable names and calls more descriptive, added more comments.
* Modified my_admin_bar.classes.php to become my_admin_bar.class.php - adding a new class call the my_sites, cache and tools menu.
* Corrected issue with uninstall and deactivation not working on multisite standalone site activations.
* Better functionality for standalone wordpress installs.
* Created new file: function.class.php which contains repeat used functions and standalone classes.
* Adjusted repeat calls in the code to use the repeat functions in the new function.class.php file.
* Created upgrade.php: Auto upgrades old option value names to the new names, only runs once.


# 0.1.3

* Screenshot correction, again.
* Added release tag to main file.


# 0.1.2

* Added root Site Name display back to Admin Bar.
* Generated POT file and set domain for gettext calls.
* Added link to Plugin in settings_sidebar template.
* Screenshot added, I think.


# 0.1.1

* Note: Testing how the svn works.
* Corrected display of New Post Option under My Sites menu.
* Corrected wp_blogs to use $wpdb->blogs
* Updates to: Spelling, readme.txt layout, plugin url added.


# 0.1

* Created: Feb 12, 2012
