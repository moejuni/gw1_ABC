<?php

session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}


// Dynamisch JS-bestanden laden
$jsDir = __DIR__ . '/bootstrap-js';
$jsFiles = array_diff(scandir($jsDir), ['.', '..']);
?>

<!-- Dynamisch geladen JS-bestanden -->
<?php
foreach ($jsFiles as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'js') {
        echo '<script src="bootstrap-js/' . $file . '"></script>' . PHP_EOL;
    }
}
?>
</body>

</html>