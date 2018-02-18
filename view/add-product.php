<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product | ACME.com </title>
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
    <h1>Add Product</h1>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form action="/acme/products/index.php" id="newProduct" method="post">
        <ul class="formLayout">
            <li>
                <?php echo $catList; ?>
            </li>
            <li>
                <label for="invName">Product Name</label>
                <input type="text" id="invName" name="invName">
            </li>
            <li>
                <label for="invDescription">Description</label>
                <input type="text" id="invDescription" name="invDescription">
            </li>
            <li>
                <label for="invImage">Image</label>
                <input type="text" id="invImage" name="invImage">
            </li>
            <li>
                <label for="invThumbnail">Thumbnail</label>
                <input type="text" id="invThumbnail" name="invThumbnail">
            </li>
            <li>
                <label for="invPrice">Price</label>
                <input type="text" id="invPrice" name="invPrice">
            </li>
            <li>
                <label for="invStock">Stock</label>
                <input type="text" id="invStock" name="invStock">
            </li>
            <li>
                <label for="invSize">Size</label>
                <input type="text" id="invSize" name="invSize">
            </li>
            <li>
                <label for="invWeight">Weight</label>
                <input type="text" id="invWeight" name="invWeight">
            </li>
            <li>
                <label for="invLocation">Location</label>
                <input type="text" id="invLocation" name="invLocation">
            </li>
            <li>
                <label for="invVendor">Vendor</label>
                <input type="text" id="invVendor" name="invVendor">
            </li>
            <li>
                <label for="invStyle">Style</label>
                <input type="text" id="invStyle" name="invStyle">
            </li>
            <li>
                <input type="submit" class="submit" value="Add Product">
                <input type="hidden" name="action" value="newProduct">
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
