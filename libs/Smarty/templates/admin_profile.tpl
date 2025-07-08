{* File: templates/admin_profile.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannello di Controllo</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; }
        .container { max-width: 1000px; margin: 2em auto; background: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #e8491d; margin-bottom: 1em; }
        .profile-details { margin-bottom: 2em; }
        .profile-details h2 { color: #333; margin-bottom: 0.5em; }
        .profile-details p { margin: 0.3em 0; }
        .dashboard { display: flex; flex-wrap: wrap; gap: 2em; justify-content: center; }
        .dashboard-item { background: #f4f4f4; padding: 1.5em; border-radius: 8px; width: 250px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .dashboard-item h3 { margin-top: 0; color: #e8491d; }
        .dashboard-item ul { list-style: none; padding: 0; }
        .dashboard-item ul li { margin: 0.5em 0; }
        .dashboard-item ul li a { text-decoration: none; color: #007bff; }
        .nav-links { text-align: center; margin-top: 2em; }
        .nav-links a { text-decoration: none; color: #e8491d; margin: 0 10px; }
    </style>
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
                    <li><a href="/Pancia_mia_fatti_capanna/Table/listAll">Gestisci Tavoli e Sale</a></li>
                    <li><a href="/Pancia_mia_fatti_capanna/Home/menu">Gestisci Menù e Prodotti</a></li>
                </ul>
            </div>
            <div class="dashboard-item">
                <h3>Gestione Utenti</h3>
                <ul>
                    <li><a href="/Pancia_mia_fatti_capanna/Admin/manageClients">Gestisci Clienti</a></li>
                    <li><a href="/Pancia_mia_fatti_capanna/Waiter/manage">Gestisci Camerieri</a></li>
                </ul>
            </div>
        </div>

        <div class="nav-links">
            <a href="/Pancia_mia_fatti_capanna/Home/home">Torna alla Home</a> |
            <a href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a>
        </div>
    </div>
</body>
</html>
