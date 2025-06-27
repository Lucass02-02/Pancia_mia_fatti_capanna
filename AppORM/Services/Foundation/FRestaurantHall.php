<?php

class FRestaurantHall {

    public static function getRestaurantHallById($idRestaurantHall) {
        $results = FEntityManager::getInstance()->retriveObject(ERestaurantHall::getEntity(), $idRestaurantHall);
        return $results;
    }

    public static function getRestaurantHallByNumPlaces($totalPlaces) {
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(ERestaurantHall::getEntity(), 'totalPlaces', $totalPlaces);
        return $results;
    }
}