{* File: templates/manage_waiters.tpl (SINTASSI SMARTY CORRETTA, STYLES.CSS APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Camerieri</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 1200px;">
        <h1 class="text-primary text-center mb-4">Gestione Camerieri</h1>
         <div class="text-end mb-4">
            <a href="/Pancia_mia_fatti_capanna/RestaurantHall/manage" class="btn btn-info">Gestisci Banchetto</a>
        </div>
        

        <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">Registra Nuovo Cameriere</h2>
            <form action="/Pancia_mia_fatti_capanna/Waiter/register" method="POST" class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" id="name" name="name" placeholder="Mario" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="surname" class="form-label">Cognome</label>
                    <input type="text" id="surname" name="surname" placeholder="Rossi" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" placeholder="m.rossi@ristorante.it" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="birthDate" class="form-label">Data di Nascita</label>
                    <input type="date" id="birthDate" name="birthDate" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="serialNumber" class="form-label">Matricola</label>
                    <input type="text" id="serialNumber" name="serialNumber" placeholder="ID Univoco" class="form-control" required>
                </div>
                <div class="col-12">
                    <label for="hall_id" class="form-label">Assegna a una Sala</label>
                    <select id="hall_id" name="hall_id" class="form-select" required>
                        <option value="">Seleziona una sala...</option>
                        {foreach $halls as $hall}
                            <option value="{$hall->getIdHall()}">{$hall->getName()|escape}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success w-100">Registra Cameriere</button>
                </div>
            </form>
        </div>

        <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">Camerieri Registrati</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nome Completo</th>
                            <th>Matricola</th>
                            <th>Sala Assegnata</th>
                            <th>Azioni</th> {* Nuova colonna per i pulsanti Modifica/Elimina *}
                        </tr>
                    </thead>
                    <tbody>
                        {if empty($waiters)}
                            <tr><td colspan="4" class="text-center">Non ci sono camerieri registrati.</td></tr>
                        {else}
                            {foreach $waiters as $waiter}
                            <tr>
                                <td>{$waiter->getName()|escape} {$waiter->getSurname()|escape}</td>
                                <td>{$waiter->getSerialNumber()|escape}</td>
                                <td>
                                    <form action="/Pancia_mia_fatti_capanna/Waiter/updateHall" method="POST" class="d-flex align-items-center gap-2">
                                        <input type="hidden" name="waiter_id" value="{$waiter->getId()}">
                                        <select name="hall_id" class="form-select">
                                            {foreach $halls as $hall}
                                                <option value="{$hall->getIdHall()}" {if $waiter->getRestaurantHall() && $waiter->getRestaurantHall()->getIdHall() == $hall->getIdHall()}selected{/if}>
                                                    {$hall->getName()|escape}
                                                </option>
                                            {/foreach}
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                                    </form>
                                </td>
                                <td>
                                    <div class="d-flex gap-2"> {* Contenitore per allineare i pulsanti *}
                                        <a href="/Pancia_mia_fatti_capanna/Waiter/edit/{$waiter->getId()}" class="btn btn-warning btn-sm">Modifica</a> {* Nuovo pulsante Modifica *}
                                        <a href="/Pancia_mia_fatti_capanna/Waiter/delete/{$waiter->getId()}" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo cameriere?');">Elimina</a>
                                    </div>
                                </td>
                            </tr>
                            {/foreach}
                        {/if}
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary">Torna al Pannello di Controllo</a>
        </div>
    </div>
</body>
</html>