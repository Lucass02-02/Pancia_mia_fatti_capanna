<?php
/* Smarty version 5.5.1, created on 2025-07-11 12:29:01
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/waiter_tables_view.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6870e76d209c58_59453491',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7cc022c61a70205d521747e90ad8134351ac0912' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/waiter_tables_view.tpl',
      1 => 1752163377,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6870e76d209c58_59453491 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stato Tavoli - <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('hall')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</title>

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

    <!-- ======= Tables View Section ======= -->
    <section class="tables-view">
        <div class="container my-5" style="max-width: 900px;">
            <div class="php-email-form bg-white p-4 rounded shadow-sm">
                <h1 class="text-primary text-center mb-4">Stato Tavoli - <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('hall')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</h1>

                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('tables')) == 0) {?>
                    <p class="text-center text-muted">Non ci sono tavoli assegnati a questa sala.</p>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Tavolo</th>
                                    <th>Posti</th>
                                    <th>Stato Attuale</th>
                                    <th>Cambia Stato</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('tables'), 'table');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('table')->value) {
$foreach0DoElse = false;
?>
                                    <tr>
                                        <td><strong>#<?php echo $_smarty_tpl->getValue('table')->getIdTable();?>
</strong></td>
                                        <td><?php echo $_smarty_tpl->getValue('table')->getSeatsNumber();?>
</td>
                                        <td>
                                            <span class="fw-bold text-<?php if ($_smarty_tpl->getValue('table')->getState()->value == 'available') {?>success<?php } elseif ($_smarty_tpl->getValue('table')->getState()->value == 'reserved') {?>warning<?php } elseif ($_smarty_tpl->getValue('table')->getState()->value == 'occupied') {?>danger<?php }?>">
                                                <?php echo mb_strtoupper((string) $_smarty_tpl->getValue('table')->getState()->value ?? '', 'UTF-8');?>

                                            </span>
                                        </td>
                                        <td>
                                            <form action="/Pancia_mia_fatti_capanna/Waiter/updateTableState" method="POST" class="d-flex align-items-center gap-2">
                                                <input type="hidden" name="table_id" value="<?php echo $_smarty_tpl->getValue('table')->getIdTable();?>
">
                                                <select name="state" class="form-select">
                                                    <option value="available" <?php if ($_smarty_tpl->getValue('table')->getState()->value == 'available') {?>selected<?php }?>>Disponibile</option>
                                                    <option value="reserved" <?php if ($_smarty_tpl->getValue('table')->getState()->value == 'reserved') {?>selected<?php }?>>Prenotato</option>
                                                    <option value="occupied" <?php if ($_smarty_tpl->getValue('table')->getState()->value == 'occupied') {?>selected<?php }?>>Occupato</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm">Salva</button>
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
                    <a href="/Pancia_mia_fatti_capanna/Waiter/profile" class="btn btn-secondary">Torna alla Dashboard</a>
                </div>
            </div>
        </div>
    </section><!-- End Tables View Section -->

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
