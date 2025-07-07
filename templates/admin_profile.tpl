{* File: templates/admin_profile.tpl (FINALE) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannello di Controllo</title>
    {* I tuoi stili CSS qui *}
    <style> /* ... */ </style>
</head>
<body>
    <div class="container">
        <h1>Pannello di Controllo</h1>
        <div class="profile-details">
            <h2>Dati del Proprietario</h2>
            <p><strong>Nome Completo:</strong> {$admin->getName()|escape} {$admin->getSurname()|escape}</p>
            <p><strong>Email:</strong> {$admin->getEmail()|escape}</p>
        </div>
        <div class="dashboard">
            <div class="dashboard-item">
                <h3>Gestione Ristorante</h3>
                <ul>
                    <li><a href="{url controller='table' action='listAll'}">Gestisci Tavoli e Sale</a></li>
                    <li><a href="{url controller='home' action='menu'}">Gestisci Menù e Prodotti</a></li>
                </ul>
            </div>
            <div class="dashboard-item">
                <h3>Gestione Utenti</h3>
                <ul>
                    <li><a href="{url controller='admin' action='manageClients'}">Gestisci Clienti</a></li>
                    <li><a href="{url controller='waiter' action='manage'}">Gestisci Camerieri</a></li>
                </ul>
            </div>
        </div>
        <div class="nav-links">
            <a href="{url controller='home' action='home'}">Torna alla Home</a> |
            <a href="{url controller='client' action='logout'}">Logout</a>
        </div>
    </div>
</body>
</html>