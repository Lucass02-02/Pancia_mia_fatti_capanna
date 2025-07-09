{* File: templates/profile.tpl (VERSIONE FINALE E COMPLETA CON TUTTI I DATI) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Mio Profilo - {$client->getName()|escape}</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="p-5 bg-white rounded shadow-sm">
        <h1 class="text-primary">Profilo di {$client->getName()|escape} {$client->getSurname()|escape}</h1>
        <p class="lead">Benvenuto nel tuo pannello di controllo personale.</p>
        <hr>

        <div class="mb-5">
            <h3 class="text-secondary">I Tuoi Dati</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Nome Completo:</strong> {$client->getName()|escape} {$client->getSurname()|escape}</li>
                <li class="list-group-item"><strong>Nickname:</strong> {$client->getNickname()|escape}</li>
                <li class="list-group-item"><strong>Email:</strong> {$client->getEmail()|escape}</li>
                <li class="list-group-item"><strong>Numero di Telefono:</strong> {$client->getPhoneNumber()|escape|default:"Non specificato"}</li>
                <li class="list-group-item"><strong>Data di Nascita:</strong> {$client->getBirthDate()->format('d/m/Y')}</li>
            </ul>
        </div>

        <div class="mt-5">
            <h3 class="text-secondary">Le Mie Recensioni</h3>
            {if !empty($reviews)}
                <ul class="list-group">
                    {foreach from=$reviews item=review}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1"><strong>Voto: {$review->getRating()}/5</strong></p>
                                <p class="mb-0 fst-italic">"{$review->getComment()|escape}"</p>
                                <small class="text-muted">Scritta il: {$review->getCreationDate()->format('d/m/Y')}</small>
                            </div>
                            <form action="/Pancia_mia_fatti_capanna/client/deleteReview" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa recensione?');">
                                <input type="hidden" name="review_id" value="{$review->getId()}">
                                <button type="submit" class="btn btn-outline-danger btn-sm">Elimina</button>
                            </form>
                        </li>
                    {/foreach}
                </ul>
            {else}
                <p>Non hai ancora scritto nessuna recensione.</p>
            {/if}
            <a href="/Pancia_mia_fatti_capanna/client/addReview" class="btn btn-primary mt-3">Scrivi una Recensione</a>
        </div>
        
        <hr class="my-5">
        <div class="mt-4">
            <h3 class="text-secondary">Le Mie Carte di Credito</h3>
            {if !empty($creditCards)}
                <ul class="list-group">
                    {foreach from=$creditCards item=card}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{$card->getBrand()|escape}</strong> che finisce con **** **** **** {$card->getLast4()|escape}
                                <br>
                                <small class="text-muted">Intestatario: {$card->getCardName()|escape}</small>
                            </div>
                            <form action="/Pancia_mia_fatti_capanna/client/deleteCreditCard" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa carta?');">
                                <input type="hidden" name="card_id" value="{$card->getId()}">
                                <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                            </form>
                        </li>
                    {/foreach}
                </ul>
            {else}
                <p>Non hai ancora aggiunto nessuna carta di credito.</p>
            {/if}
            <a href="/Pancia_mia_fatti_capanna/client/addCreditCard" class="btn btn-success mt-3">Aggiungi Carta</a>
        </div>
        
        <hr class="my-5">

        <div class="d-flex justify-content-center gap-3">
             <a href="/Pancia_mia_fatti_capanna/" class="btn btn-secondary">Torna alla Home</a>
             <a href="/Pancia_mia_fatti_capanna/client/logout" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

</body>
</html>