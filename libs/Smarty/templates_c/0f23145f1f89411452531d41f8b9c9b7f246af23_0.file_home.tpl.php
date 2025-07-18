<?php
/* Smarty version 5.5.1, created on 2025-07-12 18:17:24
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68728a94bed319_51198549',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0f23145f1f89411452531d41f8b9c9b7f246af23' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/home.tpl',
      1 => 1752330409,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68728a94bed319_51198549 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Pancia mia fatti capanna' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
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


    <!-- ======= Hero Section ======= -->
    <section class="hero d-flex align-items-center">
        <div class="container text-center">
            <h1><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('titolo'), ENT_QUOTES, 'UTF-8', true);?>
</h1>
            <p><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('messaggio'), ENT_QUOTES, 'UTF-8', true);?>
</p>

            <div class="mt-4 d-flex justify-content-center flex-wrap">
                <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-get-started mx-2 my-2">Visualizza Menù</a>
                <a href="/Pancia_mia_fatti_capanna/Review/showAll" class="btn btn-get-started mx-2 my-2">Vedi le Recensioni</a>
                <a href="/Pancia_mia_fatti_capanna/Client/login" class="btn btn-get-started mx-2 my-2">Login</a>
                
                

                <?php if ($_smarty_tpl->getValue('user_role') == null) {?>
                    <a href="/Pancia_mia_fatti_capanna/Client/reserve" class="btn btn-get-started mx-2 my-2">Prenota</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/registration" class="btn btn-get-started mx-2 my-2">Registrati</a>
                <?php } elseif ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                    <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-get-started mx-2 my-2">Pannello di Controllo</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-get-started mx-2 my-2">Logout</a>
                <?php } elseif ($_smarty_tpl->getValue('user_role') == 'client') {?>
                    <a href="/Pancia_mia_fatti_capanna/Client/profile" class="btn btn-get-started mx-2 my-2">Mio Profilo</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-get-started mx-2 my-2">Logout</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/order" class="btn btn-get-started mx-2 my-2">Ordina</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/reserve" class="btn btn-get-started mx-2 my-2">Prenota</a>
                <?php } elseif ($_smarty_tpl->getValue('user_role') == 'waiter') {?>
                    <a href="/Pancia_mia_fatti_capanna/Waiter/profile" class="btn btn-get-started mx-2 my-2">Dashboard Cameriere</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-get-started mx-2 my-2">Logout</a>
                <?php }?>
            </div>
        </div>
    </section><!-- End Hero Section -->
<section class="my-5" style="background: url('/Pancia_mia_fatti_capanna/images/ristorantino.jpg') center center / cover no-repeat; height: 400px;">
  <div class="text-center text-white d-flex flex-column justify-content-center align-items-center h-100" style="background-color: rgba(0,0,0,0.4);">
    <h1 style="color:bisque">Benvenuto al Ristorante</h1>
    <p>Tradizione e gusto dal 1980</p>
  </div>
</section>

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
