<?php
// File: verify.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Verifica Autoloader di Composer</h1>";

$autoloaderPath = __DIR__ . '/vendor/autoload.php';

if (!file_exists($autoloaderPath)) {
    die("<h2>STATO: ERRORE CRITICO</h2><p>Il file 'vendor/autoload.php' non esiste. Esegui 'composer install'.</p>");
}

// Includiamo l'autoloader e salviamo l'oggetto loader
$loader = require $autoloaderPath;

echo "<h2>STATO: OK</h2><p>Il file 'vendor/autoload.php' è stato caricato con successo.</p>";

echo "<h3>Verifica Esistenza Classe 'Smarty':</h3>";

// Usiamo class_exists() che è il modo corretto per verificare se l'autoloader funziona
if (class_exists('Smarty')) {
    echo "<p style='color:green; font-weight:bold;'>SUCCESSO: La classe 'Smarty' è stata trovata dall'autoloader.</p>";
} else {
    echo "<p style='color:red; font-weight:bold;'>FALLIMENTO: La classe 'Smarty' NON è stata trovata, anche dopo aver caricato l'autoloader.</p>";
}

echo "<h3>Mappa delle Classi Caricate da Composer:</h3>";
echo "<p>Questa è la lista di tutte le classi che Composer conosce. Cerca 'Smarty' qui dentro.</p>";
echo "<pre style='background-color:#f0f0f0; padding:10px; border:1px solid #ccc; max-height: 400px; overflow-y:scroll;'>";
// Stampiamo la mappa delle classi per il debug
print_r($loader->getClassMap());
echo "</pre>";

?>