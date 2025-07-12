<?php
/* Smarty version 5.5.1, created on 2025-07-12 12:33:34
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/waiter_order_detail.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_687239fe7d6fe8_05566933',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aa3042e0ccddd942860837f66a08e3b42710f66d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/waiter_order_detail.tpl',
      1 => 1752313802,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_687239fe7d6fe8_05566933 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dettagli Ordine</title>

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
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <!-- ======= Page Title Section ======= -->
    <section class="page-title mb-4">
        <div class="container text-center">
            <h1 style="color: var(--heading-color); font-family: var(--heading-font);">Dettagli Ordine</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Main Content ======= -->
    <main>
        <div class="container" style="max-width: 900px;">
            <div class="surface bg-white p-4 rounded shadow-sm">

                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('order_items')) == 0) {?>
                    <p class="text-center text-muted">Non sono stati ancora scelti prodotti per questo ordine.</p>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Quantità</th>
                                    <th>Costo Unitario</th>
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
                                        <td>€ <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('order_item')->getPrice(),2,',',' ');?>
</td>
                                        <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('order_item')->getProduct()->getName(), ENT_QUOTES, 'UTF-8', true);?>
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

                                <div class="text-center mt-4">
                    <?php if ($_smarty_tpl->getValue('user_role') == 'waiter') {?>
                        <a href="/Pancia_mia_fatti_capanna/Waiter/viewOrder" class="btn btn-primary">Torna agli Ordini</a>
                    <?php } elseif ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                        <a href="/Pancia_mia_fatti_capanna/Admin/showOrders" class="btn btn-primary">Torna agli Ordini</a>
                    <?php }?>
                </div>

            </div>
        </div>
    </main>
    <!-- ======= End Main Content ======= -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer mt-5">
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
