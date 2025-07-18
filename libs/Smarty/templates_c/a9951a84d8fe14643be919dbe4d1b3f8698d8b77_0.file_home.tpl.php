<?php
/* Smarty version 5.5.1, created on 2025-07-12 19:56:54
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6872a1e6365539_95335135',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9951a84d8fe14643be919dbe4d1b3f8698d8b77' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/home.tpl',
      1 => 1752342874,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6872a1e6365539_95335135 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
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
                
                
                

                <?php if ($_smarty_tpl->getValue('user_role') == null) {?>
                    <a href="/Pancia_mia_fatti_capanna/Client/reserve" class="btn btn-get-started mx-2 my-2">Prenota</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/registration" class="btn btn-get-started mx-2 my-2">Registrati</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/login" class="btn btn-get-started mx-2 my-2">Login</a>
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
