<?php
namespace App\Foundation;


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