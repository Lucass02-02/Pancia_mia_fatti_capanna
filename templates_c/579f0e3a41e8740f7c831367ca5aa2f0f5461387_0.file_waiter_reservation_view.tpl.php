<?php
/* Smarty version 5.5.1, created on 2025-07-10 22:55:09
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/waiter_reservation_view.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_687028ad9f9060_40899130',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '579f0e3a41e8740f7c831367ca5aa2f0f5461387' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/waiter_reservation_view.tpl',
      1 => 1752180907,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_687028ad9f9060_40899130 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lista Prenotazioni</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 900px;">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1 class="text-primary text-center mb-4">Lista Prenotazioni</h1>

                        <div class="bg-white p-4 rounded shadow-sm mb-4 border">
                <h2 class="h5 text-secondary mb-3">Filtra per data:</h2>
                <form action="/Pancia_mia_fatti_capanna/Waiter/viewReservation" method="post" class="row g-3 align-items-end">
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
                        <a href="/Pancia_mia_fatti_capanna/Waiter/viewReservation" class="btn btn-secondary">Rimuovi Filtro</a>
                    </div>
                </form>
            </div>

            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('reservations')) == 0) {?>
                <p class="text-center text-muted">Non ci sono ancora prenotazioni.</p>
            <?php } else { ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                             <tr>
                                <th>ID</th>
                                <th>Data</th>
                                <th>Durata</th>
                                <th>Orario</th>
                                <th>Num persone</th>
                                <th>note</th>
                                <th>Nome Prenotazione</th>
                                <th>Stato</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reservations'), 'reservation');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('reservation')->value) {
$foreach0DoElse = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->getValue('reservation')->getIdReservation();?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('reservation')->getDate()->format('d/m/Y');?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('reservation')->getDuration();?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('reservation')->getHours()->format('H:i');?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('reservation')->getPeopleNum();?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('reservation')->getNote();?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('reservation')->getNameReservation();?>
</td>
                                    <td>
                                        <span class="fw-bold text-<?php if ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'created') {?>success<?php } elseif ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'appoved') {?>success<?php } elseif ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'order_in_progress') {?>warning
                                            <?php } elseif ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'order_completed') {?>warning<?php } elseif ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'ended') {?>success<?php } elseif ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'canceled') {?>danger<?php }?>">
                                            <?php echo mb_strtoupper((string) $_smarty_tpl->getValue('reservation')->getStatus()->value ?? '', 'UTF-8');?>

                                        </span>
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
                <a href="/Pancia_mia_fatti_capanna/Waiter/profile" class="btn btn-secondary">Torna alla Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php }
}
