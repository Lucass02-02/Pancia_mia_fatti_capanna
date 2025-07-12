<?php
/* Smarty version 5.5.1, created on 2025-07-12 15:49:08
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/edit_admin_response.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_687267d443eeb5_64143110',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f82ded5ff53309105498965f2b35ac46ac42417' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/edit_admin_response.tpl',
      1 => 1752313802,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_687267d443eeb5_64143110 (\Smarty\Template $_smarty_tpl) {
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

    <!-- ======= Edit Admin Response Section ======= -->
    <section class="contact">
        <div class="container">

            <div class="php-email-form bg-white p-4 shadow-sm mx-auto" style="max-width: 700px;">
                <form action="/Pancia_mia_fatti_capanna/review/updateAdminResponseComment" method="POST">
                    <input type="hidden" name="response_id" value="<?php echo $_smarty_tpl->getValue('adminResponse')->getId();?>
">

                    <div class="form-group mb-3">
                        <label for="response_text" class="form-label">Testo della Risposta:</label>
                        <textarea name="response_text" id="response_text" class="form-control" rows="5" required><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('adminResponse')->getResponseText(), ENT_QUOTES, 'UTF-8', true);?>
</textarea>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-get-started">Salva Modifiche</button>
                        <a href="/Pancia_mia_fatti_capanna/review/showAll" class="btn btn-secondary">Annulla</a>
                    </div>
                </form>
            </div>

        </div>
    </section><!-- End Edit Admin Response Section -->

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
