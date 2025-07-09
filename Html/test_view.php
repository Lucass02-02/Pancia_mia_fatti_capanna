<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titoloPagina; ?></title>
</head>
<body>
    <h2>Benvenuto, <?php echo htmlspecialchars($utente['nome']) . ' ' . htmlspecialchars($utente['cognome']); ?>!</h2>
    <p>Questa è una vista renderizzata dalla classe UView.</p>
</body>
</html>
