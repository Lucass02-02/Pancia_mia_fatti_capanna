{* File: templates/admin_profile.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
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
            <h1>Pannello di Controllo</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Admin Profile Section ======= -->
    <section class="section">
        <div class="container">

            <div class="php-email-form bg-white p-4 shadow-sm mx-auto" style="max-width: 800px;">
                <div class="mb-4">
                    <h2 class="h4">Dati del Proprietario</h2>
                    <p><strong>Nome Completo:</strong> {$admin->getName()|escape} {$admin->getSurname()|escape}</p>
                    <p><strong>Email:</strong> {$admin->getEmail()|escape}</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="icon-box">
                            <i class="bi bi-shop"></i>
                            <h4>Gestione Ristorante</h4>
                            <ul class="list-unstyled">
                            <div class="mb-2"><a href="/Pancia_mia_fatti_capanna/Table/listAll" class="btn btn-info">Gestisci Tavoli</a></div>
                            <div class="mb-2"><a href="/Pancia_mia_fatti_capanna/RestaurantHall/manage" class="btn btn-info">Gestisci Banchetto</a></div>
                            <div class="mb-2"><a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-info">Gestisci Menù e Prodotti</a></div></div>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="icon-box">
                            <i class="bi bi-people"></i>
                            <h4>Gestione Utenti</h4>
                            <ul class="list-unstyled">
                                <div class="mb-2"><a href="/Pancia_mia_fatti_capanna/Admin/manageClients" class="btn btn-info">Gestisci Clienti</a></div>
                                <div class="mb-2"><a href="/Pancia_mia_fatti_capanna/Waiter/manage" class="btn btn-info">Gestisci Camerieri</a></div>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary me-2">Torna alla Home</a>
                </div>
            </div>

        </div>
    </section><!-- End Admin Profile Section -->

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
