<?php
/* Smarty version 5.5.1, created on 2025-07-10 17:47:10
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/waiter_profile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686fe07e808da1_31412962',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7095e82e231c2743f100bf04fc2cfa6466117332' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/waiter_profile.tpl',
      1 => 1752161259,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686fe07e808da1_31412962 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Cameriere - <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 900px;">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1 class="text-primary text-center mb-4">Ciao, <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('waiter')->getName(), ENT_QUOTES, 'UTF-8', true);?>
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
                                <button class="btn btn-secondary w-100" disabled>Visualizza Prenotazioni</button>
                            </li>
                            <li>
                                <button class="btn btn-secondary w-100" disabled>Visualizza Ordini</button>
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
</body>
</html>
<?php }
}
