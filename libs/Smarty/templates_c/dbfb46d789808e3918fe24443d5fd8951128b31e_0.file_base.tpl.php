<?php
/* Smarty version 5.5.1, created on 2025-07-09 13:37:07
  from 'file:base.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686e5463a048b2_82031097',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dbfb46d789808e3918fe24443d5fd8951128b31e' => 
    array (
      0 => 'base.tpl',
      1 => 1752061022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_686e5463a048b2_82031097 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Pancia Mia Fatti Capanna' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</title>

  <!-- Favicons -->
  <link href="/Pancia_mia_fatti_capanna/assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Inter&family=Roboto&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/Pancia_mia_fatti_capanna/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/Pancia_mia_fatti_capanna/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/Pancia_mia_fatti_capanna/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/Pancia_mia_fatti_capanna/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/Pancia_mia_fatti_capanna/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/Pancia_mia_fatti_capanna/assets/css/style.css" rel="stylesheet">
</head>
<body>

  <!-- ======= Header ======= -->
  <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

  <!-- ======= Hero Section ======= -->
  <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_587737004686e5463a03b93_74082514', "hero");
?>


  <!-- ======= Main Content ======= -->
  <main id="main">
    <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1997280794686e5463a04220_51132689', "content");
?>

  </main>

  <!-- ======= Footer ======= -->
  <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS Files -->
  <?php echo '<script'; ?>
 src="/Pancia_mia_fatti_capanna/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="/Pancia_mia_fatti_capanna/assets/vendor/aos/aos.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="/Pancia_mia_fatti_capanna/assets/vendor/glightbox/js/glightbox.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="/Pancia_mia_fatti_capanna/assets/vendor/swiper/swiper-bundle.min.js"><?php echo '</script'; ?>
>

  <!-- Template Main JS File -->
  <?php echo '<script'; ?>
 src="/Pancia_mia_fatti_capanna/assets/js/main.js"><?php echo '</script'; ?>
>

</body>
</html>
<?php }
/* {block "hero"} */
class Block_587737004686e5463a03b93_74082514 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
}
}
/* {/block "hero"} */
/* {block "content"} */
class Block_1997280794686e5463a04220_51132689 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
}
}
/* {/block "content"} */
}
