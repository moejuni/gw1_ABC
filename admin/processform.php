<?php
$host = "localhost";
$dbname = "groepswerk";
$username = "root";
$password = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Databaseverbinding mislukt: " . $e->getMessage());
}

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $short_desc = $_POST['short_desc'];
    $long_desc = $_POST['long_desc'];

    // Controleer of een bestand is geüpload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Toegestane bestandstypen
        $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Verplaats het bestand naar de map 'uploads'
            $uploadFileDir = './uploads/';
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Sla gegevens op in de database TODOOOOOO****************************************************************
                $sql = "INSERT INTO battles (title, shdescription, description, image) VALUES (:title, :short_desc, :long_desc, :image)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':title' => $title,
                    ':short_desc' => $short_desc,
                    ':long_desc' => $long_desc,
                    ':image' => $fileName
                ]);

                echo "Item succesvol toegevoegd!";
            } else {
                echo "Fout bij het verplaatsen van het bestand.";
            }
        } else {
            echo "Ongeldig bestandstype. Alleen WEBP, JPG, JPEG, PNG en GIF zijn toegestaan.";
        }
    } else {
        echo "Geen afbeelding geüpload of er is een fout opgetreden.";
    }
}
