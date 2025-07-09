{* File: templates/waiter_profile.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1>Ciao, {$waiter->getName()|escape}!</h1>
        <p>Benvenuto nella tua dashboard personale.</p>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}

{block name="content"}
<section id="waiter-profile" class="waiter-profile">
  <div class="container" data-aos="fade-up" style="max-width: 900px;">

    <div class="row g-4">
      <div class="col-md-6">
        <div class="border p-3 rounded h-100">
          <h3 class="h5 text-secondary text-center mb-3">Le Tue Informazioni</h3>
          <p><strong>Matricola:</strong> {$waiter->getSerialNumber()|escape}</p>
          <p><strong>Sala Assegnata:</strong> {$waiter->getRestaurantHall()->getName()|escape}</p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="border p-3 rounded h-100">
          <h3 class="h5 text-secondary text-center mb-3">Le Tue Funzioni</h3>
          <ul class="list-unstyled">
            <li class="mb-2">
              <a href="/Pancia_mia_fatti_capanna/Waiter/viewTables" class="btn btn-primary w-100">Visualizza Stato Tavoli</a>
            </li>
            <li class="mb-2">
              <button class="btn btn-secondary w-100" disabled>Visualizza Prenotazioni</button>
            </li>
            <li>
              <button class="btn btn-secondary w-100" disabled>Visualizza Ordini</button>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="text-center mt-4">
      <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-danger">Logout</a>
    </div>

  </div>
</section><!-- End Waiter Profile Section -->
{/block}
