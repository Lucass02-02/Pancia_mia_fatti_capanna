<?php


use AppORM\Entity\EAllergens;
use AppORM\Services\Foundation\FEntityManager;


class FAllergens {

    public static function getAllergenById($id) {
        $results = FEntityManager::getInstance()->retriveObject(EAllergens::getEntity(), $id);
        return $results;
    }

    public static function getAllergenByName($name) {
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(EAllergens::getEntity(), 'name', $name);
        return $results;
    }
}