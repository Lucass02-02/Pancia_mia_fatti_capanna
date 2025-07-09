<?php // File: View/profile.php (Aggiornato con stile link arancione desiderato) ?>
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
        
        /* Stile per i link che si comportano come "bottoni" ma più leggeri */
        .action-link-style {
            display: inline-block; /* Permette padding e margin */
            margin: 0 10px; /* Spazio tra i link */
            text-decoration: none; /* Nessuna sottolineatura di default */
            font-weight: bold; /* Grassetto */
            color: #e8491d; /* Testo arancione */
            padding: 8px 15px; /* Spaziatura interna */
            border-radius: 5px; /* Bordi leggermente arrotondati */
            transition: all 0.2s ease-in-out; /* Effetto di transizione all'hover */
            /* Rimosso border e background-color iniziale per look "link" */
        }
        .action-link-style:hover {
            background-color: #f0f0f0; /* Sfondo grigio chiaro all'hover, come la tua richiesta */
            color: #e8491d; /* Mantiene il testo arancione all'hover */
            text-decoration: underline; /* Aggiunge sottolineatura all'hover per chiarezza */
        }

        /* Contenitori per l'allineamento dei link */
        .profile-nav-links, .section-action-links { /* Rinominato per chiarezza */
            margin-top: 1.5em; /* Spazio dalla sezione precedente */
            display: flex; /* Usa flexbox per allineare */
            justify-content: center; /* Centra orizzontalmente */
            flex-wrap: wrap; /* Per andare a capo su schermi piccoli */
            gap: 15px; /* Spazio tra i link */
        }
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
            
            <div class="profile-nav-links"> <a href="/Pancia_mia_fatti_capanna/" class="action-link-style">Torna alla Home</a>
                <a href="/Pancia_mia_fatti_capanna/Home/menu" class="action-link-style">Visualizza Menù</a>
                <a href="/Pancia_mia_fatti_capanna/Cart/view" class="action-link-style">Vai al Carrello</a>
                <a href="/Pancia_mia_fatti_capanna/Client/logout" class="action-link-style">Logout</a>
            </div>
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
            <div class="section-action-links"> <a href="/Pancia_mia_fatti_capanna/index.php?c=client&a=addReview" class="action-link-style">Lascia una recensione</a>
            </div>
        </div>

        <div class="cards-section">
            <h2>Le Tue Carte</h2>
            <?php if ($creditCards->isEmpty()): ?>
                <p>Non hai nessuna carta di credito salvata.</p>
            <?php else: ?>
                <?php foreach ($creditCards as $card): ?>
                    <div class="card">
                        <span><?php echo htmlspecialchars($card->getBrand()); ?> che finisce con **** <?php echo htmlspecialchars($card->getLast4()); ?></span>
                        <form action="/Pancia_mia_fatti_capanna/index.php?c=client&a=deleteCreditCard" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa carta?');">
                            <input type="hidden" name="card_id" value="<?php echo $card->getId(); ?>">
                            <button type="submit" style="background: none; border: none; color: red; cursor: pointer; text-decoration: underline;">Elimina</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="section-action-links"> <a href="/Pancia_mia_fatti_capanna/index.php?c=client&a=addCreditCard" class="action-link-style">Aggiungi una carta</a>
            </div>
        </div>
    </div>
</body>
</html>