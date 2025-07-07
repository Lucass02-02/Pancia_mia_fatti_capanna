<?php
/* Smarty version 5.5.1, created on 2025-07-06 03:06:29
  from 'file:registration.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6869cc1544ea49_51851600',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b2311ddc3b69c4fa56ea6c2f84abc624fc3b6cba' => 
    array (
      0 => 'registration.tpl',
      1 => 1751762498,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6869cc1544ea49_51851600 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione - Pancia mia fatti capanna</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 2em 0; }
        .container { background-color: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 100%; max-width: 450px; }
        h1 { text-align: center; color: #333; }
        .form-group { margin-bottom: 1em; }
        label { display: block; margin-bottom: 0.5em; color: #555; }
        input { width: 100%; padding: 0.8em; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 1em; background-color: #e8491d; color: white; border: none; border-radius: 4px; font-size: 1em; cursor: pointer; }
        button:hover { background-color: #d7380c; }
        .message { padding: 1em; margin-bottom: 1em; border-radius: 4px; text-align: center; }
        .message.success { background-color: #d4edda; color: #155724; }
        .message.error { background-color: #f8d7da; color: #721c24; }
        nav { text-align: center; margin-top: 1em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrati</h1>

                <?php if ((true && ($_smarty_tpl->hasVariable('message') && null !== ($_smarty_tpl->getValue('message') ?? null)))) {?>
            <div class="message <?php if ((true && ($_smarty_tpl->hasVariable('success') && null !== ($_smarty_tpl->getValue('success') ?? null))) && $_smarty_tpl->getValue('success')) {?>success<?php } else { ?>error<?php }?>">
                <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('message'), ENT_QUOTES, 'UTF-8', true);?>

            </div>
        <?php }?>

        <form action="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'client','action'=>'registration'), $_smarty_tpl);?>
" method="POST">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="surname">Cognome</label>
                <input type="text" id="surname" name="surname" required>
            </div>
            <div class="form-group">
                <label for="birthDate">Data di Nascita</label>
                <input type="date" id="birthDate" name="birthDate" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Numero di Telefono (Opzionale)</label>
                <input type="tel" id="phoneNumber" name="phoneNumber">
            </div>
            <div class="form-group">
                <label for="nickname">Nickname (Opzionale)</label>
                <input type="text" id="nickname" name="nickname">
            </div>
            <button type="submit">Registrati</button>
        </form>
        <nav>
            <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'home','action'=>'home'), $_smarty_tpl);?>
">Torna alla Home</a>
        </nav>
    </div>
</body>
</html><?php }
}
