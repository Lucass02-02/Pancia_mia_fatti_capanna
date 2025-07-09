{* File: templates/manage_tables.tpl (SINTASSI SMARTY CORRETTA, STYLES.CSS APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Tavoli</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 1100px;">
        <h1 class="text-primary text-center mb-4">Gestione Tavoli</h1>

        <div class="text-end mb-4">
            <a href="/Pancia_mia_fatti_capanna/RestaurantHall/manage" class="btn btn-info">Gestisci Banchetto</a>
        </div>

        <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">Aggiungi Nuovo Tavolo</h2>
            <form action="/Pancia_mia_fatti_capanna/Table/create" method="POST" class="row g-3 align-items-center justify-content-center">
                <div class="col-auto">
                    <label for="seatsNumber" class="col-form-label">Numero Posti:</label>
                </div>
                <div class="col-auto">
                    <input type="number" id="seatsNumber" name="seatsNumber" min="1" class="form-control" required>
                </div>
                <div class="col-auto">
                    <label for="hall_id" class="col-form-label">Sala:</label>
                </div>
                <div class="col-auto">
                    <select id="hall_id" name="hall_id" class="form-select" required>
                        <option value="">Seleziona una sala</option>
                        {foreach $halls as $hall}
                            <option value="{$hall->getIdHall()}">{$hall->getName()|escape}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success">Aggiungi Tavolo</button>
                </div>
            </form>
        </div>

        <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">Tavoli Esistenti</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
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
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
        </div>
    </div>
</body>
</html>
