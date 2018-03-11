<?php
    // Verify user is an administrator
    if($_SESSION['clientData']['clientLevel'] < 2){
    header('Location: /acme/');
    }?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName] ";}?> | ACME.com </title>
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
    <h1><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";}?></h1>
    <p>Confirm Product Deletion. The delete is permanent.</p>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form action="/acme/products/index.php" id="newProduct" method="post">
        <ul class="formLayout">
            <li>
                <label for="invName">Product Name</label>
                <input type="text" id="invName" name="invName" readonly <?php if(isset($prodInfo['invName'])){echo "value='$prodInfo[invName]'";} ?>>
            </li>
            <li>
                <label for="invDescription">Description</label>
                <textarea name="invDescription" readonly id="invDescription"><?php if(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; } ?></textarea>
            </li>
            <li>
                <label>&nbsp;</label>
                <input type="submit" class="submit" value="Delete Product">
                <input type="hidden" name="action" value="deleteProd">
                <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];}?>">
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
