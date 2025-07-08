<?php
/* Smarty version 4.3.4, created on 2025-07-08 16:32:33
  from 'C:\xampp\htdocs\Pancia_mia_fatti_capanna\templates\register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_686d2c014f6094_69220111',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '136d3152a159d25b14b975a2309bee60139d1797' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\templates\\register.tpl',
      1 => 1751985119,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_686d2c014f6094_69220111 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h1>Registrazione</h1>

<?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
  <div style="color:red;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['success']->value) {?>
  <div style="color:green;"><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
</div>
<?php }?>

<form method="POST" action="register.php">
  <label>Nome*:</label><br>
  <input type="text" name="name" required><br><br>

  <label>Cognome*:</label><br>
  <input type="text" name="surname" required><br><br>

  <label>Data di nascita*:</label><br>
  <input type="date" name="birthDate" required><br><br>

  <label>Email*:</label><br>
  <input type="email" name="email" required><br><br>

  <label>Password*:</label><br>
  <input type="password" name="password" required><br><br>

  <label>Telefono:</label><br>
  <input type="text" name="phonenumber"><br><br>

  <button type="submit">Registrati</button>
</form>

<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
