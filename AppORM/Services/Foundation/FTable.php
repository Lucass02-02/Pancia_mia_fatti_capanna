<?php

namespace AppORM\Services\Foundation;


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

        /**
     * Salva o aggiorna un oggetto ETable nel database.
     * @param ETable $table L'oggetto tavolo da salvare.
     * @return bool
     */
    public static function save(ETable $table): bool {
        return FEntityManager::getInstance()->saveObject($table);
    }

    /**
     * Cancella un oggetto ETable dal database.
     * @param ETable $table L'oggetto tavolo da cancellare.
     * @return bool
     */
    public static function delete(ETable $table): bool {
        return FEntityManager::getInstance()->deleteObject($table);
    }

    /**
     * Recupera tutti i tavoli dal database.
     * @return array
     */
    public static function getAllTables(): array {
        return FEntityManager::getInstance()->selectAll(ETable::class);
    }

   
}