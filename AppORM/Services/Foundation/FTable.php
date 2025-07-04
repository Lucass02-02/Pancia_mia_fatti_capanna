<?php

require_once __DIR__ . '/../../Entity/ETable.php';
require_once __DIR__ . '/FEntityManager.php';
use AppORM\Entity\ETable;
use AppORM\Services\Foundation\FEntityManager;


class FTable {

    // Add the reservations property
    protected $reservations = [];

    public static function getTableById($idTable) {
        return FEntityManager::getInstance()->retriveObject(ETable::class, $idTable);
    }

    public static function getTableBySeatNumber($seatNumber) {
        return FEntityManager::getInstance()->retriveObjectOnAttribute(ETable::class, 'seatNumber', $seatNumber);
    }

    public static function getTableListByState($state) {
        return FEntityManager::getInstance()->retriveObjectList(ETable::class, 'state', $state);
    }

   
}