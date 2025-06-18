<?php

require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$path = [__DIR__ . '/Entity'];
$isDevMode = true; //per ora usa true ma poi metti false

//configuration for connection 
$dbParams = [
    'driver' => 'pdo_mysql',
    'user' => 'paperino',
    'password' => 'cacca',
    'dbname' => 'testdb',
];

$config = ORMSetup::createAttributeMetadataConfiguration($path, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);



