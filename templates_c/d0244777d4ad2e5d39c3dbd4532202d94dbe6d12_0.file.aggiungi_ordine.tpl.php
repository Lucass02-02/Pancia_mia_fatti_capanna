<?php
/* Smarty version 4.3.4, created on 2025-07-08 16:43:31
  from 'C:\xampp\htdocs\Pancia_mia_fatti_capanna\templates\aggiungi_ordine.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_686d2e93147e85_50759529',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0244777d4ad2e5d39c3dbd4532202d94dbe6d12' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\templates\\aggiungi_ordine.tpl',
      1 => 1751985809,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_686d2e93147e85_50759529 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h1>Aggiungi Ordine</h1>

<?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
  <div style="color:red;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['success']->value) {?>
  <div style="color:green;"><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
</div>
<?php }?>

<form method="POST" action="aggiungi_ordine.php">
  <h3>Seleziona i piatti e le quantità:</h3>

  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
    <div style="margin-bottom:15px;">
      <input type="checkbox" name="piatti[<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
][selected]" value="1" id="p<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
"> 
      <label for="p<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
"><strong><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</strong> - €<?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>
</label><br>
      <small><?php echo $_smarty_tpl->tpl_vars['product']->value['description'];?>
</small><br>
      Quantità: <input type="number" name="piatti[<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
][qty]" min="1" value="1" style="width:60px;" disabled>
    </div>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

  <button type="submit">Invia Ordine</button>
</form>


<?php echo '<script'; ?>
>
  document.querySelectorAll('input[type=checkbox][name^="piatti"]').forEach(chk => {
    chk.addEventListener('change', function() {
      const id = this.id.replace('p', '');
      const qtyInput = document.querySelector(`input[name="piatti[${id}][qty]"]`);
      if (this.checked) {
        qtyInput.disabled = false;
        qtyInput.value = 1;
      } else {
        qtyInput.disabled = true;
        qtyInput.value = '';
      }
    });
  });
<?php echo '</script'; ?>
>


<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
