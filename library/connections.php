<?php

/* 
 * PDO connection
 */

function acmeConnect(){
$server = 'localhost';
$dbname= 'acme';
$username = 'net_client';
$password = '22Sr51juUYKCuD5m';
$dsn = "mysql:host=$server;dbname=$dbname";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

// Create the actual connection object and assign it to a variable
try {
$link = new PDO($dsn, $username, $password, $options);
return $link;
} catch(PDOException $e) {
header('Location: /acme/view/500.php');
exit;
}
}


