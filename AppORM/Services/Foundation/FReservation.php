<?php

namespace AppORM\Services\Foundation;

require_once __DIR__ . '/../../Entity/EReservation.php';
require_once __DIR__ . '/../../Entity/ETable.php';
require_once __DIR__ . '/FEntityManager.php';
use AppORM\Entity\EReservation;
use AppORM\Entity\ETable;
use AppORM\Entity\EOrder;
use AppORM\Services\Foundation\FEntityManager;

class FReservation {

    // MODIFICA: Chiamate a FEntityManager corrette e usato EReservation::class

    public static function getReservationById($idReservation) {
        return FEntityManager::getInstance()->retriveObject(EReservation::class, $idReservation);
    }

    public static function getReservationByDate($date, $hours) {
        $results = FEntityManager::getInstance()->retriveObjectOnTwoAttributes(EReservation::getEntity(), 'date', $date, 'hours', $hours);
        return $results;
    }

    public static function getReservationByClient($clientId) {
        return FEntityManager::getInstance()->retriveObjectOnAttribute(EReservation::class, 'client', $clientId);
    }

    public static function getReservationListByDate($date) {
        // Nota: retriveObjectList non è tra i metodi che mi hai mostrato per FEntityManager.
        // Se esiste, la sintassi corretta è questa. Altrimenti dovrai implementarlo.
        return FEntityManager::getInstance()->retriveObjectList(EReservation::class, 'date', $date);
    }

    public static function getReservationsForTableOnDate(ETable $table, \DateTime $date) {
        $reservationTables = $table->getReservationTables();

        if (!$reservationTables || $reservationTables->isEmpty()) {
            return [];
        }

        $filtered = $reservationTables->filter(function($reservationTable) use ($date) {
            $reservation = $reservationTable->getReservation(); // prendo la prenotazione
            return $reservation->getDate()->format('Y-m-d') === $date->format('Y-m-d');
        });

        // ritorno solo le prenotazioni estratte dalle entità di join
        return $filtered->map(fn($reservationTable) => $reservationTable->getReservation())->toArray();
    }

    public static function getOrderByReservation(EReservation $reservation) {
        $order = FEntityManager::getInstance()->retriveObjectOnAttribute(EOrder::getEntity(), 'reservation', $reservation->getIdReservation());
        return $order;
    }

}