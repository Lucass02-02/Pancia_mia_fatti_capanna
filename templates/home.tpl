{* File: templates/home.tpl (SINTASSI SMARTY CORRETTA) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>{$titolo|default:'Pancia mia fatti capanna'|escape}</title>
    {* Puoi includere i tuoi file CSS esterni qui, se ne hai *}
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
        <a href="{url controller='home' action='home'}">Home</a> |
        <a href="{url controller='home' action='menu'}">Visualizza Menù</a> |
        <a href="{url controller='review' action='showAll'}">Vedi le Recensioni</a> |

        {if $user_role == 'admin'}
            <a href="{url controller='admin' action='profile'}">Pannello di Controllo</a> |
            <a href="{url controller='client' action='logout'}">Logout</a>
        {elseif $user_role == 'client'}
            <a href="{url controller='client' action='profile'}">Mio Profilo</a> |
            <a href="{url controller='client' action='logout'}">Logout</a>
        {elseif $user_role == 'waiter'}
            <a href="{url controller='waiter' action='profile'}">Dashboard Cameriere</a> |
            <a href="{url controller='client' action='logout'}">Logout</a>
        {else}
            <a href="{url controller='client' action='login'}">Login</a> |
            <a href="{url controller='client' action='registration'}">Registrati</a>
        {/if}
    </nav>
</body>
</html>