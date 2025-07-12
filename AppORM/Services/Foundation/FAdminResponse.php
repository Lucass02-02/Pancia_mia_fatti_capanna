<?php
namespace AppORM\Services\Foundation; 


use AppORM\Entity\EAdminResponse;
use AppORM\Entity\EAdmin;
use AppORM\Services\Foundation\FEntityManager;


class FAdminResponse {

    
    public static function getAdminResponseById($idResponse) {
        return FEntityManager::retriveObject(EAdminResponse::class, $idResponse);
    }

    public static function getAdminResponseByAdmin(EAdmin $admin) {
        return FEntityManager::retriveObjectOnAttribute(EAdminResponse::class, 'admin', $admin);
    }

    public static function getAdminResponseByDateTime(\DateTime $dateTime) {
        return FEntityManager::retriveObjectOnAttribute(EAdminResponse::class, 'dateTime', $dateTime);
    }
}