<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Prenotazioni</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 1100px;">
        <h1 class="text-primary text-center mb-4">Gestione Prenotazioni</h1>

        {* Filtro per data *}
        <div class="bg-white p-4 rounded shadow-sm mb-4 border">
            <h2 class="h5 text-secondary mb-3">Filtra per data:</h2>
            <form action="/Pancia_mia_fatti_capanna/Admin/showReservations" method="post" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="filterDate" class="form-label">Data</label>
                    <input type="date" id="filterDate" name="filter_date" class="form-control"
                           value="{$smarty.post.filter_date|default:''}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Applica Filtro</button>
                </div>
                <div class="col-auto">
                    <a href="/Pancia_mia_fatti_capanna/Admin/showReservations" class="btn btn-secondary">Rimuovi Filtro</a>
                </div>
            </form>
        </div>

        {* Sezione tabella *}
        <div class="mb-5">
            <h2 class="h4 text-secondary mb-3">Prenotazioni Esistenti</h2>
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
                                        <span class="fw-bold text-{if $reservation->getStatus()->value == 'created'}success{elseif $reservation->getStatus()->value == 'appoved'}success{elseif $reservation->getStatus()->value == 'order_in_progress'}warning
                                            {elseif $reservation->getStatus()->value == 'order_completed'}warning{elseif $reservation->getStatus()->value == 'ended'}success{elseif $reservation->getStatus()->value == 'canceled'}danger{/if}">
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
                                                <option value="ended" {if $reservation->getStatus()->value eq 'ended'}selected{/if}>Conculusa</option>
                                                <option value="canceled" {if $reservation->getStatus()->value eq 'canceled'}selected{/if}>Cancellata</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Salva</button>
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
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
        </div>
    </div>
</body>
</html>
