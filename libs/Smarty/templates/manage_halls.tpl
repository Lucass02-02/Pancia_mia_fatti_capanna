{* File: templates/manage_halls.tpl (CORRETTO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Sale</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 900px;">
        <h1 class="text-primary text-center mb-4">Gestione Banchetto</h1>

        <div class="card mb-5">
            <div class="card-header">
                Aggiungi Nuova Sala
            </div>
            <div class="card-body">
                <form action="/Pancia_mia_fatti_capanna/RestaurantHall/create" method="POST" class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome Banchetto</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="totalPlaces" class="form-label">Posti Totali</label>
                        <input type="number" id="totalPlaces" name="totalPlaces" class="form-control" min="1" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">Aggiungi</button>
                    </div>
                </form>
            </div>
        </div>

        <h2 class="h4 text-secondary mb-3">Banchetti Esistenti</h2>
        {if empty($halls)}
            <p class="text-center text-muted">Non ci sono banchetti registrati al momento.</p>
        {else}
            <div class="table-responsive">
                <table class="table table-stripdevered table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome Sala</th>
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
                                    {* Questo è il form corretto per l'eliminazione *}
                                    <form action="/Pancia_mia_fatti_capanna/RestaurantHall/delete" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa sala?');">
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
            <a href="/Pancia_mia_fatti_capanna/" class="btn btn-secondary">Torna alla Home</a>
        </div>
    </div>
</body>
</html>