<?php
/* Smarty version 5.5.1, created on 2025-07-08 16:41:40
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/all_reviews.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686d2e24575da4_27023100',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ee59fde1d946acbd736cd3be553da0fa0ec7c61' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/all_reviews.tpl',
      1 => 1751985499,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686d2e24575da4_27023100 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
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

        <?php if ((true && ($_smarty_tpl->hasVariable('reviews') && null !== ($_smarty_tpl->getValue('reviews') ?? null))) && !( !$_smarty_tpl->hasVariable('reviews') || empty($_smarty_tpl->getValue('reviews')))) {?>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reviews'), 'review');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('review')->value) {
$foreach0DoElse = false;
?>
                <div class="review-card">
                    <div class="review-header">
                        <?php $_smarty_tpl->assign('author', $_smarty_tpl->getValue('review')->getClient(), false, NULL);?>
                        <?php if ($_smarty_tpl->getValue('author')) {?>
                            <span class="review-author"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('author')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('author')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
</span>
                        <?php } else { ?>
                            <span class="review-author">Utente Anonimo</span>
                        <?php }?>
                        <span class="review-date"><?php echo $_smarty_tpl->getValue('review')->getReviewDate()->format('d/m/Y H:i');?>
</span>
                    </div>
                    <div class="review-rating">
                        Voto:
                        <?php
$__section_star_0_loop = (is_array(@$_loop=$_smarty_tpl->getValue('review')->getRating()) ? count($_loop) : max(0, (int) $_loop));
$__section_star_0_total = $__section_star_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_star'] = new \Smarty\Variable(array());
if ($__section_star_0_total !== 0) {
for ($__section_star_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_star']->value['index'] = 0; $__section_star_0_iteration <= $__section_star_0_total; $__section_star_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_star']->value['index']++){
?>★<?php
}
}
?>
                        <?php
$__section_nostar_0_start = (int)@$_smarty_tpl->getValue('review')->getRating() < 0 ? max(0, (int)@$_smarty_tpl->getValue('review')->getRating() + 5) : min((int)@$_smarty_tpl->getValue('review')->getRating(), 5);
$__section_nostar_0_total = min((5 - $__section_nostar_0_start), 5);
$_smarty_tpl->tpl_vars['__smarty_section_nostar'] = new \Smarty\Variable(array());
if ($__section_nostar_0_total !== 0) {
for ($__section_nostar_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_nostar']->value['index'] = $__section_nostar_0_start; $__section_nostar_0_iteration <= $__section_nostar_0_total; $__section_nostar_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_nostar']->value['index']++){
?>☆<?php
}
}
?>
                    </div>
                    <p class="review-comment">"<?php echo nl2br((string) htmlspecialchars((string)$_smarty_tpl->getValue('review')->getComment(), ENT_QUOTES, 'UTF-8', true), (bool) 1);?>
"</p>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        <?php } else { ?>
            <p style="text-align: center;">Non ci sono ancora recensioni da mostrare.</p>
        <?php }?>

        <a href="/Pancia_mia_fatti_capanna/Home/home" class="nav-link">Torna alla Home</a>
    </div>
</body>
</html>
<?php }
}
