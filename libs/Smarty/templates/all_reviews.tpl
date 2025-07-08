{* File: templates/all_reviews.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutte le Recensioni - Pancia mia fatti capanna</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; line-height: 1.6; }
        .container { max-width: 900px; margin: 2em auto; padding: 1em; }
        h1 { color: #e8491d; text-align: center; }
        .review-card { background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 1.5em; margin-bottom: 1.5em; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .review-header { border-bottom: 1px solid #eee; padding-bottom: 1em; margin-bottom: 1em; }
        .review-author { font-weight: bold; color: #333; }
        .review-date { float: right; color: #777; font-size: 0.9em; }
        .review-rating { font-size: 1.2em; color: #f0ad4e; }
        .review-comment { color: #555; }
        .nav-link { display: block; text-align: center; margin-top: 2em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>{$titolo|default:'Tutte le Recensioni'|escape}</h1>

        {if isset($reviews) && !empty($reviews)}
            {foreach $reviews as $review}
                <div class="review-card">
                    <div class="review-header">
                        {assign var="author" value=$review->getClient()}
                        {if $author}
                            <span class="review-author">{$author->getName()|escape} {$author->getSurname()|escape}</span>
                        {else}
                            <span class="review-author">Utente Anonimo</span>
                        {/if}
                        <span class="review-date">{$review->getReviewDate()->format('d/m/Y H:i')}</span>
                    </div>
                    <div class="review-rating">
                        Voto:
                        {section name=star loop=$review->getRating()}★{/section}
                        {section name=nostar start=$review->getRating() loop=5}☆{/section}
                    </div>
                    <p class="review-comment">"{$review->getComment()|escape|nl2br}"</p>
                </div>
            {/foreach}
        {else}
            <p style="text-align: center;">Non ci sono ancora recensioni da mostrare.</p>
        {/if}

        <a href="/Pancia_mia_fatti_capanna/Home/home" class="nav-link">Torna alla Home</a>
    </div>
</body>
</html>
