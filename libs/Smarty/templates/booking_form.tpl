{* File: templates/booking_form.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Prenota un Tavolo</title>

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
            <h1>Prenota il Tuo Tavolo</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Booking Form Section ======= -->
    <section class="contact">
        <div class="container">

            <div class="php-email-form bg-white p-4 shadow-sm mx-auto" style="max-width: 500px;">
                {if isset($error)}
                    <div class="error-message text-center">{$error|escape}</div>
                {/if}

                <form action="/Pancia_mia_fatti_capanna/Reservation/book" method="POST">
                    <div class="form-group mb-3">
                        <label for="date" class="form-label">Data</label>
                        <input type="date" id="date" name="date" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="time" class="form-label">Ora</label>
                        <input type="time" id="time" name="time" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="guests" class="form-label">Numero Ospiti</label>
                        <input type="number" id="guests" name="guests" min="1" max="10" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="table_id" class="form-label">Tavolo</label>
                        <select id="table_id" name="table_id" class="form-select" required>
                            <option value="">Seleziona un tavolo</option>
                            {foreach $tables as $table}
                                <option value="{$table->getId()}">{$table->getName()|escape} (Max {$table->getCapacity()} persone)</option>
                            {/foreach}
                        </select>
                    </div>

                    <button type="submit" class="btn btn-get-started w-100">Conferma Prenotazione</button>
                </form>

                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Client/profile" class="btn btn-secondary">Torna al Profilo</a>
                </div>
            </div>

        </div>
    </section><!-- End Booking Form Section -->

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
