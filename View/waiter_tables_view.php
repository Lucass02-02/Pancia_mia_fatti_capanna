<?php
// File: View/waiter_tables_view.php (AGGIORNATO CON MODIFICA STATO)
/** @var \Doctrine\Common\Collections\Collection<\AppORM\Entity\ETable> $tables */
/** @var \AppORM\Entity\ERestaurantHall $hall */
use AppORM\Entity\TableState;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Stato Tavoli - <?php echo htmlspecialchars($hall->getName()); ?></title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; }
        .container { max-width: 900px; margin: 2em auto; padding: 2em; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #e8491d; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 1.5em; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; vertical-align: middle; }
        th { background-color: #f2f2f2; }
        .action-form { display: flex; gap: 10px; align-items: center; }
        .action-form select { padding: 8px; flex-grow: 1; border-radius: 4px; border: 1px solid #ccc; }
        .action-form button { background-color: #007bff; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; }
        .nav-links { margin-top: 2.5em; text-align: center; }
        .nav-links a { color: #007bff; font-weight: bold; text-decoration: none; }
        .state-available { color: green; font-weight: bold; }
        .state-reserved { color: orange; font-weight: bold; }
        .state-occupied { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Stato Tavoli - <?php echo htmlspecialchars($hall->getName()); ?></h1>

        <?php if ($tables->isEmpty()): ?>
            <p style="text-align:center;">Non ci sono tavoli assegnati a questa sala.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Tavolo</th>
                        <th>Posti</th>
                        <th>Stato Attuale</th>
                        <th>Cambia Stato</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tables as $table): ?>
                        <tr>
                            <td><strong>#<?php echo $table->getIdTable(); ?></strong></td>
                            <td><?php echo $table->getSeatsNumber(); ?></td>
                            <td>
                                <span class="state-<?php echo $table->getState()->value; ?>">
                                    <?php echo strtoupper($table->getState()->value); ?>
                                </span>
                            </td>
                            <td>
                                <form class="action-form" action="/Pancia_mia_fatti_capanna/waiter/updateTableState" method="POST">
                                    <input type="hidden" name="table_id" value="<?php echo $table->getIdTable(); ?>">
                                    <select name="state">
                                        <option value="available" <?php if ($table->getState() === TableState::AVAILABLE) echo 'selected'; ?>>Disponibile</option>
                                        <option value="reserved" <?php if ($table->getState() === TableState::RESERVED) echo 'selected'; ?>>Prenotato</option>
                                        <option value="occupied" <?php if ($table->getState() === TableState::OCCUPIED) echo 'selected'; ?>>Occupato</option>
                                    </select>
                                    <button type="submit">Salva</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="nav-links">
            <a href="/Pancia_mia_fatti_capanna/waiter/profile">Torna alla Dashboard</a>
        </div>
    </div>
</body>
</html>