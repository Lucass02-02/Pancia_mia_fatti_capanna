<?php
/* Smarty version 5.5.1, created on 2025-07-12 15:47:57
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/reservation.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6872678d189179_80374763',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '420563dac35343e677a33e52a8bd333dfb01088a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/reservation.tpl',
      1 => 1752313802,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6872678d189179_80374763 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Effettua una Prenotazione</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body class="bg-light">

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <!-- ======= Prenotazione Section ======= -->
    <main>
        <div class="container" style="max-width: 550px;">
            <div class="surface p-4 rounded shadow-sm">
                <h2 class="text-center mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">Prenota</h2>

                <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
                    <div class="alert alert-danger text-center"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>
</div>
                <?php }?>

                <form action="/Pancia_mia_fatti_capanna/Client/reserve" method="post">
                    <div class="mb-3">
                        <label for="date" class="form-label">Data</label>
                        <input type="date" id="date" name="date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="hours" class="form-label">Ora</label>
                        <input type="time" id="hours" name="hours" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="duration" class="form-label">Durata (opzionale)</label>
                        <input type="number" id="duration" name="duration" placeholder="Tra 60 e 120 minuti" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="numPeople" class="form-label">Numero Persone</label>
                        <input type="number" id="numPeople" name="numPeople" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="note" class="form-label">Note (opzionale)</label>
                        <textarea id="note" name="note" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="nameReservation" class="form-label">Nome Prenotazione</label>
                        <input type="text" id="nameReservation" name="nameReservation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">
                        Invia
                    </button>
                </form>

                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
                </div>
            </div>
        </div>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer mt-5">
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
