<?php
/* Smarty version 5.5.1, created on 2025-07-09 23:17:42
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_product_categories.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686edc76a27441_23835256',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e0879d82dd272c4b5dbf542ff0bfd364ceeab24' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_product_categories.tpl',
      1 => 1752095860,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686edc76a27441_23835256 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Categorie Prodotti - Pancia mia fatti capanna</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-primary text-center mb-4">Gestione Categorie Prodotti</h1>

                <div class="bg-white p-4 rounded shadow-sm mb-5">
            <h3 class="text-secondary mb-3">Aggiungi Nuova Categoria</h3>
            <form action="/Pancia_mia_fatti_capanna/Product/createCategory" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Nome nuova categoria" required>
                    <button class="btn btn-primary" type="submit">Aggiungi Categoria</button>
                </div>
            </form>
        </div>

                <div class="bg-white p-4 rounded shadow-sm">
            <h3 class="text-secondary mb-3">Categorie Esistenti</h3>
            <?php if (( !$_smarty_tpl->hasVariable('categories') || empty($_smarty_tpl->getValue('categories')))) {?>
                <p class="text-center text-muted">Nessuna categoria trovata.</p>
            <?php } else { ?>
                <ul class="list-group">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('categories'), 'category');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('category')->value) {
$foreach0DoElse = false;
?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <form action="/Pancia_mia_fatti_capanna/Product/updateCategory" method="POST" class="d-flex flex-grow-1 align-items-center">
                                <input type="hidden" name="category_id" value="<?php echo $_smarty_tpl->getValue('category')->getId();?>
">
                                <input type="text" class="form-control me-2" name="name" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('category')->getName(), ENT_QUOTES, 'UTF-8', true);?>
" required>
                                <button class="btn btn-warning btn-sm" type="submit">Modifica</button>
                            </form>
                            
                                                        <form action="/Pancia_mia_fatti_capanna/Product/deleteCategory/<?php echo $_smarty_tpl->getValue('category')->getId();?>
" method="POST" class="ms-2">
                                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Sei sicuro di voler eliminare questa categoria? Tutti i prodotti associati a questa categoria potrebbero perdere il loro riferimento alla categoria.');">Elimina</button>
                            </form>
                        </li>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </ul>
            <?php }?>
        </div>

                <div class="text-center mt-4">
            <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary">Torna al Menu</a>
        </div>
    </div>
</body>
</html><?php }
}
