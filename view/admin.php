<?php
    if($_SESSION['loggedin'] == FALSE){
        header('Location: /acme/');
    }

    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
?><!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Admin | ACME.com </title>
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
                <h1>
                    <?php echo $_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname']; ?>
                </h1>
                <p class="acctConf"> You are logged in. (Not <?php echo $_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname']; ?>? <a href='/acme/accounts/index.php?action=Logout' class="adminLink">Log out</a>)</p>
                <?php
                    if (isset($message)) {
                        echo $message;
                    }
                ?>
                <ul id="clientInfo">
                    <li>First name:
                        <?php echo $_SESSION['clientData']['clientFirstname']; ?>
                    </li>
                    <li>Last name:
                        <?php echo $_SESSION['clientData']['clientLastname']; ?>
                    </li>
                    <li>Email:
                        <?php echo $_SESSION['clientData']['clientEmail']; ?>
                    </li>
                </ul>
                <p><a href="/acme/accounts/index.php?action=editClient" class="adminLink">Update your account Info</a></p>
                <?php
                if($_SESSION['clientData']['clientLevel'] > 1){ ?>
                <h2 class="adminHeading">Product Administration</h2>
                
                <?php  echo $adminLink;
                } ?>
            </main>
            <footer>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
            </footer>
        </div>
    </body>

    </html>
