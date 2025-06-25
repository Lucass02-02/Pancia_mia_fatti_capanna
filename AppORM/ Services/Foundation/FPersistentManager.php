<?php

// Assicurati che l'autoloader sia configurato correttamente (es. Composer autoload)
require __DIR__ . '/vendor/autoload.php';

// Abilita l'output buffering implicito. Questo fa sì che l'output venga inviato
// al browser non appena viene generato, senza attendere la fine dello script.
ob_implicit_flush(true);

use AppORM\Entity\EClient;
use AppORM\Entity\EUserReview; // Aggiunto per il test delle recensioni
use App\EntityManager\FEntityManager; // MODIFICA QUI: Corretto il namespace e il nome della classe
// use DateTime; // Rimosso: la dichiarazione use per DateTime non è necessaria in questo contesto
use DateTime; // Mantengo l'uso di DateTime, anche se il warning persiste, per coerenza con il tuo codice precedente.

echo "Avvio test di persistenza...\n";
flush(); // Forza l'invio dell'output

// MODIFICA QUI: Corretto il nome della classe da chiamare
$manager = FEntityManager::getInstance();

// 1. Creazione di un nuovo cliente
echo "Creazione di un nuovo cliente...\n";
flush();
try {
    $birthDate = new DateTime('1990-05-15'); // Esempio di data di nascita
    $client = new EClient(
        'Mario',
        'Rossi',
        $birthDate, // Passa la data di nascita
        'mario.rossi@example.com',
        password_hash('password123', PASSWORD_BCRYPT), // La password dovrebbe essere sempre hashata
        'supermario', // Nickname (ora gestito nel costruttore di EClient)
        '3331234567'  // Phonenumber
    );

    // Assumendo che saveClient esista e usi FEntityManager::saveObj
    $isSaved = $manager->saveClient($client); // Se saveClient non esiste in FEntityManager, dovrai usare saveObj

    if ($isSaved) {
        echo "Cliente salvato con successo! ID: " . $client->getId() . "\n";
    } else {
        echo "Errore nel salvataggio del cliente.\n";
    }
    flush();

    // 2. Recupero del cliente tramite ID
    echo "\nRecupero del cliente tramite ID...\n";
    flush();
    $retrievedClient = $manager->getClient($client->getId()); // Se getClient non esiste in FEntityManager, dovrai usare retriveObjectOnAttribute o similare

    if ($retrievedClient) {
        echo "Cliente recuperato: " . $retrievedClient->getName() . " " . $retrievedClient->getSurname() . " (Email: " . $retrievedClient->getEmail() . ")\n";
    } else {
        echo "Cliente non trovato.\n";
    }
    flush();

    // 3. Recupero del cliente tramite email (simulazione)
    echo "\nRecupero del cliente tramite email...\n";
    flush();
    // Assumo che FEntityManager abbia un metodo per recuperare per attributo, o che la Foundation specifica lo wrappi.
    $clientByEmail = $manager->retriveObjectOnAttribute(EClient::class, 'email', 'mario.rossi@example.com');
    if ($clientByEmail) {
        echo "Cliente recuperato per email: " . $clientByEmail->getName() . "\n";
    } else {
        echo "Cliente con questa email non trovato.\n";
    }
    flush();

    // 4. Verifica esistenza email (simulazione)
    echo "\nVerifica esistenza email...\n";
    flush();
    $emailExists = $manager->checkClientEmail('mario.rossi@example.com'); // Questo metodo dovrebbe essere in FClient o FEntityManager
    if ($emailExists) {
        echo "Email 'mario.rossi@example.com' esiste.\n";
    } else {
        echo "Email 'mario.rossi@example.com' NON esiste.\n";
    }
    flush();

    // 5. Aggiornamento del cliente
    echo "\nAggiornamento del cliente...\n";
    flush();
    if ($retrievedClient) {
        $retrievedClient->setPhonenumber('3399876543');
        $retrievedClient->setEmail('mario.updated@example.com');
        $isUpdated = $manager->saveClient($retrievedClient); // Salva le modifiche

        if ($isUpdated) {
            echo "Cliente aggiornato con successo!\n";
            echo "Nuovo numero di telefono: " . $retrievedClient->getPhonenumber() . "\n";
            echo "Nuova email: " . $retrievedClient->getEmail() . "\n";
        } else {
            echo "Errore nell'aggiornamento del cliente.\n";
        }
    }
    flush();

} catch (\Exception $e) {
    echo "Errore durante il test: " . $e->getMessage() . "\n";
    flush();
}

// 6. Test recensioni cliente
echo "\nTest recensioni cliente...\n";
flush();
if (isset($client) && $client->getId()) {
    try {
        // Crea una recensione
        // Il costruttore di EUserReview ora richiede l'oggetto EClient
        $review = new EUserReview($client, 'Ottimo servizio!', 5, new DateTime(), new DateTime());
        // Assumendo che saveReview esista in FEntityManager o sia wrappato da FUserReview
        $isReviewSaved = $manager->saveReview($review);

        if ($isReviewSaved) {
            echo "Recensione salvata con successo! ID: " . $review->getId() . "\n";
        } else {
            echo "Errore nel salvataggio della recensione.\n";
        }
        flush();

        // Assumendo che getClientReviews esista in FEntityManager o sia wrappato da FUserReview
        $reviews = $manager->getClientReviews($client);
        echo "Recensioni per " . $client->getName() . ": " . count($reviews) . "\n";
        flush();

        if (count($reviews) > 0) {
            echo "Prima recensione: " . $reviews[0]->getDescription() . " (Voto: " . $reviews[0]->getVote() . ")\n";
        }
        flush();

    } catch (\Exception $e) {
        echo "Errore durante la creazione/salvataggio della recensione: " . $e->getMessage() . "\n";
        flush();
    }
}

// 7. Eliminazione del cliente (ATTENZIONE: questo lo eliminerà dal DB!)
echo "\nTentativo di eliminazione del cliente...\n";
flush();
if (isset($client) && $client->getId()) {
    // Assumendo che deleteClient esista in FEntityManager o sia wrappato da FClient
    $isDeleted = $manager->deleteClient($client);
    if ($isDeleted) {
        echo "Cliente eliminato con successo!\n";
    } else {
        echo "Errore nell'eliminazione del cliente.\n";
    }
    flush();
}

echo "\nTest di persistenza completato.\n";
flush();