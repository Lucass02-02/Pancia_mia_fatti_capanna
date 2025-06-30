<?php

require_once __DIR__ . '/../Entity/EProduct.php';
use AppORM\Entity\EProduct;
require_once __DIR__ . '/FEntityManager.php';
use AppORM\Services\Foundation\FEntityManager;

class FProduct {

    public static function getProductById($idProduct) {
        $results = FEntityManager::getInstance()->retriveObject(EProduct::getEntity(), $idProduct);
        return $results;
    }

    public static function getProductByName($name) {
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(EProduct::getEntity(), 'name', $name);
        return $results;
    }

    public static function getProductListByAvaiability($availability) {
        $results = FEntityManager::getInstance()->retriveObjectList(EProduct::getEntity(), 'availability', $availability);
        return $results;
    }

    public static function getProductListByCategory($category) {
        $results = FEntityManager::getInstance()->retriveObjectList(EProduct::getEntity(), 'category', $category);
        return $results;
    }



}