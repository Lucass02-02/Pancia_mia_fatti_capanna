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