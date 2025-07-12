<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'bootstrap.php';
use AppORM\Control\CFrontController;
use AppORM\Services\Utility\USession;
use AppORM\Control\CClient;


USession::start();
CClient::checkRememberMeLogin();
$fc = new CFrontController();
$fc->run($_SERVER['REQUEST_URI']);