<?php
// File: cli-config.php

// Carica l'autoloader di Composer
// Assicurati che questo percorso sia corretto rispetto alla posizione del tuo file cli-config.php
require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use AppORM\Services\Foundation\FEntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner; // Aggiungi questa riga

// --- 1. Configurazione di Doctrine ---
$entityPaths = [__DIR__ . '/AppORM/Entity'];
$isDevMode = true;
$proxyDir = null;
$cache = null;

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

// --- 5. Ritorna l'HelperSet per i comandi Doctrine CLI ---
// QUESTA RIGA È FONDAMENTALE!
return ConsoleRunner::createHelperSet($entityManager);