<?php
include_once "db.inc.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // 1. Validatie van tekstvelden
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_SPECIAL_CHARS);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_SPECIAL_CHARS);
    $shdescription = filter_input(INPUT_POST, 'shdescription', FILTER_SANITIZE_SPECIAL_CHARS);
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

    if (!$shdescription || strlen($shdescription) > 250) {
        $errors[] = "Korte beschrijving mag niet langer zijn dan 250 tekens.";
    }

    if (!$description || strlen($description) > 1000) {
        $errors[] = "Lange beschrijving mag niet langer zijn dan 1000 tekens.";
    }

    // 2. Validatie van bestand
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
        $errors[] = "Afbeelding is vereist.";
    }

    // 3. Als er geen fouten zijn, voeg de gegevens toe aan de database
    if (empty($errors)) {
        $sql = "INSERT INTO battles (title, year, location, shdescription, description, image) 
                VALUES (:title, :year, :location, :shdescription, :description, :image)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':year' => $year,
            ':location' => $location,
            ':shdescription' => $shdescription,
            ':description' => $description,
            ':image' => $imageData
        ]);

        echo "<div class='alert alert-success'>Battle succesvol toegevoegd!</div>";
        echo "<a href='inputform.php' class='btn btn-primary'>Nieuwe Battle Toevoegen</a>";
    } else {
        // Toon fouten
        echo "<div class='alert alert-danger'>";
        foreach ($errors as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }
        echo "</div>";
        echo "<a href='inputform.php' class='btn btn-primary'>Terug naar het formulier</a>";
    }
}
