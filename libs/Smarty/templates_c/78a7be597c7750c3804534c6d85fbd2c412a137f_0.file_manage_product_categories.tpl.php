<?php
/* Smarty version 5.5.1, created on 2025-07-12 14:01:23
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/manage_product_categories.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68724e93575c54_77207712',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '78a7be597c7750c3804534c6d85fbd2c412a137f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/manage_product_categories.tpl',
      1 => 1752313802,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68724e93575c54_77207712 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Categorie Prodotti - Pancia mia fatti capanna</title>

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
            <h1>Gestione Categorie Prodotti</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Manage Categories Section ======= -->
    <section class="contact">
        <div class="container" style="max-width: 800px;">

            <!-- Aggiungi nuova categoria -->
            <div class="php-email-form bg-white p-4 shadow-sm mb-5">
                <h3 class="text-secondary mb-3">Aggiungi Nuova Categoria</h3>
                <form action="/Pancia_mia_fatti_capanna/Product/createCategory" method="POST" class="d-flex gap-2 flex-wrap">
                    <input type="text" class="form-control" name="name" placeholder="Nome nuova categoria" required>
                    <button class="btn btn-get-started" type="submit">Aggiungi Categoria</button>
                </form>
            </div>

            <!-- Elenco categorie esistenti -->
            <div class="php-email-form bg-white p-4 shadow-sm">
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
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <!-- Form modifica categoria -->
                                <form action="/Pancia_mia_fatti_capanna/Product/updateCategory" method="POST" class="d-flex flex-grow-1 gap-2 align-items-center">
                                    <input type="hidden" name="category_id" value="<?php echo $_smarty_tpl->getValue('category')->getId();?>
">
                                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('category')->getName(), ENT_QUOTES, 'UTF-8', true);?>
" required>
                                    <button class="btn btn-warning btn-sm" type="submit">Modifica</button>
                                </form>

                                <!-- Form elimina categoria -->
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

            <!-- Pulsante torna al menu -->
            <div class="text-center mt-4">
                <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary">Torna al Menu</a>
            </div>

        </div>
    </section><!-- End Manage Categories Section -->

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
