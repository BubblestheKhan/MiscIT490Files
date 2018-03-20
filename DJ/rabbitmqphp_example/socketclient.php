<?php
require_once("testRabbitMQ.ini");

$host="192.168.1.2";
$port=8008;
$message="Hello Server!\n";
echo "Message to server:".$message;

//Create a socket
$socket= socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket :(\n");

//Connect to Server
$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");

//Send string to Server
socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");

//Get server response
$result = socket_read($socket, 1024) or die("Could not read server response\n");
	echo "Reply From Server:".$result;

//close socket
socket_close($socket);

$client->send_request
