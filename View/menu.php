<?php // File: View/menu.php (Correzione aggiunta singolo prodotto)
use AppORM\Services\Utility\USession;
?>
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
        .product-actions { margin-top: 1em; text-align: right; display: flex; align-items: center; justify-content: flex-end;}
        .product-actions input[type="number"] {
            width: 60px;
            padding: 5px;
            margin-right: 10px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .product-actions button { /* Pulsante "Aggiungi al Carrello" individuale */
            background-color: #e8491d;
            color: white;
            border: none;
            padding: 0.7em 1.2em;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9em;
        }
        .product-actions button:hover {
            background-color: #d7380c;
        }
        .nav-actions { /* Per contenere i pulsanti di navigazione in fondo al menù */
            margin-top: 30px;
            text-align: center;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .nav-actions a, .nav-actions button { /* Stile comune per link e pulsanti di navigazione */
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 15px;
            border-radius: 5px;
            display: inline-block;
            border: none;
            cursor: pointer;
            font-size: 1em;
        }
        .nav-actions a:hover, .nav-actions button:hover {
            background-color: #0056b3;
        }
        .add-all-container { /* Contenitore per il pulsante "Aggiungi Tutto" */
            text-align: right;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Il Nostro Menù</h1>
        <div class="filter-container">
            <h3>Filtra per allergeni (mostra piatti senza):</h3>
            <form action="/Pancia_mia_fatti_capanna/index.php" method="GET">
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
                <a href="/Pancia_mia_fatti_capanna/index.php?c=home&a=menu" style="margin-left: 10px;">Rimuovi Filtro</a>
            </form>
        </div>

        <?php if (empty($products)): ?>
            <p>Nessun piatto trovato con i filtri selezionati.</p>
        <?php else: ?>
            <?php if (USession::isSet('user_id')): ?>
                <div class="add-all-container">
                    <form action="/Pancia_mia_fatti_capanna/index.php?c=cart&a=addAll" method="POST" style="display: inline-block;">
                        <?php
                        // Questo loop deve popolare gli ID di *tutti* i prodotti visualizzati
                        // E deve essere specifico per il form "aggiungi tutto"
                        foreach ($products as $product): ?>
                            <input type="hidden" name="product_ids[]" value="<?php echo $product->getId(); ?>">
                        <?php endforeach; ?>
                        <button type="submit" class="nav-actions button">Aggiungi Tutto il Menù al Carrello</button>
                    </form>
                </div>
            <?php endif; ?>

            <div class="menu-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <h3><?php echo htmlspecialchars($product->getName()); ?></h3>
                        <p><?php echo htmlspecialchars($product->getDescription()); ?></p>
                        <p><strong>€ <?php echo htmlspecialchars(number_format($product->getPrice(), 2, ',', '.')); ?></strong></p>
                        
                        <?php if (USession::isSet('user_id')): ?>
                            <div class="product-actions">
                                <form action="/Pancia_mia_fatti_capanna/index.php?c=cart&a=add" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
                                    <input type="number" name="quantity" value="1" min="1" max="99" aria-label="Quantità">
                                    <button type="submit">Aggiungi al Carrello</button>
                                </form>
                            </div>
                        <?php else: ?>
                            <p style="text-align: right; color: gray;">Accedi per aggiungere al carrello.</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="nav-actions">
            <a href="/Pancia_mia_fatti_capanna/">Torna alla Home</a>
            <?php if (USession::isSet('user_id')): ?>
                <a href="/Pancia_mia_fatti_capanna/index.php?c=cart&a=view">Vai al Carrello</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>