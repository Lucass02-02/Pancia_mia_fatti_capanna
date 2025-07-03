<?php // File: View/profile.php ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo di <?php echo htmlspecialchars($client->getName()); ?></title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; color: #333; }
        .container { max-width: 800px; margin: 50px auto; padding: 2em; background-color: #fff; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
        h1 { color: #e8491d; }
        p { line-height: 1.6; }
        strong { color: #555; }
        nav { margin-top: 2em; text-align: center; }
        nav a { margin: 0 10px; text-decoration: none; color: #e8491d; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ciao, <?php echo htmlspecialchars($client->getName()); ?>!</h1>
        <p>Questa è la tua area personale.</p>
        <p><strong>Nome Completo:</strong> <?php echo htmlspecialchars($client->getName() . ' ' . $client->getSurname()); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($client->getEmail()); ?></p>
        <p><strong>Data di Nascita:</strong> <?php echo htmlspecialchars($client->getBirthDate()->format('d/m/Y')); ?></p>
        
        <nav>
            <a href="/GitHub/Pancia_mia_fatti_capanna/">Torna alla Home</a> |
            <a href="/GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=logout">Logout</a>
        </nav>
    </div>
</body>
</html>
