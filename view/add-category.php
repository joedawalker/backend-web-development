<?php
// Verify user is an administrator
if(!isset($_SESSION) || $_SESSION['clientData']['clientLevel'] < 2){
    header('Location: /acme/');
} ?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category | ACME.com </title>
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
<main class="colMain">
    <h1>Add Category</h1>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form action="/acme/products/index.php" id="newCategory" method="post">
        <ul class="formLayout" id="catForm">
            <li>
                <label for="categoryName">Category Name</label>
                <input type="text" id="categoryName" name="categoryName" required>
            </li>
            <li>
                <input type="submit" class="submit" value="Add Category">
                <input type="hidden" name="action" value="newCategory">
            </li>
        </ul>
    </form>
</main>
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
</footer>
</div>
</body>
</html>
