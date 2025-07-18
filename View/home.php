<?php
// File: View/home.php (CORRETTO E DEFINITIVO)
use AppORM\Services\Utility\USession;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titolo ?? 'Pancia mia fatti capanna'); ?></title>
    <style>
        body { font-family: sans-serif; text-align: center; margin-top: 50px; }
        h1 { color: #333; }
        p { color: #666; }
        nav { margin-top: 20px; font-size: 1.2em; }
        nav a { margin: 0 15px; text-decoration: none; color: #e8491d; }
    </style>
</head>
<body>
    <h1><?php echo htmlspecialchars($titolo ?? 'Benvenuto!'); ?></h1>
    <p><?php echo htmlspecialchars($messaggio ?? 'Il miglior ristorante della zona.'); ?></p>
    <nav>
        <a href="/Pancia_mia_fatti_capanna/">Home</a> |
        <a href="/Pancia_mia_fatti_capanna/home/menu">Visualizza Menù</a> |
        <a href="/Pancia_mia_fatti_capanna/review/showAll">Vedi le Recensioni</a> |

        <?php if (USession::isSet('user_id')): ?>
            <?php if (USession::getValue('user_role') === 'admin'): ?>
                <a href="/Pancia_mia_fatti_capanna/admin/profile">Mio Profilo</a> |
                
                <a href="/Pancia_mia_fatti_capanna/table/listAll">Gestione Tavoli</a> |
                
                <a href="/Pancia_mia_fatti_capanna/client/logout">Logout</a>

            <?php else: ?>
                <a href="/Pancia_mia_fatti_capanna/cart/view">Carrello</a> |
                <a href="/Pancia_mia_fatti_capanna/client/profile">Mio Profilo</a> |
                <a href="/Pancia_mia_fatti_capanna/client/logout">Logout</a>
            <?php endif; ?>
        <?php else: ?>
            <a href="/Pancia_mia_fatti_capanna/client/login">Login</a> |
            <a href="/Pancia_mia_fatti_capanna/client/registration">Registrati</a>
        <?php endif; ?>
    </nav>
</body>
</html>