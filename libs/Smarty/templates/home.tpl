{* File: templates/home.tpl (SINTASSI SMARTY CORRETTA) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>{$titolo|default:'Pancia mia fatti capanna'|escape}</title>
    <style>
        body { font-family: sans-serif; text-align: center; margin-top: 50px; }
        h1 { color: #333; }
        p { color: #666; }
        nav { margin-top: 20px; font-size: 1.2em; }
        nav a { margin: 0 15px; text-decoration: none; color: #e8491d; }
    </style>
</head>
<body>
    <h1>{$titolo|escape}</h1>
    <p>{$messaggio|escape}</p>
    <nav>
        <a href="/Pancia_mia_fatti_capanna/Home/home">Home</a> |
        <a href="/Pancia_mia_fatti_capanna/Home/menu">Visualizza Menù</a> |
        <a href="/Pancia_mia_fatti_capanna/Review/showAll">Vedi le Recensioni</a> |

        {if $user_role == 'admin'}
            <a href="/Pancia_mia_fatti_capanna/Admin/profile">Pannello di Controllo</a> |
            <a href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a>
        {elseif $user_role == 'client'}
            <a href="/Pancia_mia_fatti_capanna/Client/profile">Mio Profilo</a> |
            <a href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a>
        {elseif $user_role == 'waiter'}
            <a href="/Pancia_mia_fatti_capanna/Waiter/profile">Dashboard Cameriere</a> |
            <a href="/Pancia_mia_fatti_capanna/Client/logout">Logout</a>
        {else}
            <a href="/Pancia_mia_fatti_capanna/Client/login">Login</a> |
            <a href="/Pancia_mia_fatti_capanna/Client/registration">Registrati</a>
        {/if}
    </nav>
</body>
</html>
