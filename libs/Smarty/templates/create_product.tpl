{* File: templates/create_product.tpl (SINTASSI SMARTY CORRETTA, STYLES.CSS APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Crea Nuovo Prodotto</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container p-4 bg-white rounded shadow-sm" style="max-width: 600px;">
        <h1 class="text-center text-primary mb-4">Crea Nuovo Prodotto</h1>
        <form action="/Pancia_mia_fatti_capanna/Product/create" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nome Prodotto</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo (€)</label>
                <input type="number" id="price" name="price" step="0.01" min="0" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">Seleziona una categoria</option>
                    {foreach $categories as $category}
                        <option value="{$category->getId()}">{$category->getName()|escape}</option>
                    {/foreach}
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Allergeni Presenti nel Piatto</label>
                <div class="border rounded p-3">
                    <div class="row">
                        {foreach $allAllergens as $allergen}
                            <div class="col-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergens[]" value="{$allergen->getId()}" id="allergen{$allergen->getId()}">
                                    <label class="form-check-label" for="allergen{$allergen->getId()}">
                                        {$allergen->getAllergenType()|escape}
                                    </label>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-success w-100">Crea Prodotto</button>
        </form>
        <div class="text-center mt-3">
            <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary">Annulla</a>
        </div>
    </div>
</body>
</html>
