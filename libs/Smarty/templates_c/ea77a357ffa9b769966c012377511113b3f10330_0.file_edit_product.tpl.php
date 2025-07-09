<?php
/* Smarty version 5.5.1, created on 2025-07-09 03:07:43
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/edit_product.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686dc0df573b34_67485476',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ea77a357ffa9b769966c012377511113b3f10330' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/edit_product.tpl',
      1 => 1752012840,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686dc0df573b34_67485476 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Prodotto - <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container p-4 bg-white rounded shadow-sm" style="max-width: 600px;">
        <h1 class="text-center text-primary mb-4">Modifica Prodotto</h1>
        <form action="/Pancia_mia_fatti_capanna/Product/update" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('product')->getId();?>
">
            
            <div class="mb-3">
                <label for="name" class="form-label">Nome Prodotto</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getName(), ENT_QUOTES, 'UTF-8', true);?>
" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea id="description" name="description" class="form-control" rows="4" required><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getDescription(), ENT_QUOTES, 'UTF-8', true);?>
</textarea>
            </div>
            
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo (€)</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getPrice(), ENT_QUOTES, 'UTF-8', true);?>
" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Salva Modifiche</button>
        </form>
        <div class="text-center mt-3">
            <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary">Annulla e torna al Menù</a>
        </div>
    </div>
</body>
</html>
<?php }
}
