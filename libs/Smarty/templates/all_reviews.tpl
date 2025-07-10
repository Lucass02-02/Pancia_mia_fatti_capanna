<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$titolo|escape} - Pancia mia fatti capanna</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
    <style>
        /* Stili aggiuntivi per le risposte */
        .admin-response {
            background-color: #e9ecef; /* Grigio chiaro */
            border-left: 4px solid #007bff; /* Bordo blu */
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            position: relative; /* Per posizionare il pulsante di eliminazione */
        }
        .admin-response small {
            font-size: 0.85em;
            color: #6c757d;
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
            padding: .1rem .4rem; /* Pulsante più piccolo */
            font-size: .7rem;
        }
        .admin-response .edit-response-btn { /* Stile per il pulsante di modifica risposta admin */
            position: absolute;
            top: 5px;
            right: 45px; /* Spostato a sinistra del pulsante Elimina */
            padding: .1rem .4rem;
            font-size: .7rem;
            background-color: #ffc107; /* Giallo warning */
            border-color: #ffc107;
            color: #212529;
        }
        .admin-response .edit-response-btn:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }
    </style>
</head>
<body class="bg-light">

<div class="container my-5">
    <h1 class="text-primary text-center mb-5">{$titolo|escape}</h1>

    {if empty($reviews)}
        <p class="text-center text-muted">Non ci sono ancora recensioni da mostrare.</p>
    {else}
        <div class="row g-4">
            {foreach from=$reviews item=review}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text fst-italic">"{$review->getComment()|escape}"</p>
                            <p class="card-text"><strong>Voto: {$review->getRating()}/5</strong></p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center bg-light flex-wrap">
                           <small class="text-muted">
                                Di: {$review->getClient()->getName()|escape} {$review->getClient()->getSurname()|escape}<br>
                                Scritta il: {$review->getCreationDate()->format('d/m/Y')}
                           </small>
                           
                           {* PULSANTI AZIONE SULLA RECENSIONE UTENTE - COMPLETAMENTE RIMOSSI *}
                           {*
                               Questo blocco è stato rimosso per garantire che l'admin non possa modificare le recensioni degli utenti.
                               La modifica delle recensioni da parte del cliente è gestita tramite CClient::editReview.
                           *}
                        </div>
                        
                        {* Sezione delle risposte dell'admin *}
                        {if !$review->getAdminResponses()->isEmpty()}
                            <div class="card-body pt-0">
                                {foreach from=$review->getAdminResponses() item=response}
                                    <div class="admin-response">
                                        <p class="mb-1"><strong>Risposta dell'Admin:</strong> {$response->getResponseText()|escape}</p>
                                        <small class="d-block text-end">
                                            Di: {$response->getAdmin()->getName()|escape} {$response->getAdmin()->getSurname()|escape}<br>
                                            Inviata il: {$response->getResponseDate()->format('d/m/Y H:i')}
                                        </small>
                                        
                                        {* PULSANTI AZIONE SULLA RISPOSTA ADMIN *}
                                        {if $user_role == 'admin'}
                                            {* Pulsante Modifica Risposta Admin - PRESENTE *}
                                            <a href="/Pancia_mia_fatti_capanna/review/editAdminResponse/{$response->getId()}" class="btn btn-warning btn-sm edit-response-btn">Modifica</a>

                                            {* Pulsante Elimina Risposta Admin - PRESENTE *}
                                            <form action="/Pancia_mia_fatti_capanna/review/deleteAdminResponse/{$response->getId()}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa risposta dell\'admin?');" class="delete-response-btn">
                                                <button type="submit" class="btn btn-danger btn-sm">X</button>
                                            </form>
                                        {/if}
                                    </div>
                                {/foreach}
                            </div>
                        {/if}

                        {* Form di risposta per l'admin - PRESENTE *}
                        {if $user_role == 'admin'}
                            <div class="card-body admin-response-form">
                                <h5>Rispondi a questa recensione:</h5>
                                <form action="/Pancia_mia_fatti_capanna/review/respond" method="POST">
                                    <input type="hidden" name="review_id" value="{$review->getId()}">
                                    <div class="mb-3">
                                        <textarea name="response_text" class="form-control" rows="3" placeholder="Scrivi qui la tua risposta..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Invia Risposta</button>
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

</body>
</html>