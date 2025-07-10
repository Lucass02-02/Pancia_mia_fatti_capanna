{* File: templates/manage_halls.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Sale Ristorante</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 900px;">
        <h1 class="text-center text-primary mb-4">Gestione Banchetto Ristorante</h1>

        <div class="text-end mb-4">
            <a href="/Pancia_mia_fatti_capanna/Waiter/manage"  class="btn btn-info">Gestisci Camerieri</a>
        </div>

        {if isset($error) && $error}
            <div class="alert alert-danger" role="alert">
                Non puoi eliminare questa sala perché contiene dei camerieri, sposta i camerieri in un altra sala e riprova...
            </div>
        {/if}

        <h2 class="h5 mb-3">Aggiungi Nuova Sala</h2>
        <form action="/Pancia_mia_fatti_capanna/RestaurantHall/create" method="POST" class="mb-4 p-3 border rounded">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nome Sala:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="totalPlaces" class="form-label">Posti Totali:</label>
                    <input type="number" id="totalPlaces" name="totalPlaces" class="form-control" min="1" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Crea Sala</button>
                </div>
            </div>
        </form>

        <h2 class="h5 mb-3">Sale Esistenti</h2>
        {if empty($halls)}
            <p class="text-center text-muted">Nessuna sala ristorante presente.</p>
        {else}
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Posti Totali</th>
                            <th class="text-center">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $halls as $hall}
                            <tr>
                                <td>{$hall->getIdHall()}</td>
                                <td>{$hall->getName()|escape}</td>
                                <td>{$hall->getTotalPlaces()}</td>
                                <td class="text-center">
                                    <form action="/Pancia_mia_fatti_capanna/RestaurantHall/delete" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare la sala {$hall->getName()|escape}?');">
                                        <input type="hidden" name="hall_id" value="{$hall->getIdHall()}">
                                        <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                                    </form>
                                </td>
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
</body>
</html>