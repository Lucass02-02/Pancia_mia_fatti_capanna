<?php
/* Smarty version 5.5.1, created on 2025-07-12 13:20:58
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/add_review.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6872451aab5fa2_72449406',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd66a7e103275d751eee4660508db02a8acf7d924' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/add_review.tpl',
      1 => 1752319257,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6872451aab5fa2_72449406 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lascia una Recensione</title>

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

    <!-- ======= Hero Image Section (Centrata) ======= -->
    <section class="d-flex justify-content-center align-items-center my-4">
        <img src="/Pancia_mia_fatti_capanna/images/recensioni.png" alt="Recensioni" class="img-fluid" style="max-width: 400px; height: auto;">
    </section>

    <!-- ======= Page Title Section ======= -->
    <section class="page-title">
        <div class="container text-center">
            <h1>La Tua Opinione Conta!</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Add Review Section ======= -->
    <section class="contact">
        <div class="container">

            <div class="php-email-form bg-white p-4 shadow-sm mx-auto" style="max-width: 500px;">
                <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
                    <div class="error-message text-center"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>
</div>
                <?php }?>

                <form action="/Pancia_mia_fatti_capanna/Client/addReview" method="POST">
                    <div class="form-group mb-3">
                        <label for="rating" class="form-label">Voto (da 1 a 5)</label>
                        <select id="rating" name="rating" class="form-select" required>
                            <option value="">Seleziona un voto</option>
                            <option value="5">5 - Eccellente</option>
                            <option value="4">4 - Molto Buono</option>
                            <option value="3">3 - Buono</option>
                            <option value="2">2 - Sufficiente</option>
                            <option value="1">1 - Insufficiente</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="comment" class="form-label">Commento</label>
                        <textarea id="comment" name="comment" rows="5" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-get-started w-100">Invia Recensione</button>
                </form>
            </div>

        </div>
    </section><!-- End Add Review Section -->

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
