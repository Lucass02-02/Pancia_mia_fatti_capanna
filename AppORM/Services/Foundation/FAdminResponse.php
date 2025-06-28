<?php
namespace App\Foundation;


class FAdminResponse {

    public static function getAdminResponseById($idResponse) {
        $results = FEntityManager::getInstance()->retriveObject(EAdminResponse::getEntity(), $idResponse);
        return $results;
    }

    public static function getAdminResponseByAdmin($admin) {
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(EAdminResponse::getEntity(), 'admin', $admin);
        return $results;
    }

    public static function getAdminResponseByDateTime($dateTime) {
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(EAdminResponse::getEntity(), 'dateTime', $dateTime);
        return $results;
    }
}