<?php
namespace AppORM\Services\Foundation; // MODIFICA: Namespace corretto

use AppORM\Entity\ETable; // MODIFICA: Aggiunto 'use'

class FTable {

    // MODIFICA: Chiamate a FEntityManager corrette e usato ETable::class
    
    public static function getTableById($idTable) {
        return FEntityManager::retriveObject(ETable::class, $idTable);
    }

    public static function getTableBySeatNumber($seatNumber) {
        return FEntityManager::retriveObjectOnAttribute(ETable::class, 'seatNumber', $seatNumber);
    }

    public static function getTableListByState($state) {
        return FEntityManager::retriveObjectList(ETable::class, 'state', $state);
    }
}