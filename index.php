<?php
// File: index.php (il punto di ingresso principale)

// Mostra tutti gli errori (utile in fase di sviluppo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Carica il file di bootstrap, che configura Doctrine e l'autoloader.
require __DIR__ . '/bootstrap.php';

// Avvia la sessione per tutto il sito
use AppORM\Services\Utility\USession;
USession::start();

// --- ROUTING SEMPLICE ---
$controllerName = $_GET['c'] ?? 'home';
$actionName = $_GET['a'] ?? 'home';

$controllerClass = 'AppORM\\Control\\C' . ucfirst($controllerName);

if (class_exists($controllerClass) && method_exists($controllerClass, $actionName)) {
    $controllerClass::$actionName();
} else {
    http_response_code(404);
    echo "<h1>Errore 404</h1><p>Pagina non trovata.</p>";
}
