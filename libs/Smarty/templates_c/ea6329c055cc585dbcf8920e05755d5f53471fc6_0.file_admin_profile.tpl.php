<?php
/* Smarty version 5.5.1, created on 2025-07-10 19:51:11
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/admin_profile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686ffd8f5bfa69_31075213',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ea6329c055cc585dbcf8920e05755d5f53471fc6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/admin_profile.tpl',
      1 => 1752169869,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686ffd8f5bfa69_31075213 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannello di Controllo</title>

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
            <h1>Pannello di Controllo</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Admin Profile Section ======= -->
    <section class="section">
        <div class="container">

            <div class="php-email-form bg-white p-4 shadow-sm mx-auto" style="max-width: 800px;">
                <div class="mb-4">
                    <h2 class="h4">Dati del Proprietario</h2>
                    <p><strong>Nome Completo:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('admin')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('admin')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('admin')->getEmail(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="icon-box">
                            <i class="bi bi-shop"></i>
                            <h4>Gestione Ristorante</h4>
                            <ul class="list-unstyled">
                            <div class="mb-2"><a href="/Pancia_mia_fatti_capanna/Table/listAll" class="btn btn-info">Gestisci Tavoli</a></div>
                            <div class="mb-2"><a href="/Pancia_mia_fatti_capanna/RestaurantHall/manage" class="btn btn-info">Gestisci Banchetto</a></div>
                            <div class="mb-2"><a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-info">Gestisci Menù e Prodotti</a></div></div>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="icon-box">
                            <i class="bi bi-people"></i>
                            <h4>Gestione Utenti</h4>
                            <ul class="list-unstyled">
                                <div class="mb-2"><a href="/Pancia_mia_fatti_capanna/Admin/manageClients" class="btn btn-info">Gestisci Clienti</a></div>
                                <div class="mb-2"><a href="/Pancia_mia_fatti_capanna/Waiter/manage" class="btn btn-info">Gestisci Camerieri</a></div>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary me-2">Torna alla Home</a>
                </div>
            </div>

        </div>
    </section><!-- End Admin Profile Section -->

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
