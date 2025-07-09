{* File: templates/booking_form.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center" style="padding-top: 100px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="card p-4 shadow">
          <h1 class="text-center mb-4">Prenota il Tuo Tavolo</h1>

          {if isset($error)}
            <div class="alert alert-danger text-center">{$error|escape}</div>
          {/if}

          <form action="/Pancia_mia_fatti_capanna/Reservation/book" method="POST">
            <div class="mb-3">
              <label for="date" class="form-label">Data</label>
              <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="time" class="form-label">Ora</label>
              <input type="time" id="time" name="time" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="guests" class="form-label">Numero Ospiti</label>
              <input type="number" id="guests" name="guests" min="1" max="10" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="table_id" class="form-label">Tavolo</label>
              <select id="table_id" name="table_id" class="form-select" required>
                <option value="">Seleziona un tavolo</option>
                {foreach $tables as $table}
                  <option value="{$table->getId()}">{$table->getName()|escape} (Max {$table->getCapacity()} persone)</option>
                {/foreach}
              </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Conferma Prenotazione</button>
          </form>

          <div class="text-center mt-4">
            <a href="/Pancia_mia_fatti_capanna/Client/profile" class="btn btn-secondary">Torna al Profilo</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}
