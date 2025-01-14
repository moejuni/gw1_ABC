<?php
$host = "localhost";
$dbname = "groepswerk";
$username = "root";
$password = "root";
$dbport = 8889;

try {
    $pdo = new PDO("mysql:host=$host;port=$dbport;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Databaseverbinding mislukt: " . $e->getMessage());
}

// Functie om het totaal aantal battles op te halen
function getTotalBattles()
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM battles");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

// Functie om de meest recente battle op te halen
function getLatestBattle()
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT title, year, location FROM battles ORDER BY id DESC LIMIT 1");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Functie om recente activiteiten op te halen
function getRecentActivities()
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT action, details FROM admin_logs ORDER BY created_at DESC LIMIT 5");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// functie om adminlog op te slaan
function addAdminLog($action, $details)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO admin_logs (action, details) VALUES (:action, :details)");
    $stmt->execute([
        ':action' => $action,
        ':details' => $details,
    ]);
}
