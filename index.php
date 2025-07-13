<?php 



require 'bootstrap.php';
use AppORM\Control\CFrontController;
use AppORM\Services\Utility\USession;
use AppORM\Control\CClient;


USession::start();
CClient::checkRememberMeLogin();
$fc = new CFrontController();
$fc->run($_SERVER['REQUEST_URI']);