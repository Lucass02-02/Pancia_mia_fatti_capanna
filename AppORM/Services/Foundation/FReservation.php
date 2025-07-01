<?php
namespace AppORM\Services\Foundation; // MODIFICA: Namespace corretto

// MODIFICA: Aggiunto 'use' per l'entità e FEntityManager
use AppORM\Entity\EReservation;
use AppORM\Services\Foundation\FEntityManager;

class FReservation {

    // MODIFICA: Chiamate a FEntityManager corrette e usato EReservation::class

    public static function getReservationById($idReservation) {
        return FEntityManager::retriveObject(EReservation::class, $idReservation);
    }

    public static function getRexsservationByDate($date, $hours) {
        // MODIFICA: Corretto errore di battitura 'retriveObjectOnTwoAttribute' -> 'retriveObjOnTwoAttributes'
        return FEntityManager::retriveObjOnTwoAttributes(EReservation::class, 'date', $date, 'hours', $hours);
    }

    public static function getReservationByClient($clientId) {
        return FEntityManager::retriveObjectOnAttribute(EReservation::class, 'client', $clientId);
    }

    public static function getReservationListByDate($date) {
        // Nota: retriveObjectList non è tra i metodi che mi hai mostrato per FEntityManager.
        // Se esiste, la sintassi corretta è questa. Altrimenti dovrai implementarlo.
        return FEntityManager::retriveObjectList(EReservation::class, 'date', $date);
    }
}