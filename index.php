<?php
//This is the acme controller

// Create or access a Session
session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

// Get the database connection file
require_once 'library/connections.php';
// Get the acme model for use as needed
require_once 'model/acme-model.php';
// Get the functions library
require_once 'library/functions.php';



// Get the array of categories
$categories = getCategories();

/*var_dump($categories);
exit;*/

$navList = buildNavList($categories);
//echo $navList;
//exit;

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action){
 case "":
 default:
    include 'view/home.php';
}