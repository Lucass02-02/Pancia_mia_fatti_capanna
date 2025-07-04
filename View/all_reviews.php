<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titolo); ?></title>
    <style>
        body { font-family: sans-serif; margin: 20px; color: #333; }
        h1 { text-align: center; color: #e8491d; }
        .review-container { max-width: 800px; margin: auto; }
        .review-card { border: 1px solid #ddd; border-radius: 8px; padding: 15px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .review-card .author { font-weight: bold; color: #333; }
        .review-card .date { font-size: 0.9em; color: #888; margin-left: 10px; }
        .review-card .rating { margin: 10px 0; color: #f39c12; }
        .review-card .comment { margin-top: 5px; }
        .no-reviews { text-align: center; font-size: 1.2em; color: #777; }
        .back-link { display: block; text-align: center; margin-top: 30px; }
    </style>
</head>
<body>

    <h1><?php echo htmlspecialchars($titolo); ?></h1>

    <div class="review-container">
        <?php if (!empty($reviews)): ?>
            <?php foreach ($reviews as $review): ?>
                <div class="review-card">
                    <p>
                        <span class="author">
                            <?php 
                                // Recuperiamo l'autore dalla recensione e ne mostriamo nome e cognome
                                echo htmlspecialchars($review->getUser()->getName() . ' ' . $review->getUser()->getSurname()); 
                            ?>
                        </span>
                        <span class="date">
                            <?php echo $review->getReviewDate()->format('d/m/Y H:i'); ?>
                        </span>
                    </p>
                    <div class="rating">
                        <?php echo str_repeat('★', $review->getRating()) . str_repeat('☆', 5 - $review->getRating()); ?>
                    </div>
                    <p class="comment"><?php echo nl2br(htmlspecialchars($review->getComment())); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-reviews">Non ci sono ancora recensioni da mostrare.</p>
        <?php endif; ?>
        
        <a class="back-link" href="/GitHub/Pancia_mia_fatti_capanna/">Torna alla Home</a>
    </div>

</body>
</html>