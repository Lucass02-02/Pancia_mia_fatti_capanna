{* File: templates/home.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>{$titolo|default:'Pancia mia fatti capanna'|escape}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/index">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header><!-- End Header -->


    <!-- ======= Hero Section ======= -->
    <section class="hero d-flex align-items-center">
        <div class="container text-center">
            <h1>{$titolo|escape}</h1>
            <p>{$messaggio|escape}</p>

            <div class="mt-4 d-flex justify-content-center flex-wrap">
                <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-get-started mx-2 my-2">Visualizza Menù</a>
                <a href="/Pancia_mia_fatti_capanna/Review/showAll" class="btn btn-get-started mx-2 my-2">Vedi le Recensioni</a>
                <a href="/Pancia_mia_fatti_capanna/Client/login" class="btn btn-get-started mx-2 my-2">Login</a>
                
                

                {if $user_role == null}
                    <a href="/Pancia_mia_fatti_capanna/Client/reserve" class="btn btn-get-started mx-2 my-2">Prenota</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/registration" class="btn btn-get-started mx-2 my-2">Registrati</a>
                {elseif $user_role == 'admin'}
                    <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-get-started mx-2 my-2">Pannello di Controllo</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-get-started mx-2 my-2">Logout</a>
                {elseif $user_role == 'client'}
                    <a href="/Pancia_mia_fatti_capanna/Client/profile" class="btn btn-get-started mx-2 my-2">Mio Profilo</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-get-started mx-2 my-2">Logout</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/order" class="btn btn-get-started mx-2 my-2">Ordina</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/reserve" class="btn btn-get-started mx-2 my-2">Prenota</a>
                {elseif $user_role == 'waiter'}
                    <a href="/Pancia_mia_fatti_capanna/Waiter/profile" class="btn btn-get-started mx-2 my-2">Dashboard Cameriere</a>
                    <a href="/Pancia_mia_fatti_capanna/Client/logout" class="btn btn-get-started mx-2 my-2">Logout</a>
                {/if}
            </div>
        </div>
    </section><!-- End Hero Section -->
<section class="my-5" style="background: url('/Pancia_mia_fatti_capanna/images/ristorantino.jpg') center center / cover no-repeat; height: 400px;">
  <div class="text-center text-white d-flex flex-column justify-content-center align-items-center h-100" style="background-color: rgba(0,0,0,0.4);">
    <h1 style="color:bisque">Benvenuto al Ristorante</h1>
    <p>Tradizione e gusto dal 1980</p>
  </div>
</section>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer><!-- End Footer -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
