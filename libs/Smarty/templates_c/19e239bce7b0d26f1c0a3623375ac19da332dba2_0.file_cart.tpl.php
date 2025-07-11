<?php
/* Smarty version 5.5.1, created on 2025-07-11 13:42:34
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/cart.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6870f8aae4f855_45317593',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19e239bce7b0d26f1c0a3623375ac19da332dba2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/cart.tpl',
      1 => 1752231983,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6870f8aae4f855_45317593 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Mio Carrello - Pancia mia fatti capanna</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/index">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <!-- ======= Page Title Section ======= -->
    <section class="page-title">
        <div class="container">
            <h1>Il Mio Carrello</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Cart Section ======= -->
    <section class="section">
        <div class="container" style="max-width: 800px;">
            <?php if (( !$_smarty_tpl->hasVariable('cartItems') || empty($_smarty_tpl->getValue('cartItems')))) {?>
                <p class="text-center text-muted">Il tuo carrello è vuoto. <a href="/Pancia_mia_fatti_capanna/Home/menu" class="link-primary">Vai al menù</a> per aggiungere prodotti!</p>
            <?php } else { ?>
                <?php $_smarty_tpl->assign('total', 0, false, NULL);?>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('cartItems'), 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
                    <?php $_smarty_tpl->assign('itemTotal', $_smarty_tpl->getValue('item')['price']*$_smarty_tpl->getValue('item')['quantity'], false, NULL);?>
                    <?php $_smarty_tpl->assign('total', $_smarty_tpl->getValue('total')+$_smarty_tpl->getValue('itemTotal'), false, NULL);?>
                    <div class="icon-box">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <p class="mb-1 fw-bold"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('item')['name'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                                <small>Quantità: <?php echo $_smarty_tpl->getValue('item')['quantity'];?>
 x € <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('item')['price'],2,',','.');?>
 = € <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('itemTotal'),2,',','.');?>
</small>
                            </div>
                            <div class="btn-group mt-2 mt-md-0" role="group">
                                <form action="/Pancia_mia_fatti_capanna/Cart/remove" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('item')['product_id'];?>
">
                                    <input type="hidden" name="remove_one" value="1">
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">-</button>
                                </form>
                                <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('item')['product_id'];?>
">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="from_cart" value="true">
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                                </form>
                                <form action="/Pancia_mia_fatti_capanna/Cart/remove" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('item')['product_id'];?>
">
                                    <button type="submit" class="btn btn-danger btn-sm">Rimuovi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

                <div class="text-end mt-4 fs-5 fw-bold">
                    Totale Carrello: € <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('total'),2,',','.');?>

                </div>

                <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                    <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-get-started">Torna al Menù</a>
                    <form action="/Pancia_mia_fatti_capanna/Cart/clear" method="POST">
                        <button type="submit" class="btn btn-secondary">Svuota Carrello</button>
                    </form>
                    <a href="/Pancia_mia_fatti_capanna/Cart/checkout" class="btn btn-success">Procedi al Checkout</a>
                </div>
            <?php }?>
        </div>
    </section><!-- End Cart Section -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer><!-- End Footer -->

    <!-- Bootstrap JS -->
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>

</body>
</html>
<?php }
}
