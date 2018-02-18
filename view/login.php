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
<main class="acctMain">
    <h1 class="acctH1">Login to your Account</h1>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form method="post">
        <ul class="formLayout">
            <li>
                <label for="email">Email address (required)</label>
                <input type="text" id="email" name="email" required>
              </li>
              <li> 
                <label for="password">Password (required)</label>
                <input type="password" id="password" name="password" required>
              </li>
              <li>
                  <input type="submit" class="submit" value="Login">
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
