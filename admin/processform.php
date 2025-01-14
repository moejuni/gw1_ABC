<?php
include_once "db.inc.php";
include_once "header.inc.php";

// Controleer of de pagina via een POST-verzoek is geopend
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Als de pagina niet via POST is geopend, toon een foutmelding
    echo "<div class='container mt-5 text-center'>";
    echo "<h1 class='display-4 text-danger'>Oops, you're on the wrong page!</h1>";
    echo "<p class='lead'>Het lijkt erop dat je deze pagina niet correct hebt geopend.</p>";
    echo "<a href='indexadmin.php' class='btn btn-primary btn-lg mt-3'>Ga terug naar de Homepagina</a>";
    echo "</div>";
    include_once "footer.inc.php";
    exit; // Stop verdere uitvoering
}

// Verwerking van formuliergegevens
$errors = [];

// 1. Validatie van tekstvelden

// Haalt de waarde van het 'title' veld uit de POST-data en ontsmet deze
$title = filter_input(
    INPUT_POST,                  // Geeft aan dat de invoer uit de POST-data komt
    'title',                     // Het specifieke veld dat opgehaald wordt ('title')
    FILTER_SANITIZE_SPECIAL_CHARS // Verwijdert speciale HTML-tekens om XSS-aanvallen te voorkomen
);

// $title bevat nu de veilige, opgeschoonde waarde van het 'title' veld$year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_SPECIAL_CHARS);
$location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_SPECIAL_CHARS);
$shdescription = filter_input(INPUT_POST, 'shdescription', FILTER_SANITIZE_SPECIAL_CHARS);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
$year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_SPECIAL_CHARS);
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

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) // controleer of er een bestand is geüpload en of de upload succesvol was
{
    //     $_FILES['input_name'] = [
    //     'name' => 'bestand.txt',         // Originele bestandsnaam
    //     'type' => 'text/plain',          // MIME-type
    //     'tmp_name' => '/tmp/phpYzdqkD',  // Tijdelijke opslaglocatie
    //     'error' => 0,                    // Eventuele foutcodes (0 betekent geen fout)
    //     'size' => 12345                  // Bestandsgrootte in bytes
    // ];
    $fileTmpPath = $_FILES['image']['tmp_name'];     // haal het temporaire pad op waar het geüploade bestand is opgeslagen

    $fileType = mime_content_type($fileTmpPath);     // bepaal het MIME-type van het geüploade bestand

    $allowedfileTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp']; //mag enkel deze soorten bestanden zijn

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
    addAdminLog(
        "Item toegevoegd",
        "Titel: $title, Jaar: $year, Locatie: $location"
    );

    echo "<div class='alert alert-success'>Battle succesvol toegevoegd!</div>";
    echo "<a href='inputform.php' class='btn btn-primary'>Nieuwe Battle Toevoegen</a>";
} else {
    // Toon fouten
    echo "<div class='alert alert-danger'>";
    foreach ($errors as $error) {
        echo "<p>" . $error . "</p>";
    }
    echo "</div>";
    echo "<a href='inputform.php' class='btn btn-primary'>Terug naar het formulier</a>";
}
