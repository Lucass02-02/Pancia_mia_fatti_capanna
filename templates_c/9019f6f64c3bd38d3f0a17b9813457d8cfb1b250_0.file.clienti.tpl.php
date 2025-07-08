<?php
/* Smarty version 4.3.4, created on 2025-07-08 15:38:54
  from 'C:\xampp\htdocs\Pancia_mia_fatti_capanna\templates\clienti.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_686d1f6e72dad0_96331616',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9019f6f64c3bd38d3f0a17b9813457d8cfb1b250' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\templates\\clienti.tpl',
      1 => 1751981896,
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
function content_686d1f6e72dad0_96331616 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:sidebar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</h1>
  </section>
  <section class="content">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clienti']->value, 'cliente');
$_smarty_tpl->tpl_vars['cliente']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cliente']->value) {
$_smarty_tpl->tpl_vars['cliente']->do_else = false;
?>
        <tr>
          <td><?php echo $_smarty_tpl->tpl_vars['cliente']->value['nome'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['cliente']->value['email'];?>
</td>
        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </tbody>
    </table>
  </section>
</div>

<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
