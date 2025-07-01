<?php
namespace AppORM\Services\Foundation; // MODIFICA: Namespace corretto

use AppORM\Entity\ERestaurantHall; // MODIFICA: Aggiunto 'use'

class FRestaurantHall {

    // MODIFICA: Chiamata a FEntityManager corretta e usato ERestaurantHall::class
    public static function getRestaurantHallById($idRestaurantHall) {
        return FEntityManager::retriveObject(ERestaurantHall::class, $idRestaurantHall);
    }
}