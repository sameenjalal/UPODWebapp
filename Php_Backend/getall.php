<?php

require "./predis/lib/Predis/Autoloader.php";
Predis\Autoloader::register();

$redis = new Predis\Client();

$script_key = "scripts";
$all = $redis->hgetall( $script_key );
if( empty($all) ) {
	print_r( "NO SCRIPTS SET\n" );
	return $all;
}

$all_scripts = array();
foreach( $all as $script_id ) {
	$script_value = $redis->hgetall( $script_id );
	$all_scripts[ $script_id ] = $script_value;
}

// print_r($all_scripts);
$json_all = json_encode( $all_scripts );
print_r( $json_all );
return $json_all;
