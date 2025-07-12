{* File: templates/manage_halls.tpl (RIADATTATO CON NUOVO style.css Yummy CORRETTO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Turni</title>

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
<section class="my-5 text-center">
  <img src="/Pancia_mia_fatti_capanna/images/sala-ristorante.png" alt="Recensioni" class="img-fluid" style="width: 600px; height: 300px; margin-top: 20px;">
</section>
    <!-- ======= Page Title Section ======= -->
    <section class="page-title py-3">
        <div class="container">
            <h1 class="text-center">Gestione Turni</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Manage Halls Section ======= -->
    <section class="contact py-4">
        <div class="container" style="max-width: 900px;">

            <div class="php-email-form bg-white p-4 shadow-sm rounded">

                {if isset($error) && $error}
                    <div class="alert alert-danger mb-3">
                        {$error}
                    </div>
                {/if}

                <h2 class="h5 mb-3">Aggiungi Nuovo Turno</h2>
                <form action="/Pancia_mia_fatti_capanna/Admin/createTurn" method="POST" class="mb-4 p-3 border rounded bg-light">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="dayOfWeek" class="form-label">Scegli il giorno</label>
                            <select name="dayOfWeek" class="form-select">
                                {foreach $enumValues as $name => $value}
                                    <option value="{$value}">{$name|escape}</option>
                                {/foreach}
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="turno" class="form-label">Scegli il turno</label>
                            <select name="turno" class="form-select">
                                {foreach $enumValues2 as $name => $value}
                                    <option value="{$value}">{$name|escape}</option>
                                {/foreach}
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="startTime" class="form-label">Ora Inizio</label>
                            <input type="time" id="startTime" name="startTime" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="endTime" class="form-label">Ora Fine</label>
                            <input type="time" id="endTime" name="endTime" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="hall_id" class="form-label">Assegna a un banchetto</label>
                            <select id="hall_id" name="hall_id" class="form-select" required>
                                <option value="">Seleziona un banchetto...</option>
                                {foreach $halls as $hall}
                                    <option value="{$hall->getIdHall()}">{$hall->getName()|escape}</option>
                                {/foreach}
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-get-started w-100">Crea</button>
                        </div>
                    </div>
                </form>

                <h2 class="h5 mb-3">Turni Esistenti</h2>
                {if empty($turns)}
                    <p class="text-center text-muted">Nessun turno presente.</p>
                {else}
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Giorno Della Settimana</th>
                                    <th>Ora Inizio</th>
                                    <th>Ora Fine</th>
                                    <th>Banchetto Assegnato</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $turns as $turn}
                                    <tr>
                                        <td>{$turn->getIdTurn()}</td>
                                        <td>{$turn->getNameValue()}</td>
                                        <td>{$turn->getDayOfWeekName()}</td>
                                        <td>{$turn->getStartTime()->format('H:i:s')}</td>
                                        <td>{$turn->getEndTime()->format('H:i:s')}</td>
                                        <td>{$turn->getRestaurantHall()->getName()}</td>
                                        <td class="text-center">
                                            <form action="/Pancia_mia_fatti_capanna/Admin/deleteTurn" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare il turno {$turn->getIdTurn()|escape}?');" class="d-inline">
                                                <input type="hidden" name="turn_id" value="{$turn->getIdTurn()}">
                                                <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                                            </form>
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                {/if}

                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary">Torna al Pannello di Controllo</a>
                </div>

            </div>

        </div>
    </section><!-- End Manage Halls Section -->

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
