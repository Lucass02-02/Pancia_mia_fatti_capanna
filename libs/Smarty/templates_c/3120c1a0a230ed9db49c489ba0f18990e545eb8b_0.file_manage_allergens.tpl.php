<?php
/* Smarty version 5.5.1, created on 2025-07-09 03:27:26
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_allergens.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686dc57ea39e09_53890874',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3120c1a0a230ed9db49c489ba0f18990e545eb8b' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_allergens.tpl',
      1 => 1752024441,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686dc57ea39e09_53890874 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Allergeni</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">     <style>
        /* Stili aggiuntivi o sovrascritture per questa pagina */
        .container { max-width: 800px; margin: 30px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .table-responsive { margin-top: 20px; }
        .table th, .table td { vertical-align: middle; }
        .btn-group { display: flex; gap: 5px; }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <h1 class="text-primary text-center mb-4">Gestione Allergeni</h1>

        <div class="mb-4">
            <h2 class="h4 text-secondary mb-3">Aggiungi Nuovo Allergene</h2>
            <form action="/Pancia_mia_fatti_capanna/Allergen/create" method="POST" class="d-flex gap-2">
                <input type="text" name="name" class="form-control" placeholder="Nome Allergene (es. Glutine)" required>
                <button type="submit" class="btn btn-primary">Aggiungi</button>
            </form>
        </div>

        <div class="table-responsive">
            <h2 class="h4 text-secondary mb-3">Elenco Allergeni Esistenti</h2>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('allergens')) > 0) {?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome Allergene</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allergens'), 'allergen');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('allergen')->value) {
$foreach0DoElse = false;
?>
                            <tr>
                                <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('allergen')->getId(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('allergen')->getAllergenType(), ENT_QUOTES, 'UTF-8', true);?>
</td>                                 <td>
                                    <div class="btn-group">
                                                                                                                        <form action="/Pancia_mia_fatti_capanna/Allergen/delete/<?php echo $_smarty_tpl->getValue('allergen')->getId();?>
" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare l\'allergene <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('allergen')->getAllergenType(), ENT_QUOTES, 'UTF-8', true);?>
?');">
                                            <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>Nessun allergene trovato. Aggiungine uno nuovo!</p>
            <?php }?>
        </div>

        <div class="text-center mt-4">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary me-2">Torna alla Home</a>
        </div>
    </div>
</body>
</html><?php }
}
