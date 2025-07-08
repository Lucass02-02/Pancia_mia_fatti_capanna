<?php
require_once 'libs/Smarty.class.php';
require_once 'AppORM/Services/Utility/USession.php';
require_once 'config.php';

use AppORM\Services\Utility\USession;

USession::start();

$user_role = USession::getValue('user_role') ?? 'guest';

if ($user_role === 'guest') {
    header('Location: login.php');
    exit;
}

// Prendo tutti i prodotti
$stmt = $pdo->query("SELECT id, name, description, price FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');

$smarty->assign('page_title', 'Menù');
$smarty->assign('products', $products);
$smarty->assign('user_role', $user_role);

$smarty->display('menu.tpl');


