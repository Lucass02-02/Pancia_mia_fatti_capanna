{extends file="base.tpl"}

{block name="hero"}
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1>Il Nostro Menù</h1>
        <p>Scopri i nostri piatti e ordina comodamente!</p>
      </div>
    </div>
  </div>
</section>
{/block}

{block name="content"}
<section id="menu" class="menu">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Menu</h2>
      <p>Le nostre proposte</p>
    </div>

    <div class="row gy-4">
      {if empty($products)}
        <p class="text-center text-muted">Nessun piatto disponibile al momento.</p>
      {else}
        {foreach $products as $product}
          <div class="col-lg-4 menu-item">
            <div class="menu-content">
              <a href="#">{$product->getName()|escape}</a><span>€ {$product->getPrice()|number_format:2:",":"."}</span>
            </div>
            <div class="menu-ingredients">
              {$product->getDescription()|escape}
            </div>
          </div>
        {/foreach}
      {/if}
    </div>

  </div>
</section>
{/block}
