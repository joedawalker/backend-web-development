<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home | ACME.com </title>
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
            <!--<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/navigation.php'; ?>-->
        </nav>
        <main>
            <section id="home-content">
                <h1>Welcome to ACME!</h1>
                <section id="advertisement-banner">
                    <ul id="rocket-ad">
                        <li class="ad-description">
                            <h2>Acme Rocket</h2>
                        </li>
                        <li class="ad-description">Quick lighting fuse</li>
                        <li class="ad-description">NHTSA approved seat belts</li>
                        <li class="ad-description">Mobile launch stand included</li>
                        <li id="btnitem"><a href="#"><img id="actionbtn" alt="Add to cart button" src="/acme/images/site/iwantit.gif"></a></li>
                    </ul>
                </section>
                <div id="featured-content">
                    <section id="recipes">
                        <h3>Featured Recipes</h3>
                        <div id="featured-recipes">
                            <figure id="figure1">
                                <img src="images/recipes/bbqsand.jpg" alt="Roadrunner BBQ Sandwich Icon">
                                <figcaption><a href='/acme/index.php?action=login' title="Pulled Roadrunner BBQ Sandwich Recipe">Pulled Roadrunner BBQ</a></figcaption>
                            </figure>
                            <figure>
                                <img src="images/recipes/potpie.jpg" alt="Roadrunner Pot Pie Icon">
                                <figcaption><a href="#" title="Roadrunner Pot Pie Recipe">Roadrunner Pot Pie</a></figcaption>
                            </figure>
                            <figure>
                                <img src="images/recipes/soup.jpg" alt="Roadrunner Soup Icon">
                                <figcaption><a href="#" title="Roadrunner Soup Recipe">Roadrunner Soup</a></figcaption>
                            </figure>
                            <figure>
                                <img src="images/recipes/taco.jpg" alt="Roadrunner Tacos Icon">
                                <figcaption><a href="#" title="Roadrunner Tacos Recipe">Roadrunner Tacos</a></figcaption>
                            </figure>
                        </div>
                    </section>
                    <section id="reviews">
                        <h3>ACME Rocket Reviews</h3>
                        <ul>
                            <li>"I don't know how I ever caught roadrunners before this." (9/10)</li>
                            <li>"That thing was fast!" (4/5)</li>
                            <li>"Talk about fast delivery." (5/5)</li>
                            <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
                            <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
                        </ul>
                    </section>
                </div>
            </section>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
