<?php
/* Smarty version 4.3.4, created on 2025-07-08 16:23:03
  from 'C:\xampp\htdocs\Pancia_mia_fatti_capanna\templates\menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_686d29c759aae7_67951704',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ca5ef81000d8992beb89fc72ff455457ca36dd7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\templates\\menu.tpl',
      1 => 1751984450,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_686d29c759aae7_67951704 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\plugins\\modifier.number_format.php','function'=>'smarty_modifier_number_format',),));
$_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h1>Menù</h1>

<ul>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
    <li>
        <strong><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</strong> - €<?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['product']->value['price'],2,",",".");?>
<br>
        <small><?php echo $_smarty_tpl->tpl_vars['product']->value['description'];?>
</small>
    </li>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>

<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>



<?php }
}
