<?php
// File: View/manage_waiters.php (CODICE COMPLETO E FUNZIONANTE CON URL AGGIUSTATI)
/** @var \AppORM\Entity\EWaiter[] $waiters */
/** @var \AppORM\Entity\ERestaurantHall[] $halls */
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Camerieri</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; color: #333; }
        .container { max-width: 1200px; margin: 2em auto; padding: 2em; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h1, h2 { color: #e8491d; text-align: center; }
        .form-section, .list-section { margin-bottom: 2.5em; padding: 1.5em; border: 1px solid #ddd; border-radius: 8px; }
        .registration-form { display: grid; grid-template-columns: 1fr 1fr; gap: 15px 20px; }
        .form-group { display: flex; flex-direction: column; }
        .form-group.full-width { grid-column: 1 / -1; }
        .form-group label { margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group select { padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 1em; }
        .form-group button { padding: 12px 20px; border: none; border-radius: 4px; background-color: #28a745; color: white; cursor: pointer; font-size: 1.1em; transition: background-color 0.2s; margin-top: 10px; }
        .form-group button:hover { background-color: #218838; }
        table { width: 100%; border-collapse: collapse; margin-top: 1.5em; }
        th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; vertical-align: middle; }
        th { background-color: #f2f2f2; }
        .delete-btn { display: inline-block; background-color: #dc3545; color: white; text-decoration: none; padding: 8px 12px; border-radius: 4px; }
        .hall-update-form { display: flex; align-items: center; gap: 10px; }
        .hall-update-form select { flex-grow: 1; }
        .hall-update-form button { background-color: #007bff; font-size: 0.9em; padding: 8px 12px; }
        .nav-links { margin-top: 2em; text-align: center; }
        .nav-links a { color: #007bff; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestione Camerieri</h1>
        <div class="form-section">
            <h2>Registra Nuovo Cameriere</h2>
            <form action="/Pancia_mia_fatti_capanna/waiter/register" method="POST" class="registration-form">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" placeholder="Mario" required>
                </div>
                <div class="form-group">
                    <label for="surname">Cognome</label>
                    <input type="text" id="surname" name="surname" placeholder="Rossi" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="m.rossi@ristorante.it" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
                <div class="form-group">
                    <label for="birthDate">Data di Nascita</label>
                    <input type="date" id="birthDate" name="birthDate" required>
                </div>
                <div class="form-group">
                    <label for="serialNumber">Matricola</label>
                    <input type="text" id="serialNumber" name="serialNumber" placeholder="ID Univoco" required>
                </div>
                <div class="form-group full-width">
                    <label for="hall_id">Assegna a una Sala</label>
                    <select id="hall_id" name="hall_id" required>
                        <option value="">Seleziona una sala...</option>
                        <?php foreach($halls as $hall): ?>
                            <option value="<?php echo $hall->getIdHall(); ?>"><?php echo htmlspecialchars($hall->getName()); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group full-width">
                    <button type="submit">Registra Cameriere</button>
                </div>
            </form>
        </div>

        <div class="list-section">
            <h2>Camerieri Registrati</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome Completo</th>
                        <th>Matricola</th>
                        <th>Sala Assegnata</th>
                        <th>Azione</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($waiters)): ?>
                        <tr><td colspan="5" style="text-align:center;">Non ci sono camerieri registrati.</td></tr>
                    <?php else: ?>
                        <?php foreach($waiters as $waiter): ?>
                        <tr>
                            <td><?php echo $waiter->getId(); ?></td>
                            <td><?php echo htmlspecialchars($waiter->getName() . ' ' . $waiter->getSurname()); ?></td>
                            <td><?php echo htmlspecialchars($waiter->getSerialNumber()); ?></td>
                            <td>
                                <?php if ($waiter->getRestaurantHall()): ?>
                                    <form class="hall-update-form" action="/Pancia_mia_fatti_capanna/waiter/updateHall" method="POST">
                                        <input type="hidden" name="waiter_id" value="<?php echo $waiter->getId(); ?>">
                                        <select name="hall_id">
                                            <?php foreach($halls as $hall): ?>
                                                <option value="<?php echo $hall->getIdHall(); ?>" <?php if ($waiter->getRestaurantHall()->getIdHall() == $hall->getIdHall()) echo 'selected'; ?>>
                                                    <?php echo htmlspecialchars($hall->getName()); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit">Salva</button>
                                    </form>
                                <?php else: ?>
                                    <span>N/A</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/Pancia_mia_fatti_capanna/waiter/delete/<?php echo $waiter->getId(); ?>" class="delete-btn" onclick="return confirm('Sei sicuro di voler eliminare questo cameriere?');">Elimina</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="nav-links">
            <a href="/Pancia_mia_fatti_capanna/admin/profile">Torna al Pannello di Controllo</a>
        </div>
    </div>
</body>
</html>