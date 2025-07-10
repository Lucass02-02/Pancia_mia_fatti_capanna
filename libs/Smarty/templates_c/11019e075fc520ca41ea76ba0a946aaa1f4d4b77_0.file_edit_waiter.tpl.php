<?php
/* Smarty version 5.5.1, created on 2025-07-10 17:45:25
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/edit_waiter.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686fe015b3e6d1_55233147',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11019e075fc520ca41ea76ba0a946aaa1f4d4b77' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/edit_waiter.tpl',
      1 => 1752161259,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686fe015b3e6d1_55233147 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Cameriere</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 800px;">
        <h1 class="text-primary text-center mb-4">Modifica Cameriere</h1>

                <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null))) && $_smarty_tpl->getValue('error')) {?>
            <div class="alert alert-danger" role="alert">
                Errore: <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>

            </div>
        <?php }?>

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
" <?php if ($_smarty_tpl->getValue('waiter')->getRestaurantHall() && $_smarty_tpl->getValue('waiter')->getRestaurantHall()->getIdHall() == $_smarty_tpl->getValue('hall')->getIdHall()) {?>selected<?php }?>>
                            <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('hall')->getName(), ENT_QUOTES, 'UTF-8', true);?>

                        </option>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </select>
            </div>
            <div class="col-12 mt-4 d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Salva Modifiche</button>
                <a href="/Pancia_mia_fatti_capanna/Waiter/manage" class="btn btn-secondary">Annulla</a>
            </div>
        </form>
    </div>
</body>
</html><?php }
}
