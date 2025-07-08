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

// Prendo tutti i clienti
$stmt = $pdo->query("SELECT id, nickname, loyaltyPoints, receivesNotifications FROM clients");
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__


