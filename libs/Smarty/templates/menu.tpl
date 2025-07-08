{* File: templates/menu.tpl (SINTASSI SMARTY COMPLETA E URL GOFFY REST AGGIUSTATI) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Nostro Menù - Pancia mia fatti capanna</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; }
        .container { max-width: 1200px; margin: 2em auto; padding: 1em; }
        h1, h3 { color: #e8491d; }
        .filter-container { background: #fff; padding: 1.5em; border-radius: 8px; margin-bottom: 2em; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .allergen-list { display: flex; flex-wrap: wrap; gap: 15px; padding-bottom: 1em; }
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5em; }
        .product-card { background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); display: flex; flex-direction: column; padding: 1.5em; transition: opacity 0.3s ease; }
        .product-card.unavailable { opacity: 0.6; background-color: #f8f9fa; }
        .product-actions { margin-top: auto; padding-top: 1em; text-align: right; display: flex; align-items: center; justify-content: flex-end; }
        .product-actions input[type="number"] { width: 60px; padding: 5px; margin-right: 10px; text-align: center; border: 1px solid #ccc; border-radius: 4px; }
        .product-actions button { background-color: #e8491d; color: white; border: none; padding: 0.7em 1.2em; border-radius: 5px; cursor: pointer; font-size: 0.9em; }
        .admin-top-actions { display: flex; justify-content: center; gap: 20px; margin-bottom: 2em; }
        .btn-create, .btn-manage { padding: 12px 25px; border-radius: 5px; text-decoration: none; font-size: 1.1em; font-weight: bold; color: white; }
        .btn-create { background-color: #28a745; }
        .btn-manage { background-color: #17a2b8; }
        .admin-actions { margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee; display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; }
        .admin-actions a { text-decoration: none; color: white; padding: 8px 12px; border-radius: 4px; font-size: 0.9em; text-align: center; }
        .btn-edit { background-color: #ffc107; }
        .btn-delete { background-color: #dc3545; }
        .btn-toggle-available { background-color: #28a745; }
        .btn-toggle-unavailable { background-color: #6c757d; }
        .nav-actions { margin-top: 30px; text-align: center; display: flex; justify-content: center; gap: 20px; }
        .nav-actions a { text-decoration: none; color: white; background-color: #007bff; padding: 10px 15px; border-radius: 5px; display: inline-block; border: none; cursor: pointer; font-size: 1em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Il Nostro Menù</h1>

        {if $user_role == 'admin'}
            <div class="admin-top-actions">
                <a href="/Pancia_mia_fatti_capanna/Product/showCreateForm" class="btn-create">Aggiungi Nuovo Prodotto</a>
                <a href="/Pancia_mia_fatti_capanna/Allergen/manage" class="btn-manage">Gestisci Allergeni</a>
            </div>
        {/if}

        <div class="filter-container">
            <h3>Filtra per allergeni (mostra piatti senza):</h3>
            <form action="/Pancia_mia_fatti_capanna/Home/menu" method="GET">
                <div class="allergen-list">
                    {foreach from=$allAllergens item=allergen}
                        <label>
                            <input type="checkbox" name="allergens[]" value="{$allergen->getId()}"
                                {if in_array($allergen->getId(), $selectedAllergens)}checked{/if}>
                            {$allergen->getAllergenType()|escape}
                        </label>
                    {/foreach}
                </div>
                <button type="submit">Applica Filtro</button>
                <a href="/Pancia_mia_fatti_capanna/Home/menu" style="margin-left: 10px;">Rimuovi Filtro</a>
            </form>
        </div>

        {if empty($products)}
            <p>Nessun piatto trovato con i filtri selezionati.</p>
        {else}
            <div class="menu-grid">
                {foreach from=$products item=product}
                    {assign var="cardClass" value="product-card"}
                    {if $user_role == 'admin' && !$product->isAvailable()}
                        {assign var="cardClass" value="product-card unavailable"}
                    {/if}

                    <div class="{$cardClass}">
                        <h3>{$product->getName()|escape}</h3>
                        <p>{$product->getDescription()|escape}</p>
                        <p><strong>€ {$product->getPrice()|number_format:2:",":"."}</strong></p>

                        {if $user_id && $user_role != 'admin'}
                            <div class="product-actions">
                                <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST">
                                    <input type="hidden" name="product_id" value="{$product->getId()}">
                                    <input type="number" name="quantity" value="1" min="1" max="99" aria-label="Quantità">
                                    <button type="submit">Aggiungi</button>
                                </form>
                            </div>
                        {elseif !$user_id}
                            <p style="margin-top: auto; padding-top: 1em; text-align: right; color: gray;">Accedi per aggiungere al carrello.</p>
                        {/if}

                        {if $user_role == 'admin'}
                            <div class="admin-actions">
                                <a href="/Pancia_mia_fatti_capanna/Product/showEditForm/{$product->getId()}" class="btn-edit">Modifica</a>
                                {if $product->isAvailable()}
                                    <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/{$product->getId()}" class="btn-toggle-available">Rendi Non Disp.</a>
                                {else}
                                    <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/{$product->getId()}" class="btn-toggle-unavailable">Rendi Disp.</a>
                                {/if}
                                <a href="/Pancia_mia_fatti_capanna/Product/delete/{$product->getId()}" class="btn-delete" onclick="return confirm('Sei sicuro di voler eliminare questo prodotto? L\'azione è irreversibile.');">Elimina</a>
                            </div>
                        {/if}
                    </div>
                {/foreach}
            </div>
        {/if}

        <div class="nav-actions">
            <a href="/Pancia_mia_fatti_capanna/Home/home">Torna alla Home</a>
            {if $user_id && $user_role != 'admin'}
                <a href="/Pancia_mia_fatti_capanna/Cart/view">Vai al Carrello</a>
            {/if}
        </div>
    </div>
</body>
</html>
