<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $type; ?> Products | Acme, Inc.</title>
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
<h1><?php echo $type; ?> Products</h1>
<?php if(isset($message)){ echo $message; } ?>
<?php if(isset($prodDisplay)){ echo $prodDisplay; } ?>
</main>
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
</footer>
</div>
</body>
</html>
