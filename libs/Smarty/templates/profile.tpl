{* File: templates/profile.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Mio Profilo - {$client->getName()|escape}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/index">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <!-- ======= Page Title Section ======= -->
    <section class="page-title">
        <div class="container">
            <h1>Profilo di {$client->getName()|escape} {$client->getSurname()|escape}</h1>
            <p class="lead">Benvenuto nel tuo pannello di controllo personale.</p>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Profile Section ======= -->
    <section class="profile">
        <div class="container">

            <div class="php-email-form bg-white p-4 shadow-sm mb-5">

                <h3 class="text-secondary">I Tuoi Dati</h3>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item"><strong>Nome Completo:</strong> {$client->getName()|escape} {$client->getSurname()|escape}</li>
                    <li class="list-group-item"><strong>Nickname:</strong> {$client->getNickname()|escape}</li>
                    <li class="list-group-item"><strong>Email:</strong> {$client->getEmail()|escape}</li>
                    <li class="list-group-item"><strong>Numero di Telefono:</strong> {$client->getPhoneNumber()|escape|default:"Non specificato"}</li>
                    <li class="list-group-item"><strong>Data di Nascita:</strong> {$client->getBirthDate()->format('d/m/Y')}</li>
                </ul>

                <h3 class="text-secondary">Le Mie Recensioni</h3>
                {if !empty($reviews)}
                    <ul class="list-group mb-4">
                        {foreach from=$reviews item=review}
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1"><strong>Voto: {$review->getRating()}/5</strong></p>
                                    <p class="mb-0 fst-italic">"{$review->getComment()|escape}"</p>
                                    <small class="text-muted">Scritta il: {$review->getCreationDate()->format('d/m/Y')}</small>
                                </div>
                                <form action="/Pancia_mia_fatti_capanna/client/deleteReview" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa recensione?');">
                                    <input type="hidden" name="review_id" value="{$review->getId()}">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Elimina</button>
                                </form>
                            </li>
                        {/foreach}
                    </ul>
                {else}
                    <p>Non hai ancora scritto nessuna recensione.</p>
                {/if}
                <div class="mb-2"><a href="/Pancia_mia_fatti_capanna/client/addReview" class="btn btn-info">Scrivi una recensione</a></div>

                <h3 class="text-secondary">Le Mie Carte di Credito</h3>
                {if !empty($creditCards)}
                    <ul class="list-group mb-4">
                        {foreach from=$creditCards item=card}
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{$card->getBrand()|escape}</strong> che finisce con **** **** **** {$card->getLast4()|escape}
                                    <br>
                                    <small class="text-muted">Intestatario: {$card->getCardName()|escape}</small>
                                </div>
                                <form action="/Pancia_mia_fatti_capanna/client/deleteCreditCard" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa carta?');">
                                    <input type="hidden" name="card_id" value="{$card->getId()}">
                                    <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                                </form>
                            </li>
                        {/foreach}
                    </ul>
                {else}
                    <p>Non hai ancora aggiunto nessuna carta di credito.</p>
                {/if}
                <div class="mb-2"><a href="/Pancia_mia_fatti_capanna/client/addCreditCard" class="btn btn-info">Aggiungi Carta</a></div>

            </div>

            <div class="text-center mt-4">
                <a href="/Pancia_mia_fatti_capanna/" class="btn btn-secondary mx-2">Torna alla Home</a>
                <a href="/Pancia_mia_fatti_capanna/client/logout" class="btn btn-danger mx-2">Logout</a>
            </div>

        </div>
    </section><!-- End Profile Section -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer><!-- End Footer -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>