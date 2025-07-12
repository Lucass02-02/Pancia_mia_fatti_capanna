<?php
/* Smarty version 5.5.1, created on 2025-07-12 19:58:11
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/manage_waiters.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6872a2332b0c93_52910098',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '96d83d654d58f342afcf646de6a4f2fc84eac2c4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/manage_waiters.tpl',
      1 => 1752342918,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6872a2332b0c93_52910098 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Camerieri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body>

    <header id="header" class="header d-flex align-items-center">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/index">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header>

    <section class="page-title">
        <div class="container">
            <h1>Gestione Camerieri</h1>
        </div>
    </section>

    <section class="contact">
        <div class="container" style="max-width: 1400px;">

            <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null))) && $_smarty_tpl->getValue('error')) {?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>

                </div>
            <?php }?>
            <?php if ((true && ($_smarty_tpl->hasVariable('success') && null !== ($_smarty_tpl->getValue('success') ?? null))) && $_smarty_tpl->getValue('success')) {?>
                <div class="alert alert-success text-center" role="alert">
                    <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('success'), ENT_QUOTES, 'UTF-8', true);?>

                </div>
            <?php }?>

            <div class="php-email-form bg-white p-4 shadow-sm mb-5">
                <h4 class="mb-4 text-center">Registra Nuovo Cameriere</h4>
                
                <form action="/Pancia_mia_fatti_capanna/waiter/register" method="post" role="form">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" placeholder="Nome" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="text" name="surname" class="form-control" placeholder="Cognome" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>

                     <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <input type="text" name="serialNumber" class="form-control" placeholder="Matricola" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                             <input type="tel" name="phoneNumber" class="form-control" placeholder="Telefono" pattern="[0-9]+" title="Il numero può contenere solo cifre." inputmode="numeric">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label for="birthDate" class="form-label">Data di Nascita</label>
                            <input type="date" id="birthDate" class="form-control" name="birthDate" required>
                        </div>
                         <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label for="hall_id" class="form-label">Sala Assegnata</label>
                            <select name="hall_id" id="hall_id" class="form-control" required>
                                <option value="">-- Seleziona Sala --</option>
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
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Registra Cameriere</button>
                    </div>
                </form>
            </div>

            <div class="php-email-form bg-white p-4 shadow-sm">
                 <h4 class="mb-4 text-center">Elenco Camerieri</h4>
                <?php if (( !$_smarty_tpl->hasVariable('waiters') || empty($_smarty_tpl->getValue('waiters')))) {?>
                    <p class="text-center text-muted">Non ci sono camerieri registrati al momento.</p>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Matricola</th>
                                    <th>Nome Completo</th>
                                    <th>Email</th>
                                    <th>Sala Assegnata</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('waiters'), 'waiter');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('waiter')->value) {
$foreach1DoElse = false;
?>
                                    <tr>
                                        <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getSerialNumber(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                        <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                        <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getEmail(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                        <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getRestaurantHall()->getName(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                        <td>
                                            <a href="/Pancia_mia_fatti_capanna/waiter/edit/<?php echo $_smarty_tpl->getValue('waiter')->getId();?>
" class="btn btn-sm btn-warning">Modifica</a>
                                            <a href="/Pancia_mia_fatti_capanna/waiter/delete/<?php echo $_smarty_tpl->getValue('waiter')->getId();?>
" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo cameriere?');">Elimina</a>
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
    </section>
    
    <footer id="footer" class="footer">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer>
    
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
