<?php
/* Smarty version 5.5.1, created on 2025-07-13 04:43:46
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/edit_product.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68731d625a4091_10168914',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '048b6208294cbdad2458c4e355913f830087223d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/edit_product.tpl',
      1 => 1752373716,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68731d625a4091_10168914 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Prodotto - <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</title>

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
            <h1>Modifica Prodotto</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Edit Product Section ======= -->
    <section class="contact">
        <div class="container">

            <div class="php-email-form bg-white p-4 shadow-sm mx-auto" style="max-width: 600px;">
                <form action="/Pancia_mia_fatti_capanna/Product/update" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('product')->getIdProduct();?>
">

                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nome Prodotto</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getName(), ENT_QUOTES, 'UTF-8', true);?>
" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getDescription(), ENT_QUOTES, 'UTF-8', true);?>
</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="price" class="form-label">Prezzo (€)</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getPrice(), ENT_QUOTES, 'UTF-8', true);?>
" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-get-started w-100">Salva Modifiche</button>
                </form>

                <div class="text-center mt-3">
                    <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary">Annulla e torna al Menù</a>
                </div>
            </div>

        </div>
    </section><!-- End Edit Product Section -->

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
