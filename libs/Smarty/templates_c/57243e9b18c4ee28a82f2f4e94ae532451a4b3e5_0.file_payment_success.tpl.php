<?php
/* Smarty version 5.5.1, created on 2025-07-12 12:19:47
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/payment_success.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_687236c3354bc3_31960691',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57243e9b18c4ee28a82f2f4e94ae532451a4b3e5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/payment_success.tpl',
      1 => 1752315584,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_687236c3354bc3_31960691 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Completato</title>

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

    <!-- ======= Main Content ======= -->
    <main>
        <div class="container" style="max-width: 450px;">
            <div class="surface p-4 rounded shadow-sm text-center">
                <h2 class="mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">
                    Pagamento Completato!
                </h2>

                <img src="https://i.makeagif.com/media/5-07-2024/X0XqAg.gif"
                    alt="Successo" class="img-fluid rounded mb-4" style="max-width: 350px;">

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
