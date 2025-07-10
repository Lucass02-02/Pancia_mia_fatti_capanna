<?php
/* Smarty version 5.5.1, created on 2025-07-10 18:24:22
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_halls.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686fe936490b37_27305442',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b3008017d1be8e5bde97897423d1481c35ffc69d' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_halls.tpl',
      1 => 1752164308,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686fe936490b37_27305442 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Sale Ristorante</title>

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
            <h1>Gestione Sale Ristorante</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Manage Halls Section ======= -->
    <section class="contact">
        <div class="container" style="max-width: 900px;">

            <div class="php-email-form bg-white p-4 shadow-sm">

                <div class="text-end mb-4">
                    <a href="/Pancia_mia_fatti_capanna/Waiter/manage" class="btn btn-info">Gestisci Camerieri</a>
                </div>

                <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null))) && $_smarty_tpl->getValue('error')) {?>
                    <div class="error-message mb-3">Non puoi eliminare questa sala perché contiene dei camerieri. Sposta i camerieri in un'altra sala e riprova.</div>
                <?php }?>

                <h2 class="h5 mb-3">Aggiungi Nuova Sala</h2>
                <form action="/Pancia_mia_fatti_capanna/RestaurantHall/create" method="POST" class="mb-4 p-3 border rounded">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nome Sala:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="totalPlaces" class="form-label">Posti Totali:</label>
                            <input type="number" id="totalPlaces" name="totalPlaces" class="form-control" min="1" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-get-started w-100">Crea Sala</button>
                        </div>
                    </div>
                </form>

                <h2 class="h5 mb-3">Sale Esistenti</h2>
                <?php if (( !$_smarty_tpl->hasVariable('halls') || empty($_smarty_tpl->getValue('halls')))) {?>
                    <p class="text-center text-muted">Nessuna sala ristorante presente.</p>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Posti Totali</th>
                                    <th class="text-center">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('halls'), 'hall');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('hall')->value) {
$foreach0DoElse = false;
?>
                                    <tr>
                                        <td><?php echo $_smarty_tpl->getValue('hall')->getIdHall();?>
</td>
                                        <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('hall')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                        <td><?php echo $_smarty_tpl->getValue('hall')->getTotalPlaces();?>
</td>
                                        <td class="text-center">
                                            <form action="/Pancia_mia_fatti_capanna/RestaurantHall/delete" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare la sala <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('hall')->getName(), ENT_QUOTES, 'UTF-8', true);?>
?');">
                                                <input type="hidden" name="hall_id" value="<?php echo $_smarty_tpl->getValue('hall')->getIdHall();?>
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
