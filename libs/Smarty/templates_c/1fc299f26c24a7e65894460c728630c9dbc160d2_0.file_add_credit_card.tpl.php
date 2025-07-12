<?php
/* Smarty version 5.5.1, created on 2025-07-12 13:38:26
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/add_credit_card.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68724932b6fad1_09410361',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1fc299f26c24a7e65894460c728630c9dbc160d2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/add_credit_card.tpl',
      1 => 1752313802,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68724932b6fad1_09410361 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Aggiungi Carta di Credito</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/index">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <!-- ======= Page Title Section ======= -->
    <section class="page-title">
        <div class="container">
            <h1>Aggiungi Metodo di Pagamento</h1>
            <p class="fst-italic">Nota: non inserire dati reali. Questa è una simulazione.</p>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Add Credit Card Section ======= -->
    <section class="contact">
        <div class="container">

            <div class="php-email-form bg-white p-4 shadow-sm mx-auto" style="max-width: 500px;">
                <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
                    <div class="error-message text-center"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>
</div>
                <?php }?>

                <form action="/Pancia_mia_fatti_capanna/Client/addCreditCard" method="POST">
                    <div class="form-group mb-3">
                        <label for="cardName" class="form-label">Nome Carta (es. La mia Visa)</label>
                        <input type="text" id="cardName" name="cardName" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="brand" class="form-label">Circuito (es. Visa, MasterCard)</label>
                        <input type="text" id="brand" name="brand" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="last4" class="form-label">Ultime 4 Cifre</label>
                        <input type="text" id="last4" name="last4" maxlength="4" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="expMonth" class="form-label">Mese Scadenza</label>
                        <input type="number" id="expMonth" name="expMonth" min="1" max="12" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="expYear" class="form-label">Anno Scadenza</label>
                        <input type="number" id="expYear" name="expYear" min="2024" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-get-started w-100">Aggiungi Carta</button>
                </form>
            </div>

        </div>
    </section><!-- End Add Credit Card Section -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer><!-- End Footer -->

    <!-- Bootstrap JS -->
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>

</body>
</html>
<?php }
}
