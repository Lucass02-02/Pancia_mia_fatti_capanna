<?php
/* Smarty version 5.5.1, created on 2025-07-12 02:35:57
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/waiter_reservation_view.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6871aded6f2719_57704625',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e40d1ccff79bf73f15ef650bb24f8189d437c9da' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/waiter_reservation_view.tpl',
      1 => 1752280554,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6871aded6f2719_57704625 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lista Prenotazioni</title>

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
        <div class="container" style="max-width: 900px;">
            <div class="surface bg-white p-4 rounded shadow-sm">
                <h1 class="text-center mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">Lista Prenotazioni</h1>

                                <div class="surface bg-light p-4 rounded shadow-sm mb-4 border">
                    <h2 class="h5 mb-3" style="color: var(--heading-color);">Filtra per data:</h2>
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
                                    <th>Note</th>
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
 min</td>
                                        <td><?php echo $_smarty_tpl->getValue('reservation')->getHours()->format('H:i');?>
</td>
                                        <td><?php echo $_smarty_tpl->getValue('reservation')->getPeopleNum();?>
</td>
                                        <td><?php echo $_smarty_tpl->getValue('reservation')->getNote();?>
</td>
                                        <td><?php echo $_smarty_tpl->getValue('reservation')->getNameReservation();?>
</td>
                                        <td>
                                            <span class="fw-bold text-<?php if ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'created') {?>primary
                                                <?php } elseif ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'approved') {?>success
                                                <?php } elseif ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'order_in_progress') {?>warning
                                                <?php } elseif ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'ended') {?>secondary
                                                <?php } elseif ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'canceled') {?>danger<?php }?>">
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
                    <a href="/Pancia_mia_fatti_capanna/Waiter/profile" class="btn btn-primary">Torna alla Dashboard</a>
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
