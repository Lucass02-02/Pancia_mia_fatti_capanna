<?php
require_once 'libs/Smarty.class.php';
require_once 'AppORM/Services/Utility/USession.php';
require_once 'config.php';

use AppORM\Services\Utility\USession;

USession::start();

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $surname = trim($_POST['surname'] ?? '');
    $birthDate = trim($_POST['birthDate'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $phonenumber = trim($_POST['phonenumber'] ?? '');
    $role = 'cliente';

    if (!$name || !$surname || !$birthDate || !$email || !$password) {
        $error = "Compila tutti i campi obbligatori.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Email già registrata.";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, surname, birthDate, email, password, phonenumber, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $res = $stmt->execute([$name, $surname, $birthDate, $email, $passwordHash, $phonenumber, $role]);
            if ($res) {
                $success = "Registrazione avvenuta con successo. Ora puoi fare il login.";
            } else {
                $error = "Errore durante la registrazione.";
            }
        }
    }
}

$smarty->assign('page_title', 'Registrazione');
$smarty->assign('error', $error);
$smarty->assign('success', $success);
$smarty->display('register.tpl');