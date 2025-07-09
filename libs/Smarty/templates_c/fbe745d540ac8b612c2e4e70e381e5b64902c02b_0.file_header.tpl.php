<?php
/* Smarty version 5.5.1, created on 2025-07-09 03:24:03
  from 'file:header.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686dc4b3980bc1_07051184',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fbe745d540ac8b612c2e4e70e381e5b64902c02b' => 
    array (
      0 => 'header.tpl',
      1 => 1752023808,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686dc4b3980bc1_07051184 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><header id="header" class="d-flex align-items-center shadow-sm py-2">
  <div class="container d-flex justify-content-between align-items-center">

    <h1 class="logo m-0">
      <a href="/Pancia_mia_fatti_capanna/Home/home" class="text-decoration-none text-dark">
        Pancia<span class="text-danger">Mia</span>
      </a>
    </h1>

    <nav id="navbar" class="navbar">
      <ul class="nav">
        <li class="nav-item"><a class="nav-link px-3" href="/Pancia_mia_fatti_capanna/Home/home">Home</a></li>
        <li class="nav-item"><a class="nav-link px-3" href="/Pancia_mia_fatti_capanna/Home/menu">Menù</a></li>
        <li class="nav-item"><a class="nav-link px-3" href="/Pancia_mia_fatti_capanna/Review/showAll">Recensioni</a></li>

        <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
          <li class="nav-item"><a class="nav-link px-3" href="/Pancia_mia_fatti_capanna/Admin/profile">Pannello</a></li>
          <li class="nav-item"><a class="nav-link px-3 text-danger" href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a></li>
        <?php } elseif ($_smarty_tpl->getValue('user_role') == 'client') {?>
          <li class="nav-item"><a class="nav-link px-3" href="/Pancia_mia_fatti_capanna/Client/profile">Profilo</a></li>
          <li class="nav-item"><a class="nav-link px-3 text-danger" href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a></li>
        <?php } elseif ($_smarty_tpl->getValue('user_role') == 'waiter') {?>
          <li class="nav-item"><a class="nav-link px-3" href="/Pancia_mia_fatti_capanna/Waiter/profile">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link px-3 text-danger" href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a></li>
        <?php } else { ?>
          <li class="nav-item"><a class="nav-link px-3" href="/Pancia_mia_fatti_capanna/Client/login">Login</a></li>
          <li class="nav-item"><a class="nav-link px-3" href="/Pancia_mia_fatti_capanna/Client/registration">Registrati</a></li>
        <?php }?>
      </ul>
    </nav>

  </div>
</header>
<?php }
}
