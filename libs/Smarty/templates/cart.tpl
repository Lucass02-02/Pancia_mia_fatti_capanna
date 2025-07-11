{* File: templates/cart.tpl (SINTASSI SMARTY CORRETTA, STYLES.CSS APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Mio Carrello - Pancia mia fatti capanna</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body class="bg-light">
    <div class="container my-5 p-4 bg-white rounded shadow-sm" style="max-width: 800px;">
        <h1 class="text-center text-primary mb-4">Il Mio Carrello</h1>

        {if empty($cartItems)}
            <p class="text-center text-muted">Il tuo carrello è vuoto. <a href="/Pancia_mia_fatti_capanna/Client/order" class="link-primary">Vai al menù</a> per aggiungere prodotti!</p>
        {else}
            {assign var="total" value=0}
            {foreach $cartItems as $item}
                {assign var="itemTotal" value=$item->getPrice() * $item->getQuantity()}
                {assign var="total" value=$total + $itemTotal}
                <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                    <div>
                        <strong>{$item->getProduct()->getName()|escape}</strong><br>
                        <small>Quantità: {$item->getQuantity()} x € {$item->getPrice()|number_format:2:',':'.'} = € {$itemTotal|number_format:2:',':'.'}</small>
                    </div>
                    <div class="btn-group" role="group">
                        <form action="/Pancia_mia_fatti_capanna/Cart/remove" method="POST">
                            <input type="hidden" name="product_id" value="{$item->getProduct()->getIdProduct()}">
                            <input type="hidden" name="remove_one" value="1">
                            <button type="submit" class="btn btn-outline-secondary btn-sm">-</button>
                        </form>
                        <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST">
                            <input type="hidden" name="product_id" value="{$item->getProduct()->getIdProduct()}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="from_cart" value="true">
                            <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                        </form>
                        <form action="/Pancia_mia_fatti_capanna/Cart/remove" method="POST">
                            <input type="hidden" name="product_id" value="{$item->getProduct()->getIdProduct()}">
                            <button type="submit" class="btn btn-danger btn-sm">Rimuovi</button>
                        </form>
                    </div>
                </div>
            {/foreach}

            <div class="text-end mt-4 fs-5 fw-bold">
                Totale Carrello: € {$total|number_format:2:',':'.'}
            </div>

            <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                <a href="/Pancia_mia_fatti_capanna/Client/order" class="btn btn-primary">Torna al Menù</a>
                <form action="/Pancia_mia_fatti_capanna/Cart/clear" method="POST">
                    <button type="submit" class="btn btn-secondary">Svuota Carrello</button>
                </form>
                <a href="/Pancia_mia_fatti_capanna/Cart/checkout" class="btn btn-success">Procedi al Checkout</a>
            </div>
        {/if}
    </div>
</body>
</html>
