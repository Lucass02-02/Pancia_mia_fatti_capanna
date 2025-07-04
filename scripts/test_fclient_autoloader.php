<?php

// Carica l'autoloader di Composer
require __DIR__ . '/vendor/autoload.php';

use App\EntityManager\FClient; // Tenta di usare la classe FClient

echo "Tentativo di caricamento della classe FClient...\n";

try {
    // Tenta di accedere a un metodo statico o istanziare la classe
    // Per questo test, basta provare a creare un'istanza o accedere a qualcosa
    // Anche se la classe non ha un getInstance(), il solo tentativo di "new FClient()"
    // o di riferirsi al suo nome nel "use" triggera il caricamento dell'autoloader.
    $testClient = new FClient();
    echo "Classe FClient caricata con successo!\n";
    echo "Istanza di FClient creata.\n";

} catch (\Throwable $e) { // Cattura anche Error, non solo Exception
    echo "ERRORE durante il caricamento di FClient:\n";
    echo "Messaggio: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " (Linea: " . $e->getLine() . ")\n";
    echo "Stack Trace:\n";
    echo $e->getTraceAsString() . "\n";
}

echo "Test completato.\n";

?>