<?php
/** @var \AppORM\Entity\EProductCategory[] $categories */
/** @var \AppORM\Entity\EAllergens[] $allAllergens */
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Crea Nuovo Prodotto</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 2em 0; }
        .container { background-color: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 100%; max-width: 600px; }
        h1, h3 { text-align: center; color: #e8491d; }
        .form-group { margin-bottom: 1.5em; }
        label { display: block; margin-bottom: 0.5em; font-weight: bold; }
        input[type="text"], input[type="number"], textarea, select { width: 100%; padding: 0.8em; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        textarea { resize: vertical; min-height: 100px; }
        button { width: 100%; padding: 1em; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; margin-top: 1em; }
        .nav-link { display: block; text-align: center; margin-top: 1em; }
        .allergens-container { border: 1px solid #ddd; padding: 1em; border-radius: 4px; }
        .allergen-list { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .allergen-list label { font-weight: normal; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Crea Nuovo Prodotto</h1>
        <form action="/Pancia_mia_fatti_capanna/index.php?c=product&a=create" method="POST">
            <div class="form-group">
                <label for="name">Nome Prodotto</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Descrizione</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Prezzo (€)</label>
                <input type="number" id="price" name="price" step="0.01" min="0" required>
            </div>
            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Seleziona una categoria</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->getId(); ?>">
                            <?php echo htmlspecialchars($category->getName()); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Allergeni Presenti nel Piatto</label>
                <div class="allergens-container">
                    <div class="allergen-list">
                        <?php foreach ($allAllergens as $allergen): ?>
                            <label>
                                <input type="checkbox" name="allergens[]" value="<?php echo $allergen->getId(); ?>">
                                <?php echo htmlspecialchars($allergen->getAllergenType()); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <button type="submit">Crea Prodotto</button>
        </form>
        <a href="/Pancia_mia_fatti_capanna/index.php?c=home&a=menu" class="nav-link">Annulla</a>
    </div>
</body>
</html>