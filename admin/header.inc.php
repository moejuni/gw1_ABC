<?php
$_SERVER["admin"] = true;
include_once "../includes/css_js.inc.php";


session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}



// Dynamisch CSS-bestanden laden
$cssDir = __DIR__ . '/bootstrap-css';
$cssFiles = array_diff(scandir($cssDir), ['.', '..']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN HOMEPAGE</title>

    <!-- Dynamisch geladen CSS-bestanden -->
    <?php
    foreach ($cssFiles as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'css') {
            echo '<link rel="stylesheet" href="bootstrap-css/' . $file . '">' . PHP_EOL;
        }
    }
    ?>

    <!-- Vite gegenereerde CSS en JS -->
    <link rel="stylesheet" href="../dist/<?= $cssPath ?>" />
    <script type="module" src="../dist/<?= $jsPath ?>"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="indexadmin.php">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="indexadmin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inputform.php">New Item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list.php">List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>