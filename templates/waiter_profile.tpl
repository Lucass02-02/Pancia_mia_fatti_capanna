{* File: templates/waiter_profile.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Cameriere - {$waiter->getName()|escape}</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; color: #333; }
        .container { max-width: 900px; margin: 2em auto; padding: 2em; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h1, h3 { color: #e8491d; text-align: center; }
        .dashboard { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 2em; }
        .dashboard-item { padding: 1.5em; border: 1px solid #eee; border-radius: 8px; text-align: center; }
        .dashboard-item p { font-size: 1.1em; }
        .dashboard-item ul { list-style: none; padding: 0; }
        .dashboard-item ul li a, .dashboard-item ul li span {
            display: block;
            padding: 12px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background-color 0.2s;
        }
        .dashboard-item ul li a:hover { background-color: #0056b3; }
        /* Stile per i pulsanti non ancora attivi */
        .dashboard-item ul li span {
            background-color: #6c757d;
            cursor: not-allowed;
            opacity: 0.7;
        }
        .nav-links { margin-top: 2.5em; text-align: center; }
        .nav-links a { color: #007bff; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ciao, {$waiter->getName()|escape}!</h1>

        <div class="dashboard">
            <div class="dashboard-item">
                <h3>Le Tue Informazioni</h3>
                <p><strong>Matricola:</strong> {$waiter->getSerialNumber()|escape}</p>
                <p><strong>Sala Assegnata:</strong> {$waiter->getRestaurantHall()->getName()|escape}</p>
            </div>
            <div class="dashboard-item">
                <h3>Le Tue Funzioni</h3>
                <ul>
                    <li><a href="{url controller='waiter' action='viewTables'}">Visualizza Stato Tavoli</a></li>
                    <li><span>Visualizza Prenotazioni</span></li>
                    <li><span>Visualizza Ordini</span></li>
                </ul>
            </div>
        </div>

        <div class="nav-links">
            <a href="{url controller='client' action='logout'}">Logout</a>
        </div>
    </div>
</body>
</html>