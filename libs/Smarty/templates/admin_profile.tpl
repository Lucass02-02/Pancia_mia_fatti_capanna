{* File: templates/admin_profile.tpl *}

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannello di Controllo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center mb-5">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <main>
        <div class="container" style="max-width: 1100px;">
            <div class="surface p-4 rounded shadow-sm">
                <h1 class="text-center mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">
                    Pannello di Controllo
                </h1>

                <div class="mb-5">
                    <h2 class="h4" style="color: var(--heading-color); font-family: var(--heading-font);">Dati del Proprietario</h2>
                    <p><strong>Nome Completo:</strong> {$admin->getName()|escape} {$admin->getSurname()|escape}</p>
                    <p><strong>Email:</strong> {$admin->getEmail()|escape}</p>
                </div>

                <div class="row g-4 justify-content-center dashboard-buttons">
                    <div class="col-md-5">
                        <div class="p-3 rounded border h-100" style="background-color: var(--surface-color);">
                            <h3 class="h5 mb-3" style="color: var(--heading-color); font-family: var(--heading-font);">Gestione Ristorante</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="/Pancia_mia_fatti_capanna/RestaurantHall/manage" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Banchetto</a></li>
                                <li class="mb-2"><a href="/Pancia_mia_fatti_capanna/Admin/manageTurns" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Turni</a></li>
                                <li class="mb-2"><a href="/Pancia_mia_fatti_capanna/Table/listAll" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Tavoli</a></li>
                                <li class="mb-2"><a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Menù e Prodotti</a></li>
                                <li class="mb-2"><a href="/Pancia_mia_fatti_capanna/Admin/showReservations" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Prenotazioni</a></li>
                                <li><a href="/Pancia_mia_fatti_capanna/Admin/showOrders" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Ordini</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="p-3 rounded border h-100" style="background-color: var(--surface-color);">
                            <h3 class="h5 mb-3" style="color: var(--heading-color); font-family: var(--heading-font);">Gestione Utenti</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="/Pancia_mia_fatti_capanna/Admin/manageClients" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Clienti</a></li>
                                <li><a href="/Pancia_mia_fatti_capanna/Waiter/manage" class="btn w-100" style="background-color: var(--accent-color); color: var(--contrast-color);">Gestisci Camerieri</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary me-2">Torna alla Home</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">Logout</a>
                </div>
            </div>
        </div>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer mt-5">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer><!-- End Footer -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
