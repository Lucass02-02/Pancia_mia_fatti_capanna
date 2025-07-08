<?php
// File: View/manage_clients.php (NUOVO)
/** @var \AppORM\Entity\EClient[] $clients */
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Clienti</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; }
        .container { max-width: 1200px; margin: 2em auto; padding: 2em; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #e8491d; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 1.5em; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .nav-links { margin-top: 2em; text-align: center; }
        .nav-links a { color: #007bff; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Clienti Registrati</h1>

        <?php if (empty($clients)): ?>
            <p style="text-align:center;">Non ci sono clienti registrati al momento.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome Completo</th>
                        <th>Email</th>
                        <th>Nickname</th>
                        <th>Telefono</th>
                        <th>Data di Nascita</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Il codice assume che EClient abbia questi metodi, ereditati da EUser
                    // o definiti direttamente.
                    foreach ($clients as $client): 
                    ?>
                        <tr>
                            <td><?php echo $client->getId(); ?></td>
                            <td><?php echo htmlspecialchars($client->getName() . ' ' . $client->getSurname()); ?></td>
                            <td><?php echo htmlspecialchars($client->getEmail()); ?></td>
                            <td><?php echo htmlspecialchars($client->getNickname() ?: '-'); ?></td>
                            <td><?php echo htmlspecialchars($client->getPhonenumber() ?: '-'); ?></td>
                            <td><?php echo $client->getBirthDate()->format('d/m/Y'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        
        <div class="nav-links">
            <a href="/Pancia_mia_fatti_capanna/admin/profile">Torna al Pannello di Controllo</a>
        </div>
    </div>
</body>
</html>