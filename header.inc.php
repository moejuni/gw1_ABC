<?php $battles = getBattleNames();

if (isset($_POST['searchterm']) && !empty($_POST['searchterm'])) {
    $battles = searchbattles($_POST['searchterm']);
} else {
    $battles = getBattleNames();
}

?>

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
                    <li>
                        <form action="index.php" method="post">
                            <input type="text" name="searchterm" placeholder="Search Battles" value="<?= isset($_POST['searchterm']) ? htmlspecialchars($_POST['searchterm']) : ''; ?>">
                            <input type="submit" value="Search" class="submit">
                        </form>
                    </li>
                    <a href="index.php">
                        <li class="logo">
                            <img src="images/logo_ba.png" alt="logo" />
                        </li>
                    </a>
                    <li><a class="nav-link" href="about.php">About</a></li>
                    <li>
                        <a class="login" href="admin/login.php">Log in</a>
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