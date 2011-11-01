<?php

 
// TESTING CODE

$_POST['device'] = "lamp";
$_POST['trigger'] = "mic";
$_POST['condition'] = ">60";
$_POST['action'] = "toggle";
$_POST['negate'] = "false";
$_POST['d_event'] = 1;
$_POST['t_event'] = 2;
//$_POST['init'] = "false";
$_POST['prev_state'] = "false";
 
// DONE TESTING 


// SET UP LINKS TO PREDIS
require "./predis/lib/Predis/Autoloader.php";
Predis\Autoloader::register();

// SET UP CLIENT TO REDIS
$redis = new Predis\Client();

// GET PARAMETERS TO SCRIPT
$device = array_key_exists( "device", $_POST ) ? $_POST[ "device" ] : null;
if( $device == null ) {
	print_r("\nDid not give a device name, quitting.\n");
	return -1;
}

$script_id = $device . "_" . mt_rand();
$script = array(
	"device" => array_key_exists( "device", $_POST ) ? $_POST[ "device" ] : null,
	"trigger" => array_key_exists( "trigger", $_POST ) ? $_POST[ "trigger" ] : null,
	"condition" => array_key_exists( "condition", $_POST ) ? $_POST[ "condition" ] : null,
	"action" => array_key_exists( "action", $_POST ) ? $_POST[ "action" ] : null,
	"negate" => array_key_exists( "negate", $_POST ) ? $_POST[ "negate" ] : null,
	"d_event" => array_key_exists( "d_event", $_POST ) ? $_POST[ "d_event" ] : null,
	"t_event" => array_key_exists( "t_event", $_POST ) ? $_POST[ "t_event" ] : null,
	"init" => "false",
	"prev_state" => "false"
	);

// REMOVE ALL NULLS FROM ARRAY
foreach( $script as $field ) {
	if( $field == null ) {
		unset( $script[ $field ] );
	}
}
print_r( $script );
	
// SET THE SCRIPT AND SCRIPT ID VALUES IN REDIS
$retval = $redis->hmset($script_id, $script);

// ADD SCRIPT ID TO LIST OF ALL SCRIPT IDS
$script_key = "scripts";
$all_scripts = $redis->hvals( $script_key );
array_push( $all_scripts, $script_id );
$redis->del( $script_key );
$redis->hmset( $script_key,  $all_scripts );

if( $retval == 1 ) {
	print_r( "RETURNED TRUE WITH SCRIPT_ID: $script_id\n" );
	return $script_id;
}
else {
	print_r( "RETURNED FALSE\n" );
	return -1;
}
