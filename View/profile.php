<?php // File: View/profile.php (Aggiornato) ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Profilo di <?php echo htmlspecialchars($client->getName()); ?></title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; color: #333; }
        .container { max-width: 800px; margin: 50px auto; padding: 2em; }
        .profile-section, .reviews-section, .cards-section { background-color: #fff; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.1); padding: 2em; margin-bottom: 2em; }
        h1, h2 { color: #e8491d; }
        .message { padding: 1em; border-radius: 4px; margin-bottom: 1em; text-align: center; }
        .success { background-color: #d4edda; color: #155724; }
        .review, .card { border-bottom: 1px solid #eee; padding: 1em 0; }
        .review:last-child, .card:last-child { border-bottom: none; }
        .card form { display: inline; }
        .card button { background: none; border: none; color: red; cursor: pointer; text-decoration: underline; }
        nav { margin-top: 1em; }
        nav a { margin-right: 15px; text-decoration: none; font-weight: bold; color: #e8491d; }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_GET['review']) && $_GET['review'] === 'success'): ?>
            <div class="message success">Recensione aggiunta con successo!</div>
        <?php endif; ?>
        <?php if (isset($_GET['card']) && $_GET['card'] === 'success'): ?>
            <div class="message success">Carta di credito aggiunta con successo!</div>
        <?php endif; ?>
        <?php if (isset($_GET['card']) && $_GET['card'] === 'deleted'): ?>
            <div class="message success">Carta di credito rimossa con successo!</div>
        <?php endif; ?>

        <div class="profile-section">
            <h1>Ciao, <?php echo htmlspecialchars($client->getName()); ?>!</h1>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($client->getEmail()); ?></p>
            <nav>
                <a href="/GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=logout">Logout</a>
            </nav>
        </div>

        <div class="reviews-section">
            <h2>Le Tue Recensioni</h2>
            <?php if ($reviews->isEmpty()): ?>
                <p>Non hai ancora lasciato nessuna recensione.</p>
            <?php else: ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review">
                        <p><strong>Voto: <?php echo $review->getRating(); ?>/5</strong> - <em><?php echo $review->getReviewDate()->format('d/m/Y'); ?></em></p>
                        <p>"<?php echo htmlspecialchars($review->getComment()); ?>"</p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <nav><a href="/GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=addReview">Lascia una recensione</a></nav>
        </div>

        <div class="cards-section">
            <h2>Le Tue Carte</h2>
            <?php if ($creditCards->isEmpty()): ?>
                <p>Non hai nessuna carta di credito salvata.</p>
            <?php else: ?>
                <?php foreach ($creditCards as $card): ?>
                    <div class="card">
                        <span><?php echo htmlspecialchars($card->getBrand()); ?> che finisce con **** <?php echo htmlspecialchars($card->getLast4()); ?></span>
                        <form action="/GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=deleteCreditCard" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa carta?');">
                            <input type="hidden" name="card_id" value="<?php echo $card->getId(); ?>">
                            <button type="submit">Elimina</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <nav><a href="/GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=addCreditCard">Aggiungi una carta</a></nav>
        </div>
    </div>
</body>
</html>