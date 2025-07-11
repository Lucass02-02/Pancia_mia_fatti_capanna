<?php
/* Smarty version 5.5.1, created on 2025-07-11 18:53:48
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/waiter_manage_order.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6871419cb5cbd1_99461579',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '758c58622c2fa81c2ea17ab787c516e13effb171' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/waiter_manage_order.tpl',
      1 => 1752252824,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6871419cb5cbd1_99461579 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lista Ordini</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 900px;">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1 class="text-primary text-center mb-4">Lista Ordini</h1>

            <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
            <div class="alert alert-danger text-center"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>
</div>
            <?php }?>

                        <div class="bg-white p-4 rounded shadow-sm mb-4 border">
                <h2 class="h5 text-secondary mb-3">Filtra per data:</h2>
                <form action="/Pancia_mia_fatti_capanna/Waiter/viewOrder" method="post" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="filterDate" class="form-label">Data</label>
                        <input type="date" id="filterDate" name="filter_date" class="form-control"
                            value="<?php echo (($tmp = $_POST['filter_date'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
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
                                        <span class="fw-bold text-<?php if ($_smarty_tpl->getValue('order')->getStatus()->value == 'created') {?>success<?php } elseif ($_smarty_tpl->getValue('order')->getStatus()->value == 'in_progress') {?>warning
                                            <?php } elseif ($_smarty_tpl->getValue('order')->getStatus()->value == 'paid') {?>success<?php } elseif ($_smarty_tpl->getValue('order')->getStatus()->value == 'canceled') {?>danger<?php }?>">
                                            <?php echo mb_strtoupper((string) $_smarty_tpl->getValue('order')->getStatus()->value ?? '', 'UTF-8');?>

                                        </span>    
                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->getValue('order')->getStatus()->value == 'created') {?>
                                            <?php if ($_smarty_tpl->getValue('user_role') == 'waiter') {?>
                                                <form action="/Pancia_mia_fatti_capanna/Waiter/enableOrder" method="post" class="d-flex align-items-center gap-2">
                                                    <input type="hidden" name="order_id" value="<?php echo $_smarty_tpl->getValue('order')->getIdOrder();?>
">
                                                    <select name="status" class="form-select">
                                                    <option value="in_progress" <?php if ($_smarty_tpl->getValue('order')->getStatus()->value == 'in_progress') {?>selected<?php }?>>In Corso</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                                                </form>
                                            <?php } elseif ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                                                <form action="/Pancia_mia_fatti_capanna/Admin/enableOrder" method="post" class="d-flex align-items-center gap-2">
                                                    <input type="hidden" name="order_id" value="<?php echo $_smarty_tpl->getValue('order')->getIdOrder();?>
">
                                                    <select name="status" class="form-select">
                                                    <option value="in_progress" <?php if ($_smarty_tpl->getValue('order')->getStatus()->value == 'in_progress') {?>selected<?php }?>>In Corso</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                                                </form>
                                            <?php }?>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->getValue('user_role') == 'waiter') {?>
                                            <form action="/Pancia_mia_fatti_capanna/Waiter/detailOrder" method="post" style="display:inline;">
                                                <input type="hidden" name="order_id" value="<?php echo $_smarty_tpl->getValue('order')->getIdOrder();?>
">
                                                <button type="submit" class="btn btn-secondary btn-sm">Dettagli</button>
                                            </form>
                                        <?php } elseif ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                                            <form action="/Pancia_mia_fatti_capanna/Admin/detailOrder" method="post" style="display:inline;">
                                                <input type="hidden" name="order_id" value="<?php echo $_smarty_tpl->getValue('order')->getIdOrder();?>
">
                                                <button type="submit" class="btn btn-secondary btn-sm">Dettagli</button>
                                            </form>
                                        <?php }?>
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
                <a href="/Pancia_mia_fatti_capanna/Waiter/profile" class="btn btn-secondary">Torna alla Dashboard</a>
            </div>
            <?php } elseif ($_smarty_tpl->getValue('user_role') == 'admin') {?>
            <div class="text-center mt-4">
                <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary">Torna alla Dashboard</a>
            </div>
            <?php }?>
        </div>
    </div>
</body>
</html>
<?php }
}
