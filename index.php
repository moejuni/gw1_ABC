<?php
include_once "includes/css_js.inc.php";
require('db.inc.php');

 $battles = getBattleNames();
// print "<pre>";
// print_r($titles);
// print "<pre>";
if(isset($_POST['searchterm']) && !empty($_POST['searchterm'])) {
    $battles = searchbattles($_POST['searchterm']);
} else {
    $battles = getBattleNames();
}

// ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle Archives</title>
    <link rel="stylesheet" href="https://meyerweb.com/eric/tools/css/reset/reset.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" type="x-icon" href="images/icon.png" />
    <script type="module" src="./dist/<?= $jsPath ?>"></script>
</head>

<body>
    <section class="banner">
        <header>
            <nav class="navbar">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <form action="index.php" method="post">
<input type="text" name="searchterm" placeholder="Search Battles" value="<?= isset($_POST['searchterm']) ? htmlspecialchars($_POST['searchterm']) : ''; ?> ">
<input type="submit" value="Search" class="submit">
                        </form>
                    </li>
                    <li class="logo">
                        <img src="images/logo_ba.png" alt="logo" />
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Admin Page</a>
                    </li>
                </ul>
                <div class="moblogo">
                    <img src="images/logo_ba.png" alt="moblogo" />
                </div>
               <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
               </div>
            </nav>
        </header>

        <main>
        <section class="grid">
        <div class="container">
            <?php foreach ($battles as $battle): ?>
                
            <a href="detail.php?id=<?=$battle['id']; ?>"> 

                    <article>
                        <p class="text"><?= htmlspecialchars($battle['title']); ?></p>
                    </article>
                </a>
            <?php endforeach; ?>
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
