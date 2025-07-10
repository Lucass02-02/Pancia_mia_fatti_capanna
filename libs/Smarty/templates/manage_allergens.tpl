{* File: templates/manage_allergens.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Allergeni</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css"> {* Assicurati che questo percorso sia corretto *}
    <style>
        /* Stili aggiuntivi o sovrascritture per questa pagina */
        .container { max-width: 800px; margin: 30px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .table-responsive { margin-top: 20px; }
        .table th, .table td { vertical-align: middle; }
        .btn-group { display: flex; gap: 5px; }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <h1 class="text-primary text-center mb-4">Gestione Allergeni</h1>

        <div class="mb-4">
            <h2 class="h4 text-secondary mb-3">Aggiungi Nuovo Allergene</h2>
            <form action="/Pancia_mia_fatti_capanna/Allergen/create" method="POST" class="d-flex gap-2">
                <input type="text" name="name" class="form-control" placeholder="Nome Allergene (es. Glutine)" required>
                <button type="submit" class="btn btn-primary">Aggiungi</button>
            </form>
        </div>

        <div class="table-responsive">
            <h2 class="h4 text-secondary mb-3">Elenco Allergeni Esistenti</h2>
            {if count($allergens) > 0}
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome Allergene</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$allergens item=allergen}
                            <tr>
                                <td>{$allergen->getId()|escape}</td>
                                <td>{$allergen->getAllergenType()|escape}</td> {* <--- CORREZIONE QUI! Usa getAllergenType() *}
                                <td>
                                    <div class="btn-group">
                                        {* Se avrai una pagina di modifica per allergeni, aggiungi qui il link *}
                                        {* <a href="/Pancia_mia_fatti_capanna/Allergen/edit/{$allergen->getId()}" class="btn btn-warning btn-sm">Modifica</a> *}
                                        <form action="/Pancia_mia_fatti_capanna/Allergen/delete/{$allergen->getId()}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare l\'allergene {$allergen->getAllergenType()|escape}?');">
                                            <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            {else}
                <p>Nessun allergene trovato. Aggiungine uno nuovo!</p>
            {/if}
        </div>

        <div class="text-center mt-4">
            <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary me-2">Torna al Menu</a>
        </div>
    </div>
</body>
</html>