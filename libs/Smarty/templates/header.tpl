<!-- ======= Header ======= -->
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
        {if $isLoggedIn}
          <li><a href="/Pancia_mia_fatti_capanna/client/profile">Profilo</a></li>
          <li><a href="/Pancia_mia_fatti_capanna/client/logout">Logout</a></li>
        {else}
          <li><a href="/Pancia_mia_fatti_capanna/client/login">Login</a></li>
          <li><a href="/Pancia_mia_fatti_capanna/client/registration">Registrati</a></li>
        {/if}
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navmenu -->

  </div>
</header><!-- End Header -->
