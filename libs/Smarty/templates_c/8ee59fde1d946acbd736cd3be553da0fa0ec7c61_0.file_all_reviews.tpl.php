<?php
/* Smarty version 5.5.1, created on 2025-07-09 17:25:56
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/all_reviews.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686e8a04ca1409_92576308',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ee59fde1d946acbd736cd3be553da0fa0ec7c61' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/all_reviews.tpl',
      1 => 1752074751,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686e8a04ca1409_92576308 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('titolo'), ENT_QUOTES, 'UTF-8', true);?>
 - Pancia mia fatti capanna</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <h1 class="text-primary text-center mb-5"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('titolo'), ENT_QUOTES, 'UTF-8', true);?>
</h1>

    <?php if (( !$_smarty_tpl->hasVariable('reviews') || empty($_smarty_tpl->getValue('reviews')))) {?>
        <p class="text-center text-muted">Non ci sono ancora recensioni da mostrare.</p>
    <?php } else { ?>
        <div class="row g-4">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reviews'), 'review');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('review')->value) {
$foreach0DoElse = false;
?>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <p class="card-text fst-italic">"<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('review')->getComment(), ENT_QUOTES, 'UTF-8', true);?>
"</p>
                            <p class="card-text"><strong>Voto: <?php echo $_smarty_tpl->getValue('review')->getRating();?>
/5</strong></p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center bg-light">
                           <small class="text-muted">
                                Di: <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('review')->getClient()->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('review')->getClient()->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
<br>
                                Scritta il: <?php echo $_smarty_tpl->getValue('review')->getCreationDate()->format('d/m/Y');?>

                           </small>
                           
                                                      <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                                <form action="/Pancia_mia_fatti_capanna/review/delete" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa recensione?');">
                                    <input type="hidden" name="review_id" value="<?php echo $_smarty_tpl->getValue('review')->getId();?>
">
                                    <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                                </form>
                           <?php }?>
                        </div>
                    </div>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
    <?php }?>

    <div class="text-center mt-5">
        <a href="/Pancia_mia_fatti_capanna/" class="btn btn-secondary">Torna alla Home</a>
    </div>
</div>

</body>
</html><?php }
}
