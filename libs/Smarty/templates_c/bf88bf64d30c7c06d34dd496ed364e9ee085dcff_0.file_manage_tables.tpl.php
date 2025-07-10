<?php
/* Smarty version 5.5.1, created on 2025-07-10 12:43:32
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_tables.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686f9954686653_54586679',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf88bf64d30c7c06d34dd496ed364e9ee085dcff' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_tables.tpl',
      1 => 1752144209,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686f9954686653_54586679 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Tavoli</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 1100px;">
        <h1 class="text-primary text-center mb-4">Gestione Tavoli</h1>


        <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">Aggiungi Nuovo Tavolo</h2>
            <form action="/Pancia_mia_fatti_capanna/Table/create" method="POST" class="row g-3 align-items-center justify-content-center">
                <div class="col-auto">
                    <label for="seatsNumber" class="col-form-label">Numero Posti:</label>
                </div>
                <div class="col-auto">
                    <input type="number" id="seatsNumber" name="seatsNumber" min="1" class="form-control" required>
                </div>
                <div class="col-auto">
                    <label for="hall_id" class="col-form-label">Sala:</label>
                </div>
                <div class="col-auto">
                    <select id="hall_id" name="hall_id" class="form-select" required>
                        <option value="">Seleziona una sala</option>
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
                <div class="col-auto">
                    <button type="submit" class="btn btn-success">Aggiungi Tavolo</button>
                </div>
            </form>
        </div>

        <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">Tavoli Esistenti</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>N. Posti</th>
                            <th>Sala</th>
                            <th>Stato Attuale</th>
                            <th>Cambia Stato</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('tables'), 'table');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('table')->value) {
$foreach1DoElse = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->getValue('table')->getSeatsNumber();?>
</td>
                                <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('table')->getRestaurantHall()->getName(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td>
                                    <span class="fw-bold text-<?php if ($_smarty_tpl->getValue('table')->getState()->value == 'available') {?>success<?php } elseif ($_smarty_tpl->getValue('table')->getState()->value == 'reserved') {?>warning<?php } elseif ($_smarty_tpl->getValue('table')->getState()->value == 'occupied') {?>danger<?php }?>">
                                        <?php echo mb_strtoupper((string) $_smarty_tpl->getValue('table')->getState()->value ?? '', 'UTF-8');?>

                                    </span>
                                </td>
                                <td>
                                    <form action="/Pancia_mia_fatti_capanna/Table/updateState" method="POST" class="d-flex align-items-center gap-2">
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
                                <td>
                                    <a href="/Pancia_mia_fatti_capanna/Table/delete/<?php echo $_smarty_tpl->getValue('table')->getIdTable();?>
" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo tavolo?');">Elimina</a>
                                </td>
                            </tr>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
        </div>

       
        <div class="text-center mt-4">
            <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary">Torna al Panello di Controllo</a>
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>

        </div>
    </div>
</body>
</html><?php }
}
