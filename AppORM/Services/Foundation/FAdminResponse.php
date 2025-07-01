<?php
namespace AppORM\Services\Foundation; // MODIFICA: Namespace corretto

// MODIFICA: Aggiunti i 'use' necessari
use AppORM\Entity\EAdminResponse;
use AppORM\Entity\EAdmin;

class FAdminResponse {

    // MODIFICA: Chiamate a FEntityManager corrette (senza getInstance)
    // MODIFICA: Usato EAdminResponse::class invece di un metodo custom getEntity()
    
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