<?php

require_once __DIR__ . '/../Entities/ERestaurantHall.php';
require_once __DIR__ . '/FEntityManager.php';
use AppORM\Entity\ERestaurantHall;
use AppORM\Services\Foundation\FEntityManager;

class FRestaurantHall {

    // MODIFICA: Chiamata a FEntityManager corretta e usato ERestaurantHall::class
    public static function getRestaurantHallById($idRestaurantHall) {
        return FEntityManager::getInstance()->retriveObject(ERestaurantHall::class, $idRestaurantHall);
    }

    public static function getRestaurantHallByNumPlaces($totalPlaces) {
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(ERestaurantHall::getEntity(), 'totalPlaces', $totalPlaces);
        return $results;
    }
}