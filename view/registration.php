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
                <label for="clientFirstName">First Name (required)</label>
                <input type="text" id="clientFirstName" name="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>
            </li>
            <li>
                <label for="clientLastName">Last Name (required)</label>
                <input type="text" id="clientLastName" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required>
            </li>
            <li>
                <label for="clientEmail">Email (required)</label>
                <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
            </li>
            <li>
                <span class="pswdSpan">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span>
                <label for="clientPassword">Password (required)</label>
                <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
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
