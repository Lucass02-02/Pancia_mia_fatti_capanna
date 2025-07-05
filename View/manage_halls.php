<?php
// File: View/manage_halls.php (AGGIORNATO)
/** @var \AppORM\Entity\ERestaurantHall[] $halls */
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Sale</title>
    <style> 
        body { font-family: sans-serif; background-color: #f9f9f9; }
        .container { max-width: 900px; margin: 2em auto; padding: 2em; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1, h2 { color: #e8491d; text-align: center; }
        .form-section, .list-section { margin-bottom: 2em; padding: 1.5em; border: 1px solid #ddd; border-radius: 8px; }
        .item { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #eee; }
        .item:last-child { border-bottom: none; }
        .delete-btn { background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; text-decoration: none; }
        .delete-btn:hover { background-color: #c82333; }
        .nav-links { margin-top: 2em; text-align: center; }
        .nav-links a { color: #007bff; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestione Sale</h1>
        <div class="form-section">
            <h2>Aggiungi Nuova Sala</h2>
            <form action="/Pancia_mia_fatti_capanna/hall/create" method="POST" style="display:flex; gap:10px;">
                <input type="text" name="name" placeholder="Nome della sala" required style="flex-grow:1;">
                <input type="number" name="totalPlaces" placeholder="Capienza" min="1" required style="width:100px;">
                <button type="submit">Aggiungi</button>
            </form>
        </div>
        <div class="list-section">
            <h2>Sale Esistenti</h2>
            <?php if (empty($halls)): ?>
                <p>Nessuna sala presente.</p>
            <?php else: ?>
                <?php foreach ($halls as $hall): ?>
                    <div class="item">
                        <span><?php echo htmlspecialchars($hall->getName()); ?> (Capienza: <?php echo $hall->getTotalPlaces(); ?> posti)</span>
                        <a href="/Pancia_mia_fatti_capanna/hall/delete/<?php echo $hall->getIdHall(); ?>" class="delete-btn" onclick="return confirm('Sei sicuro di voler eliminare questa sala?');">Elimina</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="nav-links">
            <a href="/Pancia_mia_fatti_capanna/table/listAll">Torna alla Gestione Tavoli</a>
        </div>
    </div>
</body>
</html>