<?php
require_once 'libs/Smarty.class.php';
require_once 'AppORM/Services/Utility/USession.php';
require_once 'config.php';

use AppORM\Services\Utility\USession;

USession::start();

$user_role = USession::getValue('user_role') ?? 'guest';

// Se non sei loggato, vai al login
if ($user_role === 'guest') {
    header('Location: login.php');
    exit;
}

// Prendi tutti gli ordini dal DB
$stmt = $pdo->query("SELECT * FROM orders ORDER BY data_ordine DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');

$smarty->assign('page_title', 'Lista Ordini');
$smarty->assign('orders', $orders);
$smarty->assign('user_role', $user_role);

$smarty->display('orders.tpl');