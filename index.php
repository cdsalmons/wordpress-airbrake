<?php
/*
Plugin Name: Wordpress Airbrake Plugin
Plugin URI: http://github.com/fredngo/wordpress-airbrake
Description: Airbrake integration for Wordpress
Version: 0.5.0
Author: Fred Ngo
Author URI: http://github.com/fredngo
License: GPL v2
*/

if (defined('WORDPRESS_AIRBRAKE_VERSION')) return;
define('WORDPRESS_AIRBRAKE_VERSION', '0.5.0');


/*********************
 * Utility Functions *
 *********************/

function install_php_airbrake() {
   require_once 'php-airbrake/src/Airbrake/EventHandler.php';
   $api_key = get_option('wordpress_airbrake_api_key');
   $event_handler = Airbrake\EventHandler::start($api_key);
}


/*****************
 * Menu Creation *
 *****************/

function add_wordpress_airbrake_settings_menu() {
   add_options_page('Airbrake Options', 'Airbrake', 'manage_options',
                   'wordpress-airbrake', 'wordpress_airbrake_options' );
}

function wordpress_airbrake_options() {
   if (!current_user_can('manage_options')) {
      wp_die(_e('You do not have sufficient permissions to access this page.'));
   }

   $hidden_field_name = 'wordpress_airbrake_submit_hidden';
   $enabled_name      = 'wordpress_airbrake_enabled';
   $api_key_name      = 'wordpress_airbrake_api_key';

   // Read in existing option value from database
   $enabled_value = get_option($enabled_name);
   $api_key_value = get_option($api_key_name);

   // See if the user has posted us some information
   // If they did, this hidden field will be set to 'Y'
   if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
      // Read their posted value
      $api_key_value = $_POST[$api_key_name];

      if (isset($_POST[$enabled_name])) {
         $enabled_value = 1;
      }
      else {
         $enabled_value = 0;
      }

      // Save the posted value in the database
      update_option($enabled_name, $enabled_value);
      update_option($api_key_name, $api_key_value);

      // Put a settings updated message on the screen
      echo '<div class="updated"><p><strong>' . "Settings Saved" . '</strong></p></div>';
   }

   // Now display the settings editing screen
?>
<div class="wrap">
<h2>Wordpress Airbrake Integration</h2>
<form name="plugin_options" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Airbrake API Key:"); ?>
<input type="text" name="<?php echo $api_key_name; ?>" value="<?php echo $api_key_value; ?>" size="40">
</p>

<p><?php _e("Enable Airbrake:"); ?>
<input type="checkbox" name="<?php echo $enabled_name; ?>" value="<?php echo $enabled_value; ?>"<?php if(1 == $enabled_value){echo " CHECKED";} ?> />
</p>

<hr />
<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>
</form>
</div>
<?php
}


/*******************************
 * Wordpress Actions and Hooks *
 *******************************/
// Run all actions and hooks at the end to keep it tidy

if (is_admin()) {
  add_action('admin_menu', 'add_wordpress_airbrake_settings_menu');
}

if (get_option('wordpress_airbrake_enabled')) {
  add_action('init', 'install_php_airbrake');
}

?>
