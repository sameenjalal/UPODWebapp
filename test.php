<?php
//require "./predis/lib/Predis/Autoloader.php";
require "/home/samjalal/sameenjalal.com/UPOD/UPODWebapp/predis/lib/Predis/Autoloader.php";
Predis\Autoloader::register();

$redis = new Predis\Client();
//$redis->set('foo', 'bar');
$value = $redis->get('foo');
print( $value );
