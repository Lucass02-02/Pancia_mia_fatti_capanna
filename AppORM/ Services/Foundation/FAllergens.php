<?php

class FAllergens {

    public static function getAllergenById($id) {
        $results = FEntityManager::getInstance()->retriveObject(EAllergen::getEntity(), $id);
        return $results;
    }

    public static function getAllergenByName($name) {
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(EAllergen::getEntity(), 'name', $name);
        return $results;
    }
}