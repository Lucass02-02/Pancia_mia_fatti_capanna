<?php
/* Smarty version 5.5.1, created on 2025-07-06 02:58:34
  from 'file:all_reviews.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6869ca3a20e5f1_59829530',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '01fee5b3ece5e7ea0eca05510e584699d1444ca7' => 
    array (
      0 => 'all_reviews.tpl',
      1 => 1751762293,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6869ca3a20e5f1_59829530 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutte le Recensioni - Pancia mia fatti capanna</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; line-height: 1.6; }
        .container { max-width: 900px; margin: 2em auto; padding: 1em; }
        h1 { color: #e8491d; text-align: center; }
        .review-card { background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 1.5em; margin-bottom: 1.5em; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .review-header { border-bottom: 1px solid #eee; padding-bottom: 1em; margin-bottom: 1em; }
        .review-author { font-weight: bold; color: #333; }
        .review-date { float: right; color: #777; font-size: 0.9em; }
        .review-rating { font-size: 1.2em; color: #f0ad4e; }
        .review-comment { color: #555; }
        .nav-link { display: block; text-align: center; margin-top: 2em; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Tutte le Recensioni' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</h1> 
        <?php if ((true && ($_smarty_tpl->hasVariable('reviews') && null !== ($_smarty_tpl->getValue('reviews') ?? null))) && !( !$_smarty_tpl->hasVariable('reviews') || empty($_smarty_tpl->getValue('reviews')))) {?>             <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reviews'), 'review');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('review')->value) {
$foreach0DoElse = false;
?>                 <div class="review-card">
                    <div class="review-header">
                                                <?php $_smarty_tpl->assign('author', $_smarty_tpl->getValue('review')->getClient(), false, NULL);?>                         <?php if ($_smarty_tpl->getValue('author')) {?>
                            <?php ob_start();
echo htmlspecialchars((string)$_smarty_tpl->getValue('author')->getName(), ENT_QUOTES, 'UTF-8', true);
$_prefixVariable1=ob_get_clean();
ob_start();
echo htmlspecialchars((string)$_smarty_tpl->getValue('author')->getSurname(), ENT_QUOTES, 'UTF-8', true);
$_prefixVariable2=ob_get_clean();
$_smarty_tpl->assign('author_name', $_prefixVariable1." ".$_prefixVariable2, false, NULL);?>
                        <?php } else { ?>
                            <?php $_smarty_tpl->assign('author_name', "Utente Anonimo", false, NULL);?>
                        <?php }?>
                        <span class="review-author"><?php echo $_smarty_tpl->getValue('author_name');?>
</span>                         <span class="review-date"><?php echo $_smarty_tpl->getValue('review')->getReviewDate()->format('d/m/Y H:i');?>
</span>                     </div>
                    <div class="review-rating">
                        Voto: <?php echo str_repeat((string) '★', (int) $_smarty_tpl->getValue('review')->getRating());
echo str_repeat((string) '☆', (int) 5-$_smarty_tpl->getValue('review')->getRating());?>
                     </div>
                    <p class="review-comment">"<?php echo nl2br((string) htmlspecialchars((string)$_smarty_tpl->getValue('review')->getComment(), ENT_QUOTES, 'UTF-8', true), (bool) 1);?>
"</p>                 </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>         <?php } else { ?>             <p style="text-align: center;">Non ci sono ancora recensioni da mostrare.</p>
        <?php }?> 
        <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('controller'=>'home','action'=>'home'), $_smarty_tpl);?>
" class="nav-link">Torna alla Home</a>     </div>
</body>
</html><?php }
}
