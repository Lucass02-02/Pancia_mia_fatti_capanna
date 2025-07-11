<?php
/* Smarty version 5.5.1, created on 2025-07-11 18:58:05
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/waiter_order_detail.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6871429da3f069_05128887',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ace49581934f642b0f62c6239852469b039094c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/waiter_order_detail.tpl',
      1 => 1752253080,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6871429da3f069_05128887 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dettagli Ordine</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 900px;">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1 class="text-primary text-center mb-4">Dettagli Ordine</h1>

            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('order_items')) == 0) {?>
                <p class="text-center text-muted">Non sono stati ancora scelti prodotti per questo ordine.</p>
            <?php } else { ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Quantità</th>
                                <th>Costo Singola Quantità</th>
                                <th>Nome Prodotto</th>
                                <th>ID Ordine</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('order_items'), 'order_item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('order_item')->value) {
$foreach0DoElse = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->getValue('order_item')->getQuantity();?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('order_item')->getPrice();?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('order_item')->getProduct()->getName();?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('order_item')->getOrder()->getIdOrder();?>
</td>
                                </tr>
                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
            <?php }?>

            <?php if ($_smarty_tpl->getValue('user_role') == 'waiter') {?>
                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Waiter/viewOrder" class="btn btn-secondary">Torna agli ordini</a>
                </div>
            <?php } elseif ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Admin/showOrders" class="btn btn-secondary">Torna agli ordini</a>
                </div>
            <?php }?>
        </div>
    </div>
</body>
</html><?php }
}
