<?php
require_once __DIR__ . '/vendor/autoload.php';
//require_once __DIR__ . '/config/config.php'; // Assicurati che il file config.php esista e contenga le costanti DB_HOST, DB_NAME, DB_USER, DB_PASS

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
function getEntityManager(): EntityManager{
        $paths = array(__DIR__ . '/AppORM/Entity');
        $isDevMode = true;
        $config = ORMSetup::createAttributeMetadataConfiguration($paths,true);  # 2. Configurazione per attributi o annotazioni 
        $dbParams = [
                    'dbname'   => 'testdb',
                    'user'     => 'root',
                    'password' => '',
                    'host'     => 'localhost',
                    'driver'   => 'pdo_mysql',
                    ]; #3. Parametri del DB
        $connection = DriverManager::getConnection($dbParams, $config); # 4. Creazione della connessione con DriverManager
        $entityManager = new EntityManager($connection, $config);# 5. Creazione EntityManager
        return $entityManager;

    }




