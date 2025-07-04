<?php
// debug_doctrine.php
// Script per isolare il problema della Doctrine\Persistence\Mapping\MappingException

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bootstrap.php'; // Includi il tuo bootstrap.php

use Doctrine\ORM\EntityManager;
use AppORM\Entity\EClient; // Importa l'entità che causa problemi

echo "--- Inizio test di isolamento Doctrine ---\n";

try {
    // 1. Ottieni l'EntityManager (che include già il debug del bootstrap.php)
    echo "Tentativo di ottenere l'EntityManager...\n";
    $entityManager = getEntityManager(); // Chiamata alla tua funzione getEntityManager()

    if (!$entityManager instanceof EntityManager) {
        throw new Exception("Errore: getEntityManager() non ha restituito un'istanza di EntityManager.");
    }
    echo "EntityManager ottenuto con successo.\n";

    // 2. Tenta di ottenere il repository per EClient
    echo "Tentativo di ottenere il repository per EClient...\n";
    $repository = $entityManager->getRepository(EClient::class);

    if (!$repository) {
        throw new Exception("Errore: Impossibile ottenere il repository per EClient.");
    }
    echo "Repository per EClient ottenuto con successo!\n";

    // 3. Tenta una query semplice per vedere se la mappatura funziona
    echo "Tentativo di trovare un EClient tramite find (anche se non esiste ancora)...\n";
    $client = $entityManager->find(EClient::class, 1); // Cerca un ID 1
    if ($client) {
        echo "Trovato cliente con ID 1 (questo è inatteso se il DB è vuoto, ma indica che la query funziona).\n";
    } else {
        echo "Nessun cliente trovato con ID 1 (atteso in un DB vuoto, indica che la query è stata eseguita).\n";
    }

    echo "--- Test di isolamento Doctrine completato con successo (o con l'errore esatto) ---\n";

} catch (\Doctrine\Persistence\Mapping\MappingException $me) {
    echo "ERRORE ISOLATO CATTURATO: Doctrine\\Persistence\\Mapping\\MappingException - " . $me->getMessage() . "\n";
    echo "Stack Trace ISOLATO:\n" . $me->getTraceAsString() . "\n";
} catch (\Exception $e) {
    echo "ERRORE ISOLATO CATTURATO (generico): " . get_class($e) . " - " . $e->getMessage() . "\n";
    echo "Stack Trace ISOLATO:\n" . $e->getTraceAsString() . "\n";
}
