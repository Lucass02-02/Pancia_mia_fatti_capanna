<?php

namespace AppORM\Services\Utility;

class UServer {

    private static $instance = null;

    public static function getInstance() {

        if (self::$instance == null) {
            self::$instance = new UServer();
        }

        return self::$instance;
    }

    public static function getRequestedMethod() {

        return $_SERVER['REQUEST_METHOD'];
    }
}