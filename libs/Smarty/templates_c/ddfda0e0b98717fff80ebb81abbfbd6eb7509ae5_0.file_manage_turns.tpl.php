<?php
/* Smarty version 5.5.1, created on 2025-07-12 22:05:37
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/manage_turns.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6872c0115fda96_65863630',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ddfda0e0b98717fff80ebb81abbfbd6eb7509ae5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/manage_turns.tpl',
      1 => 1752350572,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6872c0115fda96_65863630 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Turni</title>

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
<section class="my-5 text-center">
  <img src="/Pancia_mia_fatti_capanna/images/sala-ristorante.png" alt="Recensioni" class="img-fluid" style="width: 600px; height: 300px; margin-top: 20px;">
</section>
    <!-- ======= Page Title Section ======= -->
    <section class="page-title py-3">
        <div class="container">
            <h1 class="text-center">Gestione Turni</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Manage Halls Section ======= -->
    <section class="contact py-4">
        <div class="container" style="max-width: 900px;">

            <div class="php-email-form bg-white p-4 shadow-sm rounded">

                <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null))) && $_smarty_tpl->getValue('error')) {?>
                    <div class="alert alert-danger mb-3">
                        <?php echo $_smarty_tpl->getValue('error');?>

                    </div>
                <?php }?>

                <h2 class="h5 mb-3">Aggiungi Nuovo Turno</h2>
                <form action="/Pancia_mia_fatti_capanna/Admin/createTurn" method="POST" class="mb-4 p-3 border rounded bg-light">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="dayOfWeek" class="form-label">Scegli il giorno</label>
                            <select name="dayOfWeek" class="form-select">
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('enumValues'), 'value', false, 'name');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('name')->value => $_smarty_tpl->getVariable('value')->value) {
$foreach0DoElse = false;
?>
                                    <option value="<?php echo $_smarty_tpl->getValue('value');?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('name'), ENT_QUOTES, 'UTF-8', true);?>
</option>
                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="turno" class="form-label">Scegli il turno</label>
                            <select name="turno" class="form-select">
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('enumValues2'), 'value', false, 'name');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('name')->value => $_smarty_tpl->getVariable('value')->value) {
$foreach1DoElse = false;
?>
                                    <option value="<?php echo $_smarty_tpl->getValue('value');?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('name'), ENT_QUOTES, 'UTF-8', true);?>
</option>
                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="startTime" class="form-label">Ora Inizio</label>
                            <input type="time" id="startTime" name="start_time" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="endTime" class="form-label">Ora Fine</label>
                            <input type="time" id="endTime" name="end_time" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="hall_id" class="form-label">Assegna a un banchetto</label>
                            <select id="hall_id" name="hall_id" class="form-select" required>
                                <option value="">Seleziona un banchetto...</option>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('halls'), 'hall');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('hall')->value) {
$foreach2DoElse = false;
?>
                                    <option value="<?php echo $_smarty_tpl->getValue('hall')->getIdHall();?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('hall')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</option>
                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-get-started w-100">Crea</button>
                        </div>
                    </div>
                </form>

                <h2 class="h5 mb-3">Turni Esistenti</h2>
                <?php if (( !$_smarty_tpl->hasVariable('turns') || empty($_smarty_tpl->getValue('turns')))) {?>
                    <p class="text-center text-muted">Nessun turno presente.</p>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Giorno Della Settimana</th>
                                    <th>Ora Inizio</th>
                                    <th>Ora Fine</th>
                                    <th>Banchetto Assegnato</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('turns'), 'turn');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('turn')->value) {
$foreach3DoElse = false;
?>
                                    <tr>
                                        <td><?php echo $_smarty_tpl->getValue('turn')->getIdTurn();?>
</td>
                                        <td><?php echo $_smarty_tpl->getValue('turn')->getNameValue();?>
</td>
                                        <td><?php echo $_smarty_tpl->getValue('turn')->getDayOfWeekName();?>
</td>
                                        <td><?php echo $_smarty_tpl->getValue('turn')->getStartTime()->format('H:i:s');?>
</td>
                                        <td><?php echo $_smarty_tpl->getValue('turn')->getEndTime()->format('H:i:s');?>
</td>
                                        <td><?php echo $_smarty_tpl->getValue('turn')->getRestaurantHall()->getName();?>
</td>
                                        <td class="text-center">
                                            <form action="/Pancia_mia_fatti_capanna/Admin/deleteTurn" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare il turno <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('turn')->getIdTurn(), ENT_QUOTES, 'UTF-8', true);?>
?');" class="d-inline">
                                                <input type="hidden" name="turn_id" value="<?php echo $_smarty_tpl->getValue('turn')->getIdTurn();?>
">
                                                <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
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
                    <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary">Torna al Pannello di Controllo</a>
                </div>

            </div>

        </div>
    </section><!-- End Manage Halls Section -->

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
