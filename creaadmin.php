<?php

use AppORM\Entity\EAdmin;
use AppORM\Services\Foundation\FPersistentManager;

$password = '1'; // o la password che vuoi
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

require 'bootstrap.php';

$admin = new EAdmin('admin', 'admin', 'admin@gmail', 'admin1' );

FPersistentManager::getInstance()->uploadObject($admin);
