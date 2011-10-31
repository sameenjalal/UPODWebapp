<?php

require "./predis/lib/Predis/Autoloader.php";
Predis\Autoloader::register();

$redis = new Predis\Client();

$key = "devices";
$all = $redis->hgetall( $key );
if( empty($all) ) {
	print_r( "NO DEVICES SET\n" );
	return $all;
}

$connected = array();
foreach( $all as $device => $value ) {
	if( $value == 1 ) {
		$connected[] = $device;
	}
}

//print_r( $connected );
$json_connected = json_encode( $connected );
print_r( $json_connected );
return $json_connected;
