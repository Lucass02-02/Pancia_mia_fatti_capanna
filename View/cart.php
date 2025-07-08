<?php // File: View/cart.php (Correzione $total non definita - AGGIUSTATO URL) ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Mio Carrello - Pancia mia fatti capanna</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; }
        .container { max-width: 800px; margin: 2em auto; padding: 1.5em; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #e8491d; text-align: center; margin-bottom: 1em; }
        .cart-item { display: flex; justify-content: space-between; align-items: center; padding: 0.8em 0; border-bottom: 1px solid #eee; }
        .cart-item:last-child { border-bottom: none; }
        .item-details { flex-grow: 1; }
        .item-actions form { display: inline-block; margin-left: 10px; }
        .item-actions button { background-color: #e8491d; color: white; border: none; padding: 0.5em 0.8em; border-radius: 4px; cursor: pointer; font-size: 0.8em; }
        .item-actions button.remove-btn { background-color: #dc3545; }
        .item-actions button:hover { opacity: 0.9; }
        .cart-summary { text-align: right; margin-top: 1.5em; font-size: 1.2em; font-weight: bold; }
        .cart-actions {
            text-align: center;
            margin-top: 2em;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .cart-actions a, .cart-actions button {
            display: inline-block;
            padding: 1em 1.5em;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 1em;
        }
        .cart-actions a:hover, .cart-actions button:hover { background-color: #0056b3; }
        .cart-actions .clear-btn { background-color: #6c757d; }
        .cart-actions .clear-btn:hover { background-color: #5a6268; }
        .empty-cart-message { text-align: center; margin-top: 2em; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Il Mio Carrello</h1>

        <?php if (empty($cartItems)): ?>
            <p class="empty-cart-message">Il tuo carrello è vuoto. <a href="/Pancia_mia_fatti_capanna/home/menu">Vai al menù</a> per aggiungere prodotti!</p>
        <?php else: ?>
            <?php
            // NUOVA RIGA: Inizializza $total a 0 PRIMA del ciclo
            $total = 0;
            foreach ($cartItems as $item):
                $itemTotal = $item['price'] * $item['quantity'];
                $total += $itemTotal;
            ?>
                <div class="cart-item">
                    <div class="item-details">
                        <strong><?php echo htmlspecialchars($item['name']); ?></strong><br>
                        Quantità: <?php echo $item['quantity']; ?> x € <?php echo number_format($item['price'], 2, ',', '.'); ?> = € <?php echo number_format($item['price'] * $item['quantity'], 2, ',', '.'); ?>
                    </div>
                    <div class="item-actions">
                        <form action="/Pancia_mia_fatti_capanna/cart/remove" method="POST" style="display: inline;">
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                            <input type="hidden" name="remove_one" value="1">
                            <button type="submit">-</button>
                        </form>
                        <form action="/Pancia_mia_fatti_capanna/cart/add" method="POST" style="display: inline;">
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="from_cart" value="true">
                            <button type="submit">+</button>
                        </form>
                        <form action="/Pancia_mia_fatti_capanna/cart/remove" method="POST" style="display: inline;">
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                            <button type="submit" class="remove-btn">Rimuovi</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="cart-summary">
                Totale Carrello: € <?php echo htmlspecialchars(number_format($total, 2, ',', '.')); ?>
            </div>

            <div class="cart-actions">
                <a href="/Pancia_mia_fatti_capanna/home/menu">Torna al Menù</a>
                <form action="/Pancia_mia_fatti_capanna/cart/clear" method="POST" style="display: inline;">
                    <button type="submit" class="clear-btn">Svuota Carrello</button>
                </form>
                <a href="/Pancia_mia_fatti_capanna/cart/checkout">Procedi al Checkout</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>