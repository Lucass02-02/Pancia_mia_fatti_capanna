{* File: templates/home.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1>{$titolo|default:'Pancia mia fatti capanna'|escape}</h1>
        <p>{$messaggio|escape}</p>
        <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn-get-started">Visualizza Menù</a>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}

{block name="content"}
<!-- ======= About Section Example ======= -->
<section id="about" class="about">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Benvenuto</h2>
      <p>Scopri il nostro ristorante</p>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <img src="/Pancia_mia_fatti_capanna/assets/img/about.jpg" class="img-fluid" alt="About">
      </div>
      <div class="col-lg-6 pt-4 pt-lg-0 content">
        <h3>Chi siamo</h3>
        <p class="fst-italic">
          Un ristorante accogliente dove il gusto incontra la tradizione.
        </p>
        <ul>
          <li><i class="bi bi-check-circle"></i> Ingredienti freschi ogni giorno</li>
          <li><i class="bi bi-check-circle"></i> Ambiente familiare e confortevole</li>
          <li><i class="bi bi-check-circle"></i> Cucina tradizionale rivisitata</li>
        </ul>
        <p>
          Vieni a provare i nostri piatti e lasciati conquistare dal sapore autentico.
        </p>
      </div>
    </div>

  </div>
</section><!-- End About Section -->
{/block}
