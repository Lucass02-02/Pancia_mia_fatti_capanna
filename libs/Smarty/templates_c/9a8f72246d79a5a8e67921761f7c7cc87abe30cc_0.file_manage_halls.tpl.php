<?php
/* Smarty version 5.5.1, created on 2025-07-10 17:44:23
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/manage_halls.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686fdfd7857bf0_38781510',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a8f72246d79a5a8e67921761f7c7cc87abe30cc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/manage_halls.tpl',
      1 => 1752161259,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686fdfd7857bf0_38781510 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Sale Ristorante</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 900px;">
        <h1 class="text-center text-primary mb-4">Gestione Banchetto Ristorante</h1>

        <div class="text-end mb-4">
            <a href="/Pancia_mia_fatti_capanna/Waiter/manage"  class="btn btn-info">Gestisci Camerieri</a>
        </div>

        <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null))) && $_smarty_tpl->getValue('error')) {?>
            <div class="alert alert-danger" role="alert">
                Non puoi eliminare questa sala perché contiene dei camerieri, sposta i camerieri in un altra sala e riprova...
            </div>
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
                    <button type="submit" class="btn btn-primary w-100">Crea Sala</button>
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
</body>
</html><?php }
}
