{* File: templates/menu.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1>Il Nostro Menù</h1>
        <p>Scopri i nostri piatti e ordina comodamente!</p>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}

{block name="content"}
<!-- ======= Menu Section ======= -->
<section id="menu" class="menu">
  <div class="container" data-aos="fade-up">

    {if $isAdmin}
      <div class="d-flex justify-content-center gap-3 mb-4">
        <a href="/Pancia_mia_fatti_capanna/Product/create" class="btn btn-success">Aggiungi Nuovo Prodotto</a>
        <a href="/Pancia_mia_fatti_capanna/Allergen/manage" class="btn btn-info">Gestisci Allergeni</a>
      </div>
    {/if}

    <div class="section-title">
      <h2>Filtra</h2>
      <p>Filtra per allergeni (mostra piatti senza)</p>
    </div>

    <form action="/Pancia_mia_fatti_capanna/Home/menu" method="GET">
      <div class="row gy-3">
        {if isset($allAllergens) && !empty($allAllergens)}
          {foreach $allAllergens as $allergen}
            <div class="col-md-3 col-sm-4 col-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="allergens[]" value="{$allergen->getId()}"
                  {if isset($selectedAllergens) && in_array($allergen->getId(), $selectedAllergens)}checked{/if}
                  id="allergen{$allergen->getId()}">
                <label class="form-check-label" for="allergen{$allergen->getId()}">
                  {$allergen->getAllergenType()|escape}
                </label>
              </div>
            </div>
          {/foreach}
        {/if}
      </div>
      <div class="mt-3 text-center">
        <button type="submit" class="btn btn-primary">Applica Filtro</button>
        <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary ms-2">Rimuovi Filtro</a>
      </div>
    </form>

    {if empty($products)}
      <p class="text-center text-muted mt-5">Nessun piatto trovato con i filtri selezionati.</p>
    {else}
      <div class="row gy-4 mt-4">
        {foreach $products as $product}
          <div class="col-lg-4 menu-item">
            <div class="menu-content {if $isAdmin && !$product->isAvailable()}opacity-50{/if}">
              <h4>{$product->getName()|escape}</h4>
              <p class="ingredients">{$product->getDescription()|escape}</p>
              <p class="price">€ {$product->getPrice()|number_format:2:',':'.'}</p>

              {if $isLoggedIn && !$isAdmin}
                <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST" class="mt-2">
                  <input type="hidden" name="product_id" value="{$product->getId()}">
                  <div class="input-group">
                    <input type="number" name="quantity" value="1" min="1" max="99" class="form-control" aria-label="Quantità">
                    <button type="submit" class="btn btn-primary">Aggiungi</button>
                  </div>
                </form>
              {elseif !$isLoggedIn}
                <p class="text-end text-muted mt-2">Accedi per aggiungere al carrello.</p>
              {/if}

              {if $isAdmin}
                <div class="d-flex flex-wrap gap-2 mt-3">
                  <a href="/Pancia_mia_fatti_capanna/Product/edit/{$product->getId()}" class="btn btn-warning btn-sm">Modifica</a>
                  {if $product->isAvailable()}
                    <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/{$product->getId()}" class="btn btn-secondary btn-sm">Rendi Non Disp.</a>
                  {else}
                    <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/{$product->getId()}" class="btn btn-success btn-sm">Rendi Disp.</a>
                  {/if}
                  <a href="/Pancia_mia_fatti_capanna/Product/delete/{$product->getId()}" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo prodotto? L\'azione è irreversibile.');">Elimina</a>
                </div>
              {/if}
            </div>
          </div>
        {/foreach}
      </div>
    {/if}

    <div class="text-center mt-5">
      <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
      {if $isLoggedIn && !$isAdmin}
        <a href="/Pancia_mia_fatti_capanna/Cart/view" class="btn btn-primary ms-2">Vai al Carrello</a>
      {/if}
    </div>

  </div>
</section><!-- End Menu Section -->
{/block}
