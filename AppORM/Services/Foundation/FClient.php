<?php

require_once __DIR__ . '/../Entity/EClient.php';
use AppORM\Entity\EClient;
require_once __DIR__ . '/FEntityManager.php';
use AppORM\Services\Foundation\FEntityManager;



class FClient {

    public static function getClientByNickname($nickname) {
        $client = FEntityManager::getInstance()->retriveObjectOnAttribute(EClient::getEntity(), 'nickname', $nickname);
        return $client;
    } 

    public static function getClientById($id) {
        $client = FEntityManager::getInstance()->retriveObject(EClient::getEntity(), $id);
        return $client;
    }   

    public static function getClientByNameSurname($name, $surname) {
        $client = FEntityManager::getInstance()->retriveObjectOnTwoAttributes(EClient::getEntity(), 'name', $name, 'surname', $surname);
        return $client;
    }


}