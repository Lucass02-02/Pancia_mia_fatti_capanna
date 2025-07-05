<?php
// File: View/manage_halls.php (AGGIORNATO)
/** @var \AppORM\Entity\ERestaurantHall[] $halls */
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Sale</title>
    <style> /* ... */ </style>
</head>
<body>
    <div class="container">
        <h1>Gestione Sale</h1>
        <div class="form-section">
            <h2>Aggiungi Nuova Sala</h2>
            <form action="/Pancia_mia_fatti_capanna/index.php?c=hall&a=create" method="POST" style="display:flex; gap:10px;">
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
                        <a href="/Pancia_mia_fatti_capanna/index.php?c=hall&a=delete&id=<?php echo $hall->getIdHall(); ?>" class="delete-btn" onclick="return confirm('Sei sicuro?');">Elimina</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="nav-links">
            <a href="/Pancia_mia_fatti_capanna/index.php?c=table&a=listAll">Torna alla Gestione Tavoli</a>
        </div>
    </div>
</body>
</html>