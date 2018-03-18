<?php
// This is the Products model

function addCategory($categoryName){
    
    $db = acmeConnect();
    // The SQL statement
    $sql = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function addProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle) {
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'INSERT INTO inventory (invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, categoryId, invVendor, invStyle) VALUES (:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle)';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // Bind the values
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
    
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function getProductBasics() {
    $db = acmeConnect();
    $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
}

// Get product information by invId
function getProductInfo($invId){
    $db = acmeConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $prodInfo;
}

// update the product info in the inventory table
function updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId) {
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invSize = :invSize, invWeight = :invWeight, invLocation = :invLocation, categoryId = :categoryId, invVendor = :invVendor, invStyle = :invStyle WHERE invId = :invId';
    
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // Bind the values
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Delete product from inventory
function deleteProduct($invId) {
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The Delete SQL statement
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function getProductsByCategory($type){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :catType)';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':catType', $type, PDO::PARAM_STR);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}

function getProductById($id){
    $db = acmeConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $product;
}

function buildProductsDisplay($products){
 $pd = '<ul id="prod-display">';
 foreach ($products as $product) {
  $pd .= '<li>';
  $pd .= "<a href='/acme/products/?action=product&id=$product[invId]' title='View our $product[invName] product'><img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'></a>";
  $pd .= '<hr>';
  $pd .= "<h2><a href='/acme/products/?action=product&id=$product[invId]' title='View our $product[invName] product'>$product[invName]</a></h2>";
  $pd .= "<span>$$product[invPrice]</span>";
  $pd .= '</li>';
 }
 $pd .= '</ul>';
 return $pd;
}

function buildProdDisplay($product){
    $pd = '<div id="prod-wrapper">';
    $pd .= "<img src='$product[invImage]' alt='Image of $product[invName] on Acme.com' id='prodImg'>";
    $pd .= '<ul id="prod-info">';
    //$pd .= "<li><h2>$product[invName]</h2></li>";
    $pd .= "<li>Made by $product[invVendor]<hr></li>";
    $pd .= "<li id='price'>Price: $$product[invPrice]</li>";
    if ($product['invStock']) {
        $pd .= "<li id='inStock'>$product[invStock] left in stock</li>";
    } else {
        $pd .= "<li id='outOfStock'>Sorry this item is currently out of stock</li>";
    }
    $pd .= "<li>$product[invDescription]</li>";
    $pd .= '<li><ul id="prod-details">';
    $pd .= "<li>$product[invSize] in<sup>3</sup></li>";
    $pd .= "<li>Weighs $product[invWeight] lbs</li>";
    $pd .= "<li>Made of $product[invStyle]</li>";
    $pd .= "<li>Made in $product[invLocation]</li>";
    $pd .= '</ul></li>';
    $pd .= '</ul></div>';
 return $pd;
}