<?php
/* Smarty version 5.5.1, created on 2025-07-11 12:28:07
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/all_reviews.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6870e737e8d4b4_70055389',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c6f0b01ca0af416743394a020c811bebdce5a5fb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/all_reviews.tpl',
      1 => 1752229685,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6870e737e8d4b4_70055389 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('titolo'), ENT_QUOTES, 'UTF-8', true);?>
 - Pancia mia fatti capanna</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">

    <style>
        .admin-response {
            background-color: #e9ecef;
            border-left: 4px solid var(--accent-color);
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            position: relative;
        }
        .admin-response-form {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #ced4da;
        }
        .admin-response .delete-response-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            padding: .1rem .4rem;
            font-size: .7rem;
        }
        .admin-response .edit-response-btn {
            position: absolute;
            top: 5px;
            right: 45px;
            padding: .1rem .4rem;
            font-size: .7rem;
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }
        .admin-response .edit-response-btn:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }
    </style>
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
            <h1><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('titolo'), ENT_QUOTES, 'UTF-8', true);?>
</h1>
        </div>
    </section><!-- End Page Title Section -->
<section class="container" style="background: url('/Pancia_mia_fatti_capanna/images/recensioni.png') center center / cover no-repeat; height: 300px; width: 600px"></section>
    <!-- ======= Reviews Section ======= -->
    <section class="section">
        <div class="container">
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
                            <div class="icon-box">
                                <p class="fst-italic">"<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('review')->getComment(), ENT_QUOTES, 'UTF-8', true);?>
"</p>
                                <p><strong>Voto: <?php echo $_smarty_tpl->getValue('review')->getRating();?>
/5</strong></p>
                                <small class="d-block">
                                    Di: <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('review')->getClient()->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('review')->getClient()->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
<br>
                                    Scritta il: <?php echo $_smarty_tpl->getValue('review')->getCreationDate()->format('d/m/Y');?>

                                </small>

                                                                <?php if (!$_smarty_tpl->getValue('review')->getAdminResponses()->isEmpty()) {?>
                                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('review')->getAdminResponses(), 'response');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('response')->value) {
$foreach1DoElse = false;
?>
                                        <div class="admin-response mt-3">
                                            <p class="mb-1"><strong>Risposta dell'Admin:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('response')->getResponseText(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                            <small class="d-block text-end">
                                                Di: <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('response')->getAdmin()->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('response')->getAdmin()->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
<br>
                                                Inviata il: <?php echo $_smarty_tpl->getValue('response')->getResponseDate()->format('d/m/Y H:i');?>

                                            </small>

                                            <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                                                <a href="/Pancia_mia_fatti_capanna/review/editAdminResponse/<?php echo $_smarty_tpl->getValue('response')->getId();?>
" class="btn btn-warning btn-sm edit-response-btn">Modifica</a>

                                                <form action="/Pancia_mia_fatti_capanna/review/deleteAdminResponse/<?php echo $_smarty_tpl->getValue('response')->getId();?>
" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa risposta dell\'admin?');" class="delete-response-btn">
                                                    <button type="submit" class="btn btn-danger btn-sm">X</button>
                                                </form>
                                            <?php }?>
                                        </div>
                                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                                <?php }?>

                                                                <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                                    <div class="admin-response-form">
                                        <h5>Rispondi a questa recensione:</h5>
                                        <form action="/Pancia_mia_fatti_capanna/review/respond" method="POST">
                                            <input type="hidden" name="review_id" value="<?php echo $_smarty_tpl->getValue('review')->getId();?>
">
                                            <div class="mb-3">
                                                <textarea name="response_text" class="form-control" rows="3" placeholder="Scrivi qui la tua risposta..." required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-get-started btn-sm">Invia Risposta</button>
                                        </form>
                                    </div>
                                <?php }?>

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
    </section><!-- End Reviews Section -->

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
