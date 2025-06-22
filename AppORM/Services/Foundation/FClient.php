<?php

class FClient {

    public static function storeClient($entity) {
        $result = FEntityManager::getInstance()->saveObject(EClient::getEntity());

        return $result;
    }


}