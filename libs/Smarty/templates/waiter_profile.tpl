{* File: templates/waiter_profile.tpl (RIADATTATA CON YUMMY STYLE COMPLETO) *}

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Cameriere - {$waiter->getName()|escape}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body class="bg-light">

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <main>
        <div class="container" style="max-width: 900px;">
            <div class="surface p-4 rounded shadow-sm">
                <h1 class="text-center mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">Ciao, {$waiter->getName()|escape}!</h1>

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
                                    <a href="/Pancia_mia_fatti_capanna/Waiter/viewReservation" class="btn btn-primary w-100">Visualizza Prenotazioni</a>
                                </li>
                                <li class="mb-2">
                                    <a href="/Pancia_mia_fatti_capanna/Waiter/viewOrder" class="btn btn-primary w-100">Visualizza Ordini</a>
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
