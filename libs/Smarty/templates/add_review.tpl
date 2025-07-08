{* File: templates/add_review.tpl (SINTASSI SMARTY CORRETTA, STYLES.CSS APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lascia una Recensione</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container p-4 bg-white rounded shadow-sm" style="max-width: 500px;">
        <h1 class="text-center text-primary mb-4">La Tua Opinione Conta!</h1>

        {if isset($error)}
            <p class="text-danger text-center mb-3">{$error|escape}</p>
        {/if}

        <form action="/Pancia_mia_fatti_capanna/Client/addReview" method="POST">
            <div class="mb-3">
                <label for="rating" class="form-label">Voto (da 1 a 5)</label>
                <select id="rating" name="rating" class="form-select" required>
                    <option value="">Seleziona un voto</option>
                    <option value="5">5 - Eccellente</option>
                    <option value="4">4 - Molto Buono</option>
                    <option value="3">3 - Buono</option>
                    <option value="2">2 - Sufficiente</option>
                    <option value="1">1 - Insufficiente</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Commento</label>
                <textarea id="comment" name="comment" rows="5" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Invia Recensione</button>
        </form>
    </div>
</body>
</html>
