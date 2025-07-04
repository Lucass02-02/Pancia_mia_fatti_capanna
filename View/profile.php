<?php
use AppORM\Entity\EClient;
use AppORM\Entity\EUserReview;
use AppORM\Entity\ECreditCard;

/** @var EClient $client */
/** @var EUserReview[] $reviews */
/** @var ECreditCard[] $creditCards */
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo di <?php echo htmlspecialchars($client->getName()); ?></title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; line-height: 1.6; }
        .container { max-width: 900px; margin: 2em auto; padding: 1em; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1, h2, h3 { color: #e8491d; }
        .profile-details, .reviews-section, .cards-section { margin-bottom: 2em; padding: 1.5em; border: 1px solid #ddd; border-radius: 5px; }
        .card-item { display: flex; justify-content: space-between; align-items: center; padding: 10px; border-bottom: 1px solid #eee; }
        .card-item:last-child { border-bottom: none; }
        .delete-form button { background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; }
        .nav-links { margin-top: 1.5em; text-align: center; }
        .nav-links a { margin: 0 10px; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ciao, <?php echo htmlspecialchars($client->getName()); ?>!</h1>

        <div class="profile-details">
            <h2>I tuoi dati</h2>
            <p><strong>Nome Completo:</strong> <?php echo htmlspecialchars($client->getName() . ' ' . $client->getSurname()); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($client->getEmail()); ?></p>
<<<<<<< Updated upstream
            
            <div class="profile-nav-links"> <a href="/GitHub/Pancia_mia_fatti_capanna/" class="action-link-style">Torna alla Home</a>
                <a href="/GitHub/Pancia_mia_fatti_capanna/index.php?c=home&a=menu" class="action-link-style">Visualizza Menù</a>
                <a href="/GitHub/Pancia_mia_fatti_capanna/index.php?c=cart&a=view" class="action-link-style">Vai al Carrello</a>
                <a href="/GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=logout" class="action-link-style">Logout</a>
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
            <div class="section-action-links"> <a href="/GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=addReview" class="action-link-style">Lascia una recensione</a>
            </div>
=======
            <p><strong>Data di Nascita:</strong> <?php echo htmlspecialchars($client->getBirthDate()->format('d/m/Y')); ?></p>
            <p><strong>Nickname:</strong> <?php echo htmlspecialchars($client->getNickname() ?: 'Non impostato'); ?></p>
            <p><strong>Telefono:</strong> <?php echo htmlspecialchars($client->getPhonenumber() ?: 'Non impostato'); ?></p>
>>>>>>> Stashed changes
        </div>

        <div class="cards-section">
            <h2>Le tue carte di credito</h2>
            <?php if (count($creditCards) > 0): ?>
                <?php foreach ($creditCards as $card): ?>
<<<<<<< Updated upstream
                    <div class="card">
                        <span><?php echo htmlspecialchars($card->getBrand()); ?> che finisce con **** <?php echo htmlspecialchars($card->getLast4()); ?></span>
                        <form action="/GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=deleteCreditCard" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa carta?');">
=======
                    <div class="card-item">
                        <span>
                            <strong><?php echo htmlspecialchars($card->getBrand()); ?></strong> che termina con **** <?php echo htmlspecialchars($card->getLast4()); ?>
                            (Scade: <?php echo htmlspecialchars($card->getExpMonth() . '/' . $card->getExpYear()); ?>)
                        </span>
                        <form class="delete-form" action="/Pancia_mia_fatti_capanna/index.php?c=client&a=deleteCreditCard" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa carta?');">
>>>>>>> Stashed changes
                            <input type="hidden" name="card_id" value="<?php echo $card->getId(); ?>">
                            <button type="submit">Elimina</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Non hai ancora aggiunto nessuna carta di credito.</p>
            <?php endif; ?>
<<<<<<< Updated upstream
            <div class="section-action-links"> <a href="/GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=addCreditCard" class="action-link-style">Aggiungi una carta</a>
            </div>
=======
            <a href="/Pancia_mia_fatti_capanna/index.php?c=client&a=addCreditCard">Aggiungi una nuova carta</a>
        </div>

        <div class="reviews-section">
            <h2>Le tue recensioni</h2>
            <?php if (count($reviews) > 0): ?>
                <ul>
                    <?php foreach ($reviews as $review): ?>
                        <li>
                            <strong>Voto: <?php echo $review->getRating(); ?>/5</strong> - 
                            <em>"<?php echo htmlspecialchars($review->getComment()); ?>"</em>
                            (<?php echo $review->getReviewDate()->format('d/m/Y'); ?>)
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Non hai ancora lasciato nessuna recensione.</p>
            <?php endif; ?>
            <a href="/Pancia_mia_fatti_capanna/index.php?c=client&a=addReview">Lascia una nuova recensione</a>
        </div>

        <div class="nav-links">
            <a href="/Pancia_mia_fatti_capanna/">Torna alla Home</a> |
            <a href="/Pancia_mia_fatti_capanna/index.php?c=client&a=logout">Logout</a>
>>>>>>> Stashed changes
        </div>
    </div>
</body>
</html>