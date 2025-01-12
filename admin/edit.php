<?php
include_once "header.inc.php";
include_once "db.inc.php";
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("Ongeldig ID.");
}

// Haal de huidige gegevens van de battle op
$sql = "SELECT * FROM battles WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$battle = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$battle) {
    die("Battle niet gevonden.");
}

// Verwerk het formulier na indienen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_SPECIAL_CHARS);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$title || strlen($title) > 150) {
        $errors[] = "Titel mag niet langer zijn dan 150 tekens.";
    }

    if (!$year || strlen($year) > 45) {
        $errors[] = "Jaar mag niet langer zijn dan 45 tekens.";
    }

    if (!$location || strlen($location) > 100) {
        $errors[] = "Locatie mag niet langer zijn dan 100 tekens.";
    }

    if (!$description || strlen($description) > 1000) {
        $errors[] = "Beschrijving mag niet langer zijn dan 1000 tekens.";
    }

    // Verwerk de afbeelding als er een nieuwe wordt geüpload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileType = mime_content_type($fileTmpPath);
        $allowedfileTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if (!in_array($fileType, $allowedfileTypes)) {
            $errors[] = "Ongeldig bestandstype. Alleen JPEG, PNG, GIF en WEBP zijn toegestaan.";
        }

        if ($_FILES['image']['size'] > 2 * 1024 * 1024) { // Max 2 MB
            $errors[] = "Afbeelding mag niet groter zijn dan 2 MB.";
        }

        if (empty($errors)) {
            $imageData = file_get_contents($fileTmpPath);
        }
    } else {
        $imageData = $battle['image']; // Gebruik de bestaande afbeelding als er geen nieuwe is geüpload
    }

    // Als er geen fouten zijn, werk de gegevens bij in de database
    if (empty($errors)) {
        $updateSql = "UPDATE battles SET title = :title, year = :year, location = :location, description = :description, image = :image WHERE id = :id";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([
            ':title' => $title,
            ':year' => $year,
            ':location' => $location,
            ':description' => $description,
            ':image' => $imageData,
            ':id' => $id
        ]);

        echo "<div class='alert alert-success'>De battle is succesvol bijgewerkt!</div>";
        echo "<a href='list.php' class='btn btn-primary'>Terug naar de lijst</a>";
        exit;
    } else {
        echo "<div class='alert alert-danger'>";
        foreach ($errors as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }
        echo "</div>";
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center text-primary">Bewerk Battle</h2>
    <form action="edit.php?id=<?= htmlspecialchars($id) ?>" method="POST" enctype="multipart/form-data" class="mt-4">
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
        <div class="mb-3">
            <label for="image" class="form-label">Afbeelding</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <small>Laat leeg om de huidige afbeelding te behouden.</small>
        </div>
        <button type="submit" class="btn btn-success">Opslaan</button>
        <a href="list.php" class="btn btn-secondary">Annuleren</a>
    </form>
</div>

<?php
include_once "footer.inc.php";
?>