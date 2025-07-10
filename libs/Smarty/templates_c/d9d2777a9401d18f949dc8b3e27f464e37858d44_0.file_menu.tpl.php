<?php
/* Smarty version 5.5.1, created on 2025-07-10 18:23:57
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/menu.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686fe91dc95380_67708107',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd9d2777a9401d18f949dc8b3e27f464e37858d44' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/menu.tpl',
      1 => 1752164308,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686fe91dc95380_67708107 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
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
    <header id="header" class="header d-flex align-items-center">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/index">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <!-- ======= Page Title Section ======= -->
    <section class="page-title">
        <div class="container">
            <h1>Il Nostro Menù</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Menu Section ======= -->
    <section class="menu">
        <div class="container">

                        <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                <div class="text-center mb-4">
                    <a href="/Pancia_mia_fatti_capanna/Product/showCreateForm" class="btn btn-get-started mx-1">Aggiungi Nuovo Prodotto</a>
                    <a href="/Pancia_mia_fatti_capanna/Allergen/manage" class="btn btn-get-started mx-1">Gestisci Allergeni</a>
                    <a href="/Pancia_mia_fatti_capanna/Product/manageCategories" class="btn btn-get-started mx-1">Gestisci Categorie Prodotti</a>
                </div>
            <?php }?>

                        <div class="php-email-form bg-white p-4 shadow-sm mb-5">
                <h3 class="text-secondary">Filtra per allergeni (mostra piatti senza):</h3>
                <form action="/Pancia_mia_fatti_capanna/Home/menu" method="POST">
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
                        <button type="submit" class="btn btn-get-started">Applica Filtro</button>
                        <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary ms-2">Rimuovi Filtro</a>
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
                            <div class="menu-item card h-100 <?php if ($_smarty_tpl->getValue('user_role') == 'admin' && !$_smarty_tpl->getValue('product')->isAvailable()) {?>opacity-50 bg-light<?php }?>">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</h5>
                                    <p class="card-text"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getDescription(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                    <p class="price">€ <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('product')->getPrice(),2,",",".");?>
</p>

                                                                        <?php if ($_smarty_tpl->getValue('user_role') == 'client') {?>
                                        <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST" class="mt-auto">
                                            <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('product')->getId();?>
">
                                            <div class="input-group">
                                                <input type="number" name="quantity" value="1" min="1" max="99" class="form-control" aria-label="Quantità">
                                                <button type="submit" class="btn btn-get-started">Aggiungi</button>
                                            </div>
                                        </form>
                                    <?php } elseif (!$_smarty_tpl->getValue('user_id')) {?>
                                        <p class="text-danger mt-auto">Devi accedere per poter ordinare!</p>
                                    <?php }?>

                                                                        <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                                        <div class="d-flex flex-wrap gap-2 mt-3">
                                            <a href="/Pancia_mia_fatti_capanna/Product/showEditForm/<?php echo $_smarty_tpl->getValue('product')->getId();?>
" class="btn btn-warning btn-sm">Modifica</a>
                                            <?php if ($_smarty_tpl->getValue('product')->isAvailable()) {?>
                                                <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/<?php echo $_smarty_tpl->getValue('product')->getId();?>
" class="btn btn-secondary btn-sm">Rendi Non Disp.</a>
                                            <?php } else { ?>
                                                <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/<?php echo $_smarty_tpl->getValue('product')->getId();?>
" class="btn btn-success btn-sm">Rendi Disp.</a>
                                            <?php }?>
                                            <a href="/Pancia_mia_fatti_capanna/Product/delete/<?php echo $_smarty_tpl->getValue('product')->getId();?>
" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo prodotto? L\'azione è irreversibile.');">Elimina</a>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </div>
            <?php }?>

                        <div class="text-center mt-5">
                <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
                <?php if ($_smarty_tpl->getValue('user_role') == 'client') {?>
                    <a href="/Pancia_mia_fatti_capanna/Cart/view" class="btn btn-get-started ms-2">Vai al Carrello</a>
                <?php } elseif ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                    <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary ms-2">Torna al Pannello di Controllo</a>
                <?php }?>
            </div>

        </div>
    </section><!-- End Menu Section -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
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
