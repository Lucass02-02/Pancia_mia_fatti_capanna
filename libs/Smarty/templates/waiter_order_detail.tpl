{* File: templates/detail_order.tpl (YUMMY STYLE COMPLETO E COERENTE) *}

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dettagli Ordine</title>

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

    <!-- ======= Page Title Section ======= -->
    <section class="page-title mb-4">
        <div class="container text-center">
            <h1 style="color: var(--heading-color); font-family: var(--heading-font);">Dettagli Ordine</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Main Content ======= -->
    <main>
        <div class="container" style="max-width: 900px;">
            <div class="surface bg-white p-4 rounded shadow-sm">

                {if $order_items|@count == 0}
                    <p class="text-center text-muted">Non sono stati ancora scelti prodotti per questo ordine.</p>
                {else}
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Quantità</th>
                                    <th>Costo Unitario</th>
                                    <th>Nome Prodotto</th>
                                    <th>ID Ordine</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $order_items as $order_item}
                                    <tr>
                                        <td>{$order_item->getQuantity()}</td>
                                        <td>€ {$order_item->getPrice()|number_format:2:',':' '}</td>
                                        <td>{$order_item->getProduct()->getName()|escape}</td>
                                        <td>{$order_item->getOrder()->getIdOrder()}</td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                {/if}

                {* Pulsanti di navigazione *}
                <div class="text-center mt-4">
                    {if $user_role == 'waiter'}
                        <a href="/Pancia_mia_fatti_capanna/Waiter/viewOrder" class="btn btn-primary">Torna agli Ordini</a>
                    {elseif $user_role == 'admin'}
                        <a href="/Pancia_mia_fatti_capanna/Admin/showOrders" class="btn btn-primary">Torna agli Ordini</a>
                    {/if}
                </div>

            </div>
        </div>
    </main>
    <!-- ======= End Main Content ======= -->

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
