{* File: templates/edit_admin_response.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$titolo|escape} - Pancia mia fatti capanna</title>

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
            <h1>{$titolo|escape}</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Edit Admin Response Section ======= -->
    <section class="contact">
        <div class="container">

            <div class="php-email-form bg-white p-4 shadow-sm mx-auto" style="max-width: 700px;">
                <form action="/Pancia_mia_fatti_capanna/review/updateAdminResponseComment" method="POST">
                    <input type="hidden" name="response_id" value="{$adminResponse->getId()}">

                    <div class="form-group mb-3">
                        <label for="response_text" class="form-label">Testo della Risposta:</label>
                        <textarea name="response_text" id="response_text" class="form-control" rows="5" required>{$adminResponse->getResponseText()|escape}</textarea>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-get-started">Salva Modifiche</button>
                        <a href="/Pancia_mia_fatti_capanna/review/showAll" class="btn btn-secondary">Annulla</a>
                    </div>
                </form>
            </div>

        </div>
    </section><!-- End Edit Admin Response Section -->

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
