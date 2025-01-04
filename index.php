<?php
include_once "includes/css_js.inc.php";
require('db.inc.php');

$battles = getBattles();
print "<pre>";
print_r($battles);
print "<pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBSITE HOMEPAGE</title>
    <link rel="stylesheet" href="https://meyerweb.com/eric/tools/css/reset/reset.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" type="x-icon" href="/assets/img/icon.png" />
    <script type="module" src="./dist/<?= $jsPath ?>"></script>
</head>

<body>
    <section class="banner">
        <header>
            <nav class="navbar">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Search Battles</a>
                    </li>
                    <li class="logo">
                        <img src="/assets/img/logo_ba.png" alt="logo" />
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Admin Page</a>
                    </li>
                </ul>
                <div class="moblogo">
                    <img src="/assets/img/logo_ba.png" alt="moblogo" />
                </div>
                <section class="burger">
                    <span><img src="/assets/img/hamburger.png" alt="icon" /></span>
                </section>
            </nav>
        </header>

        <main>
            <section class="grid">
                <div class="container">
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                    <a href="detail.php"><article></article></a>
                </div>
            </section>

            <section class="information">
                <h2>Explore the world's most iconic historic battles.</h2>
                <p>
                    uncover the stories behind interesting historic events. Our site
                    offers a rich database where you can search for battles, delve into
                    their details, and discover their exact locations. Whether you're a
                    history enthusiast, a student, or simply curious, you'll find
                    fascinating insights into the events that shaped our world. Begin
                    your journey through time and relive the moments of valor, strategy,
                    and transformation. Search now and let history come alive!
                </p>
                <div class="buttons">
                    <div class="con">
                        <h3>Think something important is missing?</h3>
                        <a href="#">Contribute</a>
                    </div>
                    <div class="searches">
                        <h3>Tired of scrolling?</h3>
                        <a href="#">Search</a>
                    </div>
                </div>
            </section>
        </main>
    </section>

    <footer>
        <p>&copy; Battle archives 2024-2025</p>
        <ul>
            <li>Privacy policy</li>
            <li>Terms of use</li>
            <li>Cookies Policy</li>
        </ul>
    </footer>
    <script src="main.js"></script>
</body>

</html>
