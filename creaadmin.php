<?php

use AppORM\Entity\EAdmin;
use AppORM\Services\Foundation\FPersistentManager;

$password = '1'; // o la password che vuoi
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$data = '1111-11-11';
$dataNascita = new DateTime($data);

require 'bootstrap.php';

$admin = new EAdmin('admin', 'admin', $dataNascita ,'admin@gmail', $hashedPassword, 12345 );

FPersistentManager::getInstance()->uploadObject($admin);
