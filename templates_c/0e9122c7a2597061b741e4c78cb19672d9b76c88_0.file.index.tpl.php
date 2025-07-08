<?php
/* Smarty version 4.3.4, created on 2025-07-08 14:36:56
  from 'C:\xampp\htdocs\Pancia_mia_fatti_capanna\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_686d10e89c6f07_70092913',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0e9122c7a2597061b741e4c78cb19672d9b76c88' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\templates\\index.tpl',
      1 => 1751977932,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:sidebar.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_686d10e89c6f07_70092913 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:sidebar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</h1>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <p>Benvenuto nella dashboard!</p>
    </div>
  </section>
</div>
<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
