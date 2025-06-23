<?php

class FPersistentManager {

    private static $instance;

    private function __construct() {
       
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function uploadObject($object) {
        $result = FEntityManager::getInstance()->saveObject($object);
        return $result;
    }

    
}