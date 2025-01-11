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
