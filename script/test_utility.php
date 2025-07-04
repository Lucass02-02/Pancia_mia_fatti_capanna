<?php
// File: test_utility.php (Versione aggiornata che usa l'autoloader di Composer)

// Non servono più i require_once manuali!
// Il tuo index.php ha già caricato 'vendor/autoload.php',
// quindi Composer sa già dove trovare le classi.

use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UCookie;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\UView;

// --- TEST USession ---
echo "<h1>Test USession</h1>";
USession::start(); // Fondamentale!
USession::setValue('user_id', 123);
USession::setValue('user_role', 'cliente');

if (USession::isSet('user_id')) {
    echo "ID utente in sessione: " . USession::getValue('user_id') . "<br>";
    echo "Ruolo utente in sessione: " . USession::getValue('user_role') . "<br>";
} else {
    echo "Nessun dato utente trovato in sessione.<br>";
}
// Per testare destroy(), ricarica la pagina dopo aver decommentato la riga sotto
// USession::destroy();


// --- TEST UCookie ---
echo "<h1>Test UCookie</h1>";
UCookie::set('preferenza_lingua', 'it-IT', 3600 * 24); // Scade tra 24 ore
echo "Cookie 'preferenza_lingua' impostato. Controlla gli strumenti per sviluppatori del tuo browser.<br>";

if (UCookie::get('preferenza_lingua')) {
    echo "Valore del cookie letto: " . UCookie::get('preferenza_lingua') . "<br>";
}
// Per testare la cancellazione, decommenta la riga sotto e ricarica la pagina.
// UCookie::delete('preferenza_lingua');


// --- TEST UHTTPMethods ---
echo "<h1>Test UHTTPMethods</h1>";
if (UHTTPMethods::isPost()) {
    echo "Questa è una richiesta POST.<br>";
    $nome = UHTTPMethods::getPostValue('nome');
    if ($nome) {
        echo "Valore 'nome' ricevuto dal form: " . htmlspecialchars($nome) . "<br>";
    }
} else {
    echo "Questa non è una richiesta POST. Invia il form qui sotto per testare.<br>";
}
?>

<!-- Un semplice form per testare il metodo POST -->
<form method="POST" action="">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome">
    <button type="submit">Invia</button>
</form>

<?php
// --- TEST UView ---
echo "<h1>Test UView</h1>";
echo "Sto per renderizzare una vista...<br>";

// Creiamo dei dati da passare alla vista
$datiPerLaVista = [
    'titoloPagina' => 'Pagina di Test',
    'utente' => [
        'nome' => 'Mario',
        'cognome' => 'Rossi'
    ]
];

// Assicurati che esista la cartella 'View' con dentro il file 'test_view.php'
UView::render('test_view', $datiPerLaVista);

/*
Contenuto del file View/test_view.php:

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titoloPagina; ?></title>
</head>
<body>
    <h2>Benvenuto, <?php echo htmlspecialchars($utente['nome']) . ' ' . htmlspecialchars($utente['cognome']); ?>!</h2>
    <p>Questa è una vista renderizzata dalla classe UView.</p>
</body>
</html>

*/
