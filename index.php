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
    <link rel="stylesheet" href="./dist/<?= $cssPath ?>" />
    <script type="module" src="./dist/<?= $jsPath ?>"></script>
</head>

<body>
    <?= "php works on front website" ?>
    <p class="icon-pacman"></p>
    <img src="images/sample.jpg" alt="">
</body>

</html>