<?php
require_once('libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');
$smarty->setCacheDir(__DIR__ . '/cache');
$smarty->setConfigDir(__DIR__ . '/configs');

$smarty->assign('page_title', 'Dashboard Ristorante');
$smarty->display('index.tpl');
?>
