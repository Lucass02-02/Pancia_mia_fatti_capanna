<?php // File: View/booking_form.php (NUOVO FILE) ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Prenota un Tavolo</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 2em 0; }
        .container { background-color: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h1 { text-align: center; color: #e8491d; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1em; }
        .form-group { margin-bottom: 1em; }
        .form-group.full-width { grid-column: 1 / -1; }
        label { display: block; margin-bottom: 0.5em; color: #555; }
        input, select { width: 100%; padding: 0.8em; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 1em; background-color: #e8491d; color: white; border: none; border-radius: 4px; font-size: 1em; cursor: pointer; margin-top: 1em; }
        .error { padding: 1em; margin-bottom: 1em; border-radius: 4px; text-align: center; background-color: #f8d7da; color: #721c24; }
        nav { text-align: center; margin-top: 1em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Prenota il Tuo Tavolo</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="/Pancia_mia_fatti_capanna/index.php?c=reservation&a=book" method="POST">
            <div class="form-grid">
                <div class="form-group"><label for="date">Data</label><input type="date" id="date" name="date" required></div>
                <div class="form-group"><label for="time">Ora</label><input type="time" id="time" name="time" required></div>
                <div class="form-group"><label for="guests">Numero Ospiti</label><input type="number" id="guests" name="guests" min="1" max="10" required></div>
                <div class="form-group">
                    <label for="table_id">Tavolo</label>
                    <select id="table_id" name="table_id" required>
                        <option value="">Seleziona un tavolo</option>
                        <?php foreach ($tables as $table): ?>
                            <option value="<?php echo $table->getId(); ?>"><?php echo htmlspecialchars($table->getName() . ' (Max ' . $table->getCapacity() . ' persone)'); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group full-width"><button type="submit">Conferma Prenotazione</button></div>
            </div>
        </form>
        <nav><a href="/Pancia_mia_fatti_capanna/index.php?c=client&a=profile">Torna al Profilo</a></nav>
    </div>
</body>
</html>