<?php

//test databse connection


$host = '127.0.0.1';
$dbname = 'groepswerk';
$dbuser = 'root';
$dbpass = 'root';

try {
    $pdo = new PDO("mysql:host=$host;port=8889;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Databaseverbinding succesvol!";
} catch (PDOException $e) {
    die("Databaseverbinding mislukt: " . $e->getMessage());
}
