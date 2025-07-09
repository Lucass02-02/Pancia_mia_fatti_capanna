{* File: templates/waiter_tables_view.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1>Stato Tavoli - {$hall->getName()|escape}</h1>
        <p>Visualizza e aggiorna lo stato dei tavoli della tua sala.</p>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}

{block name="content"}
<section id="waiter-tables" class="waiter-tables">
  <div class="container" data-aos="fade-up" style="max-width: 900px;">

    {if $tables|@count == 0}
      <p class="text-center text-muted">Non ci sono tavoli assegnati a questa sala.</p>
    {else}
      <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>Tavolo</th>
              <th>Posti</th>
              <th>Stato Attuale</th>
              <th>Cambia Stato</th>
            </tr>
          </thead>
          <tbody>
            {foreach $tables as $table}
              <tr>
                <td><strong>#{$table->getIdTable()}</strong></td>
                <td>{$table->getSeatsNumber()}</td>
                <td>
                  <span class="fw-bold text-{if $table->getState()->value == 'available'}success{elseif $table->getState()->value == 'reserved'}warning{elseif $table->getState()->value == 'occupied'}danger{/if}">
                    {$table->getState()->value|upper}
                  </span>
                </td>
                <td>
                  <form action="/Pancia_mia_fatti_capanna/Waiter/updateTableState" method="POST" class="d-flex align-items-center gap-2">
                    <input type="hidden" name="table_id" value="{$table->getIdTable()}">
                    <select name="state" class="form-select">
                      <option value="available" {if $table->getState()->value eq 'available'}selected{/if}>Disponibile</option>
                      <option value="reserved" {if $table->getState()->value eq 'reserved'}selected{/if}>Prenotato</option>
                      <option value="occupied" {if $table->getState()->value eq 'occupied'}selected{/if}>Occupato</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                  </form>
                </td>
              </tr>
            {/foreach}
          </tbody>
        </table>
      </div>
    {/if}

    <div class="text-center mt-4">
      <a href="/Pancia_mia_fatti_capanna/Waiter/profile" class="btn btn-secondary">Torna alla Dashboard</a>
    </div>

  </div>
</section><!-- End Waiter Tables Section -->
{/block}
