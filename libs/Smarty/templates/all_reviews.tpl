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
        <h1>{$titolo|default:'Tutte le Recensioni'|escape}</h1> {* Sostituisce <?php echo htmlspecialchars($titolo ?? 'Tutte le Recensioni'); ?> con {$titolo|default:'Tutte le Recensioni'|escape} *}

        {if isset($reviews) && !empty($reviews)} {* Sostituisce <?php if (isset($reviews) && !empty($reviews)): ?> *}
            {foreach $reviews as $review} {* Sostituisce <?php foreach ($reviews as $review): ?> *}
                <div class="review-card">
                    <div class="review-header">
                        {* Logica PHP spostata o riscritta con Smarty *}
                        {assign var="author" value=$review->getClient()} {* Assegna l'oggetto Client a una variabile Smarty *}
                        {if $author}
                            {assign var="author_name" value="{$author->getName()|escape} {$author->getSurname()|escape}"}
                        {else}
                            {assign var="author_name" value="Utente Anonimo"}
                        {/if}
                        <span class="review-author">{$author_name}</span> {* Sostituisce <?php echo htmlspecialchars($author); ?> *}
                        <span class="review-date">{$review->getReviewDate()->format('d/m/Y H:i')}</span> {* Sostituisce <?php echo $review->getReviewDate()->format('d/m/Y H:i'); ?> *}
                    </div>
                    <div class="review-rating">
                        Voto: {str_repeat('★', $review->getRating())}{str_repeat('☆', 5 - $review->getRating())} {* Sostituisce <?php echo str_repeat('★', $review->getRating()) . str_repeat('☆', 5 - $review->getRating()); ?> *}
                    </div>
                    <p class="review-comment">"{nl2br($review->getComment()|escape)}"</p> {* Sostituisce <?php echo nl2br(htmlspecialchars($review->getComment())); ?> *}
                </div>
            {/foreach} {* Sostituisce <?php endforeach; ?> *}
        {else} {* Sostituisce <?php else: ?> *}
            <p style="text-align: center;">Non ci sono ancora recensioni da mostrare.</p>
        {/if} {* Sostituisce <?php endif; ?> *}

        <a href="{url controller='home' action='home'}" class="nav-link">Torna alla Home</a> {* Sostituisce action="/Pancia_mia_fatti_capanna/" con la funzione Smarty 'url' *}
    </div>
</body>
</html>