<img src="/acme/images/site/logo.gif" alt="ACME site logo, ACME Buy Here. Eat Roadrunner" id="logo">
<?php if(isset($cookieFirstname)){
  echo "<span>Welcome $cookieFirstname</span>";
} ?>
<figure id="account-img">
    <img src="/acme/images/site/account.gif" alt="Log in and access your ACME account" id="account">
    <figcaption><?php
                if (!empty($_SESSION)){
                    echo "<a href='/acme/accounts/index.php?action=Logout'>Log out</a>";
                }else {
                    echo "<a href='/acme/accounts/index.php?action=login'>My Account</a>";
                }
                ?></figcaption>
</figure>
