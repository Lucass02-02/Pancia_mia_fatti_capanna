<?php
namespace App\Foundation;


class FTable {

    public static function getTableById($idTable) {
        $results = FEntityManager::getInstance()->retriveObject(ETable::getEntity(), $idTable);
        return $results;
    }

    public static function getTableBySeatNumber($seatNumber) {
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(ETable::getEntity(), 'seatNumber', $seatNumber);
        return $results;
    }

    public static function getTableListByState($state) {
        $results = FEntityManager::getInstance()->retriveObjectList(ETable::getEntity(), 'state', $state);
        return $results;
    }
}