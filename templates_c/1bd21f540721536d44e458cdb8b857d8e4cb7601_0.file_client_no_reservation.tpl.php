<?php
/* Smarty version 5.5.1, created on 2025-07-11 00:03:02
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/client_no_reservation.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68703896176393_68343019',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1bd21f540721536d44e458cdb8b857d8e4cb7601' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/client_no_reservation.tpl',
      1 => 1752183675,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68703896176393_68343019 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errore Ordine</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 450px;">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1 class="text-center text-primary mb-4">Non puoi ordinare senza aver effettuato una prenotazione</h1>
            <img src="https://media.tenor.com/hgzWU3teDqYAAAAM/aww-hell.gif" alt="Successo" class="img-fluid mx-auto d-block mb-4" style="max-width: 300px;">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
        </div>
    </div>
</body>
</html><?php }
}
