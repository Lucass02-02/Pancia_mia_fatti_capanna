<?php
/* Smarty version 5.5.1, created on 2025-07-10 18:04:42
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/manage_waiters.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686fe49a934306_63977781',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '96d83d654d58f342afcf646de6a4f2fc84eac2c4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/manage_waiters.tpl',
      1 => 1752163210,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686fe49a934306_63977781 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Camerieri</title>

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
            <h1>Gestione Camerieri</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Manage Waiters Section ======= -->
    <section class="contact">
        <div class="container" style="max-width: 1200px;">

            <div class="text-end mb-4">
                <a href="/Pancia_mia_fatti_capanna/RestaurantHall/manage" class="btn btn-info">Gestisci Banchetto</a>
            </div>

            <!-- Registra nuovo cameriere -->
            <div class="php-email-form bg-white p-4 shadow-sm mb-5">
                <h2 class="h4 text-secondary mb-3">Registra Nuovo Cameriere</h2>
                <form action="/Pancia_mia_fatti_capanna/Waiter/register" method="POST" class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" id="name" name="name" placeholder="Mario" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" id="surname" name="surname" placeholder="Rossi" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="m.rossi@ristorante.it" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="birthDate" class="form-label">Data di Nascita</label>
                        <input type="date" id="birthDate" name="birthDate" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="serialNumber" class="form-label">Matricola</label>
                        <input type="text" id="serialNumber" name="serialNumber" placeholder="ID Univoco" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label for="hall_id" class="form-label">Assegna a una Sala</label>
                        <select id="hall_id" name="hall_id" class="form-select" required>
                            <option value="">Seleziona una sala...</option>
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('halls'), 'hall');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('hall')->value) {
$foreach0DoElse = false;
?>
                                <option value="<?php echo $_smarty_tpl->getValue('hall')->getIdHall();?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('hall')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</option>
                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-get-started w-100">Registra Cameriere</button>
                    </div>
                </form>
            </div>

            <!-- Camerieri registrati -->
            <div class="php-email-form bg-white p-4 shadow-sm mb-5">
                <h2 class="h4 text-secondary mb-3">Camerieri Registrati</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nome Completo</th>
                                <th>Matricola</th>
                                <th>Sala Assegnata</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (( !$_smarty_tpl->hasVariable('waiters') || empty($_smarty_tpl->getValue('waiters')))) {?>
                                <tr><td colspan="4" class="text-center">Non ci sono camerieri registrati.</td></tr>
                            <?php } else { ?>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('waiters'), 'waiter');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('waiter')->value) {
$foreach1DoElse = false;
?>
                                <tr>
                                    <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                    <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getSerialNumber(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                    <td>
                                        <form action="/Pancia_mia_fatti_capanna/Waiter/updateHall" method="POST" class="d-flex align-items-center gap-2">
                                            <input type="hidden" name="waiter_id" value="<?php echo $_smarty_tpl->getValue('waiter')->getId();?>
">
                                            <select name="hall_id" class="form-select">
                                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('halls'), 'hall');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('hall')->value) {
$foreach2DoElse = false;
?>
                                                    <option value="<?php echo $_smarty_tpl->getValue('hall')->getIdHall();?>
" <?php if ($_smarty_tpl->getValue('waiter')->getRestaurantHall() && $_smarty_tpl->getValue('waiter')->getRestaurantHall()->getIdHall() == $_smarty_tpl->getValue('hall')->getIdHall()) {?>selected<?php }?>>
                                                        <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('hall')->getName(), ENT_QUOTES, 'UTF-8', true);?>

                                                    </option>
                                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="/Pancia_mia_fatti_capanna/Waiter/edit/<?php echo $_smarty_tpl->getValue('waiter')->getId();?>
" class="btn btn-warning btn-sm">Modifica</a>
                                            <a href="/Pancia_mia_fatti_capanna/Waiter/delete/<?php echo $_smarty_tpl->getValue('waiter')->getId();?>
" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo cameriere?');">Elimina</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pulsante torna al pannello di controllo -->
            <div class="text-center mt-4">
                <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary">Torna al Pannello di Controllo</a>
            </div>

        </div>
    </section><!-- End Manage Waiters Section -->

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
