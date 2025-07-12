{* File: templates/login.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pancia mia fatti capanna</title>

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
            <h1>Login</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Login Section ======= -->
    <section class="contact">
        <div class="container">

            <div class="php-email-form bg-white p-4 shadow-sm mx-auto" style="max-width: 400px;">
                {if isset($error)}
                    <div class="alert alert-danger text-center">{$error|escape}</div>
                {/if}

                <form action="/Pancia_mia_fatti_capanna/Client/login" method="POST">
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <!-- MODIFICA: Aggiunta Checkbox "Ricordami" -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember_me" value="1" id="rememberMeCheckbox">
                        <label class="form-check-label" for="rememberMeCheckbox">
                            Ricordami
                        </label>
                    </div>
                    <!-- FINE MODIFICA -->

                    <button type="submit" class="btn btn-get-started w-100">Accedi</button>
                </form>

                <div class="text-center mt-4">
                     <p>Non hai un account? <a href="/Pancia_mia_fatti_capanna/Client/registration">Registrati ora</a>.</p>
                    <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
                </div>
            </div>

        </div>
    </section><!-- End Login Section -->

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
