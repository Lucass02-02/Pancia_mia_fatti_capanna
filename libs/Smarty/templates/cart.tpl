{* File: templates/cart.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Mio Carrello - Pancia mia fatti capanna</title>

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
            <h1>Il Mio Carrello</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Cart Section ======= -->
    <section class="section">
        <div class="container" style="max-width: 800px;">
            {if empty($cartItems)}
                <p class="text-center text-muted">Il tuo carrello è vuoto. <a href="/Pancia_mia_fatti_capanna/Home/menu" class="link-primary">Vai al menù</a> per aggiungere prodotti!</p>
            {else}
                {assign var="total" value=0}
                {foreach $cartItems as $item}
                    {assign var="itemTotal" value=$item['price'] * $item['quantity']}
                    {assign var="total" value=$total + $itemTotal}
                    <div class="icon-box">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <p class="mb-1 fw-bold">{$item['name']|escape}</p>
                                <small>Quantità: {$item['quantity']} x € {$item['price']|number_format:2:',':'.'} = € {$itemTotal|number_format:2:',':'.'}</small>
                            </div>
                            <div class="btn-group mt-2 mt-md-0" role="group">
                                <form action="/Pancia_mia_fatti_capanna/Cart/remove" method="POST">
                                    <input type="hidden" name="product_id" value="{$item['product_id']}">
                                    <input type="hidden" name="remove_one" value="1">
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">-</button>
                                </form>
                                <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST">
                                    <input type="hidden" name="product_id" value="{$item['product_id']}">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="from_cart" value="true">
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                                </form>
                                <form action="/Pancia_mia_fatti_capanna/Cart/remove" method="POST">
                                    <input type="hidden" name="product_id" value="{$item['product_id']}">
                                    <button type="submit" class="btn btn-danger btn-sm">Rimuovi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                {/foreach}

                <div class="text-end mt-4 fs-5 fw-bold">
                    Totale Carrello: € {$total|number_format:2:',':'.'}
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                    <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-get-started">Torna al Menù</a>
                    <form action="/Pancia_mia_fatti_capanna/Cart/clear" method="POST">
                        <button type="submit" class="btn btn-secondary">Svuota Carrello</button>
                    </form>
                    <a href="/Pancia_mia_fatti_capanna/Cart/checkout" class="btn btn-success">Procedi al Checkout</a>
                </div>
            {/if}
        </div>
    </section><!-- End Cart Section -->

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
