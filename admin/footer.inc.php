<?php
<<<<<<< HEAD
=======

session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}


>>>>>>> ee14d3a65546e3ef6e9bfdd344d5a59c285018e1
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