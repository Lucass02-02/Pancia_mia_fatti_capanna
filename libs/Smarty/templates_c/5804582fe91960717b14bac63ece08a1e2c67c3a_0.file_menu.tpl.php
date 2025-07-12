<?php
/* Smarty version 5.5.1, created on 2025-07-12 13:48:55
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/menu.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68724ba7819ee6_90302984',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5804582fe91960717b14bac63ece08a1e2c67c3a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/menu.tpl',
      1 => 1752320933,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68724ba7819ee6_90302984 (\Smarty\Template $_smarty_tpl) {
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

<body class="bg-light">

<header id="header" class="header d-flex align-items-center mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
            <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
        </div>
    </div>
</header>

<section class="page-title" style="
    background: url('https://img.freepik.com/vettori-gratuito/menu-ristorante-digitale-in-formato-verticale_23-2148649586.jpg') center top / cover no-repeat;
    height: 350px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 30px;
    position: relative;
">
    <div style="
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
    "></div>

    <h1 style="
        position: relative;
        color: white;
        font-family: var(--heading-font);
        font-size: 2.5rem;
        text-align: center;
        z-index: 2;
        margin: 0;
    ">
        Il Nostro Menù
    </h1>
</section>

<main>
    <div class="container my-5" style="max-width: 1100px;">
        <div class="surface p-4 rounded shadow-sm">

                        <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                <div class="text-center mb-4 d-flex flex-wrap justify-content-center gap-3">
                    <a href="/Pancia_mia_fatti_capanna/Product/showCreateForm" class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">Aggiungi Nuovo Prodotto</a>
                    <a href="/Pancia_mia_fatti_capanna/Allergen/manage" class="btn btn-secondary">Gestisci Allergeni</a>
                    <a href="/Pancia_mia_fatti_capanna/Product/manageCategories" class="btn btn-secondary">Gestisci Categorie Prodotti</a>
                </div>
            <?php }?>

                        <?php if ($_smarty_tpl->getValue('user_role') == 'client') {?>
                <div class="bg-white p-4 rounded shadow-sm mb-4 border">
                    <h2 class="h5 mb-3">Filtra per allergeni (mostra piatti senza):</h2>
                    <form action="/Pancia_mia_fatti_capanna/Home/menu" method="post" class="row g-3 align-items-end">
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
                            <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary ms-2">Rimuovi Filtro</a>
                        </div>
                    </form>
                </div>
            <?php }?>

                        <?php if (( !$_smarty_tpl->hasVariable('products') || empty($_smarty_tpl->getValue('products')))) {?>
                <p class="text-center text-muted">Nessun piatto disponibile.</p>
            <?php } else { ?>
                <div class="row g-4">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach1DoElse = false;
?>
                        <div class="col-md-4">
                            <div class="card h-100 <?php if (!$_smarty_tpl->getValue('product')->isAvailable()) {?>opacity-50 bg-light<?php }?>">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title" style="color: var(--heading-color); font-family: var(--heading-font);"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</h5>
                                    <p class="card-text"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getDescription(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                    <p class="fw-bold">€ <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('product')->getPrice(),2,",",".");?>
</p>

                                                                        <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                                        <div class="d-flex flex-wrap gap-2 mt-auto">
                                            <a href="/Pancia_mia_fatti_capanna/Product/showEditForm/<?php echo $_smarty_tpl->getValue('product')->getIdProduct();?>
" class="btn btn-warning btn-sm">Modifica</a>
                                            <?php if ($_smarty_tpl->getValue('product')->isAvailable()) {?>
                                                <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/<?php echo $_smarty_tpl->getValue('product')->getIdProduct();?>
" class="btn btn-secondary btn-sm">Rendi Non Disp.</a>
                                            <?php } else { ?>
                                                <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/<?php echo $_smarty_tpl->getValue('product')->getIdProduct();?>
" class="btn btn-success btn-sm">Rendi Disp.</a>
                                            <?php }?>
                                            <a href="/Pancia_mia_fatti_capanna/Product/delete/<?php echo $_smarty_tpl->getValue('product')->getIdProduct();?>
" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo prodotto?');">Elimina</a>
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

                        <div class="text-center mt-5 d-flex justify-content-center gap-3">
                <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
                <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                    <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">Torna al Pannello di Controllo</a>
                <?php }?>
            </div>
        </div>
    </div>
</main>

<footer id="footer" class="footer mt-5">
    <div class="container text-center">
        <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
    </div>
</footer>

<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
