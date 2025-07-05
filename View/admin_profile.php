<?php
// File: View/admin_profile.php (AGGIORNATO E RIORGANIZZATO)
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
        .container { max-width: 900px; margin: 2em auto; padding: 2em; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1, h2, h3 { color: #e8491d; text-align: center; }
        .profile-details { margin-bottom: 2em; padding: 1.5em; border: 1px solid #ddd; border-radius: 5px; text-align: center;}
        .dashboard { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .dashboard-item { padding: 1.5em; border: 1px solid #eee; border-radius: 5px; }
        .dashboard-item ul { list-style: none; padding: 0; }
        .dashboard-item ul li a { display: block; padding: 10px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px; margin-bottom: 10px; text-align: center; transition: background-color 0.2s; }
        .dashboard-item ul li a:hover { background-color: #0056b3; }
        .nav-links { margin-top: 2em; text-align: center; }
        .nav-links a { color: #007bff; text-decoration: none; font-weight: bold; }
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

        <div class="dashboard">
            <div class="dashboard-item">
                <h3>Gestione Ristorante</h3>
                <ul>
                    <li><a href="/Pancia_mia_fatti_capanna/index.php?c=table&a=listAll">Gestisci Tavoli e Sale</a></li>
                    <li><a href="/Pancia_mia_fatti_capanna/index.php?c=home&a=menu">Gestisci Menù e Prodotti</a></li>
                </ul>
            </div>
            <div class="dashboard-item">
                <h3>Gestione Utenti</h3>
                <ul>
                    <li><a href="/Pancia_mia_fatti_capanna/index.php?c=admin&a=manageClients">Gestisci Clienti</a></li>
                    <li><a href="/Pancia_mia_fatti_capanna/index.php?c=waiter&a=manage">Gestisci Camerieri</a></li>
                </ul>
            </div>
        </div>

        <div class="nav-links">
            <a href="/Pancia_mia_fatti_capanna/">Torna alla Home</a> |
            <a href="/Pancia_mia_fatti_capanna/index.php?c=client&a=logout">Logout</a>
        </div>
    </div>
</body>
</html>