<?php // File: View/admin_profile.php (NUOVO)
/** @var \AppORM\Entity\EAdmin $admin */
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo Amministratore</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; }
        .container { max-width: 800px; margin: 2em auto; padding: 2em; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1, h2 { color: #e8491d; }
        .profile-details { margin-bottom: 2em; padding: 1.5em; border: 1px solid #ddd; border-radius: 5px; }
        .nav-links { margin-top: 1.5em; text-align: center; }
        .nav-links a { margin: 0 10px; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pannello di Controllo</h1>

        <div class="profile-details">
            <h2>Dati del Proprietario</h2>
            <p><strong>Nome Completo:</strong> <?php echo htmlspecialchars($admin->getName() . ' ' . $admin->getSurname()); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($admin->getEmail()); ?></p>
        </div>

        <div class="nav-links">
            <a href="/Pancia_mia_fatti_capanna/">Torna alla Home</a> |
            <a href="/Pancia_mia_fatti_capanna/index.php?c=client&a=logout">Logout</a>
        </div>
    </div>
</body>
</html>