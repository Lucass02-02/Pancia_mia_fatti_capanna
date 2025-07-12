{* File: templates/admin_reservations.tpl (RIADATTATA YUMMY STYLE COMPLETO) *}

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Prenotazioni</title>

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

    <main>
        <div class="container" style="max-width: 1100px;">
            <div class="surface p-4 rounded shadow-sm">
                <h1 class="text-center mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">Gestione Prenotazioni</h1>

                {* Filtro per data *}
                <div class="surface p-4 rounded shadow-sm mb-4 border">
                    <h2 class="h5 mb-3">Filtra per data:</h2>
                    <form action="/Pancia_mia_fatti_capanna/Admin/showReservations" method="post" class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="filterDate" class="form-label">Data</label>
                            <input type="date" id="filterDate" name="filter_date" class="form-control"
                                   value="{$smarty.post.filter_date|default:''}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn" style="background-color: var(--accent-color); color: var(--contrast-color);">Applica Filtro</button>
                        </div>
                        <div class="col-auto">
                            <a href="/Pancia_mia_fatti_capanna/Admin/showReservations" class="btn" style="background-color: var(--nav-hover-color);">Rimuovi Filtro</a>
                        </div>
                    </form>
                </div>

                {* Sezione tabella *}
                <div class="mb-5">
                    <h2 class="h4 mb-3">Prenotazioni Esistenti</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Data</th>
                                    <th>Durata</th>
                                    <th>Orario</th>
                                    <th>Num Persone</th>
                                    <th>Note</th>
                                    <th>Nome Prenotazione</th>
                                    <th>Stato</th>
                                    <th>Cambia Stato</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $reservations as $reservation}
                                    {assign var=resDate value=$reservation->getDate()->format('Y-m-d')}
                                    {assign var=filterDate value=$smarty.get.filter_date|default:''}
                                    {if $filterDate == '' || $filterDate == $resDate}
                                        <tr>
                                            <td>{$reservation->getIdReservation()}</td>
                                            <td>{$reservation->getDate()->format('d/m/Y')}</td>
                                            <td>{$reservation->getDuration()}</td>
                                            <td>{$reservation->getHours()->format('H:i')}</td>
                                            <td>{$reservation->getPeopleNum()}</td>
                                            <td>{$reservation->getNote()}</td>
                                            <td>{$reservation->getNameReservation()}</td>
                                            <td>
                                                <span class="fw-bold" style="color:
                                                    {if $reservation->getStatus()->value == 'created'}var(--accent-color)
                                                    {elseif $reservation->getStatus()->value == 'approved'}var(--accent-color)
                                                    {elseif $reservation->getStatus()->value == 'order_in_progress'}#FFA500
                                                    {elseif $reservation->getStatus()->value == 'ended'}var(--nav-hover-color)
                                                    {elseif $reservation->getStatus()->value == 'canceled'}#D9534F
                                                    {/if};
                                                ">
                                                    {$reservation->getStatus()->value|upper}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="/Pancia_mia_fatti_capanna/Admin/updateReservationState" method="post" class="d-flex align-items-center gap-2">
                                                    <input type="hidden" name="reservation_id" value="{$reservation->getIdReservation()}">
                                                    <select name="status" class="form-select">
                                                        <option value="created" {if $reservation->getStatus()->value eq 'created'}selected{/if}>Creata</option>
                                                        <option value="approved" {if $reservation->getStatus()->value eq 'approved'}selected{/if}>Approvata</option>
                                                        <option value="order_in_progress" {if $reservation->getStatus()->value eq 'order_in_progress'}selected{/if}>Ordine in corso</option>
                                                        <option value="order_completed" {if $reservation->getStatus()->value eq 'order_completed'}selected{/if}>Ordine Completato</option>
                                                        <option value="ended" {if $reservation->getStatus()->value eq 'ended'}selected{/if}>Conclusa</option>
                                                        <option value="canceled" {if $reservation->getStatus()->value eq 'canceled'}selected{/if}>Cancellata</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-sm" style="background-color: var(--accent-color); color: var(--contrast-color);">Salva</button>
                                                </form>
                                            </td>
                                        </tr>
                                    {/if}
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn" style="background-color: var(--nav-hover-color); color: var(--contrast-color);">Torna alla Dashboard</a>
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
