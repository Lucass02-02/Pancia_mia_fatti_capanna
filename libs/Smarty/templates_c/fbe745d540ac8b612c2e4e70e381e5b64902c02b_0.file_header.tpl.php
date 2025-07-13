<?php
/* Smarty version 5.5.1, created on 2025-07-09 13:37:50
  from 'file:header.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686e548e0c1ac1_53820685',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fbe745d540ac8b612c2e4e70e381e5b64902c02b' => 
    array (
      0 => 'header.tpl',
      1 => 1752061056,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686e548e0c1ac1_53820685 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="container d-flex align-items-center justify-content-between">

    <div class="logo d-flex align-items-center">
      <img src="/Pancia_mia_fatti_capanna/assets/img/logo.png" alt="Logo">
      <h1>Pancia Mia<span>.</span></h1>
    </div>

    <nav id="navbar" class="navmenu">
      <ul>
        <li><a href="/Pancia_mia_fatti_capanna/">Home</a></li>
        <li><a href="/Pancia_mia_fatti_capanna/home/menu">Menu</a></li>
        <?php if ($_smarty_tpl->getValue('isLoggedIn')) {?>
          <li><a href="/Pancia_mia_fatti_capanna/client/profile">Profilo</a></li>
          <li><a href="/Pancia_mia_fatti_capanna/client/logout">Logout</a></li>
        <?php } else { ?>
          <li><a href="/Pancia_mia_fatti_capanna/client/login">Login</a></li>
          <li><a href="/Pancia_mia_fatti_capanna/client/registration">Registrati</a></li>
        <?php }?>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navmenu -->

  </div>
</header><!-- End Header -->
<?php }
}
