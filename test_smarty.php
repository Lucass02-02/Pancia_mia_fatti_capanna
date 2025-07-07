<?php
// File: test_smarty.php

// Attiviamo la visualizzazione di tutti gli errori
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "DEBUG: Inizio esecuzione del file di test.<br>";
echo "--------------------------------------------------<br>";

// Percorso del file autoloader di Composer
$autoload_file = __DIR__ . '/vendor/autoload.php';
echo "DEBUG: Sto cercando l'autoloader qui: " . $autoload_file . "<br>";

// Step 1: Verifichiamo se il file autoloader esiste
if (!file_exists($autoload_file)) {
    die("<strong>ERRORE CRITICO:</strong> Il file 'vendor/autoload.php' non è stato trovato! Esegui il comando 'composer install' o 'composer require smarty/smarty' nel tuo terminale.");
}

// Step 2: Carichiamo l'autoloader di Composer. Questo è il passo cruciale.
require_once $autoload_file;
echo "DEBUG: Autoloader di Composer incluso con successo.<br>";

// Step 3: Proviamo a usare la classe Smarty.
use Smarty;
echo "DEBUG: La direttiva 'use Smarty' è stata eseguita.<br>";

try {
    // Step 4: Proviamo a creare l'oggetto Smarty.
    echo "DEBUG: Sto per creare un nuovo oggetto Smarty...<br>";
    $smarty = new Smarty();
    
    // Se arriviamo qui, è un successo!
    echo "<h2 style='color:green;'>SUCCESSO! La classe Smarty è stata trovata e l'oggetto è stato creato.</h2>";
    echo "Questo conferma che la tua installazione di Composer e Smarty è CORRETTA.<br>";
    echo "Il problema risiede al 100% in un errore di sintassi (probabilmente una parentesi '}' di troppo) nei tuoi file `index.php` o `bootstrap.php` che impedisce all'autoloader di funzionare nel contesto normale dell'applicazione.";

} catch (Throwable $t) {
    echo "<h2 style='color:red;'>ERRORE! Si è verificato un errore durante la creazione dell'oggetto Smarty:</h2>";
    echo "<pre>" . htmlspecialchars($t->getMessage()) . "</pre>";
}