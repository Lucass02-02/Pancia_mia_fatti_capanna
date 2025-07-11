<?php
/* Smarty version 5.5.1, created on 2025-07-11 13:30:45
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/manage_clients.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6870f5e5531654_45430336',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '683f3bb2f6ee20a71b3cda70194afd73e600850b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/manage_clients.tpl',
      1 => 1752233441,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6870f5e5531654_45430336 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Clienti</title>

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
<section class="my-5 text-center">
  <img src="/Pancia_mia_fatti_capanna/images/clienti.webp" alt="Recensioni" class="img-fluid" style="max-width: 400px; height: auto; margin-top: 20px;">
</section>

    <!-- ======= Page Title Section ======= -->
    <section class="page-title">
        <div class="container">
            <h1>Gestione Clienti</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Manage Clients Section ======= -->
    <section class="contact">
        <div class="container" style="max-width: 1200px;">

            <div class="php-email-form bg-white p-4 shadow-sm">
                <?php if (( !$_smarty_tpl->hasVariable('clients') || empty($_smarty_tpl->getValue('clients')))) {?>
                    <p class="text-center text-muted">Non ci sono clienti registrati al momento.</p>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome Completo</th>
                                    <th>Email</th>
                                    <th>Nickname</th>
                                    <th>Telefono</th>
                                    <th>Data di Nascita</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('clients'), 'client');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('client')->value) {
$foreach0DoElse = false;
?>
                                    <tr>
                                        <td><?php echo $_smarty_tpl->getValue('client')->getId();?>
</td>
                                        <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                        <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getEmail(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                        <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('client')->getNickname() ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                        <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('client')->getPhonenumber() ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                        <td><?php echo $_smarty_tpl->getValue('client')->getBirthDate()->format('d/m/Y');?>
</td>
                                    </tr>
                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>
                <?php }?>

                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary">Torna al Pannello di Controllo</a>
                </div>
            </div>

        </div>
    </section><!-- End Manage Clients Section -->

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
