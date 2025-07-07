{* File: templates/add_review.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lascia una Recensione</title>
    <style>
        /* ... Stile simile a login/registration ... */
        body { font-family: sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { background-color: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h1 { text-align: center; color: #e8491d; }
        textarea, select { width: 100%; padding: 0.8em; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; margin-bottom: 1em; }
        button { width: 100%; padding: 1em; background-color: #e8491d; color: white; border: none; border-radius: 4px; font-size: 1em; cursor: pointer; }
        .error { color: red; text-align: center; margin-bottom: 1em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>La Tua Opinione Conta!</h1>
        {* CONVERSIONE DA PHP A SMARTY *}
        {if isset($error)} {* Sostituisce <?php if (isset($error)): ?> *}
            <p class="error">{$error|escape}</p> {* Sostituisce <?php echo htmlspecialchars($error); ?> *}
        {/if} {* Sostituisce <?php endif; ?> *}
        
        <form action="{url controller='client' action='addReview'}" method="POST"> {* Sostituisce action="/Pancia_mia_fatti_capanna/client/addReview" con la funzione Smarty 'url' *}
            <div>
                <label for="rating">Voto (da 1 a 5)</label>
                <select id="rating" name="rating" required>
                    <option value="">Seleziona un voto</option>
                    <option value="5">5 - Eccellente</option>
                    <option value="4">4 - Molto Buono</option>
                    <option value="3">3 - Buono</option>
                    <option value="2">2 - Sufficiente</option>
                    <option value="1">1 - Insufficiente</option>
                </select>
            </div>
            <div>
                <label for="comment">Commento</label>
                <textarea id="comment" name="comment" rows="5" required></textarea>
            </div>
            <button type="submit">Invia Recensione</button>
        </form>
    </div>
</body>
</html>