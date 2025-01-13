<?php
include_once "includes/css_js.inc.php";
require('db.inc.php');
include_once "header.inc.php";
// Fetch battles for the grid and define $imagePath
$stmt = connectToDB()->prepare("SELECT * FROM battles");
$stmt->execute();
$battles = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<main>
    <section class="grid">
        <div class="container">
            <?php foreach ($battles as $battle):
                $imagePath = !empty($battle['image'])
                    ? 'data:image/jpeg;base64,' . base64_encode($battle['image'])
                    : 'images/3.png';
            ?>
                <a href="detail.php?id=<?= $battle['id']; ?>">
                    <article style="background-image: url('<?= htmlspecialchars($imagePath) ?>'); background-size: cover; background-position: center;">
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