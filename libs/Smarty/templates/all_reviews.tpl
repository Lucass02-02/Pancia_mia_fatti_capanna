{* File: templates/reviews.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$titolo|escape} - Pancia mia fatti capanna</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">

    <style>
        .admin-response {
            background-color: #e9ecef;
            border-left: 4px solid var(--accent-color);
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            position: relative;
        }
        .admin-response-form {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #ced4da;
        }
        .admin-response .delete-response-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            padding: .1rem .4rem;
            font-size: .7rem;
        }
        .admin-response .edit-response-btn {
            position: absolute;
            top: 5px;
            right: 45px;
            padding: .1rem .4rem;
            font-size: .7rem;
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }
        .admin-response .edit-response-btn:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }
    </style>
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
            <h1>{$titolo|escape}</h1>
        </div>
    </section><!-- End Page Title Section -->
<section class="container" style="background: url('/Pancia_mia_fatti_capanna/images/recensioni.png') center center / cover no-repeat; height: 300px; width: 600px"></section>
    <!-- ======= Reviews Section ======= -->
    <section class="section">
        <div class="container">
            {if empty($reviews)}
                <p class="text-center text-muted">Non ci sono ancora recensioni da mostrare.</p>
            {else}
                <div class="row g-4">
                    {foreach from=$reviews item=review}
                        <div class="col-md-6">
                            <div class="icon-box">
                                <p class="fst-italic">"{$review->getComment()|escape}"</p>
                                <p><strong>Voto: {$review->getRating()}/5</strong></p>
                                <small class="d-block">
                                    Di: {$review->getClient()->getName()|escape} {$review->getClient()->getSurname()|escape}<br>
                                    Scritta il: {$review->getCreationDate()->format('d/m/Y')}
                                </small>

                                {* Sezione risposte admin *}
                                {if !$review->getAdminResponses()->isEmpty()}
                                    {foreach from=$review->getAdminResponses() item=response}
                                        <div class="admin-response mt-3">
                                            <p class="mb-1"><strong>Risposta dell'Admin:</strong> {$response->getResponseText()|escape}</p>
                                            <small class="d-block text-end">
                                                Di: {$response->getAdmin()->getName()|escape} {$response->getAdmin()->getSurname()|escape}<br>
                                                Inviata il: {$response->getResponseDate()->format('d/m/Y H:i')}
                                            </small>

                                            {if $user_role == 'admin'}
                                                <a href="/Pancia_mia_fatti_capanna/review/editAdminResponse/{$response->getId()}" class="btn btn-warning btn-sm edit-response-btn">Modifica</a>

                                                <form action="/Pancia_mia_fatti_capanna/review/deleteAdminResponse/{$response->getId()}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa risposta dell\'admin?');" class="delete-response-btn">
                                                    <button type="submit" class="btn btn-danger btn-sm">X</button>
                                                </form>
                                            {/if}
                                        </div>
                                    {/foreach}
                                {/if}

                                {* Form risposta admin *}
                                {if $user_role == 'admin'}
                                    <div class="admin-response-form">
                                        <h5>Rispondi a questa recensione:</h5>
                                        <form action="/Pancia_mia_fatti_capanna/review/respond" method="POST">
                                            <input type="hidden" name="review_id" value="{$review->getId()}">
                                            <div class="mb-3">
                                                <textarea name="response_text" class="form-control" rows="3" placeholder="Scrivi qui la tua risposta..." required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-get-started btn-sm">Invia Risposta</button>
                                        </form>
                                    </div>
                                {/if}

                            </div>
                        </div>
                    {/foreach}
                </div>
            {/if}

            <div class="text-center mt-5">
                <a href="/Pancia_mia_fatti_capanna/" class="btn btn-secondary">Torna alla Home</a>
            </div>
        </div>
    </section><!-- End Reviews Section -->

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
