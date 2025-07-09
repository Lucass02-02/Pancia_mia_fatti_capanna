<?php
/* Smarty version 5.5.1, created on 2025-07-09 02:23:57
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_allergens.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686db69da44167_03861103',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3120c1a0a230ed9db49c489ba0f18990e545eb8b' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/manage_allergens.tpl',
      1 => 1752012840,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686db69da44167_03861103 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo di <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 900px;">
        <h1 class="text-primary text-center mb-4">Ciao, <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getName(), ENT_QUOTES, 'UTF-8', true);?>
!</h1>

        <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">I tuoi dati</h2>
            <p><strong>Nome Completo:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
</p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getEmail(), ENT_QUOTES, 'UTF-8', true);?>
</p>
            <p><strong>Data di Nascita:</strong> <?php echo $_smarty_tpl->getValue('client')->getBirthDate()->format('d/m/Y');?>
</p>
            <p><strong>Nickname:</strong> <?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('client')->getNickname() ?? null)===null||$tmp==='' ? 'Non impostato' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</p>
            <p><strong>Telefono:</strong> <?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('client')->getPhonenumber() ?? null)===null||$tmp==='' ? 'Non impostato' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</p>
        </div>

        <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">Le tue carte di credito</h2>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('creditCards')) > 0) {?>
                <ul class="list-group mb-3">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('creditCards'), 'card');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('card')->value) {
$foreach0DoElse = false;
?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('card')->getBrand(), ENT_QUOTES, 'UTF-8', true);?>
</strong> termina con **** <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('card')->getLast4(), ENT_QUOTES, 'UTF-8', true);?>

                                (Scade: <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('card')->getExpMonth(), ENT_QUOTES, 'UTF-8', true);?>
/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('card')->getExpYear(), ENT_QUOTES, 'UTF-8', true);?>
)
                            </span>
                            <form action="/Pancia_mia_fatti_capanna/Client/deleteCreditCard" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa carta?');">
                                <input type="hidden" name="card_id" value="<?php echo $_smarty_tpl->getValue('card')->getId();?>
">
                                <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                            </form>
                        </li>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </ul>
            <?php } else { ?>
                <p>Non hai ancora aggiunto nessuna carta di credito.</p>
            <?php }?>
            <a href="/Pancia_mia_fatti_capanna/Client/addCreditCard" class="btn btn-primary">Aggiungi una nuova carta</a>
        </div>

        <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">Le tue recensioni</h2>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('reviews')) > 0) {?>
                <ul class="list-group">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reviews'), 'review');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('review')->value) {
$foreach1DoElse = false;
?>
                        <li class="list-group-item">
                            <strong>Voto: <?php echo $_smarty_tpl->getValue('review')->getRating();?>
/5</strong> - 
                            <em>"<?php echo nl2br((string) htmlspecialchars((string)$_smarty_tpl->getValue('review')->getComment(), ENT_QUOTES, 'UTF-8', true), (bool) 1);?>
"</em>
                            <span class="text-muted">(<?php echo $_smarty_tpl->getValue('review')->getReviewDate()->format('d/m/Y');?>
)</span>
                        </li>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </ul>
            <?php } else { ?>
                <p>Non hai ancora lasciato nessuna recensione.</p>
            <?php }?>
            <a href="/Pancia_mia_fatti_capanna/Client/addReview" class="btn btn-primary mt-3">Lascia una nuova recensione</a>
        </div>

        <div class="text-center mt-4">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary me-2">Torna alla Home</a>
            <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>
<?php }
}
