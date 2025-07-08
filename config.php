<?php
// config.php
$host = 'localhost';
$dbname = 'testdb';
$user = 'root';   // aggiorna se serve
$pass = '';       // aggiorna se serve

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Errore connessione DB: " . $e->getMessage());
}

