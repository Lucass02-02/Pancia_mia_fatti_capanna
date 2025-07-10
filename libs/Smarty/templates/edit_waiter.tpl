{* File: templates/edit_waiter.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Cameriere</title>

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
            <h1>Modifica Cameriere</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Edit Waiter Section ======= -->
    <section class="contact">
        <div class="container" style="max-width: 800px;">

            {* Mostra messaggi di errore o successo *}
            {if isset($error) && $error}
                <div class="error-message text-center mb-3">Errore: {$error|escape}</div>
            {/if}

            <div class="php-email-form bg-white p-4 shadow-sm">
                <form action="/Pancia_mia_fatti_capanna/Waiter/update" method="POST" class="row g-3">
                    <input type="hidden" name="id" value="{$waiter->getId()}">

                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" value="{$waiter->getName()|escape}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" id="surname" name="surname" class="form-control" value="{$waiter->getSurname()|escape}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{$waiter->getEmail()|escape}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Nuova Password (lascia vuoto per non modificare)</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="birthDate" class="form-label">Data di Nascita</label>
                        <input type="date" id="birthDate" name="birthDate" class="form-control" value="{$waiter->getBirthDate()->format('Y-m-d')}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="serialNumber" class="form-label">Matricola</label>
                        <input type="text" id="serialNumber" name="serialNumber" class="form-control" value="{$waiter->getSerialNumber()|escape}" required>
                    </div>

                    <div class="col-12">
                        <label for="hall_id" class="form-label">Assegna a una Sala</label>
                        <select id="hall_id" name="hall_id" class="form-select" required>
                            <option value="">Seleziona una sala...</option>
                            {foreach $halls as $hall}
                                <option value="{$hall->getIdHall()}" {if $waiter->getRestaurantHall() && $waiter->getRestaurantHall()->getIdHall() == $hall->getIdHall()}selected{/if}>
                                    {$hall->getName()|escape}
                                </option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="col-12 mt-4 d-flex justify-content-between">
                        <button type="submit" class="btn btn-get-started">Salva Modifiche</button>
                        <a href="/Pancia_mia_fatti_capanna/Waiter/manage" class="btn btn-secondary">Annulla</a>
                    </div>
                </form>
            </div>

        </div>
    </section><!-- End Edit Waiter Section -->

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
