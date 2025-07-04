<?php

// migrations.php
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

// 1. Configurazione del Database (DBAL Connection)
$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'port'     => '3306',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'testdb', // Assicurati sia il NOME CORRETTO del tuo database
];

// 2. Configurazione di Doctrine ORM (per trovare le tue entità)
$paths = [__DIR__ . '/AppORM/Entity']; // Assicurati sia il PERCORSO CORRETTO delle tue entità
$isDevMode = true;

$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);

// 3. Configurazione specifica di Doctrine Migrations
$migrationConfig = new ConfigurationArray([
    'migrations_paths' => [
        'DoctrineMigrations' => __DIR__ . '/migrations',
    ],
    'table_storage' => [
        'table_name' => 'doctrine_migration_versions',
    ],
    'all_or_nothing' => true,
]);

// 4. Creazione della DependencyFactory (USA IL COSTRUTTORE DIRETTO!)
$dependencyFactory = new DependencyFactory(
    $migrationConfig,
    $connection,
    $entityManager,
    null, // Logger
    null  // Container
);

// 5. Il file DEVE ritornare l'oggetto DependencyFactory
return $dependencyFactory;