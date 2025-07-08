<?php
/* Smarty version 5.5.1, created on 2025-07-08 16:52:17
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686d30a11a3e93_37675616',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '778feedad9a3cae9f0c0766eb26af678b5c178ed' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/login.tpl',
      1 => 1751986331,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686d30a11a3e93_37675616 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pancia mia fatti capanna</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .container { background-color: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h1 { text-align: center; color: #333; }
        .form-group { margin-bottom: 1em; }
        label { display: block; margin-bottom: 0.5em; color: #555; }
        input { width: 100%; padding: 0.8em; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 1em; background-color: #e8491d; color: white; border: none; border-radius: 4px; font-size: 1em; cursor: pointer; margin-top: 0.5em; }
        button:hover { background-color: #d7380c; }
        .error { padding: 1em; margin-bottom: 1em; border-radius: 4px; text-align: center; background-color: #f8d7da; color: #721c24; }
        .button-link {
            display: block;
            text-align: center;
            margin-top: 1.5em;
            font-size: 1em;
            text-decoration: none;
            padding: 0.8em;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .button-link:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
            <div class="error"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>
</div>
        <?php }?>

        <form action="/Pancia_mia_fatti_capanna/Client/login" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Accedi</button>
        </form>

        <a href="/Pancia_mia_fatti_capanna/Home/home" class="button-link">Torna alla Home</a>
    </div>
</body>
</html>
<?php }
}
