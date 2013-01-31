<?php
/** Exception Test **/

require_once( dirname( dirname( __FILE__ ) ) . '/../../wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php');
?>

<h1>Wordpress-Airbrake Test</h1>

Check your Airbrake account for "A test of the emergency airbrake system."

<?php
require_once( ABSPATH . 'wp-admin/admin-footer.php');

throw new Exception("A test of the emergency airbrake system.");

?>
