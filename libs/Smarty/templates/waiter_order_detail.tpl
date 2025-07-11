{* File: templates/waiter_tables_view.tpl (SINTASSI SMARTY COMPLETA E BOOTSTRAP APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dettagli Ordine</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 900px;">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1 class="text-primary text-center mb-4">Dettagli Ordine</h1>

            {if $order_items|@count == 0}
                <p class="text-center text-muted">Non sono stati ancora scelti prodotti per questo ordine.</p>
            {else}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Quantità</th>
                                <th>Costo Singola Quantità</th>
                                <th>Nome Prodotto</th>
                                <th>ID Ordine</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $order_items as $order_item}
                                <tr>
                                    <td>{$order_item->getQuantity()}</td>
                                    <td>{$order_item->getPrice()}</td>
                                    <td>{$order_item->getProduct()->getName()}</td>
                                    <td>{$order_item->getOrder()->getIdOrder()}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            {/if}

            {if $user_role == 'waiter'}
                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Waiter/viewOrder" class="btn btn-secondary">Torna agli ordini</a>
                </div>
            {elseif $user_role == 'admin'}
                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Admin/showOrders" class="btn btn-secondary">Torna agli ordini</a>
                </div>
            {/if}
        </div>
    </div>
</body>
</html>