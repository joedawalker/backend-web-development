<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration | ACME.com </title>
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
    <h1 class="acctH1">Register Your Account</h1>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form action="/acme/accounts/index.php" id="register" method="post">
        <ul class="formLayout">
            <li>
                <label for="firstName">First Name (required)</label>
                <input type="text" id="clientFirstName" name="clientFirstname">
            </li>
            <li>
                <label for="lastName">Last Name (required)</label>
                <input type="text" id="clientLastName" name="clientLastname">
            </li>
            <li>
                <label for="email">Email (required)</label>
                <input type="text" id="clientEmail" name="clientEmail">
            </li>
            <li> 
                <label for="password">Password (required)</label>
                <input type="password" id="clientPassword" name="clientPassword">
            </li>
            <li>
                <input type="submit" class="submit" value="Register">
                <input type="hidden" name="action" value="register">
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
