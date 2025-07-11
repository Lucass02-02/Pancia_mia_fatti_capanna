<?php
/* Smarty version 5.5.1, created on 2025-07-11 11:18:37
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/registration.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6870d6ed6b4370_46865526',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e2ab4a02795eeba9df8c958068aa6575608d9e9e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/registration.tpl',
      1 => 1752163315,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6870d6ed6b4370_46865526 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione - Pancia mia fatti capanna</title>

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
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <!-- ======= Registration Section ======= -->
    <section class="registration">
        <div class="container my-5" style="max-width: 500px;">
            <div class="php-email-form bg-white p-4 rounded shadow-sm">
                <h1 class="text-center text-primary mb-4">Registrati</h1>

                <?php if ((true && ($_smarty_tpl->hasVariable('message') && null !== ($_smarty_tpl->getValue('message') ?? null)))) {?>
                    <div class="alert <?php if ((true && ($_smarty_tpl->hasVariable('success') && null !== ($_smarty_tpl->getValue('success') ?? null))) && $_smarty_tpl->getValue('success')) {?>alert-success<?php } else { ?>alert-danger<?php }?>" role="alert">
                        <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('message'), ENT_QUOTES, 'UTF-8', true);?>

                    </div>
                <?php }?>

                <form action="/Pancia_mia_fatti_capanna/Client/registration" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" id="surname" name="surname" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="birthDate" class="form-label">Data di Nascita</label>
                        <input type="date" id="birthDate" name="birthDate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Numero di Telefono (Opzionale)</label>
                        <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="nickname" class="form-label">Nickname (Opzionale)</label>
                        <input type="text" id="nickname" name="nickname" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-get-started w-100">Registrati</button>
                </form>

                <div class="text-center mt-3">
                    <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
                </div>
            </div>
        </div>
    </section><!-- End Registration Section -->

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
