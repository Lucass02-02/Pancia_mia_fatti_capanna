<?php
/* Smarty version 5.5.1, created on 2025-07-11 16:26:50
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/reservation.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68711f2a236ef0_65597082',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eaa6da600a226a98be07b3c4921f265b5a32209c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/reservation.tpl',
      1 => 1752099513,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68711f2a236ef0_65597082 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Effettua una Prenotazione</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 450px;">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1 class="text-center text-primary mb-4">Prenota</h1>

            <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
                <div class="alert alert-danger text-center"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>
</div>
            <?php }?>

            <form action="/Pancia_mia_fatti_capanna/Client/reserve" method="post">
                <div class="mb-3">
                   <label for="date" class="form-label">Date</label>
                   <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <div class="mb-3">
                   <label for="hours" class="form-label">Time</label>
                   <input type="time" id="hours" name="hours" class="form-control" required>
                </div>
                <div class="mb-3">
                   <label for="duration" class="form-label">Duration (Optional)</label>
                   <input type="number" id="duration" name="duration" placeholder="between 60 and 120 minutes" class="form-control">
                </div>
                <div class="mb-3">
                   <label for="numPeople" class="form-label">People Number</label>
                   <input type="number" id="numPeople" name="numPeople" class="form-control" required>
                </div>
                <div class="mb-3">
                   <label for="note" class="form-label">Note (Optional)</label>
                   <textarea type="text" id="note" name="note" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                   <label for="nameReservation" class="form-label">Name Reservation</label>
                   <input type="text" id="nameReservation" name="nameReservation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Invia</button>
            </form>

            <div class="text-center mt-4">
                <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
            </div>
        </div>
    </div>
</body>
</html><?php }
}
