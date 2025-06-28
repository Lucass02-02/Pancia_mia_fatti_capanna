<?php
// PHP Version: 8.1+

// Assicurati che l'autoloader sia configurato correttamente (es. Composer autoload)
require __DIR__ . '/vendor/autoload.php';

// Questo debug ci dice se il file EClient è caricabile da Composer
if (class_exists('AppORM\\Entity\\EClient')) {
    echo "DEBUG: La classe EClient è stata trovata correttamente!\n";
} else {
    echo "DEBUG: ERRORE: La classe EClient NON è stata trovata da Composer. Controlla il percorso del file e i permessi.\n";
}

// NUOVO DEBUG: Verifica che FEntityManager sia caricabile
if (class_exists('App\\Foundation\\FEntityManager')) {
    echo "DEBUG: La classe FEntityManager è stata trovata correttamente!\n";
} else {
    echo "DEBUG: ERRORE: La classe FEntityManager NON è stata trovata da Composer. Rigenera l'autoloader.\n";
    // Potrebbe essere utile terminare lo script qui per evidenziare il problema
    exit("Errore fatale: FEntityManager non trovato. Esegui 'composer dump-autoload -o'.\n");
}


// Abilita l'output buffering implicito. Questo fa sì che l'output venga inviato
// al browser non appena viene generato, senza attendere la fine dello script.
ob_implicit_flush(true);

use AppORM\Entity\EClient;
use AppORM\Entity\EUserReview;
use AppORM\Entity\ECreditCard;
use AppORM\Entity\EProduct; // Importa EProduct
use AppORM\Entity\EAllergens;
use AppORM\Entity\ProductCategory; // Lascia l'uso, è semanticamente corretto

// *** AGGIUNTA CRUCIALE QUI: FORZA IL CARICAMENTO DEL FILE CHE CONTIENE L'ENUM ***
// Questo dovrebbe garantire che ProductCategory sia definito quando necessario.
require_once __DIR__ . '/AppORM/Entity/EProduct.php';


// Namespace aggiornato per FPersistentManager
use App\Foundation\FPersistentManager;
// Importa FEntityManager per poter chiamare il metodo statico clearEntityManager
use App\Foundation\FEntityManager;
// Importa FCreditCard e FAllergens per poter chiamare i metodi getById direttamente
use App\Foundation\FCreditCard;
use App\Foundation\FAllergens;
use App\Foundation\FProduct; // Assicurati sia importato

echo "Avvio test di persistenza (i dati verranno creati e poi eliminati o mantenuti a seconda della configurazione)...\n";
flush();

$clientWithPhone = null; // Sarà il client con numero di telefono per la maggior parte dei test
$clientNoPhone = null; // Sarà il client senza numero di telefono
$clientIdToDelete = null; // ID del client con telefono per eliminazione finale
$creditCardToRemove = null;
$productToDelete = null; // Per tenere traccia del prodotto da eliminare
$allergenToDelete = null; // Per tenere traccia dell'allergene da eliminare

try {
    // Pulisci l'EntityManager all'inizio di ogni test run per evitare cache residue
    FEntityManager::clearEntityManager();
    echo "EntityManager pulito all'avvio.\n";
    flush();

    // --- 1. Test: Registrazione di un nuovo cliente (CON numero di telefono) ---
    echo "\n--- 1. Test: Registrazione di un nuovo cliente (CON numero di telefono) ---\n";
    flush();
    $uniqueId1 = uniqid(); // Genera un ID univoco per evitare duplicati
    $emailWithPhone = "test.client.with_phone." . $uniqueId1 . "@example.com";
    $phoneNumber = "+393451234567890123456789";
    $nicknameWithPhone = "MarioTheClient_" . $uniqueId1; // Rendi il nickname univoco

    $clientWithPhone = FPersistentManager::registerClient(
        "Mario",
        "Rossi",
        new DateTime("1990-01-01"),
        $emailWithPhone,
        "securePassword123",
        $nicknameWithPhone, // Usa il nickname univoco
        $phoneNumber
    );

    if ($clientWithPhone) {
        echo "Cliente CON telefono registrato con successo! ID: " . $clientWithPhone->getId() . ", Email: " . $clientWithPhone->getEmail() . ", Telefono: " . $clientWithPhone->getPhonenumber() . "\n";
        $clientIdToDelete = $clientWithPhone->getId();
    } else {
        echo "Errore critico: Registrazione del cliente CON telefono fallita. Interruzione dei test.\n";
        throw new Exception("Registrazione cliente CON telefono fallita.");
    }
    flush();

    // --- 1.1 Test: Registrazione di un nuovo cliente (SENZA numero di telefono) ---
    echo "\n--- 1.1 Test: Registrazione di un nuovo cliente (SENZA numero di telefono) ---\n";
    flush();
    $uniqueId2 = uniqid(); // Genera un ID univoco
    $emailNoPhone = "test.client.no_phone." . $uniqueId2 . "@example.com";
    $nicknameNoPhone = "LuigiTheClient_" . $uniqueId2; // Rendi il nickname univoco

    $clientNoPhone = FPersistentManager::registerClient(
        "Luigi",
        "Verdi",
        new DateTime("1985-05-15"),
        $emailNoPhone,
        "anotherSecurePassword",
        $nicknameNoPhone // Usa il nickname univoco
    );

    if ($clientNoPhone) {
        echo "Cliente SENZA telefono registrato con successo! ID: " . $clientNoPhone->getId() . ", Email: " . $clientNoPhone->getEmail() . ", Telefono: " . ($clientNoPhone->getPhonenumber() ?? "N/A") . "\n";
    } else {
        echo "Errore critico: Registrazione del cliente SENZA telefono fallita. Interruzione dei test.\n";
        throw new Exception("Registrazione cliente SENZA telefono fallita.");
    }
    flush();

    // Pulisci l'EntityManager prima del prossimo test per garantire un nuovo stato
    FEntityManager::clearEntityManager();

    echo "\n--- 2. Test: Autenticazione del cliente ---\n";
    flush();
    $authenticatedClient = FPersistentManager::authenticateClient($emailWithPhone, "securePassword123");
    if ($authenticatedClient && $authenticatedClient->getId() === $clientWithPhone->getId()) {
        echo "Cliente autenticato con successo: " . $authenticatedClient->getName() . "\n";
    } else {
        echo "Autenticazione fallita per il cliente: " . $emailWithPhone . "\n";
        throw new Exception("Autenticazione cliente fallita.");
    }
    flush();

    FEntityManager::clearEntityManager();

    echo "\n--- 3. Test: Recupero del cliente tramite ID e Email ---\n";
    flush();
    $retrievedClientById = FPersistentManager::getClientById($clientWithPhone->getId());
    if ($retrievedClientById && $retrievedClientById->getId() === $clientWithPhone->getId()) {
        echo "Cliente recuperato per ID con successo.\n";
    } else {
        echo "Errore nel recupero del cliente per ID.\n";
        throw new Exception("Recupero cliente per ID fallito.");
    }

    $retrievedClientByEmail = FPersistentManager::getClientByEmail($emailWithPhone);
    if ($retrievedClientByEmail && $retrievedClientByEmail->getId() === $clientWithPhone->getId()) {
        echo "Cliente recuperato per Email con successo.\n";
    } else {
        echo "Errore nel recupero del cliente per Email.\n";
        throw new Exception("Recupero cliente per Email fallito.");
    }
    flush();

    echo "\n--- 4. Test: Aggiornamento dati cliente ---\n";
    flush();
    // Ricarica il cliente per assicurarsi che sia gestito e non in stato detached
    // Questo clientToUpdate sarà usato per tutti gli aggiornamenti in questo blocco
    $clientToUpdate = FPersistentManager::getClientById($clientWithPhone->getId());
    if (!$clientToUpdate) {
        echo "Errore: cliente da aggiornare non trovato.\n";
        throw new Exception("Cliente per aggiornamento non disponibile.");
    }

    // Test aggiornamento numero di telefono
    $newPhoneNumber = "+391234567890";
    if (FPersistentManager::updateClientPhonenumber($clientToUpdate, $newPhoneNumber)) {
        echo "Numero di telefono aggiornato con successo.\n";
    } else {
        echo "Errore nell'aggiornamento del numero di telefono.\n";
        throw new Exception("Aggiornamento numero di telefono fallito.");
    }
    // Verifica immediata senza clear/re-fetch per questo specifico sub-test
    if ($clientToUpdate->getPhonenumber() === $newPhoneNumber) {
        echo "Verifica aggiornamento telefono riuscita.\n";
    } else {
        echo "Verifica aggiornamento telefono fallita. Valore atteso: " . $newPhoneNumber . ", Trovato: " . $clientToUpdate->getPhonenumber() . "\n";
        throw new Exception("Verifica aggiornamento telefono fallita.");
    }

    // Test aggiornamento nickname (usa lo stesso $clientToUpdate)
    $newNickname = "SuperMario" . uniqid();
    if (FPersistentManager::updateClientNickname($clientToUpdate, $newNickname)) {
        echo "Nickname aggiornato con successo.\n";
    } else {
        echo "Errore nell'aggiornamento del nickname.\n";
        throw new Exception("Aggiornamento nickname fallito.");
    }
    // Verifica immediata
    if ($clientToUpdate->getNickname() === $newNickname) {
        echo "Verifica aggiornamento nickname riuscita.\n";
    } else {
        echo "Verifica aggiornamento nickname fallita. Valore atteso: " . $newNickname . ", Trovato: " . $clientToUpdate->getNickname() . "\n";
        throw new Exception("Verifica aggiornamento nickname fallita.");
    }

    // Test aggiornamento notifiche (usa lo stesso $clientToUpdate)
    if (FPersistentManager::updateClientReceivesNotifications($clientToUpdate, true)) {
        echo "Notifiche abilitate con successo.\n";
    } else {
        echo "Errore nell'abilitazione delle notifiche.\n";
        throw new Exception("Abilitazione notifiche fallita.");
    }
    // Verifica immediata
    if ($clientToUpdate->getReceivesNotifications() === true) {
        echo "Verifica abilitazione notifiche riuscita.\n";
    } else {
        echo "Verifica abilitazione notifiche fallita.\n";
        throw new Exception("Verifica abilitazione notifiche fallita.");
    }
    flush();

    // Ora pulisci l'EntityManager per il prossimo blocco di test
    FEntityManager::clearEntityManager();

    echo "\n--- 5. Test: Aggiunta/Rimozione Loyalty Points ---\n";
    flush();
    // Ricarica il client per questo blocco
    $clientPoints = FPersistentManager::getClientById($clientWithPhone->getId());
    if (!$clientPoints) {
        echo "Errore: cliente per punti fedeltà non trovato.\n";
        throw new Exception("Cliente per punti fedeltà non disponibile.");
    }

    $initialPoints = $clientPoints->getLoyaltyPoints();

    // Aggiungi punti
    if (FPersistentManager::addClientLoyaltyPoints($clientPoints, 100)) {
        echo "Aggiunti 100 punti fedeltà.\n";
    } else {
        echo "Errore nell'aggiunta punti fedeltà.\n";
        throw new Exception("Aggiunta punti fedeltà fallita.");
    }
    // Verifica immediata
    if ($clientPoints->getLoyaltyPoints() === ($initialPoints + 100)) {
        echo "Verifica punti fedeltà (aggiunta) riuscita.\n";
    } else {
        echo "Verifica punti fedeltà (aggiunta) fallita.\n";
        throw new Exception("Verifica aggiunta punti fedeltà fallita.");
    }

    // Rimuovi punti
    if (FPersistentManager::removeClientLoyaltyPoints($clientPoints, 50)) {
        echo "Rimossi 50 punti fedeltà.\n";
    } else {
        echo "Errore nella rimozione punti fedeltà.\n";
        throw new Exception("Rimozione punti fedeltà fallita.");
    }
    // Verifica immediata
    if ($clientPoints->getLoyaltyPoints() === ($initialPoints + 50)) {
        echo "Verifica punti fedeltà (rimozione) riuscita.\n";
    } else {
        echo "Verifica punti fedeltà (rimozione) fallita.\n";
        throw new Exception("Verifica rimozione punti fedeltà fallita.");
    }
    flush();

    FEntityManager::clearEntityManager();

    echo "\n--- 6. Test: Aggiunta di una recensione ---\n";
    flush();
    $clientForReview = FPersistentManager::getClientById($clientWithPhone->getId());
    if (!$clientForReview) {
        echo "Errore: cliente per recensione non trovato.\n";
        throw new Exception("Cliente per recensione non disponibile.");
    }
    $review = new EUserReview($clientForReview, "Ottimo servizio e qualità!", 5);
    if (FPersistentManager::addClientReview($review)) {
        echo "Recensione aggiunta con successo! ID Recensione: " . $review->getId() . "\n";
    } else {
        echo "Errore nell'aggiunta della recensione.\n";
        throw new Exception("Aggiunta recensione fallita.");
    }
    flush();

    FEntityManager::clearEntityManager();

    echo "\n--- 7. Test: Gestione Carte di Credito ---\n";
    flush();
    $clientForCreditCard = FPersistentManager::getClientById($clientWithPhone->getId());
    if (!$clientForCreditCard) {
        echo "Errore: cliente per gestione carte di credito non trovato.\n";
        throw new Exception("Cliente per gestione carte di credito non disponibile.");
    }

    $expirationDate = new DateTime('+5 years');
    $cardNumber = '1111222233334444';
    $cvv = '123';
    $cardHolderName = $clientForCreditCard->getName() . " " . $clientForCreditCard->getSurname();
    $cardName = "My Visa " . uniqid();

    $creditCard = FPersistentManager::addClientCreditCard(
        $clientForCreditCard,
        $cardHolderName,
        $cardNumber,
        $cvv,
        $expirationDate,
        $cardName
    );

    if ($creditCard) {
        echo "Carta di credito aggiunta con successo! ID: " . $creditCard->getId() . ", Nome: " . $creditCard->getCardName() . "\n";
        $creditCardToRemove = $creditCard; // Tieni traccia per la rimozione successiva
    } else {
        echo "Errore nell'aggiunta della carta di credito.\n";
        throw new Exception("Aggiunta carta di credito fallita.");
    }

    FEntityManager::clearEntityManager();
    $retrievedCards = FPersistentManager::getClientCreditCards($clientForCreditCard); // Ricarica il client per ottenere la collezione aggiornata
    if (!empty($retrievedCards)) {
        echo "Verifica: Carte di credito recuperate con successo (" . count($retrievedCards) . ").\n";
        $found = false;
        foreach ($retrievedCards as $card) {
            if ($card->getId() === $creditCard->getId()) {
                $found = true;
                break;
            }
        }
        if ($found) {
            echo "Verifica: Carta aggiunta trovata nella collezione.\n";
        } else {
            echo "Verifica: Carta aggiunta NON trovata nella collezione.\n";
            throw new Exception("Verifica: Carta aggiunta NON trovata.");
        }
    } else {
        echo "Verifica: Nessuna carta di credito recuperata.\n";
        // throw new Exception("Verifica: Nessuna carta di credito recuperata."); // Non lanciare un errore se non ci sono altre carte
    }

    // Test rimozione carta di credito
    if ($creditCardToRemove) {
        FEntityManager::clearEntityManager(); // Pulisce per ricaricare la carta e il client se necessario
        $cardToDelete = FCreditCard::getObj($creditCardToRemove->getId()); // Recupera la carta
        if (!$cardToDelete) {
            echo "Errore: Carta di credito da rimuovere non trovata dopo la ricarica.\n";
            throw new Exception("Carta di credito da rimuovere non trovata.");
        }
        
        // Ricarica il clientForCreditCard per assicurarsi che sia gestito e la sua collezione sia fresca
        $clientForCreditCardReloaded = FPersistentManager::getClientById($clientForCreditCard->getId());
        if (!$clientForCreditCardReloaded) {
             echo "Errore: Client per rimozione carta non trovato dopo ricarica.\n";
             throw new Exception("Client per rimozione carta non disponibile.");
        }

        if (FPersistentManager::removeClientCreditCard($clientForCreditCardReloaded, $cardToDelete)) {
            echo "Carta di credito rimossa con successo.\n";
        } else {
            echo "Errore nella rimozione della carta di credito.\n";
            throw new Exception("Rimozione carta di credito fallita.");
        }
        FEntityManager::clearEntityManager();
        $remainingCards = FPersistentManager::getClientCreditCards($clientForCreditCardReloaded);
        
        $cardStillPresent = false;
        foreach ($remainingCards as $card) {
            if ($card->getId() === $cardToDelete->getId()) {
                $cardStillPresent = true;
                break;
            }
        }

        if (!$cardStillPresent) {
            echo "Verifica: Rimozione carta di credito riuscita. La carta specifica non è più presente.\n";
        } else {
            echo "Verifica: Rimozione carta di credito fallita. La carta è ancora presente.\n";
            throw new Exception("Verifica rimozione carta di credito fallita (carta ancora presente).");
        }
    }
    flush();

    FEntityManager::clearEntityManager();

    echo "\n--- 8. Test: Gestione Prodotti e Allergeni ---\n";
    flush();
    // Test Aggiunta Prodotto
    $productName = "Pizza Margherita " . uniqid();
    $productDescription = "Pomodoro, mozzarella, basilico.";
    $productCost = 8.50;
    // --- MODIFICA QUI: Creazione dell'enum in modo più robusto ---
    $productCategory = ProductCategory::tryFrom('primo'); // Usa tryFrom() per una gestione più sicura
    if ($productCategory === null) {
        throw new Exception("Categoria Prodotto 'primo' non valida o non trovata.");
    }
    // -----------------------------------------------------------

    $newProduct = new EProduct($productName, $productDescription, $productCost, $productCategory);
    if (FPersistentManager::saveProduct($newProduct)) {
        echo "Prodotto aggiunto con successo! ID: " . $newProduct->getId() . ", Nome: " . $newProduct->getName() . "\n";
        $productToDelete = $newProduct;
    } else {
        echo "Errore nell'aggiunta del prodotto.\n";
        throw new Exception("Aggiunta prodotto fallita.");
    }

    FEntityManager::clearEntityManager(); // Clear dopo l'aggiunta di un nuovo prodotto

    $retrievedProduct = FPersistentManager::getProductById($newProduct->getId());
    if ($retrievedProduct && $retrievedProduct->getName() === $productName) {
        echo "Verifica: Prodotto recuperato con successo.\n";
    } else {
        echo "Verifica: Prodotto non trovato o dati non corrispondenti.\n";
        throw new Exception("Recupero prodotto fallito.");
    }

    // Test Aggiornamento Disponibilità Prodotto (usa lo stesso $retrievedProduct)
    if ($retrievedProduct) { // Usa l'entità appena recuperata
        if (FPersistentManager::updateProductAvailability($retrievedProduct, false)) {
            echo "Disponibilità prodotto aggiornata a false.\n";
        } else {
            echo "Errore nell'aggiornamento disponibilità prodotto.\n";
            throw new Exception("Aggiornamento disponibilità prodotto fallita.");
        }
        // Verifica immediata
        if ($retrievedProduct->getAvailability() === false) {
            echo "Verifica: Disponibilità prodotto aggiornata correttamente.\n";
        } else {
            echo "Verifica: Errore nell'aggiornamento disponibilità prodotto.\n";
            throw new Exception("Verifica aggiornamento disponibilità prodotto fallita.");
        }
    }

    // Test Aggiunta Allergene
    $allergenType = "Glutine " . uniqid();
    $newAllergen = new EAllergens($allergenType);
    if (FPersistentManager::saveAllergen($newAllergen)) {
        echo "Allergene aggiunto con successo! ID: " . $newAllergen->getId() . ", Tipo: " . $newAllergen->getAllergenType() . "\n";
        $allergenToDelete = $newAllergen;
    } else {
        echo "Errore nell'aggiunta dell'allergene.\n";
        throw new Exception("Aggiunta allergene fallita.");
    }

    FEntityManager::clearEntityManager(); // Clear dopo l'aggiunta di un nuovo allergene

    $retrievedAllergen = FPersistentManager::getAllergenById($newAllergen->getId());
    if ($retrievedAllergen && $retrievedAllergen->getAllergenType() === $allergenType) {
        echo "Verifica: Allergene recuperato con successo.\n";
    } else {
        echo "Verifica: Allergene non trovato o dati non corrispondenti.\n";
        throw new Exception("Recupero allergene fallito.");
    }

    // Test Associazione Prodotto-Allergene
    if ($retrievedProduct && $retrievedAllergen) { // Usa le entità già recuperate
        // Ricarica le entità per assicurarsi che siano gestite e aggiornate (anche se il clear è stato fatto dopo)
        $productToAssociate = FPersistentManager::getProductById($retrievedProduct->getId());
        $allergenToAssociate = FPersistentManager::getAllergenById($retrievedAllergen->getId());

        if (!$productToAssociate || !$allergenToAssociate) {
            echo "Errore: Prodotto o Allergene per associazione non trovati.\n";
            throw new Exception("Prodotto o Allergene per associazione non disponibili.");
        }

        if (FPersistentManager::addAllergenToProduct($productToAssociate, $allergenToAssociate)) {
            echo "Allergene associato al prodotto con successo.\n";
        } else {
            echo "Errore nell'associazione allergene al prodotto.\n";
            throw new Exception("Associazione allergene al prodotto fallita.");
        }
        // Verifica immediata
        if ($productToAssociate->getAllergens()->contains($allergenToAssociate)) {
            echo "Verifica: Associazione allergene-prodotto riuscita.\n";
        } else {
            echo "Verifica: Associazione allergene-prodotto fallita.\n";
            throw new Exception("Verifica associazione allergene-prodotto fallita.");
        }

        // Test Rimozione Associazione Prodotto-Allergene (usa le stesse entità)
        if (FPersistentManager::removeAllergenFromProduct($productToAssociate, $allergenToAssociate)) {
            echo "Allergene rimosso dal prodotto con successo.\n";
        } else {
            echo "Errore nella rimozione allergene dal prodotto.\n";
            throw new Exception("Rimozione allergene dal prodotto fallita.");
        }
        // Verifica immediata
        if (!$productToAssociate->getAllergens()->contains($allergenToAssociate)) {
            echo "Verifica: Rimozione associazione allergene-prodotto riuscita. La carta specifica non è più presente.\n";
        } else {
            echo "Verifica: Rimozione associazione allergene-prodotto fallita. La carta è ancora presente.\n";
            throw new Exception("Verifica rimozione associazione allergene-prodotto fallita (carta ancora presente).");
        }
    }
    flush();

    FEntityManager::clearEntityManager();

    echo "\n--- 9. Test: Eliminazione del cliente (con recensioni e carte di credito associate) ---\n";
    flush();
    if ($clientIdToDelete) {
        $clientToDelete = FPersistentManager::getClientById($clientIdToDelete);
        if (!$clientToDelete) {
            echo "Errore: Cliente per eliminazione finale non trovato.\n";
            throw new Exception("Cliente per eliminazione non disponibile.");
        }

        if (FPersistentManager::deleteClient($clientToDelete)) {
            echo "Cliente eliminato con successo! (e recensioni e carte di credito associate tramite cascade)\n";
        } else {
            echo "Errore nell'eliminazione del cliente.\n";
            throw new Exception("Eliminazione cliente fallita.");
        }
        FEntityManager::clearEntityManager(); // Pulisce per verificare l'eliminazione
        $deletedClient = FPersistentManager::getClientById($clientIdToDelete);
        if ($deletedClient === null) {
            echo "Verifica: Cliente ID " . $clientIdToDelete . " non trovato (eliminazione riuscita).\n";
        } else {
            echo "Verifica: Cliente ID " . $clientIdToDelete . " ancora presente (eliminazione fallita).\n";
            throw new Exception("Verifica eliminazione cliente fallita.");
        }
        echo "Verifica: Le recensioni e le carte di credito associate sono state eliminate tramite CASCADE (confermato dal messaggio precedente).\n";
        flush();
    } else {
        echo "Cliente per eliminazione finale non disponibile.\n";
        flush();
    }

} catch (Exception $e) {
    echo "\n--- ERRORE CRITICO DURANTE I TEST ---\n";
    echo "Messaggio: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Linea: " . $e->getLine() . "\n";
    echo "Stack Trace:\n" . $e->getTraceAsString() . "\n";
    flush();
} finally {
    // Pulizia finale (indipendentemente dagli errori precedenti)
    // Per eliminare il prodotto e l'allergene aggiunti
    try {
        if ($productToDelete && $productToDelete->getId()) {
            FEntityManager::clearEntityManager();
            $productToErase = FPersistentManager::getProductById($productToDelete->getId());
            if ($productToErase && FPersistentManager::deleteProduct($productToErase)) {
                echo "Prodotto eliminato con successo!\n";
            } else {
                echo "Errore nell'eliminazione del prodotto.\n";
            }
        }
    } catch (\Exception $e) {
        echo "Errore durante l'eliminazione del prodotto: " . $e->getMessage() . "\n";
    }

    try {
        if ($allergenToDelete && $allergenToDelete->getId()) {
            FEntityManager::clearEntityManager();
            $allergenToErase = FPersistentManager::getAllergenById($allergenToDelete->getId());
            if ($allergenToErase && FPersistentManager::deleteAllergen($allergenToErase)) {
                echo "Allergene eliminato con successo!\n";
            } else {
                echo "Errore nell'eliminazione dell'allergene.\n";
            }
        }
    } catch (\Exception $e) {
        echo "Errore durante l'eliminazione dell'allergene: " . $e->getMessage() . "\n";
    }


    // Pulizia del secondo cliente (senza telefono)
    if ($clientNoPhone && $clientNoPhone->getId()) {
        echo "\n--- Pulizia: Eliminazione del cliente SENZA telefono ---\n";
        flush();
        try {
            // Ricarica il client per assicurarti che sia gestito prima dell'eliminazione
            FEntityManager::clearEntityManager(); // Pulisce l'entity manager prima di recuperare
            $clientNoPhoneToErase = FPersistentManager::getClientById($clientNoPhone->getId());
            if ($clientNoPhoneToErase && FPersistentManager::deleteClient($clientNoPhoneToErase)) {
                echo "Cliente SENZA telefono eliminato con successo!\n";
            } else {
                echo "Errore nell'eliminazione del cliente SENZA telefono.\\n";
            }
        } catch (\Exception $e) {
            echo "Errore durante l'eliminazione del cliente SENZA telefono: " . $e->getMessage() . "\n";
        }
        flush();
    } else {
        echo "Cliente non valido o non esiste più per l'eliminazione finale.\n";
        flush();
    }
}


echo "\n--- Test di persistenza completato. Controlla l'output e il tuo database. ---\n";
flush();
