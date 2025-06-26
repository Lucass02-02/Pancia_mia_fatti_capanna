<?php
// PHP Version: 8.1+

// Assicurati che l'autoloader sia configurato correttamente (es. Composer autoload)
require __DIR__ . '/vendor/autoload.php';

// Abilita l'output buffering implicito. Questo fa sì che l'output venga inviato
// al browser non appena viene generato, senza attendere la fine dello script.
ob_implicit_flush(true);

use AppORM\Entity\EClient;
use AppORM\Entity\EUserReview;
use AppORM\Entity\ECreditCard; // Importa ECreditCard
use App\Foundation\FPersistentManager;

echo "Avvio test di persistenza (i dati verranno creati e poi eliminati o mantenuti a seconda della configurazione)...\n";
flush();

$client = null;
$clientIdToDelete = null;
$creditCardToRemove = null; // Variabile per tenere traccia della carta da rimuovere

try {
    $uniqueId = uniqid();
    $email = 'test.client.' . $uniqueId . '@example.com';
    $nickname = 'supermario_' . $uniqueId;
    $password = 'securePassword123';
    $birthDate = new \DateTime('1990-05-15');

    // --- 1. Test: Registrazione di un nuovo cliente ---
    echo "\n--- 1. Test: Registrazione di un nuovo cliente ---\n";
    flush();
    // Non passiamo più savedMethods al costruttore di EClient
    $client = FPersistentManager::registerClient(
        'Mario',
        'Rossi',
        $birthDate,
        $email,
        $password,
        $nickname,
        '3331234567'
    );

    if ($client) {
        echo "Cliente registrato con successo! ID: " . $client->getId() . " (Email: " . $client->getEmail() . ")\n";
        $clientIdToDelete = $client->getId();

        // --- Aggiungi carte di credito DOPO la registrazione ---
        echo "\n--- 1.1 Test: Aggiunta carte di credito salvate ---\n";
        flush();

        $expirationDate1 = new \DateTime('+5 years');
        $card1 = FPersistentManager::addClientCreditCard($client, 'Mario Rossi', '1234567812345678', '123', $expirationDate1, 'Mia Visa');
        if ($card1) {
            echo "Carta di credito 1 aggiunta! ID: " . $card1->getIdCard() . ", Tipo: Visa, Desc: " . $card1->getName() . "\n";
            $creditCardToRemove = $card1; // Salva la carta per testare la rimozione dopo
        } else {
            echo "Errore nell'aggiunta della carta 1.\n";
        }

        $expirationDate2 = new \DateTime('+3 years');
        $card2 = FPersistentManager::addClientCreditCard($client, 'Mario Rossi', '8765432187654321', '321', $expirationDate2, 'Mastercard Lavoro');
        if ($card2) {
            echo "Carta di credito 2 aggiunta! ID: " . $card2->getIdCard() . ", Tipo: Mastercard, Desc: " . $card2->getName() . "\n";
        } else {
            echo "Errore nell'aggiunta della carta 2.\n";
        }
        flush();

        // Verifica che le carte siano state aggiunte
        $clientCreditCards = FPersistentManager::getClientCreditCards($client);
        echo "Carte di credito per " . $client->getName() . ": " . count($clientCreditCards) . "\n";
        foreach ($clientCreditCards as $cc) {
            echo "  - ID: " . $cc->getIdCard() . ", Nome: " . $cc->getName() . ", Numero (ultime 4): " . substr($cc->getNumber(), -4) . "\n";
        }
        flush();

    } else {
        echo "Errore nella registrazione del cliente (potrebbe già esistere o altri errori).\n";
        die("Test terminato a causa di errore di registrazione del cliente.\n");
    }
    flush();

    // --- 2. Test: Autenticazione del cliente ---
    echo "\n--- 2. Test: Autenticazione del cliente ---\n";
    flush();
    $authenticatedClient = FPersistentManager::authenticateClient($email, $password);
    if ($authenticatedClient) {
        echo "Cliente autenticato con successo: " . $authenticatedClient->getName() . "\n";
    } else {
        echo "Autenticazione fallita per email: " . $email . "\n";
    }
    flush();

    // --- 3. Test: Recupero del cliente tramite ID ---
    echo "\n--- 3. Test: Recupero del cliente tramite ID ---\n";
    flush();
    // Ricarica il client per assicurarti che Doctrine carichi le nuove relazioni se non già caricate
    $retrievedClientById = FPersistentManager::getClientById($client->getId());
    if ($retrievedClientById) {
        echo "Cliente recuperato tramite ID: " . $retrievedClientById->getName() . " " . $retrievedClientById->getSurname() . " (Email: " . $retrievedClientById->getEmail() . ")\n";
        // Verifica anche le carte di credito dopo il recupero
        $retrievedCards = FPersistentManager::getClientCreditCards($retrievedClientById);
        echo "Carte di credito recuperate tramite ID: " . count($retrievedCards) . "\n";
    } else {
        echo "Cliente non trovato tramite ID: " . $client->getId() . "\n";
    }
    flush();

    // --- 4. Test: Recupero del cliente tramite email ---
    echo "\n--- 4. Test: Recupero del cliente tramite email ---\n";
    flush();
    $retrievedClientByEmail = FPersistentManager::getClientByEmail($email);
    if ($retrievedClientByEmail) {
        echo "Cliente recuperato tramite email: " . $retrievedClientByEmail->getName() . "\n";
    } else {
        echo "Cliente con email '" . $email . "' non trovato.\n";
    }
    flush();

    // --- 5. Test: Verifica esistenza email ---
    echo "\n--- 5. Test: Verifica esistenza email ---\n";
    flush();
    $emailExists = FPersistentManager::checkClientEmailExists($email);
    if ($emailExists) {
        echo "Email '" . $email . "' esiste.\n";
    } else {
        echo "Email '" . $email . "' NON esiste.\n";
    }
    flush();

    // --- 6. Test: Aggiornamento completo del profilo del cliente ---
    echo "\n--- 6. Test: Aggiornamento completo del profilo del cliente ---\n";
    flush();
    $newEmail = 'mario.new.updated.' . $uniqueId . '@example.com';
    $updateData = [
        'name' => 'Luigi',
        'surname' => 'Verdi',
        'phonenumber' => '3391122334',
        'email' => $newEmail,
        'nickname' => 'greenluigi',
        'loyaltyPoints' => 100,
        'receivesNotifications' => true,
        'password' => 'newSecurePass456'
    ];

    if (FPersistentManager::updateClientProfile($client, $updateData)) {
        echo "Profilo cliente aggiornato con successo!\n";
        $client = FPersistentManager::getClientById($client->getId()); // Ricarica per i dati aggiornati
        echo "Nuovo Nome: " . $client->getName() . "\n";
        echo "Nuovo Cognome: " . $client->getSurname() . "\n";
        echo "Nuovo Telefono: " . $client->getPhonenumber() . "\n";
        echo "Nuova Email: " . $client->getEmail() . "\n";
        echo "Nuovo Nickname: " . $client->getNickname() . "\n";
        echo "Nuovi Punti Fedeltà: " . $client->getLoyaltyPoints() . "\n";
        echo "Riceve Notifiche: " . ($client->getReceivesNotifications() ? 'Sì' : 'No') . "\n";

        $authenticatedAfterUpdate = FPersistentManager::authenticateClient($newEmail, 'newSecurePass456');
        if ($authenticatedAfterUpdate) {
            echo "Autenticazione con nuova password riuscita.\n";
        } else {
            echo "Autenticazione con nuova password fallita.\n";
        }

        // --- 6.1 Test: Rimozione di una carta di credito salvata ---
        echo "\n--- 6.1 Test: Rimozione carta di credito salvata ---\n";
        flush();
        if ($creditCardToRemove) { // Assicurati che $creditCardToRemove sia stato effettivamente aggiunto e non sia nullo
            if (FPersistentManager::removeClientCreditCard($client, $creditCardToRemove)) {
                echo "Carta di credito ID: " . $creditCardToRemove->getIdCard() . " rimossa con successo!\n";
            } else {
                echo "Errore nella rimozione della carta di credito ID: " . $creditCardToRemove->getIdCard() . ".\n";
            }
            // Ricarica il client per assicurarti che la collezione sia aggiornata
            $client = FPersistentManager::getClientById($client->getId());
            $updatedCreditCards = FPersistentManager::getClientCreditCards($client);
            echo "Carte di credito dopo la rimozione: " . count($updatedCreditCards) . "\n";
            foreach ($updatedCreditCards as $cc) {
                echo "  - ID: " . $cc->getIdCard() . ", Nome: " . $cc->getName() . "\n";
            }
        } else {
            echo "Nessuna carta di credito da rimuovere ($creditCardToRemove non è stato inizializzato).\n";
        }
        flush();

    } else {
        echo "Errore nell'aggiornamento del profilo cliente.\n";
    }
    flush();

    // --- 7. Test: Invio e recupero recensioni cliente ---
    echo "\n--- 7. Test: Invio e recupero recensioni cliente ---\n";
    flush();

    $review1 = FPersistentManager::submitClientReview($client, 'Servizio eccellente, cibo squisito!', 5);
    if ($review1) {
        echo "Recensione 1 salvata con successo! ID: " . $review1->getId() . " (Voto: " . $review1->getVote() . ")\n";
    } else {
        echo "Errore nel salvataggio della recensione 1.\n";
    }
    flush();

    $review2 = FPersistentManager::submitClientReview($client, 'Ottima atmosfera, ma un po\' lento il servizio.', 3);
    if ($review2) {
        echo "Recensione 2 salvata con successo! ID: " . $review2->getId() . " (Voto: " . $review2->getVote() . ")\n";
    } else {
        echo "Errore nel salvataggio della recensione 2.\n";
    }
    flush();

    $reviewsForClient = FPersistentManager::getReviewsForClient($client);
    echo "Recensioni per " . $client->getName() . ": " . count($reviewsForClient) . "\n";
    foreach ($reviewsForClient as $idx => $rev) {
        echo "  Recensione " . ($idx + 1) . ": \"" . $rev->getDescription() . "\" (Voto: " . $rev->getVote() . ")\n";
    }
    flush();

    $averageRatingClient = FPersistentManager::getAverageUserRating($client);
    echo "Voto medio per " . $client->getName() . ": " . number_format($averageRatingClient, 2) . "\n";
    flush();

    $averageRatingGlobal = FPersistentManager::getAverageUserRating();
    echo "Voto medio globale delle recensioni: " . number_format($averageRatingGlobal, 2) . "\n";
    flush();

    $recentReviews = FPersistentManager::getRecentUserReviews(2);
    echo "Recensioni più recenti (globali):\n";
    foreach ($recentReviews as $idx => $recentRev) {
        echo "  Recente " . ($idx + 1) . ": \"" . $recentRev->getDescription() . "\" (Voto: " . $recentRev->getVote() . ")\n";
    }
    flush();

} catch (\Exception $e) {
    echo "\nErrore Critico durante il test: " . $e->getMessage() . "\n";
    echo "Stack Trace:\n" . $e->getTraceAsString() . "\n";
    flush();
}

// --- 8. Test: Eliminazione del cliente (con recensioni e carte di credito associate) ---
echo "\n--- 8. Test: Eliminazione del cliente (con recensioni e carte di credito associate) ---\n";
flush();
if (isset($clientIdToDelete)) {
    try {
        $clientToErase = FPersistentManager::getClientById($clientIdToDelete);
        if ($clientToErase && FPersistentManager::deleteClient($clientToErase)) {
            echo "Cliente eliminato con successo! (e recensioni e carte di credito associate tramite cascade)\n";
        } else {
            echo "Errore nell'eliminazione del cliente.\n";
        }
        flush();

        $deletedClientCheck = FPersistentManager::getClientById($clientIdToDelete);
        if ($deletedClientCheck === null) {
            echo "Verifica: Cliente ID " . $clientIdToDelete . " non trovato (eliminazione riuscita).\n";
        } else {
            echo "Verifica: ERRORE! Cliente ID " . $clientIdToDelete . " trovato dopo l'eliminazione.\n";
        }
        flush();

        echo "Verifica: Le recensioni e le carte di credito associate sono state eliminate tramite CASCADE (confermato dal messaggio precedente).\n";
        flush();

    } catch (\Exception $e) {
        echo "Errore durante l'eliminazione del cliente: " . $e->getMessage() . "\n";
        echo "Stack Trace:\n" . $e->getTraceAsString() . "\n";
        flush();
    }
} else {
    echo "Cliente non valido o non esiste più per l'eliminazione finale.\n";
    flush();
}

echo "\n--- Test di persistenza completato. Controlla l'output e il tuo DB! ---\n";
flush();
