<?php
/* Smarty version 5.5.1, created on 2025-07-11 19:33:02
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/menu_ordine.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68714ace608ab9_95832520',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bb64f324b022528e18885a722fbd4ddf65b2f52f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/menu_ordine.tpl',
      1 => 1752255179,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68714ace608ab9_95832520 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Nostro Menù - Pancia mia fatti capanna</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-primary text-center mb-4">Il Nostro Menu</h1>

                <div class="bg-white p-4 rounded shadow-sm mb-5">
            <h3 class="text-secondary">Filtra per allergeni (mostra piatti senza):</h3>
            <form action="/Pancia_mia_fatti_capanna/Client/order" method="POST">
                <div class="row">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allAllergens'), 'allergen');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('allergen')->value) {
$foreach0DoElse = false;
?>
                        <div class="col-md-3 col-sm-4 col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="allergens[]" value="<?php echo $_smarty_tpl->getValue('allergen')->getId();?>
"
                                    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('in_array')($_smarty_tpl->getValue('allergen')->getId(),$_smarty_tpl->getValue('selectedAllergens'))) {?>checked<?php }?> id="allergen<?php echo $_smarty_tpl->getValue('allergen')->getId();?>
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
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Applica Filtro</button>
                    <a href="/Pancia_mia_fatti_capanna/Client/order" class="btn btn-secondary ms-2">Rimuovi Filtro</a>
                </div>
            </form>
        </div>

                <?php if (( !$_smarty_tpl->hasVariable('products') || empty($_smarty_tpl->getValue('products')))) {?>
            <p class="text-center text-muted">Nessun piatto trovato con i filtri selezionati.</p>
        <?php } else { ?>
            <div class="row g-4">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach1DoElse = false;
?>
                    <div class="col-md-4">
                        <div class="card h-100 <?php if ($_smarty_tpl->getValue('user_role') == 'admin' && !$_smarty_tpl->getValue('product')->isAvailable()) {?>opacity-50 bg-light<?php }?>">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</h5>
                                <p class="card-text"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getDescription(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                <p class="fw-bold">€ <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('product')->getCost(),2,",",".");?>
</p>

                                
                                                                <?php if ($_smarty_tpl->getValue('user_role') == 'client') {?>
                                    <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST" class="mt-auto">
                                        <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('product')->getIdProduct();?>
">
                                        <div class="input-group">
                                            <input type="number" name="quantity" value="1" min="1" max="99" class="form-control" aria-label="Quantità">
                                            <button type="submit" class="btn btn-primary">Aggiungi</button>
                                        </div>
                                    </form>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>

                <div class="d-flex justify-content-center gap-3 mt-5">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
                        <?php if ($_smarty_tpl->getValue('user_role') == 'client') {?>
                <a href="/Pancia_mia_fatti_capanna/Cart/view" class="btn btn-primary">Vai al Carrello</a>
            <?php }?>
        </div>
    </div>
</body>
</html><?php }
}
