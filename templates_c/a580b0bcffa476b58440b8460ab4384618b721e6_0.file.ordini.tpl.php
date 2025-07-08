<?php
/* Smarty version 4.3.4, created on 2025-07-08 15:38:51
  from 'C:\xampp\htdocs\Pancia_mia_fatti_capanna\templates\ordini.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_686d1f6bb0ace2_75392215',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a580b0bcffa476b58440b8460ab4384618b721e6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\templates\\ordini.tpl',
      1 => 1751981819,
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
function content_686d1f6bb0ace2_75392215 (Smarty_Internal_Template $_smarty_tpl) {
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
          <th>ID</th>
          <th>Cliente</th>
          <th>Piatto</th>
          <th>Stato</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ordini']->value, 'ordine');
$_smarty_tpl->tpl_vars['ordine']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ordine']->value) {
$_smarty_tpl->tpl_vars['ordine']->do_else = false;
?>
        <tr>
          <td><?php echo $_smarty_tpl->tpl_vars['ordine']->value['id'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['ordine']->value['cliente'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['ordine']->value['piatto'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['ordine']->value['stato'];?>
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
?>

<?php }
}
