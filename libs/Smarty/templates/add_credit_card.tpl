{* File: templates/add_credit_card.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center" style="padding-top: 100px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="card p-4 shadow">
          <h1 class="text-center mb-3">Aggiungi Metodo di Pagamento</h1>
          <p class="text-center small text-muted">Nota: non inserire dati reali. Questa è una simulazione.</p>

          {if isset($error)}
            <p class="text-danger text-center mb-3">{$error|escape}</p>
          {/if}

          <form action="/Pancia_mia_fatti_capanna/Client/addCreditCard" method="POST">
            <div class="mb-3">
              <label for="cardName" class="form-label">Nome Carta (es. La mia Visa)</label>
              <input type="text" id="cardName" name="cardName" class="form-control">
            </div>
            <div class="mb-3">
              <label for="brand" class="form-label">Circuito (es. Visa, MasterCard)</label>
              <input type="text" id="brand" name="brand" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="last4" class="form-label">Ultime 4 Cifre</label>
              <input type="text" id="last4" name="last4" maxlength="4" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="expMonth" class="form-label">Mese Scadenza</label>
              <input type="number" id="expMonth" name="expMonth" min="1" max="12" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="expYear" class="form-label">Anno Scadenza</label>
              <input type="number" id="expYear" name="expYear" min="2024" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Aggiungi Carta</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}
