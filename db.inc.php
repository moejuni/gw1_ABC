<?php

function connectToDB()
{
    $db_host = '127.0.0.1';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'groepswerk';
    $db_port = 3306;

    try {
        $db = new PDO('mysql:host=' . $db_host . '; port=' . $db_port . '; dbname=' . $db_db, $db_user, $db_password);
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        die();
    }
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    return $db;
}

function getBattles()
{
    $stmt = connectToDB()->prepare("SELECT * FROM battles ORDER BY title ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getBattleNames()
{
    $stmt = connectToDB()->prepare(query: "SELECT id, title from battles order by title asc");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getDesc()
{
    $stmt = connectToDB()->prepare(query: "SELECT description from battles");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
