{* File: templates/menu.tpl (RIADATTATA CON FUNZIONI CLIENT) *}

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

<header id="header" class="header d-flex align-items-center mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
            <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
        </div>
    </div>
</header>

<section class="page-title" style="
    background: url('https://img.freepik.com/vettori-gratuito/menu-ristorante-digitale-in-formato-verticale_23-2148649586.jpg') center top / cover no-repeat;
    height: 350px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 30px;
    position: relative;
">
    <div style="
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
    "></div>

    <h1 style="
        position: relative;
        color: white;
        font-family: var(--heading-font);
        font-size: 2.5rem;
        text-align: center;
        z-index: 2;
        margin: 0;
    ">
        Il Nostro Menù
    </h1>
</section>

<main>
    <div class="container my-5" style="max-width: 1100px;">
        <div class="surface p-4 rounded shadow-sm">

            {* === SEZIONE GESTIONE ADMIN === *}
            {if $user_role == 'admin'}
                <div class="text-center mb-4 d-flex flex-wrap justify-content-center gap-3">
                    <a href="/Pancia_mia_fatti_capanna/Product/showCreateForm" class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">Aggiungi Nuovo Prodotto</a>
                    <a href="/Pancia_mia_fatti_capanna/Allergen/manage" class="btn btn-secondary">Gestisci Allergeni</a>
                    <a href="/Pancia_mia_fatti_capanna/Product/manageCategories" class="btn btn-secondary">Gestisci Categorie Prodotti</a>
                </div>
            {/if}

            {* === SEZIONE FILTRO PER ALLERGIE (VISIBILE SOLO AI CLIENT) === *}
            {if $user_role == 'client'}
                <div class="bg-white p-4 rounded shadow-sm mb-4 border">
                    <h2 class="h5 mb-3">Filtra per allergeni (mostra piatti senza):</h2>
                    <form action="/Pancia_mia_fatti_capanna/Home/menu" method="post" class="row g-3 align-items-end">
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
                            <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary ms-2">Rimuovi Filtro</a>
                        </div>
                    </form>
                </div>
            {/if}

            {* === SEZIONE ELENCO PIATTI === *}
            {if empty($products)}
                <p class="text-center text-muted">Nessun piatto disponibile.</p>
            {else}
                <div class="row g-4">
                    {foreach from=$products item=product}
                        <div class="col-md-4">
                            <div class="card h-100 {if !$product->isAvailable()}opacity-50 bg-light{/if}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title" style="color: var(--heading-color); font-family: var(--heading-font);">{$product->getName()|escape}</h5>
                                    <p class="card-text">{$product->getDescription()|escape}</p>
                                    <p class="fw-bold">€ {$product->getPrice()|number_format:2:",":"."}</p>

                                    {* === ADMIN: Pulsanti gestione prodotto === *}
                                    {if $user_role == 'admin'}
                                        <div class="d-flex flex-wrap gap-2 mt-auto">
                                            <a href="/Pancia_mia_fatti_capanna/Product/showEditForm/{$product->getIdProduct()}" class="btn btn-warning btn-sm">Modifica</a>
                                            {if $product->isAvailable()}
                                                <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/{$product->getIdProduct()}" class="btn btn-secondary btn-sm">Rendi Non Disp.</a>
                                            {else}
                                                <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/{$product->getIdProduct()}" class="btn btn-success btn-sm">Rendi Disp.</a>
                                            {/if}
                                            <a href="/Pancia_mia_fatti_capanna/Product/delete/{$product->getIdProduct()}" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo prodotto?');">Elimina</a>
                                        </div>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    {/foreach}
                </div>
            {/if}

            {* === NAVIGAZIONE IN FONDO === *}
            <div class="text-center mt-5 d-flex justify-content-center gap-3">
                <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
                {if $user_role == 'admin'}
                    <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">Torna al Pannello di Controllo</a>
                {/if}
            </div>
        </div>
    </div>
</main>

<footer id="footer" class="footer mt-5">
    <div class="container text-center">
        <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>