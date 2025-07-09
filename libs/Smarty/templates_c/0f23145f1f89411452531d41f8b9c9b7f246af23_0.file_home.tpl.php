<?php
/* Smarty version 5.5.1, created on 2025-07-09 02:22:46
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686db656c061e4_01571089',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0f23145f1f89411452531d41f8b9c9b7f246af23' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/home.tpl',
      1 => 1752012840,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686db656c061e4_01571089 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Pancia mia fatti capanna' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="display-4 text-center mb-4"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('titolo'), ENT_QUOTES, 'UTF-8', true);?>
</h1>
        <p class="lead text-center"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('messaggio'), ENT_QUOTES, 'UTF-8', true);?>
</p>

        <nav class="nav justify-content-center mt-4">
            <a class="nav-link" href="/Pancia_mia_fatti_capanna/Home/home">Home</a>
            <a class="nav-link" href="/Pancia_mia_fatti_capanna/Home/menu">Visualizza Menù</a>
            <a class="nav-link" href="/Pancia_mia_fatti_capanna/Review/showAll">Vedi le Recensioni</a>

            <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Admin/profile">Pannello di Controllo</a>
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a>
            <?php } elseif ($_smarty_tpl->getValue('user_role') == 'client') {?>
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Client/profile">Mio Profilo</a>
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a>
            <?php } elseif ($_smarty_tpl->getValue('user_role') == 'waiter') {?>
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Waiter/profile">Dashboard Cameriere</a>
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a>
            <?php } else { ?>
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Client/login">Login</a>
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Client/registration">Registrati</a>
            <?php }?>
        </nav>
    </div>
</body>
</html>
<?php }
}
