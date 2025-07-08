<?php
require_once 'libs/Smarty.class.php';
require_once 'AppORM/Services/Utility/USession.php';
require_once 'config.php';

use AppORM\Services\Utility\USession;

USession::start();

// Controllo se utente è loggato
if (!USession::isSet('username')) {
    USession::setValue('redirect_after_login', $_SERVER['REQUEST_URI']);
    header('Location: login.php');
    exit;
}

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');

// Carico i prodotti dal DB
$stmt = $pdo->query("SELECT id, name, description, price, image FROM products ORDER BY name");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$smarty->assign('products', $products);

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente = USession::getValue('username');
    $piatti_ids = $_POST['piatti'] ?? [];

    if (empty($piatti_ids)) {
        $error = "Seleziona almeno un piatto.";
    } else {
        $in  = str_repeat('?,', count($piatti_ids) - 1) . '?';
        $stmt = $pdo->prepare("SELECT name, price FROM products WHERE id IN ($in)");
        $stmt->execute($piatti_ids);
        $piatti_scelti = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totale = 0;
        $piatti_nomi = [];
        foreach ($piatti_scelti as $p) {
            $totale += $p['price'];
            $piatti_nomi[] = $p['name'];
        }

        $piatti_testo = implode(', ', $piatti_nomi);

        $stmt = $pdo->prepare("INSERT INTO ordini (cliente, piatti, totale, data_ordine) VALUES (?, ?, ?, NOW())");
        $res = $stmt->execute([$cliente, $piatti_testo, $totale]);

        if ($res) {
            $success = "Ordine aggiunto con successo. Totale: €" . number_format($totale, 2);
        } else {
            $error = "Errore nell'aggiunta dell'ordine.";
        }
    }
}

$smarty->assign('page_title', 'Aggiungi Ordine');
$smarty->assign('products', $products);
$smarty->assign('error', $error);
$smarty->assign('success', $success);
$smarty->display('aggiungi_ordine.tpl');
