<?php
/* Smarty version 5.5.1, created on 2025-07-13 03:47:57
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/menu_ordine.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6873104d208f98_70822987',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa784f40b1a37d8baef2c7abdfbb119a9477644d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/menu_ordine.tpl',
      1 => 1752371269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6873104d208f98_70822987 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Nostro Menù - Pancia mia fatti capanna</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <main>
        <div class="container" style="max-width: 1100px;">
            <div class="surface p-4 rounded shadow-sm">
                <h1 class="text-center mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">
                    Il Nostro Menù
                </h1>

                                <div class="bg-white p-4 rounded shadow-sm mb-5">
                    <h3 class="text-secondary" style="font-family: var(--heading-font);">Filtra per allergeni (mostra piatti senza):</h3>
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

                        <div class="mt-3 mb-4 d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary">Applica Filtro</button>
                        </div>
                    </form>

                    
                    <form method="post" action="/Pancia_mia_fatti_capanna/Client/order">
                        <input type="hidden" name="remove_filter" value="1">
                        <button type="submit" class="btn btn-secondary">Rimuovi Filtro</button>
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
                                        <h5 class="card-title" style="color: var(--heading-color); font-family: var(--heading-font);"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</h5>
                                        <p class="card-text"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getDescription(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                        <p class="fw-bold">€ <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('product')->getPrice(),2,",",".");?>
</p>

                                                                                <?php if ($_smarty_tpl->getValue('user_role') == 'client') {?>
                                            <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST" class="mt-auto">
                                                <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('product')->getIdProduct();?>
">
                                                <div class="input-group">
                                                    <input type="number" name="quantity" value="1" min="1" max="99" class="form-control" aria-label="Quantità">
                                                    <button type="submit" class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">Aggiungi</button>
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
                        <a href="/Pancia_mia_fatti_capanna/Cart/view" class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">Vai al Carrello</a>
                    <?php }?>
                </div>
            </div>
        </div>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer mt-5">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer><!-- End Footer -->

    <!-- Bootstrap JS -->
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>

</body>
</html>
<?php }
}
