<?php
include_once "header.inc.php";

<<<<<<< HEAD
$host = "localhost";
$dbname = "groepswerk";
$username = "root";
$password = "root";
=======
$host = 'localhost';
$dbname = 'groepswerk';
$dbuser = 'root';
$dbpass = 'root';

session_start();


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

>>>>>>> ee14d3a65546e3ef6e9bfdd344d5a59c285018e1

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Databaseverbinding mislukt: " . $e->getMessage());
}

$sql = "SELECT id, title, year, description, location, shdescription, image FROM battles";
$stmt = $pdo->query($sql);
$battles = $stmt->fetchAll(PDO::FETCH_ASSOC);
<<<<<<< HEAD
=======

>>>>>>> ee14d3a65546e3ef6e9bfdd344d5a59c285018e1
?>

<div class="container mt-5">
    <h2 class="text-center text-primary">Lijst van Beroemde Slagen</h2>
    <div class="container">
        <button class="btn btn-success btn-lg mt-3">Nieuwe Item</button>

    </div>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Afbeelding</th>
                <th>Titel</th>
                <th>Jaar</th>
                <th>Locatie</th>
                <th>Korte Beschrijving</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($battles as $battle): ?>
                <tr>
                    <td><?= $battle['id'] ?></td>
                    <td>
                        <?php if (!empty($battle['image'])): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($battle['image']) ?>" alt="<?= htmlspecialchars($battle['title']) ?>" class="img-thumbnail" style="width: 50px; height: 50px;">
                        <?php else: ?>
                            <img src="images/placeholder.jpg" alt="Geen afbeelding beschikbaar" class="img-thumbnail" style="width: 50px; height: 50px;">
                        <?php endif; ?>
                    </td>
                    <td><?= $battle['title'] ?></td>
                    <td><?= $battle['year'] ?></td>
                    <td><?= $battle['location'] ?></td>
                    <td><?= $battle['shdescription'] ?></td>
                    <td>
                        <a href="view.php?id=<?= $battle['id'] ?>" class="btn btn-info btn-sm">Bekijk</a>
                        <a href="edit.php?id=<?= $battle['id'] ?>" class="btn btn-warning btn-sm">Bewerk</a>
                        <a href="delete.php?id=<?= $battle['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je dit item wilt verwijderen?');">Verwijder</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
include_once "footer.inc.php";
?>