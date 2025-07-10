{* File: templates/waiter_tables_view.tpl (RIADATTATA CON YUMMY TEMPLATE) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stato Tavoli - {$hall->getName()|escape}</title>

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
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->

    <!-- ======= Tables View Section ======= -->
    <section class="tables-view">
        <div class="container my-5" style="max-width: 900px;">
            <div class="php-email-form bg-white p-4 rounded shadow-sm">
                <h1 class="text-primary text-center mb-4">Stato Tavoli - {$hall->getName()|escape}</h1>

                {if $tables|@count == 0}
                    <p class="text-center text-muted">Non ci sono tavoli assegnati a questa sala.</p>
                {else}
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Tavolo</th>
                                    <th>Posti</th>
                                    <th>Stato Attuale</th>
                                    <th>Cambia Stato</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $tables as $table}
                                    <tr>
                                        <td><strong>#{$table->getIdTable()}</strong></td>
                                        <td>{$table->getSeatsNumber()}</td>
                                        <td>
                                            <span class="fw-bold text-{if $table->getState()->value == 'available'}success{elseif $table->getState()->value == 'reserved'}warning{elseif $table->getState()->value == 'occupied'}danger{/if}">
                                                {$table->getState()->value|upper}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="/Pancia_mia_fatti_capanna/Waiter/updateTableState" method="POST" class="d-flex align-items-center gap-2">
                                                <input type="hidden" name="table_id" value="{$table->getIdTable()}">
                                                <select name="state" class="form-select">
                                                    <option value="available" {if $table->getState()->value eq 'available'}selected{/if}>Disponibile</option>
                                                    <option value="reserved" {if $table->getState()->value eq 'reserved'}selected{/if}>Prenotato</option>
                                                    <option value="occupied" {if $table->getState()->value eq 'occupied'}selected{/if}>Occupato</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                                            </form>
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
    </section><!-- End Tables View Section -->

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
