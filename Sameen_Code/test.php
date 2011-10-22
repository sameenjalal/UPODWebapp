<?php

$ip = "192.168.1.101";
$port = 80;
$data = "RX\n";
  $output = "";


  // Create a TCP Stream Socket

  $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

  if ($socket === false)

    throw new Exception("Socket Creation Failed");


  // Connect to the server.

  $result = socket_connect($socket, $ip, $port);

  if ($result === false)

    throw new Exception("Connection Failed");


  // Write to socket!

  socket_write($socket, $data, strlen($data));


  // Read from socket!

/*  do {

    $line = socket_read($socket, 1024, PHP_NORMAL_READ);

    $output .= $line;

  } while ($line != "");

*/
  // Close and return.

  socket_close($socket);

  return $output;