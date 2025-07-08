{* File: templates/home.tpl (SINTASSI SMARTY CORRETTA, STYLES.CSS APPLICATO) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>{$titolo|default:'Pancia mia fatti capanna'|escape}</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="display-4 text-center mb-4">{$titolo|escape}</h1>
        <p class="lead text-center">{$messaggio|escape}</p>

        <nav class="nav justify-content-center mt-4">
            <a class="nav-link" href="/Pancia_mia_fatti_capanna/Home/home">Home</a>
            <a class="nav-link" href="/Pancia_mia_fatti_capanna/Home/menu">Visualizza Menù</a>
            <a class="nav-link" href="/Pancia_mia_fatti_capanna/Review/showAll">Vedi le Recensioni</a>

            {if $user_role == 'admin'}
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Admin/profile">Pannello di Controllo</a>
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a>
            {elseif $user_role == 'client'}
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Client/profile">Mio Profilo</a>
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a>
            {elseif $user_role == 'waiter'}
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Waiter/profile">Dashboard Cameriere</a>
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a>
            {else}
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Client/login">Login</a>
                <a class="nav-link" href="/Pancia_mia_fatti_capanna/Client/registration">Registrati</a>
            {/if}
        </nav>
    </div>
</body>
</html>
