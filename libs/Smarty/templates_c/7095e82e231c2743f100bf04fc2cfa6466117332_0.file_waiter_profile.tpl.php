<?php
/* Smarty version 5.5.1, created on 2025-07-12 02:29:43
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/waiter_profile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6871ac77975e97_07506703',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7095e82e231c2743f100bf04fc2cfa6466117332' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/waiter_profile.tpl',
      1 => 1752280181,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6871ac77975e97_07506703 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Cameriere - <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</title>

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

    <main>
        <div class="container" style="max-width: 900px;">
            <div class="surface p-4 rounded shadow-sm">
                <h1 class="text-center mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">Ciao, <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getName(), ENT_QUOTES, 'UTF-8', true);?>
!</h1>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="border p-3 rounded h-100">
                            <h3 class="h5 text-secondary text-center mb-3">Le Tue Informazioni</h3>
                            <p><strong>Matricola:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getSerialNumber(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                            <p><strong>Sala Assegnata:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getRestaurantHall()->getName(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border p-3 rounded h-100">
                            <h3 class="h5 text-secondary text-center mb-3">Le Tue Funzioni</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <a href="/Pancia_mia_fatti_capanna/Waiter/viewTables" class="btn btn-primary w-100">Visualizza Stato Tavoli</a>
                                </li>
                                <li class="mb-2">
                                    <a href="/Pancia_mia_fatti_capanna/Waiter/viewReservation" class="btn btn-primary w-100">Visualizza Prenotazioni</a>
                                </li>
                                <li class="mb-2">
                                    <a href="/Pancia_mia_fatti_capanna/Waiter/viewOrder" class="btn btn-primary w-100">Visualizza Ordini</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-danger">Logout</a>
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
