<?php
    $catList = '<select name="categoryId" id="categoryMenu">';
    $catList .= "<option>Choose a Category </option>";
    foreach ($categories as $category) {
        $catList .= "<option value='$category[categoryId]'";
        if(isset($categoryId)) {
            if($category['categoryId'] === $categoryId){
                $catList .= ' selected ';
            }
        } elseif(isset($prodInfo['categoryId'])){
            if($category['categoryId'] === $prodInfo['categoryId']){
                $catList .= ' selected ';
            }
        }
        $catList .= ">$category[categoryName]</option>";
    }
    $catList .= '</select>';
    
    
    
    // Verify user is an administrator
    if($_SESSION['clientData']['clientLevel'] < 2){
    header('Location: /acme/');
    }?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?> | ACME.com </title>
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
    <h1><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?></h1>
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
                <input type="text" id="invName" name="invName" required <?php if(isset($invName)){echo "value='$invName'";} elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; } ?>>
            </li>
            <li>
                <label for="invDescription">Description</label>
                <input type="text" id="invDescription" name="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";} elseif(isset($prodInfo['invDescription'])) {echo "value='$prodInfo[invDescription]'"; }?> required>
            </li>
            <li>
                <label for="invImage">Image</label>
                <input type="text" id="invImage" name="invImage" <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($prodInfo['invImage'])) {echo "value='$prodInfo[invImage]'"; }?> required>
            </li>
            <li>
                <label for="invThumbnail">Thumbnail</label>
                <input type="text" id="invThumbnail" name="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($prodInfo['invThumbnail'])) {echo "value='$prodInfo[invThumbnail]'"; }?> required>
            </li>
            <li>
                <label for="invPrice">Price</label>
                <input type="text" id="invPrice" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; }?> required>
            </li>
            <li>
                <label for="invStock">Stock</label>
                <input type="text" id="invStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; }?> required>
            </li>
            <li>
                <label for="invSize">Size</label>
                <input type="text" id="invSize" name="invSize" <?php if(isset($invSize)){echo "value='$invSize'";} elseif(isset($prodInfo['invSize'])) {echo "value='$prodInfo[invSize]'"; }?> required>
            </li>
            <li>
                <label for="invWeight">Weight</label>
                <input type="text" id="invWeight" name="invWeight" <?php if(isset($invWeight)){echo "value='$invWeight'";} elseif(isset($prodInfo['invWeight'])) {echo "value='$prodInfo[invWeight]'"; }?> required>
            </li>
            <li>
                <label for="invLocation">Location</label>
                <input type="text" id="invLocation" name="invLocation" <?php if(isset($invLocation)){echo "value='$invLocation'";} elseif(isset($prodInfo['invLocation'])) {echo "value='$prodInfo[invLocation]'"; }?> required>
            </li>
            <li>
                <label for="invVendor">Vendor</label>
                <input type="text" id="invVendor" name="invVendor" <?php if(isset($invVendor)){echo "value='$invVendor'";} elseif(isset($prodInfo['invVendor'])) {echo "value='$prodInfo[invVendor]'"; }?> required>
            </li>
            <li>
                <label for="invStyle">Style</label>
                <input type="text" id="invStyle" name="invStyle" <?php if(isset($invStyle)){echo "value='$invStyle'";} elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invStyle]'"; }?> required>
            </li>
            <li>
                <input type="submit" class="submit" value="Update Product">
                <input type="hidden" name="action" value="updateProd">
                <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
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
