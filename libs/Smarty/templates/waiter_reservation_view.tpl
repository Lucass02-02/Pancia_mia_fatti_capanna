{* File: templates/waiter_tables_view.tpl (SINTASSI SMARTY COMPLETA E BOOTSTRAP APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lista Prenotazioni</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 900px;">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1 class="text-primary text-center mb-4">Lista Prenotazioni</h1>

            {* Filtro per data *}
            <div class="bg-white p-4 rounded shadow-sm mb-4 border">
                <h2 class="h5 text-secondary mb-3">Filtra per data:</h2>
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
                                <th>note</th>
                                <th>Nome Prenotazione</th>
                                <th>Stato</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $reservations as $reservation}
                                <tr>
                                    <td>{$reservation->getIdReservation()}</td>
                                    <td>{$reservation->getDate()->format('d/m/Y')}</td>
                                    <td>{$reservation->getDuration()}</td>
                                    <td>{$reservation->getHours()->format('H:i')}</td>
                                    <td>{$reservation->getPeopleNum()}</td>
                                    <td>{$reservation->getNote()}</td>
                                    <td>{$reservation->getNameReservation()}</td>
                                    <td>
                                        <span class="fw-bold text-{if $reservation->getStatus()->value == 'created'}success{elseif $reservation->getStatus()->value == 'appoved'}success{elseif $reservation->getStatus()->value == 'order_in_progress'}warning
                                            {elseif $reservation->getStatus()->value == 'ended'}success{elseif $reservation->getStatus()->value == 'canceled'}danger{/if}">
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
                <a href="/Pancia_mia_fatti_capanna/Waiter/profile" class="btn btn-secondary">Torna alla Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
