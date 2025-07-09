{* File: templates/edit_product.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center" style="padding-top: 100px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card p-4 shadow">
          <h1 class="text-center mb-4">Modifica Prodotto</h1>

          <form action="/Pancia_mia_fatti_capanna/Product/update" method="POST">
            <input type="hidden" name="product_id" value="{$product->getId()}">
            
            <div class="mb-3">
              <label for="name" class="form-label">Nome Prodotto</label>
              <input type="text" id="name" name="name" value="{$product->getName()|escape}" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Descrizione</label>
              <textarea id="description" name="description" class="form-control" rows="4" required>{$product->getDescription()|escape}</textarea>
            </div>
            
            <div class="mb-3">
              <label for="price" class="form-label">Prezzo (€)</label>
              <input type="number" id="price" name="price" step="0.01" min="0" value="{$product->getPrice()|escape}" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Salva Modifiche</button>
          </form>

          <div class="text-center mt-3">
            <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary">Annulla e torna al Menù</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}
