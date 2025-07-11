<?php
/* Smarty version 5.5.1, created on 2025-07-11 20:48:25
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/cart.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68715c7924bdd6_49877724',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1e2be46592d975dd7a9e2aa78e609a352fd7b547' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/cart.tpl',
      1 => 1752259702,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68715c7924bdd6_49877724 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Mio Carrello - Pancia mia fatti capanna</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 800px;">
        <h1 class="text-center text-primary mb-4">Il Mio Carrello</h1>

        <?php if (( !$_smarty_tpl->hasVariable('cartItems') || empty($_smarty_tpl->getValue('cartItems')))) {?>
            <p class="text-center text-muted">Il tuo carrello è vuoto. <a href="/Pancia_mia_fatti_capanna/Client/order" class="link-primary">Vai al menù</a> per aggiungere prodotti!</p>
        <?php } else { ?>
            <?php $_smarty_tpl->assign('total', 0, false, NULL);?>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('cartItems'), 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
                <?php $_smarty_tpl->assign('itemTotal', $_smarty_tpl->getValue('item')->getPrice()*$_smarty_tpl->getValue('item')->getQuantity(), false, NULL);?>
                <?php $_smarty_tpl->assign('total', $_smarty_tpl->getValue('total')+$_smarty_tpl->getValue('itemTotal'), false, NULL);?>
                <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                    <div>
                        <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('item')->getProduct()->getName(), ENT_QUOTES, 'UTF-8', true);?>
</strong><br>
                        <small>Quantità: <?php echo $_smarty_tpl->getValue('item')->getQuantity();?>
 x € <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('item')->getPrice(),2,',','.');?>
 = € <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('itemTotal'),2,',','.');?>
</small>
                    </div>
                    <div class="btn-group" role="group">
                        <form action="/Pancia_mia_fatti_capanna/Cart/remove" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('item')->getProduct()->getIdProduct();?>
">
                            <input type="hidden" name="remove_one" value="1">
                            <button type="submit" class="btn btn-outline-secondary btn-sm">-</button>
                        </form>
                        <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('item')->getProduct()->getIdProduct();?>
">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="from_cart" value="true">
                            <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                        </form>
                        <form action="/Pancia_mia_fatti_capanna/Cart/remove" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('item')->getProduct()->getIdProduct();?>
">
                            <button type="submit" class="btn btn-danger btn-sm">Rimuovi</button>
                        </form>
                    </div>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

            <div class="text-end mt-4 fs-5 fw-bold">
                Totale Carrello: € <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('total'),2,',','.');?>

            </div>

            <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                <a href="/Pancia_mia_fatti_capanna/Client/order" class="btn btn-primary">Torna al Menù</a>
                <form action="/Pancia_mia_fatti_capanna/Cart/clear" method="POST">
                    <button type="submit" class="btn btn-secondary">Svuota Carrello</button>
                </form>
                <a href="/Pancia_mia_fatti_capanna/Cart/checkout" class="btn btn-success">Procedi al Checkout</a>
            </div>
        <?php }?>
    </div>
</body>
</html>
<?php }
}
