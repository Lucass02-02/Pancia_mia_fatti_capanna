{* File: templates/waiter_tables_view.tpl (SINTASSI SMARTY COMPLETA E BOOTSTRAP APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Stato Tavoli - {$hall->getName()|escape}</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 900px;">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1 class="text-primary text-center mb-4">Stato Tavoli - {$hall->getName()|escape}</h1>

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
    </div>
</body>
</html>
