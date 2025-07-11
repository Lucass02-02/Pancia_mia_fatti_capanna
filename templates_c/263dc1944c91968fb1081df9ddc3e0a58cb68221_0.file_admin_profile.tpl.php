<?php
/* Smarty version 5.5.1, created on 2025-07-10 19:51:16
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/admin_profile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686ffd9431cb55_73236485',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '263dc1944c91968fb1081df9ddc3e0a58cb68221' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/admin_profile.tpl',
      1 => 1752169870,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686ffd9431cb55_73236485 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannello di Controllo</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow">
        <h1 class="text-center text-primary mb-4">Pannello di Controllo</h1>

        <div class="mb-5">
            <h2 class="h4 text-secondary">Dati del Proprietario</h2>
            <p><strong>Nome Completo:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('admin')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('admin')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
</p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('admin')->getEmail(), ENT_QUOTES, 'UTF-8', true);?>
</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-5">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Gestione Ristorante</h3>
                        <ul class="list-unstyled">
                            <li><a href="/Pancia_mia_fatti_capanna/Table/listAll" class="link-primary">Gestisci Tavoli e Sale</a></li>
                            <li><a href="/Pancia_mia_fatti_capanna/Home/menu" class="link-primary">Gestisci Menù e Prodotti</a></li>
                            <li><a href="/Pancia_mia_fatti_capanna/Admin/showReservations" class="link-primary">Gestisci Prenotazioni</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Gestione Utenti</h3>
                        <ul class="list-unstyled">
                            <li><a href="/Pancia_mia_fatti_capanna/Admin/manageClients" class="link-primary">Gestisci Clienti</a></li>
                            <li><a href="/Pancia_mia_fatti_capanna/Waiter/manage" class="link-primary">Gestisci Camerieri</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary me-2">Torna alla Home</a>
            <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>
<?php }
}
