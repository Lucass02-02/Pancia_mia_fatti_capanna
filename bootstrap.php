<<<<<<< Updated upstream
<?php // File: bootstrap.php (Versione Definitiva Corretta)

// Carica l'autoloader di Composer
require_once 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use AppORM\Services\Foundation\FEntityManager;

// --- 1. Configurazione di Doctrine ---
$entityPaths = [__DIR__ . '/AppORM/Entity'];
$isDevMode = true; // Ideale per lo sviluppo

// --- PUNTO CHIAVE DELLA SOLUZIONE ---
// Questa riga è FONDAMENTALE. Deve puntare alla tua cartella locale, non essere null.
$proxyDir = __DIR__ . '/AppORM/Proxies';

$cache = null; // Per lo sviluppo non usiamo cache

// La configurazione ora usa la variabile $proxyDir aggiornata
$config = ORMSetup::createAttributeMetadataConfiguration($entityPaths, $isDevMode, $proxyDir, $cache);

// --- 2. Configurazione del Database ---
$connectionParams = [
    'dbname'   => 'testdb',
    'user'     => 'root',
    'password' => '',
    'host'     => 'localhost',
    'driver'   => 'pdo_mysql',
];

// --- 3. Creazione dell'EntityManager ---
$connection = DriverManager::getConnection($connectionParams, $config);
$entityManager = new EntityManager($connection, $config);

// --- 4. Iniezione dell'EntityManager nel nostro Foundation Layer ---
FEntityManager::setEntityManager($entityManager);

// Ora l'applicazione è pronta per partire.
=======
<?php
// File: bootstrap.php (Versione Corretta e Finale)

// La prima istruzione deve essere QUESTA, per caricare tutte le librerie di Composer.
require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

// --- CONFIGURAZIONE DELLA CONNESSIONE AL DATABASE ---
$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'testdb', 
    'host'     => '127.0.0.1'
];

// --- CONFIGURAZIONE DI DOCTRINE 3 ---
$entityPaths = [__DIR__ . '/AppORM/Entity']; 
$isDevMode = true;
$config = new Configuration();

// Driver per leggere le annotazioni dalle Entità
$driver = new AttributeDriver($entityPaths);
$config->setMetadataDriverImpl($driver);

// Cache per lo sviluppo
$cache = new ArrayAdapter();
$config->setMetadataCache($cache);
$config->setQueryCache($cache);

// Directory per i Proxy
$proxyDir = __DIR__ . '/var/proxies';
$config->setProxyDir($proxyDir);
$config->setProxyNamespace('AppORM\Proxies');

if ($isDevMode) {
    $config->setAutoGenerateProxyClasses(true);
} else {
    $config->setAutoGenerateProxyClasses(false);
}

// Funzione globale per ottenere l'EntityManager
function getEntityManager() {
    global $dbParams, $config;
    static $entityManager = null;

    if ($entityManager === null) {
        try {
            $connection = DriverManager::getConnection($dbParams);
            $entityManager = new EntityManager($connection, $config);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            die("ERRORE: Impossibile connettersi al database o configurare Doctrine. Dettagli: " . $e->getMessage());
        }
    }
    return $entityManager;
}

// Inizializza l'EntityManager per renderlo disponibile
getEntityManager();
>>>>>>> Stashed changes
