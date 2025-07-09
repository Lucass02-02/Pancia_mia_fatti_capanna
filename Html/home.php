<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titolo) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($titolo) ?></h1>
    <p><?= htmlspecialchars($messaggio) ?></p>
    <nav>
        <a href="/Pancia_mia_fatti_capanna/">Home</a> |
        <a href="/Pancia_mia_fatti_capanna/Home/menu">Menu</a> |
        <a href="/Pancia_mia_fatti_capanna/Client/login">Login</a> |
        <a href="/Pancia_mia_fatti_capanna/Client/registration">Register</a> |
        <a href="/Pancia_mia_fatti_capanna/Client/reserve">Reserve</a>
        <!-- Altri link -->
    </nav>
</body>
</html>
