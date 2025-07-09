{* File: templates/all_reviews.tpl (SINTASSI SMARTY CON PULSANTE ELIMINA PER ADMIN) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$titolo|escape} - Pancia mia fatti capanna</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <h1 class="text-primary text-center mb-5">{$titolo|escape}</h1>

    {if empty($reviews)}
        <p class="text-center text-muted">Non ci sono ancora recensioni da mostrare.</p>
    {else}
        <div class="row g-4">
            {foreach from=$reviews item=review}
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <p class="card-text fst-italic">"{$review->getComment()|escape}"</p>
                            <p class="card-text"><strong>Voto: {$review->getRating()}/5</strong></p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center bg-light">
                           <small class="text-muted">
                                Di: {$review->getClient()->getName()|escape} {$review->getClient()->getSurname()|escape}<br>
                                Scritta il: {$review->getCreationDate()->format('d/m/Y')}
                           </small>
                           
                           {* Questo blocco è visibile solo se l'utente loggato è un admin *}
                           {if $user_role == 'admin'}
                                <form action="/Pancia_mia_fatti_capanna/review/delete" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa recensione?');">
                                    <input type="hidden" name="review_id" value="{$review->getId()}">
                                    <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                                </form>
                           {/if}
                        </div>
                    </div>
                </div>
            {/foreach}
        </div>
    {/if}

    <div class="text-center mt-5">
        <a href="/Pancia_mia_fatti_capanna/" class="btn btn-secondary">Torna alla Home</a>
    </div>
</div>

</body>
</html>