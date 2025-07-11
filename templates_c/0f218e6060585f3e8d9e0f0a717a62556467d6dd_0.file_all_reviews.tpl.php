<?php
/* Smarty version 5.5.1, created on 2025-07-11 20:51:31
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/all_reviews.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68715d33859488_57784632',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0f218e6060585f3e8d9e0f0a717a62556467d6dd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/all_reviews.tpl',
      1 => 1752071119,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68715d33859488_57784632 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutte le Recensioni - Pancia mia fatti capanna</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center text-primary mb-5"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Tutte le Recensioni' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</h1>

        <?php if ((true && ($_smarty_tpl->hasVariable('reviews') && null !== ($_smarty_tpl->getValue('reviews') ?? null))) && !( !$_smarty_tpl->hasVariable('reviews') || empty($_smarty_tpl->getValue('reviews')))) {?>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reviews'), 'review');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('review')->value) {
$foreach0DoElse = false;
?>
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <?php $_smarty_tpl->assign('author', $_smarty_tpl->getValue('review')->getClient(), false, NULL);?>
                            <?php if ($_smarty_tpl->getValue('author')) {?>
                                <span class="fw-bold text-dark"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('author')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('author')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
</span>
                            <?php } else { ?>
                                <span class="fw-bold text-dark">Utente Anonimo</span>
                            <?php }?>
                            <span class="text-muted small"><?php echo $_smarty_tpl->getValue('review')->getReviewDate()->format('d/m/Y H:i');?>
</span>
                        </div>
                        <div class="mb-2">
                            <span class="text-warning fs-5">
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
                            </span>
                        </div>
                        <p class="card-text">"<?php echo nl2br((string) htmlspecialchars((string)$_smarty_tpl->getValue('review')->getComment(), ENT_QUOTES, 'UTF-8', true), (bool) 1);?>
"</p>
                    </div>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        <?php } else { ?>
            <p class="text-center">Non ci sono ancora recensioni da mostrare.</p>
        <?php }?>

        <div class="text-center mt-5">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
        </div>
    </div>
</body>
</html>
<?php }
}
