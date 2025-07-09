<?php 
require 'bootstrap.php';
use AppORM\Control\CFrontController;
use AppORM\Services\Utility\USession;

USession::start(); 

$fc = new CFrontController();
$fc->run($_SERVER['REQUEST_URI']);