<?php
include_once "header.inc.php";

// Databaseverbinding
$host = "localhost";
$dbname = "groepswerk";
$username = "root";
$password = "root";


session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}



try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Databaseverbinding mislukt: " . $e->getMessage());
}

// Haal de ID op uit de URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("Ongeldig ID.");
}

// Haal de huidige gegevens van de slag op
$sql = "SELECT * FROM battles WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$battle = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$battle) {
    die("Slag niet gevonden.");
}

// Verwerk het formulier na indienen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $year = $_POST['year'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    // Update de gegevens in de database
    $updateSql = "UPDATE battles SET title = :title, year = :year, location = :location, description = :description WHERE id = :id";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->execute([
        'title' => $title,
        'year' => $year,
        'location' => $location,
        'description' => $description,
        'id' => $id
    ]);

    echo "<div class='alert alert-success'>De slag is bijgewerkt!</div>";
    header("Location: list.php");
    exit();
}
?>

<div class="container mt-5">
    <h2 class="text-center text-primary">Bewerk Slag</h2>
    <form action="edit.php?id=<?= htmlspecialchars($id) ?>" method="POST" class="mt-4">
        <div class="mb-3">
            <label for="title" class="form-label">Titel</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($battle['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Jaar</label>
            <input type="text" class="form-control" id="year" name="year" value="<?= htmlspecialchars($battle['year']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Locatie</label>
            <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($battle['location']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Beschrijving</label>
            <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($battle['description']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Opslaan</button>
        <a href="list.php" class="btn btn-secondary">Annuleren</a>
    </form>
</div>

<?php
include_once "footer.inc.php";
?>