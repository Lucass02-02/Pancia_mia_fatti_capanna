#!/usr/bin/env php
<?php
// /Applications/XAMPP/xamppfiles/htdocs/GitHub/Pancia_mia_fatti_capanna/doctrine.php

// 1. Carica l'autoloader di Composer
require __DIR__ . '/vendor/autoload.php';

// 2. Carica il tuo bootstrap di Doctrine per ottenere l'EntityManager
// Assicurati che questo percorso sia corretto e che il tuo bootstrap.php restituisca un EntityManager
$entityManager = require __DIR__ . '/bootstrap.php'; // Adatta il percorso se necessario

// 3. Importa le classi necessarie per la console
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Symfony\Component\Console\Application;

// 4. Crea l'applicazione console
$application = new Application('Doctrine Command Line Interface', \Doctrine\ORM\Version::VERSION);

// 5. Aggiungi i comandi standard di Doctrine
$singleManagerProvider = new SingleManagerProvider($entityManager);
ConsoleRunner::addDefaultCommands($application, $singleManagerProvider);

// 6. Esegui l'applicazione console
try {
    $application->run();
} catch (\Throwable $e) {
    echo "Errore durante l'esecuzione del comando Doctrine: " . $e->getMessage() . "\n";
    exit(1);
}