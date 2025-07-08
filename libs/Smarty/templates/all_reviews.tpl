{* File: templates/all_reviews.tpl (SINTASSI SMARTY CORRETTA, STYLES.CSS APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutte le Recensioni - Pancia mia fatti capanna</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center text-primary mb-5">{$titolo|default:'Tutte le Recensioni'|escape}</h1>

        {if isset($reviews) && !empty($reviews)}
            {foreach $reviews as $review}
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            {assign var="author" value=$review->getClient()}
                            {if $author}
                                <span class="fw-bold text-dark">{$author->getName()|escape} {$author->getSurname()|escape}</span>
                            {else}
                                <span class="fw-bold text-dark">Utente Anonimo</span>
                            {/if}
                            <span class="text-muted small">{$review->getReviewDate()->format('d/m/Y H:i')}</span>
                        </div>
                        <div class="mb-2">
                            <span class="text-warning fs-5">
                                {section name=star loop=$review->getRating()}★{/section}
                                {section name=nostar start=$review->getRating() loop=5}☆{/section}
                            </span>
                        </div>
                        <p class="card-text">"{$review->getComment()|escape|nl2br}"</p>
                    </div>
                </div>
            {/foreach}
        {else}
            <p class="text-center">Non ci sono ancora recensioni da mostrare.</p>
        {/if}

        <div class="text-center mt-5">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
        </div>
    </div>
</body>
</html>
