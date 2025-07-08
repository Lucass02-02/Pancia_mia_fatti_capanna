{* File: templates/waiter_profile.tpl (SINTASSI SMARTY COMPLETA E BOOTSTRAP APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Cameriere - {$waiter->getName()|escape}</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 900px;">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1 class="text-primary text-center mb-4">Ciao, {$waiter->getName()|escape}!</h1>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="border p-3 rounded h-100">
                        <h3 class="h5 text-secondary text-center mb-3">Le Tue Informazioni</h3>
                        <p><strong>Matricola:</strong> {$waiter->getSerialNumber()|escape}</p>
                        <p><strong>Sala Assegnata:</strong> {$waiter->getRestaurantHall()->getName()|escape}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="border p-3 rounded h-100">
                        <h3 class="h5 text-secondary text-center mb-3">Le Tue Funzioni</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="/Pancia_mia_fatti_capanna/Waiter/viewTables" class="btn btn-primary w-100">Visualizza Stato Tavoli</a>
                            </li>
                            <li class="mb-2">
                                <button class="btn btn-secondary w-100" disabled>Visualizza Prenotazioni</button>
                            </li>
                            <li>
                                <button class="btn btn-secondary w-100" disabled>Visualizza Ordini</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
