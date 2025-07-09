{* File: templates/add_review.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center" style="padding-top: 100px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="card p-4 shadow">
          <h1 class="text-center mb-4">La Tua Opinione Conta!</h1>

          {if isset($error)}
            <p class="text-danger text-center mb-3">{$error|escape}</p>
          {/if}

          <form action="/Pancia_mia_fatti_capanna/Client/addReview" method="POST">
            <div class="mb-3">
              <label for="rating" class="form-label">Voto (da 1 a 5)</label>
              <select id="rating" name="rating" class="form-select" required>
                <option value="">Seleziona un voto</option>
                <option value="5">5 - Eccellente</option>
                <option value="4">4 - Molto Buono</option>
                <option value="3">3 - Buono</option>
                <option value="2">2 - Sufficiente</option>
                <option value="1">1 - Insufficiente</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="comment" class="form-label">Commento</label>
              <textarea id="comment" name="comment" rows="5" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Invia Recensione</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}
