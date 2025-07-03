<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione - Pancia mia fatti capanna</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background-color: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h1 { text-align: center; color: #333; }
        .form-group { margin-bottom: 1em; }
        label { display: block; margin-bottom: 0.5em; color: #555; }
        input { width: 100%; padding: 0.8em; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 1em; background-color: #e8491d; color: white; border: none; border-radius: 4px; font-size: 1em; cursor: pointer; }
        button:hover { background-color: #d7380c; }
        .message { padding: 1em; margin-bottom: 1em; border-radius: 4px; text-align: center; }
        .message.success { background-color: #d4edda; color: #155724; }
        .message.error { background-color: #f8d7da; color: #721c24; }
        nav { text-align: center; margin-top: 1em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrati</h1>

        <?php if (isset($message)): ?>
            <div class="message <?php echo $success ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="/GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=registration" method="POST">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="surname">Cognome</label>
                <input type="text" id="surname" name="surname" required>
            </div>
            <div class="form-group">
                <label for="birthDate">Data di Nascita</label>
                <input type="date" id="birthDate" name="birthDate" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Registrati</button>
        </form>
        <nav>
            <a href="/GitHub/Pancia_mia_fatti_capanna/">Torna alla Home</a>
        </nav>
    </div>
</body>
</html>
