<?php

require_once __DIR__ . '/../Entity/ECreditCard.php';
use AppORM\Entity\ECreditCard;
require_once __DIR__ . '/FEntityManager.php';
use AppORM\Services\Foundation\FEntityManager;


class FCreditCard {
    public static function getCreditCardById($idCreditCard) {
        $results = FEntityManager::getInstance()->retriveObject(ECreditCard::getEntity(), $idCreditCard);
        return $results;
    }

    public static function getCreditCardByClient($clientId) {
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(ECreditCard::getEntity(), 'client', $clientId);
        return $results;
    }

    public static function getCreditCardListByClient($clientId) {
        $results = FEntityManager::getInstance()->retriveObjectList(ECreditCard::getEntity(), 'client', $clientId);
        return $results;
    }

}