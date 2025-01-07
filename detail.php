<?php 
require('db.inc.php');
if (isset($_GET['id'])) {
    $battle_id = (int) $_GET['id']; 
    $stmt = connectToDB()->prepare("SELECT * FROM battles WHERE id = :id");
    $stmt->bindParam(':id', $battle_id, PDO::PARAM_INT);
    $stmt->execute();
    $battle = $stmt->fetch(PDO::FETCH_ASSOC);

   
    if (!$battle) {
        echo "Battle not found.";
        exit;  
    }
} else {
    echo "No battle ID specified.";
    exit;  
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="x-icon" href="/assets/img/icon.png" />
    <link
        rel="stylesheet"
        href="https://meyerweb.com/eric/tools/css/reset/reset.css" />
    <link rel="stylesheet" href="css/detail.css" />
    <title>detail pagina</title>
</head>

<body class="detail-page">
    <section class="banner">
        <header>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Search Battles</a></li>
                    <li class="logo">
                        <img src="images/logo_ba.png" alt="logo" />
                    </li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Admin Page</a></li>
                </ul>
            </nav>
        </header>

        <main class="detail">
            <section class="info">
                <h2><?= htmlspecialchars($battle['title']); ?></h2>
                <div class="readmore">
                    <div class="container">
                        <p>
                           <?= htmlspecialchars($battle['description']); ?>
                            <span class="read-more-text">
                              <?= htmlspecialchars($battle['description']); ?>
                            </span>
                        </p>
                    </div>
                </div>
                <span class="read-more-btn">Read more..</span>
            </section>
            <section class="fullimg">
                <div class="infoimg">
                    <img src="images/3.png" alt="image" />
                </div>
            </section>
        </main>
    </section>
    <footer class="detailf">
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