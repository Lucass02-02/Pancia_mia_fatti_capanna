<?php
/* Smarty version 5.5.1, created on 2025-07-09 02:23:36
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_clients.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686db688dd4640_00229623',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c4a88ec17f288fe6460a9f86a97ab83f8acbbe62' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_clients.tpl',
      1 => 1752012840,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686db688dd4640_00229623 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Clienti</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 1200px;">
        <h1 class="text-primary text-center mb-4">Clienti Registrati</h1>

        <?php if (( !$_smarty_tpl->hasVariable('clients') || empty($_smarty_tpl->getValue('clients')))) {?>
            <p class="text-center text-muted">Non ci sono clienti registrati al momento.</p>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome Completo</th>
                            <th>Email</th>
                            <th>Nickname</th>
                            <th>Telefono</th>
                            <th>Data di Nascita</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('clients'), 'client');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('client')->value) {
$foreach0DoElse = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->getValue('client')->getId();?>
</td>
                                <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getEmail(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('client')->getNickname() ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('client')->getPhonenumber() ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('client')->getBirthDate()->format('d/m/Y');?>
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
</html>
<?php }
}
