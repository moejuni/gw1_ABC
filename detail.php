<?php
include_once('db.inc.php');


$description = getDesc();
$battles = getBattleNames();


if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

 
    $stmt = connectToDB()->prepare("SELECT * FROM battles WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $battle = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "No battle selected.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="x-icon" href="/assets/img/icon.png" />
    <link rel="stylesheet" href="https://meyerweb.com/eric/tools/css/reset/reset.css" />
    <link rel="stylesheet" href="css/detail.css" />
    <script type="module" src="./dist/<?= $jsPath ?>"></script>
<title>Detail Page</title>
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
                <?php if ($battle): ?>
                    <h2><?= htmlspecialchars($battle['title']); ?></h2>
                    <p><?= htmlspecialchars($battle['description']); ?></p>
                <?php else: ?>
                    <p>Battle not found.</p>
                <?php endif; ?>
                
                <div class="readmore">
                    <div class="container">
                        <p>
                            <span class="read-more-text">
                                <br /><?= htmlspecialchars($battle['extended_description'] ?? ''); ?>
                            </span>
                        </p>
                    </div>
                </div>
                <span class="read-more-btn">Read more..</span>
            </section>

            <section class="fullimg">
                <div class="infoimg">
                    <?php if (!empty($battle['image_path'])): ?>
                        <img src="<?= htmlspecialchars($battle['image_path']); ?>" alt="Battle Image" />
                    <?php else: ?>
                        <img src="images/3.png" alt="Default Image" />
                    <?php endif; ?>
                </div>
            </section>

            <section class="back-link">
                <a href="index.php">Back to Battle List</a>
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
</body>
</html>
