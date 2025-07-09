{* File: templates/booking_form.tpl (SINTASSI SMARTY CORRETTA, STYLES.CSS APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Prenota un Tavolo</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container p-4 bg-white rounded shadow-sm" style="max-width: 500px;">
        <h1 class="text-center text-primary mb-4">Prenota il Tuo Tavolo</h1>

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
</body>
</html>
