<?php
namespace App\Foundation;


class FRestaurantHall {

    public static function getRestaurantHallById($idRestaurantHall) {
        $results = FEntityManager::getInstance()->retriveObject(ERestaurantHall::getEntity(), $idRestaurantHall);
        return $results;
    }

       
}