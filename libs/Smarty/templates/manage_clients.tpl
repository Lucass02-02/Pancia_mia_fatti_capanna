{* File: templates/manage_clients.tpl (SINTASSI SMARTY CORRETTA, STYLES.CSS APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Clienti</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 1200px;">
        <h1 class="text-primary text-center mb-4">Clienti Registrati</h1>

        {if empty($clients)}
            <p class="text-center text-muted">Non ci sono clienti registrati al momento.</p>
        {else}
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome Completo</th>
                            <th>Email</th>
                            <th>Nickname</th>
                            <th>Telefono</th>
                            <th>Data di Nascita</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $clients as $client}
                            <tr>
                                <td>{$client->getId()}</td>
                                <td>{$client->getName()|escape} {$client->getSurname()|escape}</td>
                                <td>{$client->getEmail()|escape}</td>
                                <td>{$client->getNickname()|default:'-'|escape}</td>
                                <td>{$client->getPhonenumber()|default:'-'|escape}</td>
                                <td>{$client->getBirthDate()->format('d/m/Y')}</td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        {/if}
        
        <div class="text-center mt-4">
            <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary">Torna al Pannello di Controllo</a>
        </div>
    </div>
</body>
</html>
