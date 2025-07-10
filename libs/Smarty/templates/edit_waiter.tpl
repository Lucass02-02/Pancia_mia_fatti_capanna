{* File: templates/edit_waiter.tpl (SINTASSI SMARTY CORRETTA, STYLES.CSS APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Cameriere</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 800px;">
        <h1 class="text-primary text-center mb-4">Modifica Cameriere</h1>

        {* Mostra messaggi di errore o successo *}
        {if isset($error) && $error}
            <div class="alert alert-danger" role="alert">
                Errore: {$error|escape}
            </div>
        {/if}

        <form action="/Pancia_mia_fatti_capanna/Waiter/update" method="POST" class="row g-3">
            <input type="hidden" name="id" value="{$waiter->getId()}"> {* ID del cameriere *}

            <div class="col-md-6">
                <label for="name" class="form-label">Nome</label>
                <input type="text" id="name" name="name" class="form-control" value="{$waiter->getName()|escape}" required>
            </div>
            <div class="col-md-6">
                <label for="surname" class="form-label">Cognome</label>
                <input type="text" id="surname" name="surname" class="form-control" value="{$waiter->getSurname()|escape}" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{$waiter->getEmail()|escape}" required>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Nuova Password (lascia vuoto per non modificare)</label>
                <input type="password" id="password" name="password" placeholder="••••••••" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="birthDate" class="form-label">Data di Nascita</label>
                <input type="date" id="birthDate" name="birthDate" class="form-control" value="{$waiter->getBirthDate()->format('Y-m-d')}" required>
            </div>
            <div class="col-md-6">
                <label for="serialNumber" class="form-label">Matricola</label>
                <input type="text" id="serialNumber" name="serialNumber" class="form-control" value="{$waiter->getSerialNumber()|escape}" required>
            </div>
            <div class="col-12">
                <label for="hall_id" class="form-label">Assegna a una Sala</label>
                <select id="hall_id" name="hall_id" class="form-select" required>
                    <option value="">Seleziona una sala...</option>
                    {foreach $halls as $hall}
                        <option value="{$hall->getIdHall()}" {if $waiter->getRestaurantHall() && $waiter->getRestaurantHall()->getIdHall() == $hall->getIdHall()}selected{/if}>
                            {$hall->getName()|escape}
                        </option>
                    {/foreach}
                </select>
            </div>
            <div class="col-12 mt-4 d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Salva Modifiche</button>
                <a href="/Pancia_mia_fatti_capanna/Waiter/manage" class="btn btn-secondary">Annulla</a>
            </div>
        </form>
    </div>
</body>
</html>