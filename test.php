<?php
/** Exception Test **/
require_once( dirname( dirname( __FILE__ ) ) . '/../../wp-load.php' );
?>

<h1>Wordpress-Airbrake Test</h1>

<p>
An exception has been generated and sent to Airbrake.
</p>

<p>
If all has gone well, then your Airbrake dashboard should show an exception called: "A test of the emergency airbrake system".
</p>

<?php
throw new Exception("A test of the emergency airbrake system");
?>
