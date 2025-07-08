<?php
// File: View/manage_tables.php (CON CSS COMPLETO E URL AGGIUSTATI)
/** @var \AppORM\Entity\ETable[] $tables */
/** @var \AppORM\Entity\ERestaurantHall[] $halls */
use AppORM\Entity\TableState;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Tavoli</title>
    <style>
        /* Stili Generali */
        body {
            font-family: sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            max-width: 1100px;
            margin: 2em auto;
            padding: 2em;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #e8491d;
            text-align: center;
        }

        /* Sezioni */
        .form-section, .list-section {
            margin-bottom: 2.5em;
            padding: 1.5em;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        /* Form e Input */
        .form-inline {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
            justify-content: center;
        }
        .form-inline label {
            font-weight: bold;
        }
        .form-inline select, .form-inline input[type="number"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }
        .form-inline button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: white;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.2s;
        }
        .form-inline button:hover {
            background-color: #218838;
        }

        /* Tabella */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5em;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Stati dei Tavoli */
        .state-available { color: #28a745; font-weight: bold; }
        .state-reserved { color: #ffc107; font-weight: bold; }
        .state-occupied { color: #dc3545; font-weight: bold; }

        /* Pulsanti di Azione */
        .action-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .action-form select {
            padding: 8px;
        }
        .action-form button {
            background-color: #007bff;
            padding: 8px 12px;
        }
        .action-form button:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            display: inline-block;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        
        /* Link di Navigazione */
        .nav-links {
            margin-top: 2em;
            text-align: center;
        }
        .nav-links a, .top-link a {
            color: white;
            background-color: #17a2b8;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .top-link {
            margin-bottom: 2em;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestione Tavoli</h1>

        <div class="top-link">
            <a href="/Pancia_mia_fatti_capanna/hall/manage">Gestisci Sale</a>
        </div>

        <div class="form-section">
            <h2>Aggiungi Nuovo Tavolo</h2>
            <form action="/Pancia_mia_fatti_capanna/table/create" method="POST" class="form-inline">
                <label for="seatsNumber">Numero Posti:</label>
                <input type="number" id="seatsNumber" name="seatsNumber" min="1" required>
                
                <label for="hall_id">Sala:</label>
                <select id="hall_id" name="hall_id" required>
                    <option value="">Seleziona una sala</option>
                    <?php foreach ($halls as $hall): ?>
                        <option value="<?php echo $hall->getIdHall(); ?>"><?php echo htmlspecialchars($hall->getName()); ?></option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit">Aggiungi Tavolo</button>
            </form>
        </div>

        <div class="list-section">
            <h2>Tavoli Esistenti</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>N. Posti</th>
                        <th>Sala</th>
                        <th>Stato Attuale</th>
                        <th>Cambia Stato</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tables as $table): ?>
                        <tr>
                            <td><?php echo $table->getIdTable(); ?></td>
                            <td><?php echo $table->getSeatsNumber(); ?></td>
                            <td><?php echo htmlspecialchars($table->getRestaurantHall()->getName()); ?></td>
                            <td>
                                <span class="state-<?php echo $table->getState()->value; ?>">
                                    <?php echo strtoupper($table->getState()->value); ?>
                                </span>
                            </td>
                            <td>
                                <form action="/Pancia_mia_fatti_capanna/table/updateState" method="POST" class="action-form">
                                    <input type="hidden" name="table_id" value="<?php echo $table->getIdTable(); ?>">
                                    <select name="state">
                                        <option value="available" <?php if ($table->getState() === TableState::AVAILABLE) echo 'selected'; ?>>Disponibile</option>
                                        <option value="reserved" <?php if ($table->getState() === TableState::RESERVED) echo 'selected'; ?>>Prenotato</option>
                                        <option value="occupied" <?php if ($table->getState() === TableState::OCCUPIED) echo 'selected'; ?>>Occupato</option>
                                    </select>
                                    <button type="submit">Salva</button>
                                </form>
                            </td>
                            <td>
                                <a href="/Pancia_mia_fatti_capanna/table/delete/<?php echo $table->getIdTable(); ?>" class="delete-btn" onclick="return confirm('Sei sicuro di voler eliminare questo tavolo?');">Elimina</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="nav-links">
            <a href="/Pancia_mia_fatti_capanna/">Torna alla Home</a>
        </div>
    </div>
</body>
</html>