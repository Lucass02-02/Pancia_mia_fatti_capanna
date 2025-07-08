{* File: templates/edit_product.tpl (SINTASSI SMARTY CORRETTA, STYLES.CSS APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Prodotto - {$product->getName()|escape}</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container p-4 bg-white rounded shadow-sm" style="max-width: 600px;">
        <h1 class="text-center text-primary mb-4">Modifica Prodotto</h1>
        <form action="/Pancia_mia_fatti_capanna/Product/update" method="POST">
            <input type="hidden" name="product_id" value="{$product->getId()}">
            
            <div class="mb-3">
                <label for="name" class="form-label">Nome Prodotto</label>
                <input type="text" id="name" name="name" value="{$product->getName()|escape}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea id="description" name="description" class="form-control" rows="4" required>{$product->getDescription()|escape}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo (€)</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="{$product->getPrice()|escape}" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Salva Modifiche</button>
        </form>
        <div class="text-center mt-3">
            <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary">Annulla e torna al Menù</a>
        </div>
    </div>
</body>
</html>
