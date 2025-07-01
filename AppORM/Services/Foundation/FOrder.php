<?php
namespace AppORM\Services\Foundation; // MODIFICA: Namespace corretto

// MODIFICA: Aggiunto 'use' per l'entità e FEntityManager
use AppORM\Entity\EOrder;
use AppORM\Services\Foundation\FEntityManager;

class FOrder {

    // MODIFICA: Chiamate a FEntityManager corrette e usato EOrder::class
    
    public static function getOrderById($idOrder) {
        return FEntityManager::retriveObject(EOrder::class, $idOrder);
    }

    public static function getOrderByClient($clientId) {
        return FEntityManager::retriveObjectOnAttribute(EOrder::class, 'client', $clientId);
    }

    public static function getOrderListByDate($date) {
        // Nota: retriveObjectList non è tra i metodi che mi hai mostrato per FEntityManager.
        // Se esiste, la sintassi corretta è questa. Altrimenti dovrai implementarlo.
        return FEntityManager::retriveObjectList(EOrder::class, 'date', $date);
    }
}