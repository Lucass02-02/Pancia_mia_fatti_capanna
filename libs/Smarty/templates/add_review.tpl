{* File: templates/add_review.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lascia una Recensione</title>

    <section class="my-5" style="background: url('/Pancia_mia_fatti_capanna/images/recensioni.png') center center / cover no-repeat; height: 200px; width: 400px;"></section>
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
            <h1>La Tua Opinione Conta!</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Add Review Section ======= -->
    <section class="contact">
        <div class="container">

            <div class="php-email-form bg-white p-4 shadow-sm mx-auto" style="max-width: 500px;">
                {if isset($error)}
                    <div class="error-message text-center">{$error|escape}</div>
                {/if}

                <form action="/Pancia_mia_fatti_capanna/Client/addReview" method="POST">
                    <div class="form-group mb-3">
                        <label for="rating" class="form-label">Voto (da 1 a 5)</label>
                        <select id="rating" name="rating" class="form-select" required>
                            <option value="">Seleziona un voto</option>
                            <option value="5">5 - Eccellente</option>
                            <option value="4">4 - Molto Buono</option>
                            <option value="3">3 - Buono</option>
                            <option value="2">2 - Sufficiente</option>
                            <option value="1">1 - Insufficiente</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="comment" class="form-label">Commento</label>
                        <textarea id="comment" name="comment" rows="5" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-get-started w-100">Invia Recensione</button>
                </form>
            </div>

        </div>
    </section><!-- End Add Review Section -->

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
