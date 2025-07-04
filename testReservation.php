<?php

require_once "bootstrap.php"; // Includi Doctrine, autoload, config

use AppORM\Entity\EReservation;
use AppORM\Entity\EClient;
use AppORM\Entity\ERestaurantHall;
use AppORM\Entity\ETurn;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Foundation\FEntityManager;

try {
    // 1. Recupera entità necessarie
    $client = FEntityManager::getInstance()->retriveObjectOnAttribute(EClient::class, 'id', 1);
    $hall = FEntityManager::getInstance()->retriveObjectOnAttribute(ERestaurantHall::class, 'idHall', 1);

    $date = new DateTime('2025-07-01');
    $hours = new DateTime('12:30:00');
    $duration = 120; // 
    $peopleNum = 4;
    $note = "Cliente preferisce angolo tranquillo";
    $nameReservation = "Prenotazione Rossi";


    // 2. Crea nuova prenotazione
    $reservation = new EReservation(
        $date,
        $hours,
        $duration,
        $peopleNum,
        $note,
        $nameReservation
    );
    $reservation->setClient($client);
    $reservation->setRestaurantHall($hall);
   
    // Lasciamo duration null per usare quella automatica nella funzione

    // 3. Chiama la funzione di prenotazione
    $result = FPersistentManager::getInstance()->createReservation($reservation);
    

    // 4. Controlla risultato
    if ($result['status']) {
        echo "✅ Prenotazione effettuata con successo!\n";
        FPersistentManager::getInstance()->createOrderFromReservation($reservation);
        echo "Ordine creato con successo per la prenotazione.\n";
    } else {
        echo "❌ Errore durante la prenotazione: " . $result['message'] . "\n";
    }

} catch (Exception $e) {
    echo "❌ Eccezione non gestita: " . $e->getMessage() . "\n";
}
