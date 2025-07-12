<?php
/* Smarty version 5.5.1, created on 2025-07-12 12:33:28
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/waiter_manage_order.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_687239f8b7b524_11276883',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8c9534ca38a00969c97ca159aca6be1e07d3c91d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/waiter_manage_order.tpl',
      1 => 1752313802,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_687239f8b7b524_11276883 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Ordini</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <main>
        <div class="container" style="max-width: 1100px;">
            <div class="surface p-4 rounded shadow-sm">
                <h1 class="text-center mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">Lista Ordini</h1>

                <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
                    <div class="alert alert-danger text-center"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>
</div>
                <?php }?>

                                <div class="bg-white p-4 rounded shadow-sm mb-4 border">
                    <h2 class="h5 text-secondary mb-3">Filtra per data:</h2>
                    <form action="/Pancia_mia_fatti_capanna/Waiter/viewOrder" method="post" class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="filterDate" class="form-label">Data</label>
                            <input type="date" id="filterDate" name="filter_date" class="form-control" value="<?php echo (($tmp = $_POST['filter_date'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Applica Filtro</button>
                        </div>
                        <div class="col-auto">
                            <a href="/Pancia_mia_fatti_capanna/Waiter/viewOrder" class="btn btn-secondary">Rimuovi Filtro</a>
                        </div>
                    </form>
                </div>

                                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('orders')) == 0) {?>
                    <p class="text-center text-muted">Non ci sono ancora ordini.</p>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Data</th>
                                    <th>ID Prenotazione</th>
                                    <th>Stato</th>
                                    <th>Approva Ordine</th>
                                    <th>Dettagli Ordine</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('orders'), 'order');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('order')->value) {
$foreach0DoElse = false;
?>
                                    <tr>
                                        <td><?php echo $_smarty_tpl->getValue('order')->getIdOrder();?>
</td>
                                        <td><?php echo $_smarty_tpl->getValue('order')->getDate()->format('d/m/Y');?>
</td>
                                        <td><?php echo $_smarty_tpl->getValue('order')->getReservation()->getIdReservation();?>
</td>
                                        <td>
                                            <span class="fw-bold text-<?php if ($_smarty_tpl->getValue('order')->getStatus()->value == 'created') {?>success<?php } elseif ($_smarty_tpl->getValue('order')->getStatus()->value == 'in_progress') {?>warning<?php } elseif ($_smarty_tpl->getValue('order')->getStatus()->value == 'paid') {?>success<?php } elseif ($_smarty_tpl->getValue('order')->getStatus()->value == 'canceled') {?>danger<?php }?>">
                                                <?php echo mb_strtoupper((string) $_smarty_tpl->getValue('order')->getStatus()->value ?? '', 'UTF-8');?>

                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($_smarty_tpl->getValue('order')->getStatus()->value == 'created') {?>
                                                <form action="/Pancia_mia_fatti_capanna/<?php echo $_smarty_tpl->getValue('user_role');?>
/enableOrder" method="post" class="d-flex align-items-center gap-2">
                                                    <input type="hidden" name="order_id" value="<?php echo $_smarty_tpl->getValue('order')->getIdOrder();?>
">
                                                    <select name="status" class="form-select">
                                                        <option value="in_progress" <?php if ($_smarty_tpl->getValue('order')->getStatus()->value == 'in_progress') {?>selected<?php }?>>In Corso</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                                                </form>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <form action="/Pancia_mia_fatti_capanna/<?php echo $_smarty_tpl->getValue('user_role');?>
/detailOrder" method="post" style="display:inline;">
                                                <input type="hidden" name="order_id" value="<?php echo $_smarty_tpl->getValue('order')->getIdOrder();?>
">
                                                <button type="submit" class="btn btn-secondary btn-sm">Dettagli</button>
                                            </form>
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
                    <a href="/Pancia_mia_fatti_capanna/<?php echo $_smarty_tpl->getValue('user_role');?>
/profile" class="btn btn-secondary">Torna alla Dashboard</a>
                </div>
            </div>
        </div>
    </main>

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
