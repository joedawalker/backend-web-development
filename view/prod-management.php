<?php
// Verify user is an administrator
if($_SESSION['clientData']['clientLevel'] < 2){
    header('Location: /acme/');
} 

//Pass update - message into scope
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Management | ACME.com </title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/acme/css/acme.css" media="screen">
</head>

<body>
<div id="page-display">
<header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/header.php'; ?>
</header>
<nav id="navigation">
    <?php echo $navList; ?>
</nav>
<main>
    <h1>Product Management</h1>
    <a href='/acme/products/index.php?action=addCategory' title='Add a category' id='catLink'>Add Category</a>
    <a href='/acme/products/index.php?action=addProduct' title='Add a product to inventory' id='prodLink'>Add Product</a>
    <?php
        if (isset($message)) {
            echo $message;
        }
        
        if (isset($prodList)) {
            echo $prodList;
        }
    ?>
</main>
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
</footer>
</div>
</body>
</html><?php unset($_SESSION['message']); ?>

