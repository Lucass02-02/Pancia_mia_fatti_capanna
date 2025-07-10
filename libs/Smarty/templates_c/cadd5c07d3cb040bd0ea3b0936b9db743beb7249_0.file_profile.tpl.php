<?php
/* Smarty version 5.5.1, created on 2025-07-10 17:27:50
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/profile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686fdbf6120782_25286302',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cadd5c07d3cb040bd0ea3b0936b9db743beb7249' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/profile.tpl',
      1 => 1752161259,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686fdbf6120782_25286302 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Mio Profilo - <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="p-5 bg-white rounded shadow-sm">
        <h1 class="text-primary">Profilo di <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
</h1>
        <p class="lead">Benvenuto nel tuo pannello di controllo personale.</p>
        <hr>

        <div class="mb-5">
            <h3 class="text-secondary">I Tuoi Dati</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Nome Completo:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
</li>
                <li class="list-group-item"><strong>Nickname:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getNickname(), ENT_QUOTES, 'UTF-8', true);?>
</li>
                <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getEmail(), ENT_QUOTES, 'UTF-8', true);?>
</li>
                <li class="list-group-item"><strong>Numero di Telefono:</strong> <?php echo (($tmp = htmlspecialchars((string)$_smarty_tpl->getValue('client')->getPhoneNumber(), ENT_QUOTES, 'UTF-8', true) ?? null)===null||$tmp==='' ? "Non specificato" ?? null : $tmp);?>
</li>
                <li class="list-group-item"><strong>Data di Nascita:</strong> <?php echo $_smarty_tpl->getValue('client')->getBirthDate()->format('d/m/Y');?>
</li>
            </ul>
        </div>

        <div class="mt-5">
            <h3 class="text-secondary">Le Mie Recensioni</h3>
            <?php if (!( !$_smarty_tpl->hasVariable('reviews') || empty($_smarty_tpl->getValue('reviews')))) {?>
                <ul class="list-group">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reviews'), 'review');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('review')->value) {
$foreach0DoElse = false;
?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1"><strong>Voto: <?php echo $_smarty_tpl->getValue('review')->getRating();?>
/5</strong></p>
                                <p class="mb-0 fst-italic">"<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('review')->getComment(), ENT_QUOTES, 'UTF-8', true);?>
"</p>
                                <small class="text-muted">Scritta il: <?php echo $_smarty_tpl->getValue('review')->getCreationDate()->format('d/m/Y');?>
</small>
                            </div>
                            <form action="/Pancia_mia_fatti_capanna/client/deleteReview" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa recensione?');">
                                <input type="hidden" name="review_id" value="<?php echo $_smarty_tpl->getValue('review')->getId();?>
">
                                <button type="submit" class="btn btn-outline-danger btn-sm">Elimina</button>
                            </form>
                        </li>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </ul>
            <?php } else { ?>
                <p>Non hai ancora scritto nessuna recensione.</p>
            <?php }?>
            <a href="/Pancia_mia_fatti_capanna/client/addReview" class="btn btn-primary mt-3">Scrivi una Recensione</a>
        </div>
        
        <hr class="my-5">
        <div class="mt-4">
            <h3 class="text-secondary">Le Mie Carte di Credito</h3>
            <?php if (!( !$_smarty_tpl->hasVariable('creditCards') || empty($_smarty_tpl->getValue('creditCards')))) {?>
                <ul class="list-group">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('creditCards'), 'card');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('card')->value) {
$foreach1DoElse = false;
?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('card')->getBrand(), ENT_QUOTES, 'UTF-8', true);?>
</strong> che finisce con **** **** **** <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('card')->getLast4(), ENT_QUOTES, 'UTF-8', true);?>

                                <br>
                                <small class="text-muted">Intestatario: <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('card')->getCardName(), ENT_QUOTES, 'UTF-8', true);?>
</small>
                            </div>
                            <form action="/Pancia_mia_fatti_capanna/client/deleteCreditCard" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa carta?');">
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
            <a href="/Pancia_mia_fatti_capanna/client/addCreditCard" class="btn btn-success mt-3">Aggiungi Carta</a>
        </div>
        
        <hr class="my-5">

        <div class="d-flex justify-content-center gap-3">
             <a href="/Pancia_mia_fatti_capanna/" class="btn btn-secondary">Torna alla Home</a>
             <a href="/Pancia_mia_fatti_capanna/client/logout" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

</body>
</html><?php }
}
