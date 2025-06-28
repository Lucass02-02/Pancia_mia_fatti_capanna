<?php
// PHP Version: 8.1+

require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Mapping\ClassMetadataFactory; // Aggiungi questo per ispezionare i metadati
use AppORM\Entity\EClient; // Importa EClient per un test esplicito

/**
 * Funzione per ottenere l'istanza dell'EntityManager di Doctrine.
 * Configura le entità, la connessione al database e la modalità di sviluppo.
 *
 * @return EntityManager L'istanza configurata di EntityManager.
 */
function getEntityManager(): EntityManager
{
    // Specifica il percorso della directory dove si trovano le tue entità Doctrine.
    $paths = array(__DIR__ . '/AppORM/Entity');

    // Imposta la modalità di sviluppo.
    $isDevMode = true;

    // Specifica una directory dove Doctrine può generare le classi proxy delle entità.
    $proxyDir = __DIR__ . '/var/cache/doctrine/Proxy';
    if (!is_dir($proxyDir)) {
        mkdir($proxyDir, 0775, true); // Crea la cartella con permessi appropriati
    }

    try {
        // Configura Doctrine per usare gli attributi (#[ORM\Entity], #[ORM\Column], ecc.)
        $config = ORMSetup::createAttributeMetadataConfiguration(
            $paths,
            $isDevMode,
            $proxyDir
        );

        // Parametri di connessione al database.
        $dbParams = [
            'dbname'   => 'testdb',
            'user'     => 'root',
            'password' => '',
            'host'     => 'localhost',
            'driver'   => 'pdo_mysql',
        ];

        // Crea la connessione al database.
        $connection = DriverManager::getConnection($dbParams, $config);

        // Crea l'EntityManager.
        $entityManager = new EntityManager($connection, $config);

        // --- DEBUG AGGIUNTIVO PER CAPIRE LA MAPPATURA ---
        echo "DEBUG: Tentativo di recuperare i metadati per EClient...\n";
        try {
            // Ottieni il gestore dei metadati
            $metadataFactory = $entityManager->getMetadataFactory();

            // Tenta di caricare i metadati per l'entità EClient
            $classMetadata = $metadataFactory->getMetadataFor(EClient::class);

            echo "DEBUG: Metadati per EClient recuperati con successo!\n";
            echo "DEBUG: Nome della tabella mappata per EClient: " . $classMetadata->getTableName() . "\n";
            // Puoi ispezionare altre proprietà dei metadati qui, se vuoi
            // echo "DEBUG: Campi di EClient: " . implode(', ', array_keys($classMetadata->fieldMappings)) . "\n";

        } catch (\Doctrine\Persistence\Mapping\MappingException $me) {
            echo "DEBUG ERRORE MAPPATURA: Caught Doctrine\\Persistence\\Mapping\\MappingException: " . $me->getMessage() . "\n";
            echo "DEBUG ERRORE MAPPATURA: Stack Trace Mappatura:\n" . $me->getTraceAsString() . "\n";
        } catch (\Exception $e) {
            echo "DEBUG ERRORE MAPPATURA: Caught Altra Eccezione durante il recupero metadati: " . get_class($e) . " - " . $e->getMessage() . "\n";
            echo "DEBUG ERRORE MAPPATURA: Stack Trace Altra Eccezione:\n" . $e->getTraceAsString() . "\n";
        }
        // --- FINE DEBUG AGGIUNTIVO ---

        return $entityManager;

    } catch (\Doctrine\ORM\Exception\ORMException $e) {
        // Cattura eccezioni specifiche di Doctrine ORM durante l'inizializzazione
        error_log("FATAL ERROR: Doctrine ORM Exception during EntityManager setup: " . $e->getMessage());
        die("FATAL ERROR: Problema di configurazione Doctrine ORM. Controlla il log degli errori: " . $e->getMessage());
    } catch (\Exception $e) {
        // Cattura altre eccezioni generiche durante l'inizializzazione
        error_log("FATAL ERROR: General Exception during EntityManager setup: " . $e->getMessage());
        die("FATAL ERROR: Problema generico di configurazione. Controlla il log degli errori: " . $e->getMessage());
    }
}
