<?php
    if($_SESSION['loggedin'] == FALSE){
        header('Location: /acme/');
    }

    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
    if (isset($_SESSION['pmessage'])) {
        $message = $_SESSION['pmessage'];
    }
?><!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Account Update | ACME.com </title>
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
                    Update Your Account Information
                </h1>
                
                <?php
                    if (isset($upmessage)) {
                        echo $upmessage;
                    }
                ?>
                <form action="/acme/accounts/index.php" class="upClientForm" method="post">
                    <ul class="formLayout">
                        <li>
                            <label for="clientFirstname">Product Name</label>
                            <input type="text" id="clientFirstname" name="clientFirstname" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($clientInfo['clientFirstname'])) {echo "value='$clientInfo[clientFirstname]'"; } ?>>
                        </li>
                        <li>
                            <label for="clientLastname">Product Name</label>
                            <input type="text" id="clientLastname" name="clientLastname" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($clientInfo['clientLastname'])) {echo "value='$clientInfo[clientLastname]'"; } ?>>
                        </li>
                        <li>
                            <label for="clientEmail">Product Name</label>
                            <input type="email" id="clientEmail" name="clientEmail" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($clientInfo['clientEmail'])) {echo "value='$clientInfo[clientEmail]'"; } ?>>
                        </li>
                        <li>
                            <input type="submit" class="submit" value="Update Client">
                            <input type="hidden" name="action" value="updateClient">
                            <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId'];?>">
                        </li>
                    </ul>
                </form>
               
                <h2 id="pswdH2">Change Password</h2>
                <?php
                    if (isset($pmessage)) {
                        echo $pmessage;
                    }
                ?>
                <form action="/acme/accounts/index.php" class="upClientForm" id="pswdForm" method="post">
                    <ul class="formLayout">
                        <li>
                            <span class="pswdSpan">By entering a new password you will change your current password. Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span>
                            <label for="clientPassword">Password</label>
                            <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                        </li>
                        <li>
                            <input type="submit" class="submit" value="Change Password">
                            <input type="hidden" name="action" value="changePass">
                            <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId'];?>">
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
