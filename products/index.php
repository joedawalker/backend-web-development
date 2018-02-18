<?php
// This is the products controller
 

// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the products model for use as needed
require_once '../model/products-model.php';


// Get the array of categories
$categories = getCategories();

// Navigation list for dynamic menu
$navList = '<ul class="navbar">';
$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
foreach ($categories as $category) {
    $navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
}
$navList .= '</ul>';

// Category List for dynamic drop down menu
$catList = '<select name="categoryId" id="categoryMenu">';
foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>";
}
$catList .= '</select>';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'addCategory':
        include '../view/add-category.php';
        break;
    case 'addProduct':
        include '../view/add-product.php';
        break;
    case 'newCategory':
        // Filter and store the data
        $categoryName = filter_input(INPUT_POST, 'categoryName');
        
        // Check for missing data
        if(empty($categoryName)){
        $message = '<p id="message">Please provide information for all empty form fields.</p>';
        include '../view/add-category.php';
        exit; }
        
        // Send the data to the model
        $catOutcome = addCategory($categoryName);
        
        // Check and report the result
        if($catOutcome === 1){
         $message = "<p id='message'>The $categoryName category was added successfully.</p>";
         include '../view/prod-management.php';
         exit;
        } else {
         $message = "<p id='message'>Sorry, system failed to add the $categoryName category. Please try again.</p>";
         include '../view/add-category.php';
         exit;
        }
        
        break;
        
    case 'newProduct':
        // Filter and store the data
        $categoryId = filter_input(INPUT_POST, 'categoryId');
        $invName = filter_input(INPUT_POST, 'invName');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invImage = filter_input(INPUT_POST, 'invImage');
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invSize = filter_input(INPUT_POST, 'invSize');
        $invWeight = filter_input(INPUT_POST, 'invWeight');
        $invLocation = filter_input(INPUT_POST, 'invLocation');
        $invVendor = filter_input(INPUT_POST, 'invVendor');
        $invStyle = filter_input(INPUT_POST, 'invStyle');
        
       // echo "$categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle";
// Check for missing data
        if(empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)){
        $message = '<p id="message">Please provide information for all empty form fields.</p>';
        include '../view/add-product.php';
        exit; }
        
        // Send the data to the model
        $prodOutcome = addProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle);
        
        // Check and report the result
        if($prodOutcome === 1){
         $message = "<p id='message'>The $invName was successfully added to inventory.</p>";
         include '../view/prod-management.php';
         exit;
        } else {
         $message = "<p id='message'>Sorry, system failed to add the $invName to inventory. Please try again.</p>";
         include '../view/add-product.php';
         exit;
        }
        
        break;
    default:
        include '../view/prod-management.php';
}
