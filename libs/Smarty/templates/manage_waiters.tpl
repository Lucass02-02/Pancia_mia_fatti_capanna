{* File: templates/manage_waiters.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Camerieri</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; color: #333; }
        .container { max-width: 1200px; margin: 2em auto; padding: 2em; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h1, h2 { color: #e8491d; text-align: center; }
        .form-section, .list-section { margin-bottom: 2.5em; padding: 1.5em; border: 1px solid #ddd; border-radius: 8px; }
        .registration-form { display: grid; grid-template-columns: 1fr 1fr; gap: 15px 20px; }
        .form-group { display: flex; flex-direction: column; }
        .form-group.full-width { grid-column: 1 / -1; }
        .form-group label { margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group select { padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 1em; }
        .form-group button { padding: 12px 20px; border: none; border-radius: 4px; background-color: #28a745; color: white; cursor: pointer; font-size: 1.1em; transition: background-color 0.2s; margin-top: 10px; }
        .form-group button:hover { background-color: #218838; }
        table { width: 100%; border-collapse: collapse; margin-top: 1.5em; }
        th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; vertical-align: middle; }
        th { background-color: #f2f2f2; }
        .delete-btn { display: inline-block; background-color: #dc3545; color: white; text-decoration: none; padding: 8px 12px; border-radius: 4px; }
        .hall-update-form { display: flex; align-items: center; gap: 10px; }
        .hall-update-form select { flex-grow: 1; }
        .hall-update-form button { background-color: #007bff; font-size: 0.9em; padding: 8px 12px; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .hall-update-form button:hover { background-color: #0056b3; }
        .nav-links { margin-top: 2em; text-align: center; }
        .nav-links a { color: #e8491d; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestione Camerieri</h1>
        <div class="form-section">
            <h2>Registra Nuovo Cameriere</h2>
            <form action="/Pancia_mia_fatti_capanna/Waiter/register" method="POST" class="registration-form">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" placeholder="Mario" required>
                </div>
                <div class="form-group">
                    <label for="surname">Cognome</label>
                    <input type="text" id="surname" name="surname" placeholder="Rossi" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="m.rossi@ristorante.it" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
                <div class="form-group">
                    <label for="birthDate">Data di Nascita</label>
                    <input type="date" id="birthDate" name="birthDate" required>
                </div>
                <div class="form-group">
                    <label for="serialNumber">Matricola</label>
                    <input type="text" id="serialNumber" name="serialNumber" placeholder="ID Univoco" required>
                </div>
                <div class="form-group full-width">
                    <label for="hall_id">Assegna a una Sala</label>
                    <select id="hall_id" name="hall_id" required>
                        <option value="">Seleziona una sala...</option>
                        {foreach $halls as $hall}
                            <option value="{$hall->getIdHall()}">{$hall->getName()|escape}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group full-width">
                    <button type="submit">Registra Cameriere</button>
                </div>
            </form>
        </div>

        <div class="list-section">
            <h2>Camerieri Registrati</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome Completo</th>
                        <th>Matricola</th>
                        <th>Sala Assegnata</th>
                        <th>Azione</th>
                    </tr>
                </thead>
                <tbody>
                    {if empty($waiters)}
                        <tr><td colspan="5" style="text-align:center;">Non ci sono camerieri registrati.</td></tr>
                    {else}
                        {foreach $waiters as $waiter}
                        <tr>
                            <td>{$waiter->getId()}</td>
                            <td>{$waiter->getName()|escape} {$waiter->getSurname()|escape}</td>
                            <td>{$waiter->getSerialNumber()|escape}</td>
                            <td>
                                <form class="hall-update-form" action="/Pancia_mia_fatti_capanna/Waiter/updateHall" method="POST">
                                    <input type="hidden" name="waiter_id" value="{$waiter->getId()}">
                                    <select name="hall_id">
                                        {foreach $halls as $hall}
                                            <option value="{$hall->getIdHall()}" {if $waiter->getRestaurantHall() && $waiter->getRestaurantHall()->getIdHall() == $hall->getIdHall()}selected{/if}>
                                                {$hall->getName()|escape}
                                            </option>
                                        {/foreach}
                                    </select>
                                    <button type="submit">Salva</button>
                                </form>
                            </td>
                            <td>
                                <a href="/Pancia_mia_fatti_capanna/Waiter/delete/{$waiter->getId()}" class="delete-btn" onclick="return confirm('Sei sicuro di voler eliminare questo cameriere?');">Elimina</a>
                            </td>
                        </tr>
                        {/foreach}
                    {/if}
                </tbody>
            </table>
        </div>
        <div class="nav-links">
            <a href="/Pancia_mia_fatti_capanna/Admin/profile">Torna al Pannello di Controllo</a>
        </div>
    </div>
</body>
</html>
