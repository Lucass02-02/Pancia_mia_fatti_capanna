<?php
// File: View/all_reviews.php

/** @var \AppORM\Entity\EUserReview[] $reviews */
?>
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
        <h1><?php echo htmlspecialchars($titolo ?? 'Tutte le Recensioni'); ?></h1>

        <?php if (isset($reviews) && !empty($reviews)): ?>
            <?php foreach ($reviews as $review): ?>
                <div class="review-card">
                    <div class="review-header">
                        <?php
                            // ***** INIZIO DELLA MODIFICA *****
                            // Usiamo getClient() invece di getUser() per ottenere l'autore della recensione.
                            // Aggiungiamo un controllo per sicurezza.
                            $author = $review->getClient() ? $review->getClient()->getName() . ' ' . $review->getClient()->getSurname() : 'Utente Anonimo';
                            // ***** FINE DELLA MODIFICA *****
                        ?>
                        <span class="review-author"><?php echo htmlspecialchars($author); ?></span>
                        <span class="review-date"><?php echo $review->getReviewDate()->format('d/m/Y H:i'); ?></span>
                    </div>
                    <div class="review-rating">
                        Voto: <?php echo str_repeat('★', $review->getRating()) . str_repeat('☆', 5 - $review->getRating()); ?>
                    </div>
                    <p class="review-comment">"<?php echo nl2br(htmlspecialchars($review->getComment())); ?>"</p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center;">Non ci sono ancora recensioni da mostrare.</p>
        <?php endif; ?>
<<<<<<< Updated upstream
        
        <a class="back-link" href="/GitHub/Pancia_mia_fatti_capanna/">Torna alla Home</a>
    </div>
=======
>>>>>>> Stashed changes

        <a href="/Pancia_mia_fatti_capanna/" class="nav-link">Torna alla Home</a>
    </div>
</body>
</html>