<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }?>

<h2><?php _e( 'Global Network Update', 'wp-my-admin-bar' );?><?php if ( get_site_option( $this->option_name . 'disable' ) ) {?> <span class="inactive"><?php _e( 'Plugin Is Currently Globally Disabled', 'wp-my-admin-bar' );?></span><?php }?></h2>
<?php _e( 'The options below equalize all website settings for the WP My Admin Bar plugin, across the entire network. Selected items are not retained after the form is submitted.', 'wp-my-admin-bar' );?>

<form enctype="multipart/form-data" method="post" action="edit.php?action=wpmyadminbar">
<?php wp_nonce_field( $this->option_name . 'action', $this->option_name . 'nonce' );?>

    <h2><?php _e( 'Default Admin Bar Display', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Control the display of the Wordpress Admin Bar.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Admin Bar on Frontend', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>frontend" value="1" id="<?php echo $this->option_name;?>frontend" /> <label class="description" for="<?php echo $this->option_name;?>frontend"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Admin Bar on Backend', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>backend" value="1" id="<?php echo $this->option_name;?>backend" /> <label class="description" for="<?php echo $this->option_name;?>backend"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr>
    </tbody>
    </table>

    <h2><?php _e( 'My Sites / Sites Menu', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Custom My Sites menu with extended admin area sub-menu links.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Custom My Sites Menu', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>mysites" value="1" id="<?php echo $this->option_name;?>mysites" /> <label class="description" for="<?php echo $this->option_name;?>mysites"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Site Ids Next To Site Names', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>siteids" value="1" id="<?php echo $this->option_name;?>siteids" /> <label class="description" for="<?php echo $this->option_name;?>siteids"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Local/Current Site Menu', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>site-name" value="1" id="<?php echo $this->option_name;?>site-name" /> <label class="description" for="<?php echo $this->option_name;?>site-name"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr>
    </tbody>
    </table>

    <h2><?php _e( 'My Cache Menu & Plugins', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Custom My Cache menu with links to the listed cache plugins.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Custom My Cache Menu', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>mycache" value="1" id="<?php echo $this->option_name;?>mycache" /> <label class="description" for="<?php echo $this->option_name;?>mycache"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Total Cache', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>total" value="1" id="<?php echo $this->option_name;?>total" /> <label class="description" for="<?php echo $this->option_name;?>total"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/w3-total-cache/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Super Cache', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>super" value="1" id="<?php echo $this->option_name;?>super" /> <label class="description" for="<?php echo $this->option_name;?>super"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/wp-super-cache/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Comet Cache', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>comet" value="1" id="<?php echo $this->option_name;?>comet" /> <label class="description" for="<?php echo $this->option_name;?>comet"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/comet-cache/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Fastest Cache', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>fastest" value="1" id="<?php echo $this->option_name;?>fastest" /> <label class="description" for="<?php echo $this->option_name;?>fastest"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/wp-fastest-cache/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'CSS Minify', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>cssminify" value="1" id="<?php echo $this->option_name;?>cssminify" /> <label class="description" for="<?php echo $this->option_name;?>cssminify"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/search/CSS+Minify/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'WP Minify Fix', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>wpminify" value="1" id="<?php echo $this->option_name;?>wpminify" /> <label class="description" for="<?php echo $this->option_name;?>wpminify"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/wp-minify-fix/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Fast Velocity Minify', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>fastvelocity" value="1" id="<?php echo $this->option_name;?>fastvelocity" /> <label class="description" for="<?php echo $this->option_name;?>fastvelocity"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/fast-velocity-minify/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr>
    </tbody>
    </table>

    <h2><?php _e( 'My Tools Menu', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Custom My Tools menu featuring helpful web developer tools.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Custom My Tools Menu', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>mytools" value="1" id="<?php echo $this->option_name;?>mytools" /> <label class="description" for="<?php echo $this->option_name;?>mytools"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?></label></td>
    </tr>
    </tbody>
    </table>

    <h2><?php _e( 'Howdy Menu / My Account Items', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Manage the Howdy menu and related dropdown items.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Howdy, Menu on Admin Bar', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>my-account" value="1" id="<?php echo $this->option_name;?>my-account" /> <label class="description" for="<?php echo $this->option_name;?>my-account"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Howdy, Menu Dropdown Only', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>user-actions" value="1" id="<?php echo $this->option_name;?>user-actions" /> <label class="description" for="<?php echo $this->option_name;?>user-actions"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Avatar & Username within Dropdown', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>user-info" value="1" id="<?php echo $this->option_name;?>user-info" /> <label class="description" for="<?php echo $this->option_name;?>user-info"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Edit Profile Link within Dropdown', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>edit-profile" value="1" id="<?php echo $this->option_name;?>edit-profile" /> <label class="description" for="<?php echo $this->option_name;?>edit-profile"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Logout Link within Dropdown', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>logout" value="1" id="<?php echo $this->option_name;?>logout" /> <label class="description" for="<?php echo $this->option_name;?>logout"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr>
    </tbody>
    </table>

    <h2><?php _e( 'Other Menu Items', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Other Wordpress Created Menus.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Update Notices Menu', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>updates" value="1" id="<?php echo $this->option_name;?>updates" /> <label class="description" for="<?php echo $this->option_name;?>updates"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><input type="checkbox" name="<?php echo $this->option_name;?>new-content" value="1" id="<?php echo $this->option_name;?>new-contentnew-content" /> <label class="description" for="<?php echo $this->option_name;?>new-content"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label><?php _e( 'New Content Menu', 'wp-my-admin-bar' );?></th>
        <td></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Comments Menu', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>comments" value="1" id="<?php echo $this->option_name;?>comments" /> <label class="description" for="<?php echo $this->option_name;?>comments"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Search Icon on Frontend', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>search" value="1" id="<?php echo $this->option_name;?>search" /> <label class="description" for="<?php echo $this->option_name;?>search"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr>
    </tbody>
    </table>

    <h2><?php _e( 'Wordpress Logos', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Wordpress logo control.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Wordpress Logo on Admin Bar', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>wp-logo" value="1" id="<?php echo $this->option_name;?>wp-logo" /> <label class="description" for="<?php echo $this->option_name;?>wp-logo"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'WP Icon next to Sites in Menus', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="<?php echo $this->option_name;?>wpicon" value="1" id="<?php echo $this->option_name;?>wpicon" /> <label class="description" for="<?php echo $this->option_name;?>wpicon"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr>
    </tbody>
    </table>

    <div class="textcenter"><?php submit_button( __( 'update network', 'wp-my-admin-bar' ) );?></div>
</form>

<br /><hr /><br />

<form enctype="multipart/form-data" method="post" action="">
<?php wp_nonce_field( $this->option_name . 'action', $this->option_name . 'nonce' );?>

    <table class="form-table">
    <tr>
        <td>
            <p class="textright"><label><?php _e( 'WARNING: Delete all plugin settings across the entire network.', 'wp-my-admin-bar' );?></label> <input type="radio" name="type" value="delete"></p>
            <?php if ( get_site_option( $this->option_name . 'disable' ) ) {?>
                <p class="textright"><label><?php _e( 'Enable plugin on all network websites.', 'wp-my-admin-bar' );?></label> <input type="radio" name="type" value="enable"></p>
            <?php } else {?>
                <p class="textright"><label><?php _e( 'Disable plugin on all network websites, keeping all settings.', 'wp-my-admin-bar' );?></label> <input type="radio" name="type" value="disable"></p>
            <?php }?>
        </td>
    </tr>
    </table>

    <p class="textright"><input type="submit" name="submit" value=" submit " onclick="return confirm( 'Are You Sure?' );" /></p>

</form>
