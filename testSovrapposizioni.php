<?php

require_once "bootstrap.php";

use AppORM\Entity\EReservation;
use AppORM\Entity\EClient;
use AppORM\Entity\ETable;
use AppORM\Entity\ERestaurantHall;
use AppORM\Entity\ETurn;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Services\Foundation\FReservation;
use AppORM\Services\Foundation\FTurn;

function createReservationForTest($date, $startTime, $durationMinutes, $peopleNum, $client, $hall, $turnName = null) {
    // Trova o imposta turno in base all'orario
    $turn = FTurn::determineTurnByTime($startTime);
    if (!$turn && $turnName !== null) {
        // Carica un turno di fallback se serve
        $turn = FEntityManager::getInstance()->retriveObjectOnAttribute(ETurn::class, 'name', $turnName);
    }
    if (!$turn) {
        echo "Turno non trovato per orario " . $startTime->format('H:i:s') . "\n";
        return null;
    }

    

    $reservation = new EReservation($date, $startTime, $durationMinutes, $peopleNum, "Test note", "Test Reservation");

    // Recupera il client dal DB
$client = FEntityManager::getInstance()->retriveObjectOnAttribute(EClient::class, 'id', 5);
if (!$client) {
    throw new Exception("Client non trovato");
}

// Recupera la sala ristorante
$hall = FEntityManager::getInstance()->retriveObjectOnAttribute(ERestaurantHall::class, 'idHall', 1);
if (!$hall) {
    throw new Exception("Restaurant Hall non trovato");
}






    $reservation->setClient($client);
    $reservation->setRestaurantHall($hall);
    $reservation->setTurn($turn);
    

    return $reservation;
}

try {
    // Recupero dati esistenti
    $client = FEntityManager::getInstance()->retriveObjectOnAttribute(EClient::class, 'id', 1);
    $hall = FEntityManager::getInstance()->retriveObjectOnAttribute(ERestaurantHall::class, 'idHall', 1);
    $table = FEntityManager::getInstance()->retriveObjectOnAttribute(ETable::class, 'idTable', 1);

    $date = new DateTime('2025-07-01');

    // 1) Prenotazione base 12:00 - 13:30 (90 minuti)
    $res1 = createReservationForTest($date, new DateTime('12:00:00'), 90, 4,  $client, $hall);
    FPersistentManager::getInstance()->createReservation($res1);
    echo "Prenotazione 1 creata\n";

    // 2) Prenotazione sovrapposta 13:00 - 14:00 (60 minuti) => dovrebbe dare conflitto
    $res2 = createReservationForTest($date, new DateTime('13:00:00'), 60, 2,  $client, $hall);
    $existing = FReservation::getReservationsForTableOnDate($table, $date);

    $conflictFound = false;
    foreach ($existing as $existingRes) {
        $start1 = $res2->getHours();
        $end1 = (clone $start1)->modify("+{$res2->getDuration()} minutes");
        $start2 = $existingRes->getHours();
        $end2 = (clone $start2)->modify("+{$existingRes->getDuration()} minutes");

        // Controllo sovrapposizione
        if ($start1 < $end2 && $end1 > $start2) {
            $conflictFound = true;
            break;
        }
    }

    if ($conflictFound) {
        echo "❌ Conflitto orario rilevato per prenotazione 2\n";
    } else {
        FPersistentManager::getInstance()->createReservation($res2);
        echo "✅ Prenotazione 2 creata\n";
    }

    // 3) Prenotazione non sovrapposta 14:00 - 15:00 (60 minuti) => ok
    $res3 = createReservationForTest($date, new DateTime('14:00:00'), 60, 2, $client, $hall);
    $existing = FReservation::getReservationsForTableOnDate($table, $date);

    $conflictFound = false;
    foreach ($existing as $existingRes) {
        $start1 = $res3->getHours();
        $end1 = (clone $start1)->modify("+{$res3->getDuration()} minutes");
        $start2 = $existingRes->getHours();
        $end2 = (clone $start2)->modify("+{$existingRes->getDuration()} minutes");

        if ($start1 < $end2 && $end1 > $start2) {
            $conflictFound = true;
            break;
        }
    }

    if ($conflictFound) {
        echo "❌ Conflitto orario rilevato per prenotazione 3\n";
    } else {
        FPersistentManager::getInstance()->createReservation($res3);
        echo "✅ Prenotazione 3 creata\n";
    }

} catch (Exception $e) {
    echo "Eccezione: " . $e->getMessage() . "\n";
}
