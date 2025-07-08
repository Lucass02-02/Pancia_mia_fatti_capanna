<?php
/* Smarty version 5.5.1, created on 2025-07-06 03:13:11
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6869cda7520587_30154748',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1cb8c7a602de3842794846cdd5ca5c6527ae7bcb' => 
    array (
      0 => 'home.tpl',
      1 => 1751764360,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6869cda7520587_30154748 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/templates';
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
        <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'home','action'=>'home'), $_smarty_tpl);?>
">Home</a> |
        <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'home','action'=>'menu'), $_smarty_tpl);?>
">Visualizza Menù</a> |
        <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'review','action'=>'showAll'), $_smarty_tpl);?>
">Vedi le Recensioni</a> |

        <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
            <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'admin','action'=>'profile'), $_smarty_tpl);?>
">Pannello di Controllo</a> |
            <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'client','action'=>'logout'), $_smarty_tpl);?>
">Logout</a>
        <?php } elseif ($_smarty_tpl->getValue('user_role') == 'client') {?>
            <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'client','action'=>'profile'), $_smarty_tpl);?>
">Mio Profilo</a> |
            <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'client','action'=>'logout'), $_smarty_tpl);?>
">Logout</a>
        <?php } elseif ($_smarty_tpl->getValue('user_role') == 'waiter') {?>
            <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'waiter','action'=>'profile'), $_smarty_tpl);?>
">Dashboard Cameriere</a> |
            <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'client','action'=>'logout'), $_smarty_tpl);?>
">Logout</a>
        <?php } else { ?>
            <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'client','action'=>'login'), $_smarty_tpl);?>
">Login</a> |
            <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'client','action'=>'registration'), $_smarty_tpl);?>
">Registrati</a>
        <?php }?>
    </nav>
</body>
</html><?php }
}
