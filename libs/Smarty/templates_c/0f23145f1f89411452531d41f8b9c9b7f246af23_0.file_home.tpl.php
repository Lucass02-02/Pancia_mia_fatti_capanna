<?php
/* Smarty version 5.5.1, created on 2025-07-08 16:34:21
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686d2c6d65bf84_47623669',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0f23145f1f89411452531d41f8b9c9b7f246af23' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/home.tpl',
      1 => 1751985182,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686d2c6d65bf84_47623669 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Pancia mia fatti capanna' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</title>
    <style>
        body { font-family: sans-serif; text-align: center; margin-top: 50px; }
        h1 { color: #333; }
        p { color: #666; }
        nav { margin-top: 20px; font-size: 1.2em; }
        nav a { margin: 0 15px; text-decoration: none; color: #e8491d; }
    </style>
</head>
<body>
    <h1><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('titolo'), ENT_QUOTES, 'UTF-8', true);?>
</h1>
    <p><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('messaggio'), ENT_QUOTES, 'UTF-8', true);?>
</p>
    <nav>
        <a href="/Pancia_mia_fatti_capanna/Home/home">Home</a> |
        <a href="/Pancia_mia_fatti_capanna/Home/menu">Visualizza Menù</a> |
        <a href="/Pancia_mia_fatti_capanna/Review/showAll">Vedi le Recensioni</a> |

        <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
            <a href="/Pancia_mia_fatti_capanna/Admin/profile">Pannello di Controllo</a> |
            <a href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a>
        <?php } elseif ($_smarty_tpl->getValue('user_role') == 'client') {?>
            <a href="/Pancia_mia_fatti_capanna/Client/profile">Mio Profilo</a> |
            <a href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a>
        <?php } elseif ($_smarty_tpl->getValue('user_role') == 'waiter') {?>
            <a href="/Pancia_mia_fatti_capanna/Waiter/profile">Dashboard Cameriere</a> |
            <a href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a>
        <?php } else { ?>
            <a href="/Pancia_mia_fatti_capanna/Client/login">Login</a> |
            <a href="/Pancia_mia_fatti_capanna/Client/registration">Registrati</a>
        <?php }?>
    </nav>
</body>
</html>
<?php }
}
