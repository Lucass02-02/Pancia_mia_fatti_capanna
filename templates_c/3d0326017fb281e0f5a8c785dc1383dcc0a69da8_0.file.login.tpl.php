<?php
/* Smarty version 4.3.4, created on 2025-07-08 16:32:26
  from 'C:\xampp\htdocs\Pancia_mia_fatti_capanna\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_686d2bfabd7309_88910006',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d0326017fb281e0f5a8c785dc1383dcc0a69da8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\templates\\login.tpl',
      1 => 1751985142,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_686d2bfabd7309_88910006 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h2>Login</h2>

<form method="POST" action="login.php">
  <label>Email:</label><br>
  <input type="email" name="email" required><br><br>

  <label>Password:</label><br>
  <input type="password" name="password" required><br><br>

  <button type="submit">Accedi</button>
</form>

<p>Non hai un account? <a href="register.php">Registrati qui</a></p>

<?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
  <div style="color:red;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
<?php }?>

<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
