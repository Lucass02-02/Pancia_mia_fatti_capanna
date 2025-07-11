{* File: templates/manage_halls.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Sale Ristorante</title>

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
            <h1>Gestione Banchetti Ristorante</h1>
        </div>
    </section><!-- End Page Title Section -->
<section class="container" style="background: url('/Pancia_mia_fatti_capanna/images/sala-ristorante.png') center center / cover no-repeat; height: 300px; width: 600px"></section>
    <!-- ======= Manage Halls Section ======= -->
    <section class="contact">
        <div class="container" style="max-width: 900px;">

            <div class="php-email-form bg-white p-4 shadow-sm">

                <div class="text-end mb-4">
                    <a href="/Pancia_mia_fatti_capanna/Waiter/manage" class="btn btn-info">Gestisci Camerieri</a>
                </div>

                {if isset($error) && $error}
                    <div class="error-message mb-3">Non puoi eliminare questo banchetto perché contiene dei camerieri. Sposta i camerieri in un'altra sala e riprova.</div>
                {/if}

                <h2 class="h5 mb-3">Aggiungi Nuovo Banchetto</h2>
                <form action="/Pancia_mia_fatti_capanna/RestaurantHall/create" method="POST" class="mb-4 p-3 border rounded">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nome Banchetto:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="totalPlaces" class="form-label">Posti Totali:</label>
                            <input type="number" id="totalPlaces" name="totalPlaces" class="form-control" min="1" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-get-started w-100">Crea Banchetto</button>
                        </div>
                    </div>
                </form>

                <h2 class="h5 mb-3">Banchetti Esistenti</h2>
                {if empty($halls)}
                    <p class="text-center text-muted">Nessun Banchetto ristorante presente.</p>
                {else}
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Posti Totali</th>
                                    <th class="text-center">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $halls as $hall}
                                    <tr>
                                        <td>{$hall->getIdHall()}</td>
                                        <td>{$hall->getName()|escape}</td>
                                        <td>{$hall->getTotalPlaces()}</td>
                                        <td class="text-center">
                                            <form action="/Pancia_mia_fatti_capanna/RestaurantHall/delete" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare la sala {$hall->getName()|escape}?');">
                                                <input type="hidden" name="hall_id" value="{$hall->getIdHall()}">
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
    <footer id="footer" class="footer">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer><!-- End Footer -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
