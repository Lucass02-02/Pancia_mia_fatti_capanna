<?php
/* Smarty version 5.5.1, created on 2025-07-12 16:00:58
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/order_not_approved.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68726a9a3ac7f3_97074604',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0b8797b424db8a8cfa1a67119799ceb4b2089bda' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/order_not_approved.tpl',
      1 => 1752315658,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68726a9a3ac7f3_97074604 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errore Ordine</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body class="bg-light">

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <!-- ======= Content ======= -->
    <main>
        <div class="container" style="max-width: 450px;">
            <div class="surface p-4 rounded shadow-sm text-center">
                <h2 class="mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">
                    Il cameriere non ha ancora abilitato l'ordinazione
                </h2>

                <img src="https://dalappleblush.wordpress.com/wp-content/uploads/2016/08/gif_failed-waiter.gif"
                     alt="Errore" class="img-fluid mb-4 rounded" style="max-width: 350px;">

                <a href="/Pancia_mia_fatti_capanna/Home/home"
                   class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">
                    Torna alla Home
                </a>
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
