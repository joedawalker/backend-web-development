<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | ACME.com </title>
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
    <h1 class="acctH1">Login to your Account</h1>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form method="post" action="/acme/accounts/">
        <ul class="formLayout">
            <li>
                <label for="clientEmail">Email address (required)</label>
                <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
              </li>
              <li>
              <span class="pswdSpan">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span>
                <label for="clientPassword">Password (required)</label>
                <input type="password" id="clientPassword" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
              </li>
              <li>
                  <input type="submit" class="submit" value="Login">
                  <input type="hidden" name="action" value="Login">
              </li>
              <li id="registerBtn">
                  <a href='/acme/accounts/index.php?action=registration' title='Register for an acme account'>Register for an account</a>
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
