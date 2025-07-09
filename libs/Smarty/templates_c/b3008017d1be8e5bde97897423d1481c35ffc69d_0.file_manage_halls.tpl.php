<?php
/* Smarty version 5.5.1, created on 2025-07-09 18:22:53
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_halls.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686e975d5d7bd2_56294891',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b3008017d1be8e5bde97897423d1481c35ffc69d' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_halls.tpl',
      1 => 1752078171,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686e975d5d7bd2_56294891 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Sale</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 900px;">
        <h1 class="text-primary text-center mb-4">Gestione Banchetto</h1>

        <div class="card mb-5">
            <div class="card-header">
                Aggiungi Nuova Sala
            </div>
            <div class="card-body">
                <form action="/Pancia_mia_fatti_capanna/RestaurantHall/create" method="POST" class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome Sala</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="totalPlaces" class="form-label">Posti Totali</label>
                        <input type="number" id="totalPlaces" name="totalPlaces" class="form-control" min="1" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">Aggiungi</button>
                    </div>
                </form>
            </div>
        </div>

        <h2 class="h4 text-secondary mb-3">Sale Esistenti</h2>
        <?php if (( !$_smarty_tpl->hasVariable('halls') || empty($_smarty_tpl->getValue('halls')))) {?>
            <p class="text-center text-muted">Non ci sono sale registrate al momento.</p>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table table-stripdevered table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome Sala</th>
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
                                                                        <form action="/Pancia_mia_fatti_capanna/RestaurantHall/delete" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa sala?');">
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
            <a href="/Pancia_mia_fatti_capanna/" class="btn btn-secondary">Torna alla Home</a>
        </div>
    </div>
</body>
</html><?php }
}
