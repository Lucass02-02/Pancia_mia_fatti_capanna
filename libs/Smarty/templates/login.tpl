{* File: templates/home.tpl (SINTASSI SMARTY CORRETTA E URL AGGIUSTATI) *}
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
        {* AGGIUSTATO: da {url path=''} a {url controller='home' action='home'} *}
        <a href="{url controller='home' action='home'}">Home</a> |
        {* AGGIUSTATO: da {url path='home/menu'} a {url controller='home' action='menu'} *}
        <a href="{url controller='home' action='menu'}">Visualizza Menù</a> |
        {* AGGIUSTATO: da {url path='review/showAll'} a {url controller='review' action='showAll'} *}
        <a href="{url controller='review' action='showAll'}">Vedi le Recensioni</a> |

        {* Ora usiamo la variabile passata dal controller, non più una chiamata PHP *}
        {if $user_role == 'admin'}
            {* AGGIUSTATO: da {url path='admin/profile'} a {url controller='admin' action='profile'} *}
            <a href="{url controller='admin' action='profile'}">Pannello di Controllo</a> |
            {* AGGIUSTATO: da {url path='client/logout'} a {url controller='client' action='logout'} *}
            <a href="{url controller='client' action='logout'}">Logout</a>
        {elseif $user_role == 'client'}
            {* AGGIUSTATO: da {url path='client/profile'} a {url controller='client' action='profile'} *}
            <a href="{url controller='client' action='profile'}">Mio Profilo</a> |
            {* AGGIUSTATO: da {url path='client/logout'} a {url controller='client' action='logout'} *}
            <a href="{url controller='client' action='logout'}">Logout</a>
        {elseif $user_role == 'waiter'}
            {* AGGIUSTATO: da {url path='waiter/profile'} a {url controller='waiter' action='profile'} *}
            <a href="{url controller='waiter' action='profile'}">Dashboard Cameriere</a> |
            {* AGGIUSTATO: da {url path='client/logout'} a {url controller='client' action='logout'} *}
            <a href="{url controller='client' action='logout'}">Logout</a>
        {else}
            {* AGGIUSTATO: da {url path='client/login'} a {url controller='client' action='login'} *}
            <a href="{url controller='client' action='login'}">Login</a> |
            {* AGGIUSTATO: da {url path='client/registration'} a {url controller='client' action='registration'} *}
            <a href="{url controller='client' action='registration'}">Registrati</a>
        {/if}
    </nav>
</body>
</html>