<?php
/* Smarty version 5.5.1, created on 2025-07-10 17:36:55
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/add_credit_card.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686fde17e1dd85_54204659',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1fc299f26c24a7e65894460c728630c9dbc160d2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/add_credit_card.tpl',
      1 => 1752161259,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686fde17e1dd85_54204659 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Aggiungi Carta di Credito</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container p-4 bg-white rounded shadow-sm" style="max-width: 500px;">
        <h1 class="text-center text-primary mb-3">Aggiungi Metodo di Pagamento</h1>
        <p class="text-center small text-muted">Nota: non inserire dati reali. Questa è una simulazione.</p>

        <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
            <p class="text-danger text-center mb-3"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>
</p>
        <?php }?>

        <form action="/Pancia_mia_fatti_capanna/Client/addCreditCard" method="POST">
            <div class="mb-3">
                <label for="cardName" class="form-label">Nome Carta (es. La mia Visa)</label>
                <input type="text" id="cardName" name="cardName" class="form-control">
            </div>
            <div class="mb-3">
                <label for="brand" class="form-label">Circuito (es. Visa, MasterCard)</label>
                <input type="text" id="brand" name="brand" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="last4" class="form-label">Ultime 4 Cifre</label>
                <input type="text" id="last4" name="last4" maxlength="4" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="expMonth" class="form-label">Mese Scadenza</label>
                <input type="number" id="expMonth" name="expMonth" min="1" max="12" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="expYear" class="form-label">Anno Scadenza</label>
                <input type="number" id="expYear" name="expYear" min="2024" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Aggiungi Carta</button>
        </form>
    </div>
</body>
</html><?php }
}
