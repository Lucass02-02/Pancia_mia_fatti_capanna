{* File: templates/menu.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Nostro Menù - Pancia mia fatti capanna</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-primary text-center mb-4">Il Nostro Menu</h1>

        {* Sezione filtri allergeni *}
        <div class="bg-white p-4 rounded shadow-sm mb-5">
            <h3 class="text-secondary">Filtra per allergeni (mostra piatti senza):</h3>
            <form action="/Pancia_mia_fatti_capanna/Client/order" method="POST">
                <div class="row">
                    {foreach from=$allAllergens item=allergen}
                        <div class="col-md-3 col-sm-4 col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="allergens[]" value="{$allergen->getId()}"
                                    {if in_array($allergen->getId(), $selectedAllergens)}checked{/if} id="allergen{$allergen->getId()}">
                                <label class="form-check-label" for="allergen{$allergen->getId()}">
                                    {$allergen->getAllergenType()|escape}
                                </label>
                            </div>
                        </div>
                    {/foreach}
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Applica Filtro</button>
                    <a href="/Pancia_mia_fatti_capanna/Client/order" class="btn btn-secondary ms-2">Rimuovi Filtro</a>
                </div>
            </form>
        </div>

        {* Sezione elenco prodotti *}
        {if empty($products)}
            <p class="text-center text-muted">Nessun piatto trovato con i filtri selezionati.</p>
        {else}
            <div class="row g-4">
                {foreach from=$products item=product}
                    <div class="col-md-4">
                        <div class="card h-100 {if $user_role == 'admin' && !$product->isAvailable()}opacity-50 bg-light{/if}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{$product->getName()|escape}</h5>
                                <p class="card-text">{$product->getDescription()|escape}</p>
                                <p class="fw-bold">€ {$product->getCost()|number_format:2:",":"."}</p>

                                {* Logica condizionale per i pulsanti di acquisto/gestione *}

                                {* Se l'utente è un CLIENTE, mostra il form per aggiungere al carrello *}
                                {if $user_role == 'client'}
                                <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST" class="mt-auto">
                                    <input type="hidden" name="product_id" value="{$product->getIdProduct()}">
                                    <div class="input-group">
                                        <input type="number" name="quantity" value="1" min="1" max="99" class="form-control" aria-label="Quantità">
                                        <button type="submit" class="btn btn-primary">Aggiungi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>
        {/if}

        {* Pulsanti di navigazione in fondo alla pagina *}
        <div class="d-flex justify-content-center gap-3 mt-5">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
            {* Mostra il pulsante "Vai al Carrello" solo ai clienti *}
            {if $user_role == 'client'}
                <a href="/Pancia_mia_fatti_capanna/Cart/view" class="btn btn-primary">Vai al Carrello</a>
            {/if}
        </div>
    </div>
</body>
</html>