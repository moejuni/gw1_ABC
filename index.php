<?php
include_once "includes/css_js.inc.php";
require('db.inc.php');
include_once "header.inc.php";

// Controleer of er een zoekterm is opgegeven
$battles = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['searchterm'])) {
    // Zoek naar battles
    $searchterm = "%" . trim($_POST['searchterm']) . "%";
    $stmt = connectToDB()->prepare("SELECT id, title, image FROM battles WHERE title LIKE :searchterm");
    $stmt->bindParam(':searchterm', $searchterm, PDO::PARAM_STR);
    $stmt->execute();
    $battles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Haal alle battles op als er geen zoekterm is
    $stmt = connectToDB()->prepare("SELECT id, title, image FROM battles");
    $stmt->execute();
    $battles = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle Archives</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .search-container {
            display: none;
            /* Verbergt de extra zoekbalk */
        }
    </style>
</head>

<body>
    <section class="banner">
        <header>
            <nav>
                <!-- Zoekbalk alleen in de header -->
                <form action="index.php" method="post" class="search-container">
                    <input type="text" name="searchterm" placeholder="Search Battles" value="<?= isset($_POST['searchterm']) ? htmlspecialchars($_POST['searchterm']) : ''; ?>">
                    <input type="submit" value="Search">
                </form>
            </nav>
        </header>
    </section>
    <main>
        <section class="grid">
            <div class="container">
                <?php if (!empty($battles)): ?>
                    <?php foreach ($battles as $battle):
                        $imagePath = !empty($battle['image'])
                            ? 'data:image/jpeg;base64,' . base64_encode($battle['image']) // base 64 zorgt ervoor dat de afbeelding wordt getoond, verwerkt binaire code
                            : 'images/3.png';
                    ?>
                        <a href="detail.php?id=<?= htmlspecialchars($battle['id']); ?>">
                            <article style="background-image: url('<?= $imagePath ?>'); background-size: cover; background-position: center;">
                                <p class="text"><?= htmlspecialchars($battle['title']); ?></p>
                            </article>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No results found for "<?= htmlspecialchars($_POST['searchterm'] ?? ''); ?>".</p>
                <?php endif; ?>
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
    <footer>
        <p>&copy; Battle Archives 2024-2025</p>
        <ul>
            <li>Privacy policy</li>
            <li>Terms of use</li>
            <li>Cookies Policy</li>
        </ul>
    </footer>
</body>

</html>