<header id="header" class="d-flex align-items-center shadow-sm py-2">
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

        {if $user_role == 'admin'}
          <li class="nav-item"><a class="nav-link px-3" href="/Pancia_mia_fatti_capanna/Admin/profile">Pannello</a></li>
          <li class="nav-item"><a class="nav-link px-3 text-danger" href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a></li>
        {elseif $user_role == 'client'}
          <li class="nav-item"><a class="nav-link px-3" href="/Pancia_mia_fatti_capanna/Client/profile">Profilo</a></li>
          <li class="nav-item"><a class="nav-link px-3 text-danger" href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a></li>
        {elseif $user_role == 'waiter'}
          <li class="nav-item"><a class="nav-link px-3" href="/Pancia_mia_fatti_capanna/Waiter/profile">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link px-3 text-danger" href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a></li>
        {else}
          <li class="nav-item"><a class="nav-link px-3" href="/Pancia_mia_fatti_capanna/Client/login">Login</a></li>
          <li class="nav-item"><a class="nav-link px-3" href="/Pancia_mia_fatti_capanna/Client/registration">Registrati</a></li>
        {/if}
      </ul>
    </nav>

  </div>
</header>
