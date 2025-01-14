<?php
include_once "db.inc.php"; //database connectie

// Controleer of  id is opgegeven 
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id']; // Haal id op 

    try {
        // Bereid de SQL-query voor om het record te verwijderen
        $stmt = $pdo->prepare("DELETE FROM battles WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Controleer of een record is verwijderd
        if ($stmt->rowCount() > 0) {
            // Redirect terug naar de lijst met een succesbericht
            header("Location: list.php?message=success");
        } else {
            // Redirect met een foutmelding als het ID niet bestaat
            header("Location: list.php?message=notfound");
        }
        exit;
    } catch (PDOException $e) {
        // Redirect met een foutmelding als er een databasefout optreedt
        header("Location: list.php?message=error");
        exit;
    }
} else {
    // Redirect met een foutmelding als het ID niet is opgegeven
    header("Location: list.php?message=invalid");
    exit;
}
