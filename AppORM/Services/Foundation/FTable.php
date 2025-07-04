<?php

require_once __DIR__ . '/../../Entity/ETable.php';
require_once __DIR__ . '/FEntityManager.php';
use AppORM\Entity\ETable;
use AppORM\Services\Foundation\FEntityManager;


class FTable {

    // Add the reservations property
    protected $reservations = [];

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