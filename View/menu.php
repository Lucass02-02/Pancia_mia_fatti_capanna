<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Nostro Menù - Pancia mia fatti capanna</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; }
        .container { max-width: 1200px; margin: 2em auto; padding: 1em; }
        h1 { text-align: center; color: #e8491d; margin-bottom: 1em; }
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5em; }
        .product-card { 
            background-color: #fff; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
            overflow: hidden; 
            display: flex; 
            flex-direction: column;
            padding: 1.5em; /* Aggiunto padding dato che non c'è l'immagine */
        }
        .product-content h3 { margin-top: 0; color: #333; }
        .product-content p { color: #666; font-size: 0.9em; flex-grow: 1; /* Fa in modo che la descrizione occupi lo spazio disponibile */ }
        .product-price { font-weight: bold; color: #e8491d; font-size: 1.2em; margin-top: 1em; }
        .no-products { text-align: center; color: #777; font-size: 1.2em; padding: 3em; }
        nav { text-align: center; margin-top: 2em; }
        nav a { text-decoration: none; color: #e8491d; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Il Nostro Menù</h1>

        <?php if (empty($products)): ?>
            <p class="no-products">Il menù è in fase di aggiornamento. Torna a trovarci presto!</p>
        <?php else: ?>
            <div class="menu-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <div class="product-content">
                            <h3><?php echo htmlspecialchars($product->getName()); ?></h3>
                            <p><?php echo htmlspecialchars($product->getDescription()); ?></p>
                        </div>
                        <p class="product-price">€ <?php echo htmlspecialchars(number_format($product->getPrice(), 2, ',', '.')); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <nav>
            <a href="/GitHub/Pancia_mia_fatti_capanna/">Torna alla Home</a>
        </nav>
    </div>
</body>
</html>
