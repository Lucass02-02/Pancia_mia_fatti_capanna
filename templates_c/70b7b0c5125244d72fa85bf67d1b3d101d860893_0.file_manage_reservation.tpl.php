<?php
/* Smarty version 5.5.1, created on 2025-07-11 16:32:53
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/manage_reservation.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68712095310230_75869688',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70b7b0c5125244d72fa85bf67d1b3d101d860893' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/manage_reservation.tpl',
      1 => 1752180083,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68712095310230_75869688 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Prenotazioni</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 1100px;">
        <h1 class="text-primary text-center mb-4">Gestione Prenotazioni</h1>

                <div class="bg-white p-4 rounded shadow-sm mb-4 border">
            <h2 class="h5 text-secondary mb-3">Filtra per data:</h2>
            <form action="/Pancia_mia_fatti_capanna/Admin/showReservations" method="post" class="row g-3 align-items-end">
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
                    <a href="/Pancia_mia_fatti_capanna/Admin/showReservations" class="btn btn-secondary">Rimuovi Filtro</a>
                </div>
            </form>
        </div>

                <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">Prenotazioni Esistenti</h2>
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
                            <th>Cambia Stato</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reservations'), 'reservation');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('reservation')->value) {
$foreach0DoElse = false;
?>
                            <?php $_smarty_tpl->assign('resDate', $_smarty_tpl->getValue('reservation')->getDate()->format('Y-m-d'), false, NULL);?>
                            <?php $_smarty_tpl->assign('filterDate', (($tmp = $_GET['filter_date'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), false, NULL);?>
                            <?php if ($_smarty_tpl->getValue('filterDate') == '' || $_smarty_tpl->getValue('filterDate') == $_smarty_tpl->getValue('resDate')) {?>
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
                                    <td>
                                        <form action="/Pancia_mia_fatti_capanna/Admin/updateReservationState" method="post" class="d-flex align-items-center gap-2">
                                            <input type="hidden" name="reservation_id" value="<?php echo $_smarty_tpl->getValue('reservation')->getIdReservation();?>
">
                                            <select name="status" class="form-select">
                                                <option value="created" <?php if ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'created') {?>selected<?php }?>>Creata</option>
                                                <option value="approved" <?php if ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'approved') {?>selected<?php }?>>Approvata</option>
                                                <option value="order_in_progress" <?php if ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'order_in_progress') {?>selected<?php }?>>Ordine in corso</option>
                                                <option value="order_completed" <?php if ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'order_completed') {?>selected<?php }?>>Ordine Completato</option>
                                                <option value="ended" <?php if ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'ended') {?>selected<?php }?>>Conculusa</option>
                                                <option value="canceled" <?php if ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'canceled') {?>selected<?php }?>>Cancellata</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php }?>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
        </div>
    </div>
</body>
</html>
<?php }
}
