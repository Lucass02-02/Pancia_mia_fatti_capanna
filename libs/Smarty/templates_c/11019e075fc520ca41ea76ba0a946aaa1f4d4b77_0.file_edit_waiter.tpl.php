<?php
/* Smarty version 5.5.1, created on 2025-07-12 02:07:41
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/edit_waiter.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6871a74d29bce1_31465706',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11019e075fc520ca41ea76ba0a946aaa1f4d4b77' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/edit_waiter.tpl',
      1 => 1752231983,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6871a74d29bce1_31465706 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Cameriere</title>

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
            <h1>Modifica Cameriere</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Edit Waiter Section ======= -->
    <section class="contact">
        <div class="container" style="max-width: 800px;">

                        <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null))) && $_smarty_tpl->getValue('error')) {?>
                <div class="error-message text-center mb-3">Errore: <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>
</div>
            <?php }?>

            <div class="php-email-form bg-white p-4 shadow-sm">
                <form action="/Pancia_mia_fatti_capanna/Waiter/update" method="POST" class="row g-3">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('waiter')->getId();?>
">

                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getName(), ENT_QUOTES, 'UTF-8', true);?>
" required>
                    </div>

                    <div class="col-md-6">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" id="surname" name="surname" class="form-control" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getEmail(), ENT_QUOTES, 'UTF-8', true);?>
" required>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Nuova Password (lascia vuoto per non modificare)</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="birthDate" class="form-label">Data di Nascita</label>
                        <input type="date" id="birthDate" name="birthDate" class="form-control" value="<?php echo $_smarty_tpl->getValue('waiter')->getBirthDate()->format('Y-m-d');?>
" required>
                    </div>

                    <div class="col-md-6">
                        <label for="serialNumber" class="form-label">Matricola</label>
                        <input type="text" id="serialNumber" name="serialNumber" class="form-control" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getSerialNumber(), ENT_QUOTES, 'UTF-8', true);?>
" required>
                    </div>

                    <div class="col-12">
                        <label for="hall_id" class="form-label">Assegna a un Banchetto</label>
                        <select id="hall_id" name="hall_id" class="form-select" required>
                            <option value="">Seleziona un Banchetto...</option>
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('halls'), 'hall');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('hall')->value) {
$foreach0DoElse = false;
?>
                                <option value="<?php echo $_smarty_tpl->getValue('hall')->getIdHall();?>
" <?php if ($_smarty_tpl->getValue('waiter')->getRestaurantHall() && $_smarty_tpl->getValue('waiter')->getRestaurantHall()->getIdHall() == $_smarty_tpl->getValue('hall')->getIdHall()) {?>selected<?php }?>>
                                    <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('hall')->getName(), ENT_QUOTES, 'UTF-8', true);?>

                                </option>
                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>

                    <div class="col-12 mt-4 d-flex justify-content-between">
                        <button type="submit" class="btn btn-get-started">Salva Modifiche</button>
                        <a href="/Pancia_mia_fatti_capanna/Waiter/manage" class="btn btn-secondary">Annulla</a>
                    </div>
                </form>
            </div>

        </div>
    </section><!-- End Edit Waiter Section -->

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
