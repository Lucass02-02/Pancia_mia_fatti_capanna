<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Categorie Prodotti - Pancia mia fatti capanna</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-primary text-center mb-4">Gestione Categorie Prodotti</h1>

        {* Form per aggiungere una nuova categoria *}
        <div class="bg-white p-4 rounded shadow-sm mb-5">
            <h3 class="text-secondary mb-3">Aggiungi Nuova Categoria</h3>
            <form action="/Pancia_mia_fatti_capanna/Product/createCategory" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Nome nuova categoria" required>
                    <button class="btn btn-primary" type="submit">Aggiungi Categoria</button>
                </div>
            </form>
        </div>

        {* Elenco delle categorie esistenti *}
        <div class="bg-white p-4 rounded shadow-sm">
            <h3 class="text-secondary mb-3">Categorie Esistenti</h3>
            {if empty($categories)}
                <p class="text-center text-muted">Nessuna categoria trovata.</p>
            {else}
                <ul class="list-group">
                    {foreach from=$categories item=category}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {* Form per la modifica della categoria (nuovo approccio) *}
                            <form action="/Pancia_mia_fatti_capanna/Product/updateCategory" method="POST" class="d-flex flex-grow-1 align-items-center">
                                <input type="hidden" name="category_id" value="{$category->getId()}">
                                <input type="text" class="form-control me-2" name="name" value="{$category->getName()|escape}" required>
                                <button class="btn btn-warning btn-sm" type="submit">Modifica</button>
                            </form>
                            
                            {* Form per l'eliminazione della categoria *}
                            <form action="/Pancia_mia_fatti_capanna/Product/deleteCategory/{$category->getId()}" method="POST" class="ms-2">
                                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Sei sicuro di voler eliminare questa categoria? Tutti i prodotti associati a questa categoria potrebbero perdere il loro riferimento alla categoria.');">Elimina</button>
                            </form>
                        </li>
                    {/foreach}
                </ul>
            {/if}
        </div>

        {* Pulsante per tornare al menu *}
        <div class="text-center mt-4">
            <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary">Torna al Menu</a>
        </div>
    </div>
</body>
</html>