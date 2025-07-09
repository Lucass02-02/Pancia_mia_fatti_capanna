{* File: templates/admin_profile.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center" style="padding-top: 100px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1>Pannello di Controllo</h1>
        <p>Benvenuto, {$admin->getName()|escape} {$admin->getSurname()|escape}</p>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}

{block name="content"}
<section id="admin-profile" class="admin-profile">
  <div class="container" data-aos="fade-up">

    <div class="mb-5">
      <h2 class="h4 text-secondary">Dati del Proprietario</h2>
      <p><strong>Nome Completo:</strong> {$admin->getName()|escape} {$admin->getSurname()|escape}</p>
      <p><strong>Email:</strong> {$admin->getEmail()|escape}</p>
    </div>

    <div class="row gy-4 justify-content-center">
      <div class="col-md-5">
        <div class="icon-box">
          <h3 class="card-title text-primary">Gestione Ristorante</h3>
          <ul class="list-unstyled">
            <li><a href="/Pancia_mia_fatti_capanna/Table/listAll" class="link-primary">Gestisci Tavoli e Sale</a></li>
            <li><a href="/Pancia_mia_fatti_capanna/Home/menu" class="link-primary">Gestisci Menù e Prodotti</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-5">
        <div class="icon-box">
          <h3 class="card-title text-primary">Gestione Utenti</h3>
          <ul class="list-unstyled">
            <li><a href="/Pancia_mia_fatti_capanna/Admin/manageClients" class="link-primary">Gestisci Clienti</a></li>
            <li><a href="/Pancia_mia_fatti_capanna/Waiter/manage" class="link-primary">Gestisci Camerieri</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="text-center mt-5">
      <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary me-2">Torna alla Home</a>
      <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-danger">Logout</a>
    </div>

  </div>
</section><!-- End Admin Profile Section -->
{/block}
