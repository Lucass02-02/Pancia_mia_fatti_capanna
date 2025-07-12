<?php
/* Smarty version 5.5.1, created on 2025-07-13 00:12:31
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/client_view_reservation.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6872ddcf722f85_86427457',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '60ec542c11ea5106c660f569e0f103a79484db9f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/client_view_reservation.tpl',
      1 => 1752358349,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6872ddcf722f85_86427457 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Le Tue Prenotazioni</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    </header>

    <!-- ======= Page Title ======= -->
    <section class="page-title text-center mb-4">
        <div class="container">
            <h1>Le Tue Prenotazioni</h1>
        </div>
    </section>

    <!-- ======= Reservations List ======= -->
    <main>
        <div class="container" style="max-width: 1000px;">
            <div class="bg-white p-4 rounded shadow-sm">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Data</th>
                                <th>Orario</th>
                                <th>Durata</th>
                                <th>Persone</th>
                                <th>Note</th>
                                <th>Nome</th>
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
                                    <td><?php echo $_smarty_tpl->getValue('reservation')->getDate()->format('d/m/Y');?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('reservation')->getHours()->format('H:i');?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('reservation')->getDuration();?>
 min</td>
                                    <td><?php echo $_smarty_tpl->getValue('reservation')->getPeopleNum();?>
</td>
                                    <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('reservation')->getNote() ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                    <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('reservation')->getNameReservation(), ENT_QUOTES, 'UTF-8', true);?>
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
                                </tr>
                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
                </div>
            </div>
        </div>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer mt-5">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
