{* File: templates/manage_clients.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1>Clienti Registrati</h1>
        <p>Visualizza l'elenco completo dei clienti registrati al ristorante.</p>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}

{block name="content"}
<section id="manage-clients" class="manage-clients">
  <div class="container" data-aos="fade-up" style="max-width: 1200px;">

    {if empty($clients)}
      <p class="text-center text-muted">Non ci sono clienti registrati al momento.</p>
    {else}
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Nome Completo</th>
              <th>Email</th>
              <th>Nickname</th>
              <th>Telefono</th>
              <th>Data di Nascita</th>
            </tr>
          </thead>
          <tbody>
            {foreach $clients as $client}
              <tr>
                <td>{$client->getId()}</td>
                <td>{$client->getName()|escape} {$client->getSurname()|escape}</td>
                <td>{$client->getEmail()|escape}</td>
                <td>{$client->getNickname()|default:'-'|escape}</td>
                <td>{$client->getPhonenumber()|default:'-'|escape}</td>
                <td>{$client->getBirthDate()->format('d/m/Y')}</td>
              </tr>
            {/foreach}
          </tbody>
        </table>
      </div>
    {/if}

    <div class="text-center mt-4">
      <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary">Torna al Pannello di Controllo</a>
    </div>

  </div>
</section><!-- End Manage Clients Section -->
{/block}
