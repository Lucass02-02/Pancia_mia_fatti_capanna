{* File: templates/registration.tpl (RIADATTATA CON YUMMY TEMPLATE) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione - Pancia mia fatti capanna</title>

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
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <!-- ======= Registration Section ======= -->
    <section class="registration">
        <div class="container my-5" style="max-width: 500px;">
            <div class="php-email-form bg-white p-4 rounded shadow-sm">
                <h1 class="text-center text-primary mb-4">Registrati</h1>

                {if isset($message)}
                    <div class="alert {if isset($success) && $success}alert-success{else}alert-danger{/if}" role="alert">
                        {$message|escape}
                    </div>
                {/if}

                <form action="/Pancia_mia_fatti_capanna/Client/registration" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" id="surname" name="surname" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="birthDate" class="form-label">Data di Nascita</label>
                        <input type="date" id="birthDate" name="birthDate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Numero di Telefono (Opzionale)</label>
                        <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="nickname" class="form-label">Nickname (Opzionale)</label>
                        <input type="text" id="nickname" name="nickname" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-get-started w-100">Registrati</button>
                </form>

                <div class="text-center mt-3">
                    <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
                </div>
            </div>
        </div>
    </section><!-- End Registration Section -->

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
