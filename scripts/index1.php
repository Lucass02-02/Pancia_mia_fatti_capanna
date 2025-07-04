<?php
// Forza la visualizzazione di TUTTI gli errori PHP, anche quelli critici
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

try {
    // Carica le dipendenze di Composer
    require __DIR__ . '/vendor/autoload.php';

    // Carica il file bootstrap della tua applicazione
    require __DIR__ . '/bootstrap.php';

    // --- Codice per eseguire test_persistence.php ---
    echo "<h1>Output da test.php:</h1>";

    // Includi il file test_persistence.php.
    // Il percorso è corretto perché test_persistence.php si trova nella stessa directory di index.php. // MODIFICA QUI
    require __DIR__ . '/test_utility.php';

    // Messaggio di conferma che l'esecuzione del test è completata.
    echo "<p>Esecuzione di test_persistence.php completata.</p>";
    // -----------------------------------------------------------

    // Qui sotto potrai aggiungere il tuo codice principale.
    // Per esempio, la logica di routing per gestire diverse pagine
    // o l'inclusione di altri controller che generano l'output della tua app.

} catch (\Exception $e) {
    // Cattura qualsiasi eccezione
    echo "<h2 style='color: red;'>Errore Critico nell'Applicazione:</h2>";
    echo "<p style='color: red;'><strong>Messaggio:</strong> " . $e->getMessage() . "</p>";
    echo "<p style='color: red;'><strong>File:</strong> " . $e->getFile() . " (Linea: " . $e->getLine() . ")</p>";
    echo "<h3>Stack Trace:</h3>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
} catch (\Error $e) {
    // Cattura errori PHP più gravi (es. Fatal Errors)
    echo "<h2 style='color: red;'>Errore Fatale PHP:</h2>";
    echo "<p style='color: red;'><strong>Messaggio:</strong> " . $e->getMessage() . "</p>";
    echo "<p style='color: red;'><strong>File:</strong> " . $e->getFile() . " (Linea: " . $e->getLine() . ")</p>";
    echo "<h3>Stack Trace:</h3>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}