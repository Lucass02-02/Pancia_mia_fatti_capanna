<?php
// File: index.php (NUOVA VERSIONE CON PRETTY URLS)

// Mostra tutti gli errori (utile in fase di sviluppo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Carica il file di bootstrap, che configura tutto il resto.
require __DIR__ . '/bootstrap.php';

// Avvia la sessione
use AppORM\Services\Utility\USession;
USession::start();

// --- NUOVO ROUTING CON PRETTY URLS ---

// 1. Ottieni l'URI della richiesta (es. /Pancia_mia_fatti_capanna/client/profile?id=1)
$requestUri = $_SERVER['REQUEST_URI'];

// 2. Rimuovi eventuali query string (tutto ciò che viene dopo il '?')
if (false !== $pos = strpos($requestUri, '?')) {
    $requestUri = substr($requestUri, 0, $pos);
}

// 3. Rimuovi la cartella base del progetto per ottenere il percorso pulito
//    Esempio: /Pancia_mia_fatti_capanna/client/profile -> /client/profile
$basePath = '/Pancia_mia_fatti_capanna'; // Assicurati che corrisponda alla tua cartella
$path = substr($requestUri, strlen($basePath));

// 4. Rimuovi gli slash iniziali/finali e dividi il percorso in segmenti
//    Esempio: /client/profile/ -> ['client', 'profile']
$segments = explode('/', trim($path, '/'));

// 5. Determina il controller e l'azione dai segmenti
$controllerName = $segments[0] ?: 'home'; // Se il percorso è vuoto, usa 'home'
$actionName = $segments[1] ?? 'home';     // Se manca il secondo pezzo, usa 'home'

// Costruisce il nome completo della classe del controller
// Esempio: 'client' diventa 'AppORM\Control\CClient'
$controllerClass = 'AppORM\\Control\\C' . ucfirst($controllerName);

// Il resto della logica è identico: verifica e chiama il metodo
if (class_exists($controllerClass) && method_exists($controllerClass, $actionName)) {
    // Nota: questo router semplice non gestisce parametri nell'URL come /product/edit/123
    // Per ora, eventuali ID andranno passati come parametri GET tradizionali se necessario.
    $controllerClass::$actionName();
} else {
    // Se il controller o l'azione non esistono, restituisci un errore 404.
    http_response_code(404);
    echo "<h1>Errore 404</h1><p>Pagina non trovata.</p>";
}