{* File: templates/waiter_tables_view.tpl (YUMMY STYLE COMPLETO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lista Prenotazioni</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <main>
        <div class="container" style="max-width: 900px;">
            <div class="surface bg-white p-4 rounded shadow-sm">
                <h1 class="text-center mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">Lista Prenotazioni</h1>

                {* Filtro per data *}
                <div class="surface bg-light p-4 rounded shadow-sm mb-4 border">
                    <h2 class="h5 mb-3" style="color: var(--heading-color);">Filtra per data:</h2>
                    <form action="/Pancia_mia_fatti_capanna/Waiter/viewReservation" method="post" class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="filterDate" class="form-label">Data</label>
                            <input type="date" id="filterDate" name="filter_date" class="form-control"
                                value="{$smarty.post.filter_date|default:''}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Applica Filtro</button>
                        </div>
                        <div class="col-auto">
                            <a href="/Pancia_mia_fatti_capanna/Waiter/viewReservation" class="btn btn-secondary">Rimuovi Filtro</a>
                        </div>
                    </form>
                </div>

                {if $reservations|@count == 0}
                    <p class="text-center text-muted">Non ci sono ancora prenotazioni.</p>
                {else}
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Data</th>
                                    <th>Durata</th>
                                    <th>Orario</th>
                                    <th>Num persone</th>
                                    <th>Note</th>
                                    <th>Nome Prenotazione</th>
                                    <th>Stato</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $reservations as $reservation}
                                    <tr>
                                        <td>{$reservation->getIdReservation()}</td>
                                        <td>{$reservation->getDate()->format('d/m/Y')}</td>
                                        <td>{$reservation->getDuration()} min</td>
                                        <td>{$reservation->getHours()->format('H:i')}</td>
                                        <td>{$reservation->getPeopleNum()}</td>
                                        <td>{$reservation->getNote()}</td>
                                        <td>{$reservation->getNameReservation()}</td>
                                        <td>
                                            <span class="fw-bold text-{if $reservation->getStatus()->value == 'created'}primary
                                                {elseif $reservation->getStatus()->value == 'approved'}success
                                                {elseif $reservation->getStatus()->value == 'order_in_progress'}warning
                                                {elseif $reservation->getStatus()->value == 'ended'}secondary
                                                {elseif $reservation->getStatus()->value == 'canceled'}danger{/if}">
                                                {$reservation->getStatus()->value|upper}
                                            </span>
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                {/if}

                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Waiter/profile" class="btn btn-primary">Torna alla Dashboard</a>
                </div>
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
