{* File: templates/admin_profile.tpl (SINTASSI SMARTY CORRETTA, STYLES.CSS APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannello di Controllo</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow">
        <h1 class="text-center text-primary mb-4">Pannello di Controllo</h1>

        <div class="mb-5">
            <h2 class="h4 text-secondary">Dati del Proprietario</h2>
            <p><strong>Nome Completo:</strong> {$admin->getName()|escape} {$admin->getSurname()|escape}</p>
            <p><strong>Email:</strong> {$admin->getEmail()|escape}</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-5">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Gestione Ristorante</h3>
                        <ul class="list-unstyled">
                            <li><a href="/Pancia_mia_fatti_capanna/Table/listAll" class="link-primary">Gestisci Tavoli e Sale</a></li>
                            <li><a href="/Pancia_mia_fatti_capanna/Home/menu" class="link-primary">Gestisci Menù e Prodotti</a></li>
                            <li><a href="/Pancia_mia_fatti_capanna/Admin/showReservations" class="link-primary">Gestisci Prenotazioni</a></li>
                            <li><a href="/Pancia_mia_fatti_capanna/Admin/showOrders" class="link-primary">Gestisci Ordini</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Gestione Utenti</h3>
                        <ul class="list-unstyled">
                            <li><a href="/Pancia_mia_fatti_capanna/Admin/manageClients" class="link-primary">Gestisci Clienti</a></li>
                            <li><a href="/Pancia_mia_fatti_capanna/Waiter/manage" class="link-primary">Gestisci Camerieri</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary me-2">Torna alla Home</a>
            <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>
