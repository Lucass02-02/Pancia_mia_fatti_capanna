{* File: templates/reservation.tpl (YUMMY STYLE - Prenotazione Successo) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Effettua una Prenotazione</title>

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

    <!-- ======= Main Content ======= -->
    <main>
        <div class="container" style="max-width: 450px;">
            <div class="surface p-4 rounded shadow-sm text-center">
                <h2 class="mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">
                    Prenotazione Effettuata con Successo!
                </h2>

                <img src="https://media1.tenor.com/m/HGwktFx-y0wAAAAC/stickman-fire.gif"
                     alt="Successo" class="img-fluid rounded mb-4" style="max-width: 350px;">

                <a href="/Pancia_mia_fatti_capanna/Home/home"
                   class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">
                    Torna alla Home
                </a>
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
