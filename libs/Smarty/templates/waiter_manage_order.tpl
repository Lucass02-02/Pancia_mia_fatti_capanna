{* File: templates/waiter_tables_view.tpl (SINTASSI SMARTY COMPLETA E BOOTSTRAP APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lista Ordini</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 900px;">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1 class="text-primary text-center mb-4">Lista Ordini</h1>

            {if isset($error)}
            <div class="alert alert-danger text-center">{$error|escape}</div>
            {/if}

            {* Filtro per data *}
            <div class="bg-white p-4 rounded shadow-sm mb-4 border">
                <h2 class="h5 text-secondary mb-3">Filtra per data:</h2>
                <form action="/Pancia_mia_fatti_capanna/Waiter/viewOrder" method="post" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="filterDate" class="form-label">Data</label>
                        <input type="date" id="filterDate" name="filter_date" class="form-control"
                            value="{$smarty.post.filter_date|default:''}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Applica Filtro</button>
                    </div>
                    <div class="col-auto">
                        <a href="/Pancia_mia_fatti_capanna/Waiter/viewOrder" class="btn btn-secondary">Rimuovi Filtro</a>
                    </div>
                </form>
            </div>

            {if $orders|@count == 0}
                <p class="text-center text-muted">Non ci sono ancora ordini.</p>
            {else}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Data</th>
                                <th>ID Prenotazione</th>
                                <th>Stato</th>
                                <th>Approva Ordine</th>
                                <th>Dettagli Ordine</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $orders as $order}
                                <tr>
                                    <td>{$order->getIdOrder()}</td>
                                    <td>{$order->getDate()->format('d/m/Y')}</td>
                                    <td>{$order->getReservation()->getIdReservation()}</td>
                                    <td>
                                        <span class="fw-bold text-{if $order->getStatus()->value == 'created'}success{elseif $order->getStatus()->value == 'in_progress'}warning
                                            {elseif $order->getStatus()->value == 'paid'}success{elseif $order->getStatus()->value == 'canceled'}danger{/if}">
                                            {$order->getStatus()->value|upper}
                                        </span>    
                                    </td>
                                    <td>
                                        {if $order->getStatus()->value == 'created'}
                                            {if $user_role == 'waiter'}
                                                <form action="/Pancia_mia_fatti_capanna/Waiter/enableOrder" method="post" class="d-flex align-items-center gap-2">
                                                    <input type="hidden" name="order_id" value="{$order->getIdOrder()}">
                                                    <select name="status" class="form-select">
                                                    <option value="in_progress" {if $order->getStatus()->value eq 'in_progress'}selected{/if}>In Corso</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                                                </form>
                                            {elseif $user_role == 'admin'}
                                                <form action="/Pancia_mia_fatti_capanna/Admin/enableOrder" method="post" class="d-flex align-items-center gap-2">
                                                    <input type="hidden" name="order_id" value="{$order->getIdOrder()}">
                                                    <select name="status" class="form-select">
                                                    <option value="in_progress" {if $order->getStatus()->value eq 'in_progress'}selected{/if}>In Corso</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                                                </form>
                                            {/if}
                                        {/if}
                                    </td>
                                    <td>
                                        {if $user_role == 'waiter'}
                                            <form action="/Pancia_mia_fatti_capanna/Waiter/detailOrder" method="post" style="display:inline;">
                                                <input type="hidden" name="order_id" value="{$order->getIdOrder()}">
                                                <button type="submit" class="btn btn-secondary btn-sm">Dettagli</button>
                                            </form>
                                        {elseif $user_role == 'admin'}
                                            <form action="/Pancia_mia_fatti_capanna/Admin/detailOrder" method="post" style="display:inline;">
                                                <input type="hidden" name="order_id" value="{$order->getIdOrder()}">
                                                <button type="submit" class="btn btn-secondary btn-sm">Dettagli</button>
                                            </form>
                                        {/if}
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            {/if}

            {if $user_role == 'waiter'}
            <div class="text-center mt-4">
                <a href="/Pancia_mia_fatti_capanna/Waiter/profile" class="btn btn-secondary">Torna alla Dashboard</a>
            </div>
            {elseif $user_role == 'admin'}
            <div class="text-center mt-4">
                <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary">Torna alla Dashboard</a>
            </div>
            {/if}
        </div>
    </div>
</body>
</html>
