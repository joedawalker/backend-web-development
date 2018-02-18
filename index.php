<?php
//This is the acme controller

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

// Get the database connection file
require_once 'library/connections.php';
// Get the acme model for use as needed
require_once 'model/acme-model.php';

// Get the array of categories
$categories = getCategories();

/*var_dump($categories);
exit;*/

$navList = '<ul class="navbar">';
$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
foreach ($categories as $category) {
$navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
}
$navList .= '</ul>';

//echo $navList;
//exit;

switch ($action){
 case "":
 default:
    include 'view/home.php';
}