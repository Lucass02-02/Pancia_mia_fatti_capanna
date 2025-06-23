<?php

class FClient {

    /*
    lo store e il delete essendo metodi generali li puoi mettere nel persistent, puoi passare qualunque oggetto 
    e poi specificherai il tipo di entity che rappresenta in qualche modo arcano dio porco

    public static function storeClient($name, $surname, $birthDate, $email, $password, $nickname, $phonenumber) {
        $client = new EClient($name, $surname, $birthDate, $email, $password, $nickname, $phonenumber);
        $result = FEntityManager::getInstance()->saveObject($client);

        return $result;
    }*/

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