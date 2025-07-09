<?php // File: View/add_credit_card.php (NUOVO FILE) ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Aggiungi Carta di Credito</title>
    <style>
        /* ... Stile simile a login/registration ... */
        body { font-family: sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { background-color: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h1 { text-align: center; color: #e8491d; }
        input, select { width: 100%; padding: 0.8em; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; margin-bottom: 1em; }
        button { width: 100%; padding: 1em; background-color: #e8491d; color: white; border: none; border-radius: 4px; font-size: 1em; cursor: pointer; }
        .error { color: red; text-align: center; margin-bottom: 1em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Aggiungi Metodo di Pagamento</h1>
        <p style="text-align:center; font-size:0.8em; color:#777;">Nota: non inserire dati reali. Questa è una simulazione.</p>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="/Pancia_mia_fatti_capanna/index.php?c=client&a=addCreditCard" method="POST">
            <div><label for="cardName">Nome Carta (es. La mia Visa)</label><input type="text" id="cardName" name="cardName"></div>
            <div><label for="brand">Circuito (es. Visa, MasterCard)</label><input type="text" id="brand" name="brand" required></div>
            <div><label for="last4">Ultime 4 Cifre</label><input type="text" id="last4" name="last4" maxlength="4" required></div>
            <div><label for="expMonth">Mese Scadenza</label><input type="number" id="expMonth" name="expMonth" min="1" max="12" required></div>
            <div><label for="expYear">Anno Scadenza</label><input type="number" id="expYear" name="expYear" min="2024" required></div>
            <button type="submit">Aggiungi Carta</button>
        </form>
    </div>
</body>
</html>
