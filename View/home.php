<?php
// Usiamo la nostra utility per controllare la sessione
use AppORM\Services\Utility\USession;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titolo); ?></title>
    <style>
        body { font-family: sans-serif; text-align: center; margin-top: 50px; }
        h1 { color: #333; }
        p { color: #666; }
        nav { margin-top: 20px; font-size: 1.2em; }
        nav a { margin: 0 15px; text-decoration: none; color: #e8491d; }
    </style>
</head>
<body>
    <h1><?php echo htmlspecialchars($titolo); ?></h1>
    <p><?php echo htmlspecialchars($messaggio); ?></p>
<nav>
        <a href="/Pancia_mia_fatti_capanna/">Home</a> |
        <a href="/Pancia_mia_fatti_capanna/index.php?c=home&a=menu">Visualizza Menù</a> |
        <a href="/Pancia_mia_fatti_capanna/index.php?c=review&a=showAll">Vedi le Recensioni</a> |

        <?php if (USession::isSet('user_id')): ?>
            <a href="/Pancia_mia_fatti_capanna/index.php?c=cart&a=view">Carrello</a> | <a href="/Pancia_mia_fatti_capanna/index.php?c=client&a=profile">Mio Profilo</a> |
            <a href="/Pancia_mia_fatti_capanna/index.php?c=client&a=logout">Logout</a>

        <?php else: ?>

            <a href="/Pancia_mia_fatti_capanna/index.php?c=client&a=login">Login</a> |
            <a href="/Pancia_mia_fatti_capanna/index.php?c=client&a=registration">Registrati</a>

        <?php endif; ?>
    </nav>
</body>
</html>