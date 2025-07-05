<?php
// File: View/menu.php (CON STILI COMPLETI E URL AGGIUSTATI)
use AppORM\Services\Utility\USession;

$isAdmin = USession::getValue('user_role') === 'admin';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Nostro Menù - Pancia mia fatti capanna</title>
    <style>
        /* Stili Generali */
        body { font-family: sans-serif; background-color: #f9f9f9; }
        .container { max-width: 1200px; margin: 2em auto; padding: 1em; }
        h1, h3 { color: #e8491d; }

        /* Contenitore dei Filtri */
        .filter-container { background: #fff; padding: 1.5em; border-radius: 8px; margin-bottom: 2em; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .allergen-list { display: flex; flex-wrap: wrap; gap: 15px; padding-bottom: 1em; }

        /* Griglia del Menù e Card dei Prodotti */
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5em; }
        .product-card { background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); display: flex; flex-direction: column; padding: 1.5em; transition: opacity 0.3s ease; }
        .product-card.unavailable { opacity: 0.6; background-color: #f8f9fa; }

        /* Azioni per il Cliente */
        .product-actions { margin-top: auto; padding-top: 1em; text-align: right; display: flex; align-items: center; justify-content: flex-end; }
        .product-actions input[type="number"] { width: 60px; padding: 5px; margin-right: 10px; text-align: center; border: 1px solid #ccc; border-radius: 4px; }
        .product-actions button { background-color: #e8491d; color: white; border: none; padding: 0.7em 1.2em; border-radius: 5px; cursor: pointer; font-size: 0.9em; }

        /* Contenitore e Pulsanti di Gestione per l'Admin */
        .admin-top-actions { display: flex; justify-content: center; gap: 20px; margin-bottom: 2em; }
        .btn-create, .btn-manage { padding: 12px 25px; border-radius: 5px; text-decoration: none; font-size: 1.1em; font-weight: bold; color: white; }
        .btn-create { background-color: #28a745; }
        .btn-manage { background-color: #17a2b8; }

        /* Azioni Admin all'interno della card */
        .admin-actions { margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee; display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; }
        .admin-actions a { text-decoration: none; color: white; padding: 8px 12px; border-radius: 4px; font-size: 0.9em; text-align: center; }
        .btn-edit { background-color: #ffc107; }
        .btn-delete { background-color: #dc3545; }
        .btn-toggle-available { background-color: #28a745; }
        .btn-toggle-unavailable { background-color: #6c757d; }
        
        /* Link di Navigazione in fondo */
        .nav-actions { margin-top: 30px; text-align: center; display: flex; justify-content: center; gap: 20px; }
        .nav-actions a { text-decoration: none; color: white; background-color: #007bff; padding: 10px 15px; border-radius: 5px; display: inline-block; border: none; cursor: pointer; font-size: 1em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Il Nostro Menù</h1>

        <?php if ($isAdmin): ?>
            <div class="admin-top-actions">
                <a href="/Pancia_mia_fatti_capanna/product/showCreateForm" class="btn-create">Aggiungi Nuovo Prodotto</a>
                <a href="/Pancia_mia_fatti_capanna/allergen/manage" class="btn-manage">Gestisci Allergeni</a>
            </div>
        <?php endif; ?>

        <div class="filter-container">
            <h3>Filtra per allergeni (mostra piatti senza):</h3>
            <form action="/Pancia_mia_fatti_capanna/" method="GET">
                <input type="hidden" name="c" value="home">
                <input type="hidden" name="a" value="menu">
                <div class="allergen-list">
                    <?php if (isset($allAllergens) && is_array($allAllergens)): ?>
                        <?php foreach ($allAllergens as $allergen): ?>
                            <label>
                                <input type="checkbox" name="allergens[]" value="<?php echo $allergen->getId(); ?>"
                                    <?php if (isset($selectedAllergens) && in_array($allergen->getId(), $selectedAllergens)) echo 'checked'; ?>>
                                <?php echo htmlspecialchars($allergen->getAllergenType()); ?>
                            </label>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="submit">Applica Filtro</button>
                <a href="/Pancia_mia_fatti_capanna/home/menu" style="margin-left: 10px;">Rimuovi Filtro</a>
            </form>
        </div>

        <?php if (empty($products)): ?>
            <p>Nessun piatto trovato con i filtri selezionati.</p>
        <?php else: ?>
            <div class="menu-grid">
                <?php foreach ($products as $product): ?>
                    <?php $cardClass = ($isAdmin && !$product->isAvailable()) ? 'product-card unavailable' : 'product-card'; ?>
                    <div class="<?php echo $cardClass; ?>">
                        <h3><?php echo htmlspecialchars($product->getName()); ?></h3>
                        <p><?php echo htmlspecialchars($product->getDescription()); ?></p>
                        <p><strong>€ <?php echo htmlspecialchars(number_format($product->getPrice(), 2, ',', '.')); ?></strong></p>
                        
                        <?php if (USession::isSet('user_id') && !$isAdmin): ?>
                            <div class="product-actions">
                                <form action="/Pancia_mia_fatti_capanna/cart/add" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
                                    <input type="number" name="quantity" value="1" min="1" max="99" aria-label="Quantità">
                                    <button type="submit">Aggiungi</button>
                                </form>
                            </div>
                        <?php elseif (!USession::isSet('user_id')): ?>
                            <p style="margin-top: auto; padding-top: 1em; text-align: right; color: gray;">Accedi per aggiungere al carrello.</p>
                        <?php endif; ?>

                        <?php if ($isAdmin): ?>
                            <div class="admin-actions">
                                <a href="/Pancia_mia_fatti_capanna/product/showEditForm/<?php echo $product->getId(); ?>" class="btn-edit">Modifica</a>
                                <?php if ($product->isAvailable()): ?>
                                    <a href="/Pancia_mia_fatti_capanna/product/toggleAvailability/<?php echo $product->getId(); ?>" class="btn-toggle-available">Rendi Non Disp.</a>
                                <?php else: ?>
                                    <a href="/Pancia_mia_fatti_capanna/product/toggleAvailability/<?php echo $product->getId(); ?>" class="btn-toggle-unavailable">Rendi Disp.</a>
                                <?php endif; ?>
                                <a href="/Pancia_mia_fatti_capanna/product/delete/<?php echo $product->getId(); ?>" class="btn-delete" onclick="return confirm('Sei sicuro di voler eliminare questo prodotto? L\'azione è irreversibile.');">Elimina</a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="nav-actions">
            <a href="/Pancia_mia_fatti_capanna/">Torna alla Home</a>
            <?php if (USession::isSet('user_id') && !$isAdmin): ?>
                <a href="/Pancia_mia_fatti_capanna/cart/view">Vai al Carrello</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>