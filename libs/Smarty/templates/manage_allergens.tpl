{* File: templates/profile.tpl (SINTASSI SMARTY CORRETTA, STYLES.CSS APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo di {$client->getName()|escape}</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 900px;">
        <h1 class="text-primary text-center mb-4">Ciao, {$client->getName()|escape}!</h1>

        <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">I tuoi dati</h2>
            <p><strong>Nome Completo:</strong> {$client->getName()|escape} {$client->getSurname()|escape}</p>
            <p><strong>Email:</strong> {$client->getEmail()|escape}</p>
            <p><strong>Data di Nascita:</strong> {$client->getBirthDate()->format('d/m/Y')}</p>
            <p><strong>Nickname:</strong> {$client->getNickname()|default:'Non impostato'|escape}</p>
            <p><strong>Telefono:</strong> {$client->getPhonenumber()|default:'Non impostato'|escape}</p>
        </div>

        <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">Le tue carte di credito</h2>
            {if count($creditCards) > 0}
                <ul class="list-group mb-3">
                    {foreach $creditCards as $card}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong>{$card->getBrand()|escape}</strong> termina con **** {$card->getLast4()|escape}
                                (Scade: {$card->getExpMonth()|escape}/{$card->getExpYear()|escape})
                            </span>
                            <form action="/Pancia_mia_fatti_capanna/Client/deleteCreditCard" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa carta?');">
                                <input type="hidden" name="card_id" value="{$card->getId()}">
                                <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                            </form>
                        </li>
                    {/foreach}
                </ul>
            {else}
                <p>Non hai ancora aggiunto nessuna carta di credito.</p>
            {/if}
            <a href="/Pancia_mia_fatti_capanna/Client/addCreditCard" class="btn btn-primary">Aggiungi una nuova carta</a>
        </div>

        <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">Le tue recensioni</h2>
            {if count($reviews) > 0}
                <ul class="list-group">
                    {foreach $reviews as $review}
                        <li class="list-group-item">
                            <strong>Voto: {$review->getRating()}/5</strong> - 
                            <em>"{$review->getComment()|escape|nl2br}"</em>
                            <span class="text-muted">({$review->getReviewDate()->format('d/m/Y')})</span>
                        </li>
                    {/foreach}
                </ul>
            {else}
                <p>Non hai ancora lasciato nessuna recensione.</p>
            {/if}
            <a href="/Pancia_mia_fatti_capanna/Client/addReview" class="btn btn-primary mt-3">Lascia una nuova recensione</a>
        </div>

        <div class="text-center mt-4">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary me-2">Torna alla Home</a>
            <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>
