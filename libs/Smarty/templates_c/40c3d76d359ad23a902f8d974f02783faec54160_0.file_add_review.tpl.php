<?php
/* Smarty version 5.5.1, created on 2025-07-09 03:31:34
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/add_review.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686dc676701fa0_78080745',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40c3d76d359ad23a902f8d974f02783faec54160' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/add_review.tpl',
      1 => 1752012840,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686dc676701fa0_78080745 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lascia una Recensione</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container p-4 bg-white rounded shadow-sm" style="max-width: 500px;">
        <h1 class="text-center text-primary mb-4">La Tua Opinione Conta!</h1>

        <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
            <p class="text-danger text-center mb-3"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>
</p>
        <?php }?>

        <form action="/Pancia_mia_fatti_capanna/Client/addReview" method="POST">
            <div class="mb-3">
                <label for="rating" class="form-label">Voto (da 1 a 5)</label>
                <select id="rating" name="rating" class="form-select" required>
                    <option value="">Seleziona un voto</option>
                    <option value="5">5 - Eccellente</option>
                    <option value="4">4 - Molto Buono</option>
                    <option value="3">3 - Buono</option>
                    <option value="2">2 - Sufficiente</option>
                    <option value="1">1 - Insufficiente</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Commento</label>
                <textarea id="comment" name="comment" rows="5" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Invia Recensione</button>
        </form>
    </div>
</body>
</html>
<?php }
}
