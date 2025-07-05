<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Questo è un test diretto per l'autoloader di Composer
require_once __DIR__ . '/vendor/autoload.php';

try {
    $smarty = new Smarty(); // Prova a istanziare Smarty
    echo "Classe Smarty trovata con successo!";
} catch (Throwable $e) {
    echo "Errore: " . $e->getMessage() . " alla linea " . $e->getLine();
}
?>