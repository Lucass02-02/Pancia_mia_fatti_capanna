{* File: templates/menu.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
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

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/index">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <!-- ======= Page Title Section ======= -->
    <section class="page-title">
        <div class="container">
            <h1>Il Nostro Menù</h1>
        </div>
    </section><!-- End Page Title Section -->
<section class="my-5" style="background: url('/Pancia_mia_fatti_capanna/images/menu.avif') center center / cover no-repeat; height: 400px;">
  <div class="text-center text-white d-flex flex-column justify-content-center align-items-center h-100" style="background-color: rgba(0,0,0,0.4);">
    <h1 style="color:bisque">Esplora il nostro menù</h1>
  </div>
</section>
    <!-- ======= Menu Section ======= -->
    <section class="menu">
        <div class="container">

            {* Pulsanti admin gestione menu *}
            {if $user_role == 'admin'}
                <div class="text-center mb-4">
                    <a href="/Pancia_mia_fatti_capanna/Product/showCreateForm" class="btn btn-get-started mx-1">Aggiungi Nuovo Prodotto</a>
                    <a href="/Pancia_mia_fatti_capanna/Allergen/manage" class="btn btn-get-started mx-1">Gestisci Allergeni</a>
                    <a href="/Pancia_mia_fatti_capanna/Product/manageCategories" class="btn btn-get-started mx-1">Gestisci Categorie Prodotti</a>
                </div>
            {/if}

            {* Filtri allergeni *}
            <div class="php-email-form bg-white p-4 shadow-sm mb-5">
                <h3 class="text-secondary">Filtra per allergeni (mostra piatti senza):</h3>
                <form action="/Pancia_mia_fatti_capanna/Home/menu" method="POST">
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
                        <button type="submit" class="btn btn-secondary ms-2">Applica Filtro</button>
                        <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary ms-2">Rimuovi Filtro</a>
                    </div>
                </form>
            </div>

            {* Elenco prodotti *}
            {if empty($products)}
                <p class="text-center text-muted">Nessun piatto trovato con i filtri selezionati.</p>
            {else}
                <div class="row g-4">
                    {foreach from=$products item=product}
                        <div class="col-md-4">
                            <div class="menu-item card h-100 {if $user_role == 'admin' && !$product->isAvailable()}opacity-50 bg-light{/if}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{$product->getName()|escape}</h5>
                                    <p class="card-text">{$product->getDescription()|escape}</p>
                                    <p class="price">€ {$product->getPrice()|number_format:2:",":"."}</p>

                                    {* Pulsanti cliente *}
                                    {if $user_role == 'client'}
                                        <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST" class="mt-auto">
                                            <input type="hidden" name="product_id" value="{$product->getId()}">
                                            <div class="input-group">
                                                <input type="number" name="quantity" value="1" min="1" max="99" class="form-control" aria-label="Quantità">
                                                <button type="submit" class="btn btn-get-started">Aggiungi</button>
                                            </div>
                                        </form>
                                    {elseif !$user_id}
                                        <p class="text-danger mt-auto">Devi accedere per poter ordinare!</p>
                                    {/if}

                                    {* Pulsanti admin gestione prodotto *}
                                    {if $user_role == 'admin'}
                                        <div class="d-flex flex-wrap gap-2 mt-3">
                                            <a href="/Pancia_mia_fatti_capanna/Product/showEditForm/{$product->getId()}" class="btn btn-warning btn-sm">Modifica</a>
                                            {if $product->isAvailable()}
                                                <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/{$product->getId()}" class="btn btn-secondary btn-sm">Rendi Non Disp.</a>
                                            {else}
                                                <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/{$product->getId()}" class="btn btn-success btn-sm">Rendi Disp.</a>
                                            {/if}
                                            <a href="/Pancia_mia_fatti_capanna/Product/delete/{$product->getId()}" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo prodotto? L\'azione è irreversibile.');">Elimina</a>
                                        </div>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    {/foreach}
                </div>
            {/if}

            {* Pulsanti navigazione *}
            <div class="text-center mt-5">
                <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
                {if $user_role == 'client'}
                    <a href="/Pancia_mia_fatti_capanna/Cart/view" class="btn btn-secondary">Vai al Carrello</a>
                {elseif $user_role == 'admin'}
                    <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary ms-2">Torna al Pannello di Controllo</a>
                {/if}
            </div>

        </div>
    </section><!-- End Menu Section -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer><!-- End Footer -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
