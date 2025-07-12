<?php
/* Smarty version 5.5.1, created on 2025-07-12 12:33:06
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/admin_profile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_687239e2c1bcd1_92299090',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ea6329c055cc585dbcf8920e05755d5f53471fc6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/admin_profile.tpl',
      1 => 1752313802,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_687239e2c1bcd1_92299090 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>
<!DOCTYPE html>
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
    <header id="header" class="header d-flex align-items-center mb-5">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <main>
        <div class="container" style="max-width: 1100px;">
            <div class="surface p-4 rounded shadow-sm">
                <h1 class="text-center mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">
                    Pannello di Controllo
                </h1>

                <div class="mb-5">
                    <h2 class="h4" style="color: var(--heading-color); font-family: var(--heading-font);">Dati del Proprietario</h2>
                    <p><strong>Nome Completo:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('admin')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('admin')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('admin')->getEmail(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                </div>

                <div class="row g-4 justify-content-center dashboard-buttons">
                    <div class="col-md-5">
                        <div class="p-3 rounded border h-100" style="background-color: var(--surface-color);">
                            <h3 class="h5 mb-3" style="color: var(--heading-color); font-family: var(--heading-font);">Gestione Ristorante</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="/Pancia_mia_fatti_capanna/Table/listAll" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Tavoli e Sale</a></li>
                                <li class="mb-2"><a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Menù e Prodotti</a></li>
                                <li class="mb-2"><a href="/Pancia_mia_fatti_capanna/Admin/showReservations" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Prenotazioni</a></li>
                                <li><a href="/Pancia_mia_fatti_capanna/Admin/showOrders" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Ordini</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="p-3 rounded border h-100" style="background-color: var(--surface-color);">
                            <h3 class="h5 mb-3" style="color: var(--heading-color); font-family: var(--heading-font);">Gestione Utenti</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="/Pancia_mia_fatti_capanna/Admin/manageClients" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Clienti</a></li>
                                <li><a href="/Pancia_mia_fatti_capanna/Waiter/manage" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Camerieri</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary me-2">Torna alla Home</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">Logout</a>
                </div>
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
