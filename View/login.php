<?php // File: View/login.php (Modificato per stile e visibilità pulsante Home) ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pancia mia fatti capanna</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .container { background-color: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h1 { text-align: center; color: #333; }
        .form-group { margin-bottom: 1em; }
        label { display: block; margin-bottom: 0.5em; color: #555; }
        input { width: 100%; padding: 0.8em; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 1em; background-color: #e8491d; color: white; border: none; border-radius: 4px; font-size: 1em; cursor: pointer; margin-top: 0.5em; }
        button:hover { background-color: #d7380c; }
        .error { padding: 1em; margin-bottom: 1em; border-radius: 4px; text-align: center; background-color: #f8d7da; color: #721c24; }
        
        /* Stile per i link che si comportano come pulsanti, comune in tutta l'applicazione */
        .button-link {
            display: block;
            text-align: center;
            margin-top: 1.5em;
            font-size: 1em;
            text-decoration: none;
            padding: 0.8em;
            border-radius: 4px;
            background-color: #007bff; /* Blu, come gli altri pulsanti di navigazione */
            color: white;
            border: none;
            cursor: pointer;
        }
        .button-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="/Pancia_mia_fatti_capanna/client/login" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Accedi</button>
        </form>
        <a href="/Pancia_mia_fatti_capanna/" class="button-link">Torna alla Home</a> 
    </div>
</body>
</html>