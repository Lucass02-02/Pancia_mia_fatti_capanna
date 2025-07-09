<?php
/* Smarty version 5.5.1, created on 2025-07-09 03:21:29
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/create_product.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686dc41923deb1_45609607',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c63750a94277c33f0ff4250f286243df6f90b906' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/create_product.tpl',
      1 => 1752012840,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686dc41923deb1_45609607 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Crea Nuovo Prodotto</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container p-4 bg-white rounded shadow-sm" style="max-width: 600px;">
        <h1 class="text-center text-primary mb-4">Crea Nuovo Prodotto</h1>
        <form action="/Pancia_mia_fatti_capanna/Product/create" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nome Prodotto</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo (€)</label>
                <input type="number" id="price" name="price" step="0.01" min="0" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">Seleziona una categoria</option>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('categories'), 'category');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('category')->value) {
$foreach0DoElse = false;
?>
                        <option value="<?php echo $_smarty_tpl->getValue('category')->getId();?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('category')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</option>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Allergeni Presenti nel Piatto</label>
                <div class="border rounded p-3">
                    <div class="row">
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allAllergens'), 'allergen');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('allergen')->value) {
$foreach1DoElse = false;
?>
                            <div class="col-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergens[]" value="<?php echo $_smarty_tpl->getValue('allergen')->getId();?>
" id="allergen<?php echo $_smarty_tpl->getValue('allergen')->getId();?>
">
                                    <label class="form-check-label" for="allergen<?php echo $_smarty_tpl->getValue('allergen')->getId();?>
">
                                        <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('allergen')->getAllergenType(), ENT_QUOTES, 'UTF-8', true);?>

                                    </label>
                                </div>
                            </div>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-success w-100">Crea Prodotto</button>
        </form>
        <div class="text-center mt-3">
            <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary">Annulla</a>
        </div>
    </div>
</body>
</html>
<?php }
}
