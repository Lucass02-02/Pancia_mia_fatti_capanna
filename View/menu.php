<?php // File: View/menu.php (Completo) ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Nostro Menù - Pancia mia fatti capanna</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; }
        .container { max-width: 1200px; margin: 2em auto; padding: 1em; }
        .filter-container { background: #fff; padding: 1.5em; border-radius: 8px; margin-bottom: 2em; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .allergen-list { display: flex; flex-wrap: wrap; gap: 15px; padding-bottom: 1em; }
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5em; }
        .product-card { background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); display: flex; flex-direction: column; padding: 1.5em; }
        h1, h3 { color: #e8491d; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Il Nostro Menù</h1>
        <div class="filter-container">
            <h3>Filtra per allergeni (mostra piatti senza):</h3>
            <form action="/GitHub/Pancia_mia_fatti_capanna/index.php" method="GET">
                <input type="hidden" name="c" value="home">
                <input type="hidden" name="a" value="menu">
                <div class="allergen-list">
                    <?php foreach ($allAllergens as $allergen): ?>
                        <label>
                            <input type="checkbox" name="allergens[]" value="<?php echo $allergen->getId(); ?>"
                                <?php if (in_array($allergen->getId(), $selectedAllergens)) echo 'checked'; ?>>
                            <?php echo htmlspecialchars($allergen->getAllergenType()); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
                <button type="submit">Applica Filtro</button>
                <a href="/GitHub/Pancia_mia_fatti_capanna/index.php?c=home&a=menu" style="margin-left: 10px;">Rimuovi Filtro</a>
            </form>
        </div>
        <?php if (empty($products)): ?>
            <p>Nessun piatto trovato con i filtri selezionati.</p>
        <?php else: ?>
            <div class="menu-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <h3><?php echo htmlspecialchars($product->getName()); ?></h3>
                        <p><?php echo htmlspecialchars($product->getDescription()); ?></p>
                        <p><strong>€ <?php echo htmlspecialchars(number_format($product->getPrice(), 2, ',', '.')); ?></strong></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
