<?php
require "./predis/lib/Predis/Autoloader.php";
Predis\Autoloader::register();

$redis = new Predis\Client();

$script_id = "asdf";
$script = array(
	"a" => "asdf1",
	"s" => "asdf2",
	"d" => "asdf3",
	"f" => "asdf4"
	);

$retval = $redis->hmset( $script_id , $script );
print( $retval );
