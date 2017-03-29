<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }?>

<h2><?php _e( 'Website Settings', 'wp-my-admin-bar' );?><?php if ( get_option( $this->option_name . 'disable' ) ) {?> <span class="inactive"><?php _e( 'Plugin Is Currently Disabled', 'wp-my-admin-bar' );?></span><?php }?></h2>
<?php _e( 'Modify the settings below to adjust the display of the Admin Bar.', 'wp-my-admin-bar' );?>

<form enctype="multipart/form-data" method="post" action="options.php">
	<?php do_settings_sections( 'adminbar_group' );?>
    <?php settings_fields( 'adminbar_section' );?>
    <div class="textcenter"><?php submit_button( __( 'update admin bar', 'wp-my-admin-bar' ) );?></div>
</form>

<form enctype="multipart/form-data" method="post" action="options.php">
	<?php do_settings_sections( 'mysites_group' );?>
	<?php settings_fields( 'mysites_section' );?>
    <div class="textcenter"><?php submit_button( __( 'update my sites menu', 'wp-my-admin-bar' ) );?></div>
</form>

<form enctype="multipart/form-data" method="post" action="options.php">
	<?php do_settings_sections( 'mycache_group' );?>
	<?php settings_fields( 'mycache_section' );?>
    <div class="textcenter"><?php submit_button( __( 'update my cache menu', 'wp-my-admin-bar' ) );?></div>
</form>

<form enctype="multipart/form-data" method="post" action="options.php">
	<?php do_settings_sections( 'mytools_group' );?>
	<?php settings_fields( 'mytools_section' );?>
    <div class="textcenter"><?php submit_button( __( 'update my tools menu', 'wp-my-admin-bar' ) );?></div>
</form>

<form enctype="multipart/form-data" method="post" action="options.php">
	<?php do_settings_sections( 'howdy_group' );?>
	<?php settings_fields( 'howdy_section' );?>
    <div class="textcenter"><?php submit_button( __( 'update howdy menu', 'wp-my-admin-bar' ) );?></div>
</form>

<form enctype="multipart/form-data" method="post" action="options.php">
	<?php do_settings_sections( 'other_group' );?>
	<?php settings_fields( 'other_section' );?>
    <div class="textcenter"><?php submit_button( __( 'update other menus', 'wp-my-admin-bar' ) );?></div>
</form>

<form enctype="multipart/form-data" method="post" action="options.php">
	<?php do_settings_sections( 'logos_group' );?>
	<?php settings_fields( 'logos_section' );?>
    <div class="textcenter"><?php submit_button( __( 'update wp logos', 'wp-my-admin-bar' ) );?></div>
</form>

<br /><hr /><br />

<form enctype="multipart/form-data" method="post" action="">
<?php wp_nonce_field( $this->option_name . 'action', $this->option_name . 'nonce' );?>

    <table class="form-table">
    <tr>
        <td class="textcenter">
            <p class="textright"><label><?php _e( 'WARNING: Delete all plugin settings for this website.', 'wp-my-admin-bar' );?></label> <input type="radio" name="type" value="delete"></p>
            <?php if ( parent::option( 'disable' ) ) {?>
                <p class="textright"><label><?php _e( 'Enable plugin on this website.', 'wp-my-admin-bar' );?></label> <input type="radio" name="type" value="enable"></p>
            <?php } else {?>
                <p class="textright"><label><?php _e( 'Disable plugin on this website, keeping all settings.', 'wp-my-admin-bar' );?></label> <input type="radio" name="type" value="disable"></p>
            <?php }?>
        </td>
    </tr>
    </table>

    <p class="textright"><input type="submit" name="submit" value=" submit " onclick="return confirm( 'Are You Sure?' );" /></p>

</form>
