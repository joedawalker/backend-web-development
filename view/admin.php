<?php
if(!isset($_SESSION)){
  header('Location: /acme/');
} ?>
    <!doctype html>
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
                <?php
                if($_SESSION['clientData']['clientLevel'] > 1){
                  echo $adminLink;
                } ?>
            </main>
            <footer>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
            </footer>
        </div>
    </body>

    </html>
