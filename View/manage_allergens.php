<?php // File: View/manage_allergens.php (NUOVO)
/** @var \AppORM\Entity\EAllergens[] $allergens */
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Allergeni</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; }
        .container { max-width: 700px; margin: 2em auto; padding: 2em; background: #fff; border-radius: 8px; }
        h1, h2 { color: #e8491d; }
        .form-section, .list-section { margin-bottom: 2em; padding: 1.5em; border: 1px solid #ddd; border-radius: 5px; }
        input[type="text"] { width: calc(100% - 100px); padding: 0.8em; border: 1px solid #ddd; }
        button { padding: 0.8em 1.2em; border: none; background-color: #28a745; color: white; cursor: pointer; }
        .allergen-item { display: flex; justify-content: space-between; align-items: center; padding: 10px; border-bottom: 1px solid #eee; }
        .allergen-item:last-child { border-bottom: none; }
        .delete-btn { background-color: #dc3545; color: white; text-decoration: none; padding: 5px 10px; border-radius: 3px; }
        .nav-links { margin-top: 1.5em; text-align: center; }
        .nav-links a { color: #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestione Allergeni</h1>

        <div class="form-section">
            <h2>Aggiungi Nuovo Allergene</h2>
            <form action="/Pancia_mia_fatti_capanna/index.php?c=allergen&a=create" method="POST">
                <input type="text" name="name" placeholder="Nome allergene (es. Lattosio)" required>
                <button type="submit">Aggiungi</button>
            </form>
        </div>

        <div class="list-section">
            <h2>Allergeni Esistenti</h2>
            <?php if (empty($allergens)): ?>
                <p>Nessun allergene presente.</p>
            <?php else: ?>
                <?php foreach ($allergens as $allergen): ?>
                    <div class="allergen-item">
                        <span><?php echo htmlspecialchars($allergen->getAllergenType()); ?></span>
                        <a href="/Pancia_mia_fatti_capanna/index.php?c=allergen&a=delete&id=<?php echo $allergen->getId(); ?>" class="delete-btn" onclick="return confirm('Sei sicuro di voler eliminare questo allergene?');">Elimina</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="nav-links">
            <a href="/Pancia_mia_fatti_capanna/index.php?c=home&a=menu">Torna al Menù</a>
        </div>
    </div>
</body>
</html>