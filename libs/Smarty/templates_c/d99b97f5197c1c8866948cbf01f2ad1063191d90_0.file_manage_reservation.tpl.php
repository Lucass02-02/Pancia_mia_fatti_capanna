<?php
/* Smarty version 5.5.1, created on 2025-07-12 02:42:14
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/manage_reservation.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6871af66aa82d5_08271023',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd99b97f5197c1c8866948cbf01f2ad1063191d90' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/manage_reservation.tpl',
      1 => 1752280932,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6871af66aa82d5_08271023 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Prenotazioni</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body class="bg-light">

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
                <h1 class="text-center mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">Gestione Prenotazioni</h1>

                                <div class="surface p-4 rounded shadow-sm mb-4 border">
                    <h2 class="h5 mb-3">Filtra per data:</h2>
                    <form action="/Pancia_mia_fatti_capanna/Admin/showReservations" method="post" class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="filterDate" class="form-label">Data</label>
                            <input type="date" id="filterDate" name="filter_date" class="form-control"
                                   value="<?php echo (($tmp = $_POST['filter_date'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">Applica Filtro</button>
                        </div>
                        <div class="col-auto">
                            <a href="/Pancia_mia_fatti_capanna/Admin/showReservations" class="btn" style="background-color: var(--nav-hover-color);">Rimuovi Filtro</a>
                        </div>
                    </form>
                </div>

                                <div class="mb-5">
                    <h2 class="h4 mb-3">Prenotazioni Esistenti</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Data</th>
                                    <th>Durata</th>
                                    <th>Orario</th>
                                    <th>Num Persone</th>
                                    <th>Note</th>
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
                                                <span class="fw-bold" style="color:
                                                    <?php if ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'created') {?>var(--accent-color)
                                                    <?php } elseif ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'approved') {?>var(--accent-color)
                                                    <?php } elseif ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'order_in_progress') {?>#FFA500
                                                    <?php } elseif ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'ended') {?>var(--nav-hover-color)
                                                    <?php } elseif ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'canceled') {?>#D9534F
                                                    <?php }?>;
                                                ">
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
                                                        <option value="ended" <?php if ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'ended') {?>selected<?php }?>>Conclusa</option>
                                                        <option value="canceled" <?php if ($_smarty_tpl->getValue('reservation')->getStatus()->value == 'canceled') {?>selected<?php }?>>Cancellata</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-sm" style="background-color: var(--accent-color); color: var(--contrast-color);">Salva</button>
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
                    <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn" style="background-color: var(--nav-hover-color); color: var(--contrast-color);">Torna alla Home</a>
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
