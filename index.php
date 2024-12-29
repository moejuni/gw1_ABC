<?php
include_once "includes/css_js.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

echo "dit is php";

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBSITE HOMEPAGE</title>
    <link rel="stylesheet" href="https://meyerweb.com/eric/tools/css/reset/reset.css" />
    <link rel="stylesheet" href="./dist/<?= $cssPath ?>" />
    <script type="module" src="./dist/<?= $jsPath ?>"></script>
</head>

<body>
    <section class="banner">
        <header>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Search Battles</a></li>
                    <li class="logo">
                        <img src="/images/logo_ba.png" alt="logo" />
                    </li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Admin Page</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <section class="grid">
                <div class="container">
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
                    <article></article>
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
</body>

</html>