<?php

/* TESTING CODE

$_POST[ "script_id" ] = "lamp_1693924527";
$_POST[ "script_id" ] = "lamp_asdf";

$_POST['device'] = "lamp";
$_POST['trigger'] = "mic";
$_POST['condition'] = ">60";
$_POST['action'] = "toggle";
$_POST['negate'] = "false";
$_POST['d_event'] = 1;
$_POST['t_event'] = 2;
$_POST['init'] = "false";
$_POST['prev_state'] = "false";

DONE TESTING
*/

require "./predis/lib/Predis/Autoloader.php";
Predis\Autoloader::register();

$redis = new Predis\Client();

$script_id = array_key_exists( "script_id", $_POST ) ? $_POST[ "script_id" ] : null;
if( $script_id == null ) {
	print_r( "NO SCRIPT ID GIVEN, QUITTING\n" );
	return -1;
}

// GET PARAMETERS TO SCRIPT
$device = array_key_exists( "device", $_POST ) ? $_POST[ "device" ] : null;
if( $device == null ) {
	print_r("\nDid not give a device name, quitting.\n");
	return -1;
}

$script = array(
	"device" => $device,
	"trigger" => array_key_exists( "trigger", $_POST ) ? $_POST[ "trigger" ] : null,
	"condition" => array_key_exists( "condition", $_POST ) ? $_POST[ "condition" ] : null,
	"action" => array_key_exists( "action", $_POST ) ? $_POST[ "action" ] : null,
	"negate" => array_key_exists( "negate", $_POST ) ? $_POST[ "negate" ] : null,
	"d_event" => array_key_exists( "d_event", $_POST ) ? $_POST[ "d_event" ] : null,
	"t_event" => array_key_exists( "t_event", $_POST ) ? $_POST[ "t_event" ] : null,
	"init" => "false",
	"prev_state" => "false"
	);
	
// SET THE SCRIPT AND SCRIPT ID VALUES IN REDIS
$redis->del( $script_id );
$retval = $redis->hmset($script_id, $script);

if( $retval == 1 ) {
	print_r( "RETURNED TRUE WITH SCRIPT_ID: $script_id\n" );
	return $script_id;
}
else {
	print_r( "RETURNED FALSE\n" );
	return -1;
}
