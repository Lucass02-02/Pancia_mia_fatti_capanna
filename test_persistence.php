<?php

// Assicurati che l'autoloader sia configurato correttamente (es. Composer autoload)
require __DIR__ . '/vendor/autoload.php';

// Abilita l'output buffering implicito. Questo fa sì che l'output venga inviato
// al browser non appena viene generato, senza attendere la fine dello script.
ob_implicit_flush(true);

use AppORM\Entity\EClient;
use AppORM\Entity\EUserReview;
use App\EntityManager\FEntityManager;
use DateTime; // Mantengo l'uso di DateTime, anche se il warning persiste.

echo "Avvio test di persistenza (i dati verranno mantenuti nel database)...\n";
flush(); // Forza l'invio dell'output

// Istanzia FEntityManager
$manager = FEntityManager::getInstance();

// 1. Creazione di un nuovo cliente
echo "Creazione di un nuovo cliente...\n";
flush();
try {
    // Genera un ID univoco per l'email e il nickname per evitare duplicati
    // Se esegui il test più volte senza svuotare il DB, potresti avere errori di duplicazione.
    $uniqueId = uniqid();
    $email = 'mario.rossi.' . $uniqueId . '@example.com';
    $nickname = 'supermario_' . $uniqueId;

    $birthDate = new DateTime('1990-05-15'); // Esempio di data di nascita
    $client = new EClient(
        'Mario',
        'Rossi',
        $birthDate, // Passa la data di nascita
        $email,
        password_hash('password123', PASSWORD_BCRYPT), // La password dovrebbe essere sempre hashata
        $nickname, // Nickname
        '3331234567',  // Phonenumber
        ['email_method', 'sms_method'] // Esempio di savedMethods
    );

    $isSaved = $manager->saveObject($client);

    if ($isSaved) {
        echo "Cliente salvato con successo! ID: " . $client->getId() . " (Email: " . $email . ")\n";
    } else {
        echo "Errore nel salvataggio del cliente.\n";
    }
    flush();

    // 2. Recupero del cliente tramite ID
    echo "\nRecupero del cliente tramite ID...\n";
    flush();
    $retrievedClient = $manager->retriveObject(EClient::class, $client->getId());

    if ($retrievedClient) {
        echo "Cliente recuperato: " . $retrievedClient->getName() . " " . $retrievedClient->getSurname() . " (Email: " . $retrievedClient->getEmail() . ")\n";
    } else {
        echo "Cliente non trovato.\n";
    }
    flush();

    // 3. Recupero del cliente tramite email
    echo "\nRecupero del cliente tramite email...\n";
    flush();
    $clientByEmail = $manager->retriveObjectOnAttribute(EClient::class, 'email', $email);
    if ($clientByEmail) {
        echo "Cliente recuperato per email: " . $clientByEmail->getName() . "\n";
    } else {
        echo "Cliente con questa email non trovato.\n";
    }
    flush();

    // 4. Verifica esistenza email
    echo "\nVerifica esistenza email...\n";
    flush();
    $emailExists = $manager->verifyAttributes('id', EClient::class, 'email', $email);
    if ($emailExists) {
        echo "Email '" . $email . "' esiste.\n";
    } else {
        echo "Email '" . $email . "' NON esiste.\n";
    }
    flush();

    // 5. Aggiornamento del cliente
    echo "\nAggiornamento del cliente...\n";
    flush();
    if ($retrievedClient) {
        $retrievedClient->setPhonenumber('3399876543');
        $retrievedClient->setEmail('mario.updated.' . $uniqueId . '@example.com'); // Aggiorna anche l'email con ID univoco
        $isUpdated = $manager->saveObject($retrievedClient);

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
    echo "Errore durante il test del cliente: " . $e->getMessage() . "\n";
    flush();
}

// 6. Test recensioni cliente
echo "\nTest recensioni cliente...\n";
flush();
if (isset($client) && $client->getId()) {
    try {
        $review = new EUserReview($client, 'Ottimo servizio fornito dal cliente!', 5, new DateTime(), new DateTime());
        $isReviewSaved = $manager->saveObject($review);

        if ($isReviewSaved) {
            echo "Recensione salvata con successo! ID: " . $review->getId() . "\n";
        } else {
            echo "Errore nel salvataggio della recensione.\n";
        }
        flush();

        $reviews = $manager->retriveObjectList(EUserReview::class, 'user', $client->getId());
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
echo "Fine test recensioni.\n";
flush();

// 7. Eliminazione del cliente (SEZIONE RIMOSSA PER MANTENERE I DATI)
// Se si vuole eliminare i dati, ripristinare il blocco seguente o usare le query TRUNCATE/DELETE in phpMyAdmin.

echo "\nTest di persistenza completato. I dati sono stati mantenuti nel database. Controlla phpMyAdmin!\n";
flush();
