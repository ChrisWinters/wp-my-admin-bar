<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }?>

<h2><?php _e( 'Global Network Update', 'wp-my-admin-bar' );?><?php if ( get_site_option( $this->option_name . 'disable' ) ) {?> <span class="inactive"><?php _e( 'Plugin Is Currently Globally Disabled', 'wp-my-admin-bar' );?></span><?php }?></h2>
<?php _e( 'The options below equalize all Wp My Admin Bar features across the entire network.', 'wp-my-admin-bar' );?>

<form enctype="multipart/form-data" method="post" action="edit.php?action=wpmyadminbar">
<?php wp_nonce_field( $this->option_name . 'action', $this->option_name . 'nonce' );?>

    <h2><?php _e( 'Default Admin Bar Display', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Control the display of the Wordpress Admin Bar.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Admin Bar on Frontend', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>frontend]" value="1" id="<?php echo $this->option_name;?>frontend" <?php checked( parent::field( 'frontend' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>frontend"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Admin Bar on Backend', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>backend]" value="1" id="<?php echo $this->option_name;?>backend" <?php checked( parent::field( 'backend' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>backend"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr>
    </tbody>
    </table>

    <h2><?php _e( 'My Sites / Sites Menu', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Custom My Sites menu with extended admin area sub-menu links.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Custom My Sites Menu', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>mysites]" value="1" id="<?php echo $this->option_name;?>mysites" <?php checked( parent::field( 'mysites' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>mysites"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Site Ids Next To Site Names', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>siteids]" value="1" id="<?php echo $this->option_name;?>siteids" <?php checked( parent::field( 'siteids' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>siteids"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Local/Current Site Menu', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>site-name]" value="1" id="<?php echo $this->option_name;?>site-name" <?php checked( parent::field( 'site-name' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>site-name"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr>
    </tbody>
    </table>

    <h2><?php _e( 'My Cache Menu & Plugins', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Custom My Cache menu with links to the listed cache plugins.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Custom My Cache Menu', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>mycache]" value="1" id="<?php echo $this->option_name;?>mycache" <?php checked( parent::field( 'mycache' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>mycache"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Total Cache', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>total]" value="1" id="<?php echo $this->option_name;?>total" <?php checked( parent::field( 'total' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>total"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/w3-total-cache/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Super Cache', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>super]" value="1" id="<?php echo $this->option_name;?>super" <?php checked( parent::field( 'super' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>super"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/wp-super-cache/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Comet Cache', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>comet]" value="1" id="<?php echo $this->option_name;?>comet" <?php checked( parent::field( 'comet' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>comet"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/comet-cache/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Fastest Cache', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>fastest]" value="1" id="<?php echo $this->option_name;?>fastest" <?php checked( parent::field( 'fastest' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>fastest"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/wp-fastest-cache/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'CSS Minify', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>cssminify]" value="1" id="<?php echo $this->option_name;?>cssminify" <?php checked( parent::field( 'cssminify' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>cssminify"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/search/CSS+Minify/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'WP Minify Fix', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>wpminify]" value="1" id="<?php echo $this->option_name;?>wpminify" <?php checked( parent::field( 'wpminify' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>wpminify"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/wp-minify-fix/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Fast Velocity Minify', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>fastvelocity]" value="1" id="<?php echo $this->option_name;?>fastvelocity" <?php checked( parent::field( 'fastvelocity' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>fastvelocity"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?> [<a href="https://wordpress.org/plugins/fast-velocity-minify/" target="_blank"><?php _e( 'Plugin Details', 'wp-my-admin-bar' );?></a>]</label></td>
    </tr>
    </tbody>
    </table>

    <h2><?php _e( 'My Tools Menu', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Custom My Tools menu featuring helpful web developer tools.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Custom My Tools Menu', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>mytools]" value="1" id="<?php echo $this->option_name;?>mytools" <?php checked( parent::field( 'mytools' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>mytools"><?php _e( 'Check to Enable', 'wp-my-admin-bar' );?></label></td>
    </tr>
    </tbody>
    </table>

    <h2><?php _e( 'Howdy Menu / My Account Items', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Manage the Howdy menu and related dropdown items.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Howdy, Menu on Admin Bar', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>my-account]" value="1" id="<?php echo $this->option_name;?>my-account" <?php checked( parent::field( 'my-account' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>my-account"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Howdy, Menu Dropdown Only', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>user-actions]" value="1" id="<?php echo $this->option_name;?>user-actions" <?php checked( parent::field( 'user-actions' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>user-actions"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Avatar & Username within Dropdown', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>user-info]" value="1" id="<?php echo $this->option_name;?>user-info" <?php checked( parent::field( 'user-info' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>user-info"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Edit Profile Link within Dropdown', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>edit-profile]" value="1" id="<?php echo $this->option_name;?>edit-profile" <?php checked( parent::field( 'edit-profile' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>edit-profile"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Logout Link within Dropdown', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>logout]" value="1" id="<?php echo $this->option_name;?>logout" <?php checked( parent::field( 'logout' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>logout"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr>
    </tbody>
    </table>

    <h2><?php _e( 'Other Menu Items', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Other Wordpress Created Menus.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Update Notices Menu', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>updates]" value="1" id="<?php echo $this->option_name;?>updates" <?php checked( parent::field( 'updates' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>updates"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'New Content Menu', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>new-content]" value="1" id="<?php echo $this->option_name;?>new-content" <?php checked( parent::field( 'new-content' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>new-content"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Comments Menu', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>comments]" value="1" id="<?php echo $this->option_name;?>comments" <?php checked( parent::field( 'comments' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>comments"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'Search Icon on Frontend', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>search]" value="1" id="<?php echo $this->option_name;?>search" <?php checked( parent::field( 'search' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>search"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr>
    </tbody>
    </table>

    <h2><?php _e( 'Wordpress Logos', 'wp-my-admin-bar' );?></h2>
    <?php _e( 'Wordpress logo control.', 'wp-my-admin-bar' );?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e( 'Wordpress Logo on Admin Bar', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>wp-logo]" value="1" id="<?php echo $this->option_name;?>wp-logo" <?php checked( parent::field( 'wp-logo' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>wp-logo"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
    </tr><tr>
        <th scope="row"><?php _e( 'WP Icon next to Sites in Menus', 'wp-my-admin-bar' );?></th>
        <td><input type="checkbox" name="network[<?php echo $this->option_name;?>wpicon]" value="1" id="<?php echo $this->option_name;?>wpicon" <?php checked( parent::field( 'wpicon' ), 1 );?>/> <label class="description" for="<?php echo $this->option_name;?>wpicon"><?php _e( 'Check to Disable', 'wp-my-admin-bar' );?></label></td>
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

    <p class="textright"><input type="submit" name="network[<?php echo $this->option_name;?>submit" value=" submit " onclick="return confirm( 'Are You Sure?' );" /></p>

</form>
