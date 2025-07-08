<?php
require_once 'libs/Smarty.class.php';
require_once 'AppORM/Services/Utility/USession.php';
require_once 'config.php';

use AppORM\Services\Utility\USession;

USession::start();
// dopo aver settato la sessione:
$redirect = USession::getValue('redirect_after_login');
if ($redirect) {
    USession::unsetValue('redirect_after_login');
    header("Location: $redirect");
    exit;
} else {
    header('Location: index.php');
    exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        USession::setValue('user_role', $user['role']);
        USession::setValue('username', $user['email']);
        USession::setValue('name', $user['name']);
        USession::setValue('surname', $user['surname']);
        header('Location: index.php');
        exit;
    } else {
        $error = "Email o password errati";
    }
}

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');
$smarty->assign('page_title', 'Login');
$smarty->assign('error', $error);
$smarty->display('login.tpl');
