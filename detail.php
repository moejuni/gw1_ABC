<?php
require('db.inc.php');
include_once "includes/css_js.inc.php";

if (isset($_GET['id'])) {
    $battle_id = (int) $_GET['id'];
    $stmt = connectToDB()->prepare("SELECT * FROM battles WHERE id = :id");
    $stmt->bindParam(':id', $battle_id, PDO::PARAM_INT);
    $stmt->execute();
    $battle = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$battle) {
        header("location: index.php");
        exit;
    }

    // Controleer afbeelding
    $imagePath = (!empty($battle['image']) && $battle['image'] !== 'default.jpg')
        ? 'data:image/jpeg;base64,' . base64_encode($battle['image'])
        : 'images/3.png';
} else {
    echo "No battle ID specified.";
    exit;
}

$lat = $battle['latitude'];
$long = $battle['longitude'];
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <title>Detail Pagina</title>
</head>

<body class="detail-page">
    <section class="banner">
        <header>
            <nav>
                <ul class="nav-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php">Search Battles</a></li>
                    <a href="index.php" class="logo">
                        <li>
                            <img src="images/logo_ba.png" alt="logo" />
                        </li>
                    </a>
                    <li><a href="about.php">About</a></li>
                    <li><a href="admin/login.php">Log In</a></li>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <div class="mobile-logo">
                    <img src="images/logo_ba.png" alt="logo">
                </div>
            </nav>
        </header>

        <main class="detail">
            <section class="info">
                <h2><?= htmlspecialchars($battle['title']); ?></h2>
                <div class="readmore">
                    <div class="container">
                        <p>
                            <?= htmlspecialchars($battle['shdescription']); ?>
                            <span class="read-more-text">
                                <?= htmlspecialchars($battle['description']); ?>
                            </span>
                        </p>
                    </div>
                </div>
                <span class="read-more-btn">Read more..</span>
                <div class="info-block">
                    <section class="map">
                        <p class="click-l">Click here for location</p>
                        <div class="maplocation" id="map"></div>
                    </section>
                    <p>Year: <?= htmlspecialchars($battle['year']); ?></p>
                </div>
            </section>

            <section class="fullimg">
                <div class="infoimg">
                    <img class="detail-img" src="<?= htmlspecialchars($imagePath); ?>" alt="Battle Image" />
                </div>
            </section>

            <div class="back-link">
                <a href="index.php">Back to battle list</a>
            </div>
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

    <script>
        var map = L.map('map').setView([<?= $lat ?>, <?= $long ?>], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([<?= $lat ?>, <?= $long ?>]).addTo(map)
            .bindPopup('<b><?= htmlspecialchars($battle['title']); ?></b><br />Location: <?= htmlspecialchars($battle['location']); ?>')
            .openPopup();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const map = document.querySelector(".maplocation");
            const showmap = document.querySelector(".click-l");

            if (showmap && map) {
                showmap.addEventListener("click", () => {
                    map.classList.toggle("active");
                });

                document.addEventListener("click", (event) => {
                    if (!map.contains(event.target) && !showmap.contains(event.target)) {
                        map.classList.remove("active");
                    }
                });
            }
        });
    </script>
</body>

</html>