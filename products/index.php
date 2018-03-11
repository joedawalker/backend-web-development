<?php
// This is the products controller
 
session_start();
// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the products model for use as needed
require_once '../model/products-model.php';
// Get the functions library
require_once '../library/functions.php';


// Get the array of categories
$categories = getCategories();

// Navigation list for dynamic menu
$navList = buildNavList($categories);

// Category List for dynamic drop down menu
//$catList = '<select name="categoryId" id="categoryMenu">';
//foreach ($categories as $category) {
//    $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>";
//}
//$catList .= '</select>';

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
        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
        
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
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
        
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
    case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if(count($prodInfo)<1){
         $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-update.php';
        exit;
        break;
    case 'updateProd':
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
       // echo "$categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle";
// Check for missing data
        if(empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)){
        $message = '<p id="message">Please provide information for all empty form fields.</p>';
        include '../view/prod-update.php';
        exit; }
        
        // Send the data to the model
        $updateResult = updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId);
        
        // Check and report the result
        if ($updateResult) {
            $message = "<p id='message'>$invName was successfully updated in inventory.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
         $message = "<p id='message'>Sorry, system failed to update the $invName in inventory. Please try again.</p>";
         include '../view/prod-update.php';
         exit;
        }
        
        break;
    Case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if(count($prodInfo)<1){
         $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-delete.php';
        exit;
        break;
    case 'deleteProd':
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
       
        // Send the data to the model
        $deleteResult = deleteProduct($invId);
        
        // Check and report the result
        if ($deleteResult) {
            $message = "<p id='message'>$invName was successfully deleted from inventory.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<p id='message'>Sorry, system failed to delete the $invName from inventory. Please try again.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        }
        
        break;
    default:
        $products = getProductBasics();
        
        if(count($products) > 0){
            $prodList = '<table id="prodTable">';
            $prodList .= '<thead>';
            $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $prodList .= '</thead>';
            $prodList .= '<tbody>';
            foreach ($products as $product) {
             $prodList .= "<tr><td>$product[invName]</td>";
             $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
             $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
            }
             $prodList .= '</tbody></table>';
        } else {
             $message = '<p class="notify">Sorry, no products were returned.</p>';
        }
        
        include '../view/prod-management.php';
}
