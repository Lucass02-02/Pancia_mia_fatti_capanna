<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazione - Pancia mia fatti capanna</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 1em;
        }
        label {
            display: block;
            margin-bottom: 0.5em;
            color: #555;
        }
        input, select {
            width: 100%;
            padding: 0.8em;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 1em;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            padding: 1em;
            margin-bottom: 1em;
            border-radius: 4px;
            text-align: center;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
        nav {
            text-align: center;
            margin-top: 1em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Prenota un tavolo</h1>

        <?php if (isset($message)): ?>
            <div class="message <?php echo $login ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!isset($message) || $success): ?>
            <form action="/Pancia_mia_fatti_capanna/Client/reserve" method="POST">
                <div class="form-group">
                    <label for="data">Data</label>
                    <input type="date" id="data" name="data" required>
                </div>
                <div class="form-group">
                    <label for="ora">Ora</label>
                    <input type="time" id="ora" name="ora" required>
                </div>
                <div class="form-group">
                    <label for="persone">Numero di Persone</label>
                    <input type="number" id="persone" name="persone" min="1" max="20" required>
                </div>
                <button type="submit">Prenota</button>
            </form>
        <?php endif; ?>

        <nav>
            <a href="/Pancia_mia_fatti_capanna/">Torna alla Home</a> |
            <a href="/Pancia_mia_fatti_capanna/logout.php">Logout</a>
        </nav>
    </div>
</body>
</html>
