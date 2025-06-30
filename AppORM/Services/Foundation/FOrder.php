<?php

require_once __DIR__ . '/../Entity/EOrder.php';
use AppORM\Entity\EOrder;
require_once __DIR__ . '/FEntityManager.php';
use AppORM\Services\Foundation\FEntityManager;


class FOrder {

    public static function getOrderById($idOrder) {
        $results = FEntityManager::getInstance()->retriveObject(EOrder::getEntity(), $idOrder);
        return $results;
    }

    public static function getOrderByClient($clientId) {
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(EOrder::getEntity(), 'client', $clientId);
        return $results;
    }

    public static function getOrderListByDate($date) {
        $results = FEntityManager::getInstance()->retriveObjectList(EOrder::getEntity(), 'date', $date);
        return $results;
    }


}