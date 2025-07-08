{* File: templates/profile.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo di {$client->getName()|escape}</title>
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
        <h1>Ciao, {$client->getName()|escape}!</h1>

        <div class="profile-details">
            <h2>I tuoi dati</h2>
            <p><strong>Nome Completo:</strong> {$client->getName()|escape} {$client->getSurname()|escape}</p>
            <p><strong>Email:</strong> {$client->getEmail()|escape}</p>
            <p><strong>Data di Nascita:</strong> {$client->getBirthDate()->format('d/m/Y')}</p>
            <p><strong>Nickname:</strong> {$client->getNickname()|default:'Non impostato'|escape}</p>
            <p><strong>Telefono:</strong> {$client->getPhonenumber()|default:'Non impostato'|escape}</p>
        </div>

        <div class="cards-section">
            <h2>Le tue carte di credito</h2>
            {if count($creditCards) > 0}
                {foreach $creditCards as $card}
                    <div class="card-item">
                        <span>
                            <strong>{$card->getBrand()|escape}</strong> che termina con **** {$card->getLast4()|escape}
                            (Scade: {$card->getExpMonth()|escape}/{$card->getExpYear()|escape})
                        </span>
                        <form class="delete-form" action="{url controller='client' action='deleteCreditCard'}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa carta?');">
                            <input type="hidden" name="card_id" value="{$card->getId()}">
                            <button type="submit">Elimina</button>
                        </form>
                    </div>
                {/foreach}
            {else}
                <p>Non hai ancora aggiunto nessuna carta di credito.</p>
            {/if}
            <a href="{url controller='client' action='addCreditCard'}">Aggiungi una nuova carta</a>
        </div>

        <div class="reviews-section">
            <h2>Le tue recensioni</h2>
            {if count($reviews) > 0}
                <ul>
                    {foreach $reviews as $review}
                        <li>
                            <strong>Voto: {$review->getRating()}/5</strong> - 
                            <em>"{$review->getComment()|escape|nl2br}"</em>
                            ({$review->getReviewDate()->format('d/m/Y')})
                        </li>
                    {/foreach}
                </ul>
            {else}
                <p>Non hai ancora lasciato nessuna recensione.</p>
            {/if}
            <a href="{url controller='client' action='addReview'}">Lascia una nuova recensione</a>
        </div>

        <div class="nav-links">
            <a href="{url controller='home' action='home'}">Torna alla Home</a> |
            <a href="{url controller='client' action='logout'}">Logout</a>
        </div>
    </div>
</body>
</html>