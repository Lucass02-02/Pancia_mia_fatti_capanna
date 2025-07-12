{* File: templates/waiter_tables_view.tpl (RIADATTATA CON YUMMY STYLE) *}

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Ordini</title>

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
        <div class="container" style="max-width: 1100px;">
            <div class="surface p-4 rounded shadow-sm">
                <h1 class="text-center mb-4" style="font-family: var(--heading-font); color: var(--heading-color);">Lista Ordini</h1>

                {if isset($error)}
                    <div class="alert alert-danger text-center">{$error|escape}</div>
                {/if}

                {* Filtro per data *}
                <div class="bg-white p-4 rounded shadow-sm mb-4 border">
                    <h2 class="h5 text-secondary mb-3">Filtra per data:</h2>
                    <form action="/Pancia_mia_fatti_capanna/Waiter/viewOrder" method="post" class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="filterDate" class="form-label">Data</label>
                            <input type="date" id="filterDate" name="filter_date" class="form-control" value="{$smarty.post.filter_date|default:''}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Applica Filtro</button>
                        </div>
                        <div class="col-auto">
                            <a href="/Pancia_mia_fatti_capanna/Waiter/viewOrder" class="btn btn-secondary">Rimuovi Filtro</a>
                        </div>
                    </form>
                </div>

                {* Tabella ordini *}
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
                                            <span class="fw-bold text-{if $order->getStatus()->value == 'created'}success{elseif $order->getStatus()->value == 'in_progress'}warning{elseif $order->getStatus()->value == 'paid'}success{elseif $order->getStatus()->value == 'canceled'}danger{/if}">
                                                {$order->getStatus()->value|upper}
                                            </span>
                                        </td>
                                        <td>
                                            {if $order->getStatus()->value == 'created'}
                                                <form action="/Pancia_mia_fatti_capanna/{$user_role}/enableOrder" method="post" class="d-flex align-items-center gap-2">
                                                    <input type="hidden" name="order_id" value="{$order->getIdOrder()}">
                                                    <select name="status" class="form-select">
                                                        <option value="in_progress" {if $order->getStatus()->value eq 'in_progress'}selected{/if}>In Corso</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                                                </form>
                                            {/if}
                                        </td>
                                        <td>
                                            <form action="/Pancia_mia_fatti_capanna/{$user_role}/detailOrder" method="post" style="display:inline;">
                                                <input type="hidden" name="order_id" value="{$order->getIdOrder()}">
                                                <button type="submit" class="btn btn-secondary btn-sm">Dettagli</button>
                                            </form>
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                {/if}

                {* Pulsante Torna alla Dashboard *}
                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/{$user_role}/profile" class="btn btn-secondary">Torna alla Dashboard</a>
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
