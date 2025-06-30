<?php

namespace AppORM\Services\Foundation;

require_once __DIR__ . '/../../Entity/EReservation.php';
require_once __DIR__ . '/../../Entity/ETable.php';
require_once __DIR__ . '/FEntityManager.php';
use AppORM\Entity\EReservation;
use AppORM\Entity\ETable;
use AppORM\Services\Foundation\FEntityManager;

class FReservation {

    public static function getReservationById($idReservation) {
        $results = FEntityManager::getInstance()->retriveObject(EReservation::getEntity(), $idReservation);
        return $results;
    }

    public static function getReservationByDate($date, $hours) {
        $results = FEntityManager::getInstance()->retriveObjectOnTwoAttributes(EReservation::getEntity(), 'date', $date, 'hours', $hours);
        return $results;
    }

    public static function getReservationByClient($clientId) {
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(EReservation::getEntity(), 'client', $clientId);
        return $results;
    }

    public static function getReservationListByDate($date) {
        $results = FEntityManager::getInstance()->retriveObjectList(EReservation::getEntity(), 'date', $date);
        return $results;
    }

    // Trova le prenotazioni per un tavolo specifico in una data specifica
    /*public static function getReservationsForTableOnDate(ETable $table, \DateTime $date) {
        return $table->getReservations()->filter(function($reservation) use ($date) {
            return $reservation->getDate()->format('Y-m-d') === $date->format('Y-m-d');
        })->toArray();
    }*/

    public static function getReservationsForTableOnDate(ETable $table, \DateTime $date) {
    $reservations = $table->getReservations();

    if (!$reservations || $reservations->isEmpty()) {
        return [];
    }

    return $reservations->filter(function($reservation) use ($date) {
        return $reservation->getDate()->format('Y-m-d') === $date->format('Y-m-d');
    })->toArray();
}


}