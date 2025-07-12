{* File: templates/menu.tpl (YUMMY STYLE CLIENTE) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Nostro Menù - Pancia mia fatti capanna</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body class="bg-light">

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <main>
        <div class="container" style="max-width: 1100px;">
            <div class="surface p-4 rounded shadow-sm">
                <h1 class="text-center mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">
                    Il Nostro Menù
                </h1>

                {* Filtro per allergeni *}
                <div class="surface p-4 rounded shadow-sm mb-5 border">
                    <h3 class="h5 mb-3" style="color: var(--heading-color);">Filtra per allergeni (escludi):</h3>
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
                        <div class="mt-3 d-flex gap-2">
                            <button type="submit" class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">Applica Filtro</button>
                            <a href="/Pancia_mia_fatti_capanna/Client/order" class="btn btn-secondary">Rimuovi Filtro</a>
                        </div>
                    </form>
                </div>

                {* Sezione prodotti *}
                {if empty($products)}
                    <p class="text-center text-muted">Nessun piatto trovato con i filtri selezionati.</p>
                {else}
                    <div class="row g-4">
                        {foreach from=$products item=product}
                            <div class="col-md-4">
                                <div class="card h-100 {if $user_role == 'admin' && !$product->isAvailable()}opacity-50 bg-light{/if}">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title" style="color: var(--heading-color); font-family: var(--heading-font);">
                                            {$product->getName()|escape}
                                        </h5>
                                        <p class="card-text">{$product->getDescription()|escape}</p>
                                        <p class="fw-bold">€ {$product->getCost()|number_format:2:",":"."}</p>

                                        {* SOLO CLIENT: Form per aggiungere al carrello *}
                                        {if $user_role == 'client'}
                                            <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST" class="mt-auto">
                                                <input type="hidden" name="product_id" value="{$product->getIdProduct()}">
                                                <div class="input-group">
                                                    <input type="number" name="quantity" value="1" min="1" max="99" class="form-control" aria-label="Quantità">
                                                    <button type="submit" class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">Aggiungi</button>
                                                </div>
                                            </form>
                                        {/if}
                                    </div>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                {/if}

                {* Pulsanti di navigazione *}
                <div class="text-center mt-5 d-flex justify-content-center gap-3">
                    <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
                    {if $user_role == 'client'}
                        <a href="/Pancia_mia_fatti_capanna/Cart/view" class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">Vai al Carrello</a>
                    {/if}
                </div>
            </div>
        </div>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer mt-5">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
