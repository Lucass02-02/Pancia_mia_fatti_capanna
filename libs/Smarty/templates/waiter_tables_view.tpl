{* File: templates/waiter_tables_view.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Stato Tavoli - {$hall->getName()|escape}</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; }
        .container { max-width: 900px; margin: 2em auto; padding: 2em; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #e8491d; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 1.5em; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; vertical-align: middle; }
        th { background-color: #f2f2f2; }
        .action-form { display: flex; gap: 10px; align-items: center; }
        .action-form select { padding: 8px; flex-grow: 1; border-radius: 4px; border: 1px solid #ccc; }
        .action-form button { background-color: #007bff; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; }
        .nav-links { margin-top: 2.5em; text-align: center; }
        .nav-links a { color: #007bff; font-weight: bold; text-decoration: none; }
        .state-available { color: green; font-weight: bold; }
        .state-reserved { color: orange; font-weight: bold; }
        .state-occupied { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Stato Tavoli - {$hall->getName()|escape}</h1>

        {if $tables->isEmpty()}
            <p style="text-align:center;">Non ci sono tavoli assegnati a questa sala.</p>
        {else}
            <table>
                <thead>
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
                                <span class="state-{$table->getState()->value}">
                                    {$table->getState()->value|upper}
                                </span>
                            </td>
                            <td>
                                <form class="action-form" action="{url controller='waiter' action='updateTableState'}" method="POST">
                                    <input type="hidden" name="table_id" value="{$table->getIdTable()}">
                                    <select name="state">
                                        <option value="available" {if $table->getState()->value eq 'available'}selected{/if}>Disponibile</option>
                                        <option value="reserved" {if $table->getState()->value eq 'reserved'}selected{/if}>Prenotato</option>
                                        <option value="occupied" {if $table->getState()->value eq 'occupied'}selected{/if}>Occupato</option>
                                    </select>
                                    <button type="submit">Salva</button>
                                </form>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {/if}

        <div class="nav-links">
            <a href="{url controller='waiter' action='profile'}">Torna alla Dashboard</a>
        </div>
    </div>
</body>
</html>