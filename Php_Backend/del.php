<?php

// TESTING CODE

//$_POST[ "script_id" ] = "lamp_1693924527";
//$_POST[ "script_id" ] = "lamp_asdf";

// DONE TESTING

require "./predis/lib/Predis/Autoloader.php";
Predis\Autoloader::register();

$redis = new Predis\Client();

$script_id = array_key_exists( "script_id", $_POST ) ? $_POST[ "script_id" ] : null;
if( $script_id == null ) {
	print_r( "NO SCRIPT ID GIVEN, QUITTING\n" );
	return -1;
}

$all = $redis->del( $script_id );
print_r( $all . "\n" );
return $all;
