{* File: templates/manage_tables.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Tavoli</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body>

    <header id="header" class="header d-flex align-items-center">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/index">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><section class="page-title">
        <div class="container">
            <h1>Gestione Tavoli</h1>
        </div>
    </section><section class="contact">
        <div class="container" style="max-width: 1100px;">

            {if isset($error) && $error}
                <div class="alert alert-danger" role="alert">
                    {$error|escape}
                </div>
            {/if}

            <div class="php-email-form bg-white p-4 shadow-sm mb-5">
                <h2 class="h4 text-secondary mb-3">Aggiungi Nuovo Tavolo</h2>
                <form action="/Pancia_mia_fatti_capanna/Table/create" method="POST" class="row g-3 align-items-center justify-content-center">
                    <div class="col-auto">
                        <label for="seatsNumber" class="col-form-label">Numero Posti:</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" id="seatsNumber" name="seatsNumber" min="1" class="form-control" required>
                    </div>
                    <div class="col-auto">
                        <label for="hall_id" class="col-form-label">Banchetto:</label>
                    </div>
                    <div class="col-auto">
                        <select id="hall_id" name="hall_id" class="form-select" required>
                            <option value="">Seleziona un banchetto</option>
                            {foreach $halls as $hall}
                                <option value="{$hall->getIdHall()}">{$hall->getName()|escape}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-get-started">Aggiungi Tavolo</button>
                    </div>
                </form>
            </div>

            <div class="php-email-form bg-white p-4 shadow-sm mb-5">
                <h2 class="h4 text-secondary mb-3">Tavoli Esistenti</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>N. Posti</th>
                                <th>Sala</th>
                                <th>Stato Attuale</th>
                                <th>Cambia Stato</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $tables as $table}
                                <tr>
                                    <td>{$table->getIdTable()}</td>
                                    <td>{$table->getSeatsNumber()}</td>
                                    <td>{$table->getRestaurantHall()->getName()|escape}</td>
                                    <td>
                                        <span class="fw-bold text-{if $table->getState()->value == 'available'}success{elseif $table->getState()->value == 'reserved'}warning{elseif $table->getState()->value == 'occupied'}danger{/if}">
                                            {$table->getState()->value|upper}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="/Pancia_mia_fatti_capanna/Table/updateState" method="POST" class="d-flex align-items-center gap-2">
                                            <input type="hidden" name="table_id" value="{$table->getIdTable()}">
                                            <select name="state" class="form-select">
                                                <option value="available" {if $table->getState()->value eq 'available'}selected{/if}>Disponibile</option>
                                                <option value="reserved" {if $table->getState()->value eq 'reserved'}selected{/if}>Prenotato</option>
                                                <option value="occupied" {if $table->getState()->value eq 'occupied'}selected{/if}>Occupato</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="/Pancia_mia_fatti_capanna/Table/delete/{$table->getIdTable()}" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo tavolo?');">Elimina</a>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary">Torna al Pannello di Controllo</a>
                <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
            </div>

        </div>
    </section><footer id="footer" class="footer">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>