<?php

require __DIR__ . '/vendor/autoload.php';
// Se hai un file bootstrap.php che inizializza Doctrine, includilo qui.
// require __DIR__ . '/bootstrap.php'; 

ob_implicit_flush(true);

// 2. IMPORTAZIONI
use AppORM\Entity\EClient;
use AppORM\Entity\EUserReview;
use AppORM\Entity\ECreditCard;
use AppORM\Entity\EProduct;
use AppORM\Entity\EAllergens;
use AppORM\Entity\ProductCategory;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Services\Foundation\FCreditCard;
use AppORM\Services\Foundation\FProduct;
use AppORM\Services\Foundation\FAllergens; // Già presente
use AppORM\Services\Foundation\FClient;

echo "AVVIO TEST DI PERSISTENZA COMPLETO (v4 - Correzione Allergeni Duplicati)\n";
echo "========================================================================\n";
flush();

$testData = [
    'client_id' => null,
    'product_id' => null,
    'allergen_id' => null,
];

try {
    // --- TEST 1: GESTIONE CLIENTE (Invariato) ---
    echo "\n--- 1. Test Gestione Cliente ---\n";
    $uniqueId = uniqid();
    $email = "test.cliente.$uniqueId@example.com";
    $nickname = "Tester_$uniqueId";
    $client = FPersistentManager::registerClient("Mario", "Rossi", new DateTime("1990-01-15"), $email, "password123", $nickname, "3331234567");
    if (!$client || !$client->getId()) { throw new Exception("FALLITO: Registrazione cliente non riuscita."); }
    $testData['client_id'] = $client->getId();
    echo "OK: Registrazione cliente riuscita (ID: {$testData['client_id']}).\n";
    $duplicateClient = FPersistentManager::registerClient("Maria", "Rossa", new DateTime("1991-02-16"), $email, "password456");
    if ($duplicateClient !== null) { throw new Exception("FALLITO: Il sistema ha permesso la registrazione di un'email duplicata."); }
    echo "OK: Tentativo di registrazione duplicata fallito come previsto.\n";
    $authenticatedClient = FPersistentManager::authenticateClient($email, "password123");
    if (!$authenticatedClient || $authenticatedClient->getId() !== $testData['client_id']) { throw new Exception("FALLITO: Autenticazione cliente non riuscita."); }
    echo "OK: Autenticazione cliente riuscita.\n";
    FPersistentManager::updateClientNickname($authenticatedClient, "SuperTester_$uniqueId");
    FEntityManager::clearEntityManager();
    $reloadedClient = FPersistentManager::getClientById($testData['client_id']);
    if ($reloadedClient->getNickname() !== "SuperTester_$uniqueId") { throw new Exception("FALLITO: Aggiornamento nickname non riuscita."); }
    echo "OK: Aggiornamento dati cliente riuscito.\n";
    flush();

    // --- TEST 2: GESTIONE PRODOTTI E ALLERGENI ---
    echo "\n--- 2. Test Gestione Prodotti e Allergeni ---\n";

    // 2.1 Gestione Allergene (CORREZIONE QUI)
    $allergenName = "Glutine";
    $allergen = FAllergens::getAllergenByType($allergenName); // Cerca l'allergene per tipo
    
    if (!$allergen) {
        // Se l'allergene non esiste, crealo e salvalo
        $allergen = new EAllergens($allergenName);
        if (!FAllergens::saveObj($allergen) || !$allergen->getId()) { // Usa saveObj come definito in FAllergens
            throw new Exception("FALLITO: Creazione allergene non riuscita.");
        }
        echo "OK: Creazione allergene '{$allergenName}' riuscita (ID: {$allergen->getId()}).\n";
    } else {
        echo "OK: Allergene '{$allergenName}' già esistente (ID: {$allergen->getId()}), riutilizzato.\n";
    }
    $testData['allergen_id'] = $allergen->getId(); // Salva l'ID dell'allergene (esistente o nuovo)
    flush();
    
    // 2.2 Creazione Prodotto (Invariato - già corretto)
    $product = new EProduct("Pasta alla Carbonara", "Un classico della cucina romana", 12.50, ProductCategory::PRIMO);
    if (!FPersistentManager::saveProduct($product) || !$product->getId()) {
        throw new Exception("FALLITO: Creazione prodotto non riuscita.");
    }
    $testData['product_id'] = $product->getId();
    echo "OK: Creazione prodotto 'Pasta alla Carbonara' riuscita (ID: {$testData['product_id']}).\n";

    // 2.3 Associazione Allergene a Prodotto (SEZIONE MODIFICATA PER LA VERIFICA FINALE)
    FEntityManager::clearEntityManager();
    $productToUpdate = FPersistentManager::getProductById($testData['product_id']);
    $allergenToAdd = FPersistentManager::getAllergenById($testData['allergen_id']);
    
    // Aggiunte verifiche per assicurarsi che gli oggetti siano stati caricati correttamente
    if (!$productToUpdate) {
        throw new Exception("FALLITO: Prodotto da aggiornare non trovato per associazione allergene.");
    }
    if (!$allergenToAdd) {
        throw new Exception("FALLITO: Allergene da aggiungere non trovato per associazione a prodotto.");
    }

    if (!FPersistentManager::addAllergenToProduct($productToUpdate, $allergenToAdd)) {
        throw new Exception("FALLITO: Associazione allergene a prodotto non riuscita.");
    }

    // --- SEZIONE MODIFICATA PER LA VERIFICA ---
    FEntityManager::clearEntityManager(); // Pulisce di nuovo l'EntityManager per ricaricare oggetti freschi
    $reloadedProduct = FPersistentManager::getProductById($testData['product_id']);
    // Ricarica anche l'istanza dell'allergene che ti aspetti sia nella collezione del prodotto ricaricato
    $reloadedAllergen = FPersistentManager::getAllergenById($testData['allergen_id']); 

    // Aggiunte verifiche per assicurarsi che i ricaricamenti abbiano avuto successo
    if (!$reloadedProduct) {
        throw new Exception("FALLITO: Prodotto ricaricato non trovato per la verifica dell'associazione.");
    }
    if (!$reloadedAllergen) {
        throw new Exception("FALLITO: Allergene ricaricato non trovato per la verifica dell'associazione.");
    }

    // Esegui la verifica con le istanze ricaricate
    if ($reloadedProduct->getAllergens()->isEmpty() || !$reloadedProduct->getAllergens()->contains($reloadedAllergen)) { 
        throw new Exception("FALLITO: Verifica associazione allergene fallita."); 
    }
    echo "OK: Associazione allergene a prodotto riuscita.\n"; 
    flush();

    // --- TEST 3: GESTIONE CARTE DI CREDITO (Invariato) ---
    echo "\n--- 3. Test Gestione Carte di Credito ---\n";
    FEntityManager::clearEntityManager();
    $clientForCard = FPersistentManager::getClientById($testData['client_id']);
    $paymentToken = 'pm_' . uniqid();
    $creditCard = FPersistentManager::addClientPaymentMethod($clientForCard, $paymentToken, "MasterCard", "5555", 10, 2028, "Carta Lavoro");
    if (!$creditCard || !$creditCard->getId()) {
        throw new Exception("FALLITO: Aggiunta metodo di pagamento non riuscita.");
    }
    echo "OK: Aggiunta metodo di pagamento sicura riuscita (ID: {$creditCard->getId()}).\n";
    FEntityManager::clearEntityManager();
    $clientWithCard = FPersistentManager::getClientById($testData['client_id']);
    $cardToRemove = $clientWithCard->getCreditCards()->first();
    if (!FPersistentManager::removeClientCreditCard($clientWithCard, $cardToRemove)) {
        throw new Exception("FALLITO: Rimozione metodo di pagamento non riuscita.");
    }
    FEntityManager::clearEntityManager();
    $reloadedClientAfterCardRemoval = FPersistentManager::getClientById($testData['client_id']);
    if (!$reloadedClientAfterCardRemoval->getCreditCards()->isEmpty()) {
        throw new Exception("FALLITO: Verifica rimozione carta fallita, la carta è ancora presente.");
    }
    echo "OK: Rimozione metodo di pagamento riuscita.\n";
    flush();

} catch (Exception $e) {
    echo "\n\n--- !!! ERRORE CRITICO DURANTE I TEST !!! ---\n";
    echo "    MESSAGGIO: " . $e->getMessage() . "\n";
    echo "    FILE: " . $e->getFile() . " (Linea: " . $e->getLine() . ")\n";
    flush();
} finally {
    // --- BLOCCO DI PULIZIA FINALE (Invariato) ---
    echo "\n--- 4. Esecuzione Blocco di Pulizia Finale ---\n";
    flush();
    FEntityManager::clearEntityManager();
    if ($testData['product_id']) {
        $productToDelete = FPersistentManager::getProductById($testData['product_id']);
        if ($productToDelete && FPersistentManager::deleteProduct($productToDelete)) { echo "OK: Pulizia Prodotto riuscita.\n"; }
        else { echo "ATTENZIONE: Pulizia Prodotto fallita.\n"; }
    }
    if ($testData['allergen_id']) {
        $allergenToDelete = FPersistentManager::getAllergenById($testData['allergen_id']);
        if ($allergenToDelete && FPersistentManager::deleteAllergen($allergenToDelete)) { echo "OK: Pulizia Allergene riuscita.\n"; }
        else { echo "ATTENZIONE: Pulizia Allergene fallita.\n"; }
    }
    if ($testData['client_id']) {
        $clientToDelete = FPersistentManager::getClientById($testData['client_id']);
        if ($clientToDelete && FPersistentManager::deleteClient($clientToDelete)) { echo "OK: Pulizia Cliente riuscita.\n"; }
        else { echo "ATTENZIONE: Pulizia Cliente fallita.\n"; }
    }
}

echo "\n=========================================\n";
echo "TEST DI PERSISTENZA COMPLETATO.\n";
flush();


/*// PHP Version: 8.1+

// Assicurati che l'autoloader sia configurato correttamente (es. Composer autoload)
require __DIR__ . '/vendor/autoload.php';

// --- MODIFICA CRUCIALE QUI ---
// Ora controlliamo e usiamo il namespace corretto che abbiamo definito per tutte le classi Foundation.

if (!class_exists('AppORM\Services\Foundation\FEntityManager')) { 
    exit("Errore fatale: La classe FEntityManager NON è stata trovata nel namespace corretto. Assicurati di aver eseguito 'composer dump-autoload -o' dopo aver corretto tutti i file.\n"); 
}

ob_implicit_flush(true);

// --- MODIFICA CRUCIALE QUI: Aggiornamento di TUTTE le dichiarazioni 'use' ---
use AppORM\Entity\EClient;
use AppORM\Entity\EUserReview;
use AppORM\Entity\ECreditCard;
use AppORM\Entity\EProduct;
use AppORM\Entity\EAllergens;
use AppORM\Entity\ProductCategory;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Services\Foundation\FCreditCard;
use AppORM\Services\Foundation\FProduct;
use AppORM\Services\Foundation\FAllergens;

// Include esplicito per l'enum
require_once __DIR__ . '/AppORM/Entity/EProduct.php';

echo "Avvio test di persistenza...\n";
flush();

$clientWithPhone = null;
$clientNoPhone = null;
$clientIdToDelete = null;
$productToDelete = null;
$allergenToDelete = null;

try {
    FEntityManager::clearEntityManager();
    echo "EntityManager pulito all'avvio.\n";
    flush();

    // --- 1. Test: Registrazione Clienti ---
    echo "\n--- 1. Test: Registrazione Clienti ---\n";
    flush();
    $uniqueId1 = uniqid();
    $emailWithPhone = "test.client.with_phone." . $uniqueId1 . "@example.com";
    $nicknameWithPhone = "MarioTheClient_" . $uniqueId1;

    $clientWithPhone = FPersistentManager::registerClient("Mario", "Rossi", new DateTime("1990-01-01"), $emailWithPhone, "securePassword123", $nicknameWithPhone, "+393451234567");
    if ($clientWithPhone) {
        echo "Cliente CON telefono registrato con successo! ID: " . $clientWithPhone->getId() . "\n";
        $clientIdToDelete = $clientWithPhone->getId();
    } else {
        throw new Exception("Registrazione cliente CON telefono fallita.");
    }

    $uniqueId2 = uniqid();
    $emailNoPhone = "test.client.no_phone." . $uniqueId2 . "@example.com";
    $nicknameNoPhone = "LuigiTheClient_" . $uniqueId2;
    $clientNoPhone = FPersistentManager::registerClient("Luigi", "Verdi", new DateTime("1985-05-15"), $emailNoPhone, "anotherSecurePassword", $nicknameNoPhone);
    if ($clientNoPhone) {
        echo "Cliente SENZA telefono registrato con successo! ID: " . $clientNoPhone->getId() . "\n";
    } else {
        throw new Exception("Registrazione cliente SENZA telefono fallita.");
    }
    flush();

    // Per brevità, si assume che i test 2-6 funzionino correttamente
    echo "\n--- Test 2-6 (Autenticazione, Recupero, Update, Punti, Recensione) eseguiti... ---\n";

    // --- 7. Test: Gestione Carte di Credito (Logica di sicurezza) ---
    echo "\n--- 7. Test: Gestione Carte di Credito ---\n";
    flush();

    FEntityManager::clearEntityManager();
    $clientForCreditCard = FPersistentManager::getClientById($clientIdToDelete);
    if (!$clientForCreditCard) {
        throw new Exception("Cliente per gestione carte di credito non disponibile.");
    }

    // Dati sicuri simulati da un gateway di pagamento
    $paymentToken = 'pm_' . uniqid() . bin2hex(random_bytes(10));
    $cardBrand = 'Visa';
    $last4 = '4242';
    $expYear = (int)date('Y') + 3;
    $expMonth = 12;
    $cardName = "My Secure Visa " . uniqid();

    // Chiamata alla nuova funzione sicura
    $creditCard = FPersistentManager::addClientPaymentMethod(
        $clientForCreditCard,
        $paymentToken,
        $cardBrand,
        $last4,
        $expMonth,
        $expYear,
        $cardName
    );

    if ($creditCard) {
        echo "Metodo di pagamento aggiunto con successo! ID: " . $creditCard->getId() . "\n";
        $creditCardIdToRemove = $creditCard->getId();
    } else {
        throw new Exception("Aggiunta del metodo di pagamento fallita.");
    }

    FEntityManager::clearEntityManager();
    $reloadedClientForCards = FPersistentManager::getClientById($clientIdToDelete);
    $retrievedCards = FPersistentManager::getClientCreditCards($reloadedClientForCards);
    if (!empty($retrievedCards)) {
        echo "Verifica: Carte di credito recuperate con successo (" . count($retrievedCards) . ").\n";
    } else {
        throw new Exception("Verifica: Nessuna carta di credito recuperata.");
    }

    // Test rimozione carta di credito
    FEntityManager::clearEntityManager();
    // FCreditCard ora viene importato dal namespace corretto
    $cardToDelete = FCreditCard::getObj($creditCardIdToRemove);
    $clientForRemoval = FPersistentManager::getClientById($clientIdToDelete);

    if (!$cardToDelete || !$clientForRemoval) {
        throw new Exception("Carta o cliente non trovati per la rimozione.");
    }

    if (FPersistentManager::removeClientCreditCard($clientForRemoval, $cardToDelete)) {
        echo "Carta di credito rimossa con successo.\n";
    } else {
        throw new Exception("Rimozione carta di credito fallita.");
    }

    FEntityManager::clearEntityManager();
    $reloadedClientAfterRemoval = FPersistentManager::getClientById($clientIdToDelete);
    $remainingCards = FPersistentManager::getClientCreditCards($reloadedClientAfterRemoval);
    if (empty($remainingCards)) {
        echo "Verifica: Rimozione carta di credito riuscita. Nessuna carta rimanente.\n";
    } else {
        throw new Exception("Verifica: Rimozione carta di credito fallita. La carta è ancora presente.");
    }
    flush();
    
    // Si assume che i test 8-9 funzionino
    echo "\n--- Test 8-9 (Prodotti, Allergeni, Eliminazione) eseguiti... ---\n";

} catch (Exception $e) {
    echo "\n--- ERRORE CRITICO DURANTE I TEST ---\n";
    echo "Messaggio: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Linea: " . $e->getLine() . "\n";
    flush();
} finally {
    echo "\n--- Esecuzione blocco finally per pulizia ---\n";
    // Logica di pulizia finale...
    if ($clientNoPhone && $clientNoPhone->getId()) {
        try {
            FEntityManager::clearEntityManager();
            $clientToErase = FPersistentManager::getClientById($clientNoPhone->getId());
            if ($clientToErase) FPersistentManager::deleteClient($clientToErase);
            echo "Pulizia cliente senza telefono completata.\n";
        } catch (Exception $e) {
            echo "Errore pulizia cliente senza telefono: " . $e->getMessage() . "\n";
        }
    }
}

echo "\n--- Test di persistenza completato. ---\n";
flush();
*/

