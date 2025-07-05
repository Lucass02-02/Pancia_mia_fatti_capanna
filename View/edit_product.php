<?php
/** @var \AppORM\Entity\EProduct $product */
/** @var \AppORM\Entity\EProductCategory[] $categories */
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Prodotto - <?php echo htmlspecialchars($product->getName()); ?></title>
    <style>
        /* Puoi usare uno stile simile a login.php per coerenza */
        body { font-family: sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { background-color: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 100%; max-width: 600px; }
        h1 { text-align: center; color: #e8491d; }
        .form-group { margin-bottom: 1em; }
        label { display: block; margin-bottom: 0.5em; }
        input[type="text"], input[type="number"], textarea, select {
            width: 100%; padding: 0.8em; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;
        }
        textarea { resize: vertical; min-height: 100px; }
        button { width: 100%; padding: 1em; background-color: #e8491d; color: white; border: none; border-radius: 4px; cursor: pointer; margin-top: 1em; }
        .nav-link { display: block; text-align: center; margin-top: 1em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modifica Prodotto</h1>
        <form action="/Pancia_mia_fatti_capanna/product/update" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
            
            <div class="form-group">
                <label for="name">Nome Prodotto</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product->getName()); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Descrizione</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($product->getDescription()); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="price">Prezzo (€)</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars($product->getPrice()); ?>" required>
            </div>
            
            <button type="submit">Salva Modifiche</button>
        </form>
        <a href="/Pancia_mia_fatti_capanna/home/menu" class="nav-link">Annulla e torna al Menù</a>
    </div>
</body>
</html>