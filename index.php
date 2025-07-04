<?php
// File: index.php (il punto di ingresso principale)

// Mostra tutti gli errori (utile in fase di sviluppo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Carica il file di bootstrap, che configura Doctrine e l'autoloader.
// Questo file si occupa di includere 'vendor/autoload.php', rendendo disponibili
// tutte le classi, inclusi i controller come CClient, CHome, e il NUOVO CCart.
require __DIR__ . '/bootstrap.php';

// Avvia la sessione per tutto il sito.
// È cruciale che la sessione sia avviata prima di qualsiasi output HTML.
use AppORM\Services\Utility\USession;
USession::start();

// --- ROUTING DINAMICO ---
// Recupera il nome del controller e dell'azione dall'URL.
// Se non specificati, usa 'home' come default per entrambi.
$controllerName = $_GET['c'] ?? 'home';
$actionName = $_GET['a'] ?? 'home';

// Costruisce il nome completo della classe del controller.
// Esempio: 'home' diventa 'AppORM\Control\CHome'
// Esempio: 'client' diventa 'AppORM\Control\CClient'
// Esempio: 'cart' diventa 'AppORM\Control\CCart'
$controllerClass = 'AppORM\\Control\\C' . ucfirst($controllerName);

// Verifica se la classe del controller esiste e se il metodo (azione) esiste al suo interno.
// Se entrambi esistono, chiama il metodo staticamente.
// Grazie all'autoloader caricato in bootstrap.php, non c'è bisogno di un 'require_once' esplicito
// per ogni controller (CHome, CClient, CCart, etc.).
if (class_exists($controllerClass) && method_exists($controllerClass, $actionName)) {
    $controllerClass::$actionName(); // Chiama il metodo statico dell'azione (es. CHome::home() o CCart::add())
} else {
    // Se il controller o l'azione non esistono, restituisci un errore 404.
    http_response_code(404);
    echo "<h1>Errore 404</h1><p>Pagina non trovata.</p>";
}