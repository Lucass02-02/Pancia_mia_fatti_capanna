{* File: templates/manage_clients.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Clienti</title>

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
<section class="my-5 text-center">
  <img src="/Pancia_mia_fatti_capanna/images/clienti.webp" alt="Recensioni" class="img-fluid" style="max-width: 400px; height: auto; margin-top: 20px;">
</section>

    <!-- ======= Page Title Section ======= -->
    <section class="page-title">
        <div class="container">
            <h1>Gestione Clienti</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Manage Clients Section ======= -->
    <section class="contact">
        <div class="container" style="max-width: 1200px;">

            <div class="php-email-form bg-white p-4 shadow-sm">
                {if empty($clients)}
                    <p class="text-center text-muted">Non ci sono clienti registrati al momento.</p>
                {else}
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome Completo</th>
                                    <th>Email</th>
                                    <th>Nickname</th>
                                    <th>Telefono</th>
                                    <th>Data di Nascita</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $clients as $client}
                                    <tr>
                                        <td>{$client->getId()}</td>
                                        <td>{$client->getName()|escape} {$client->getSurname()|escape}</td>
                                        <td>{$client->getEmail()|escape}</td>
                                        <td>{$client->getNickname()|default:'-'|escape}</td>
                                        <td>{$client->getPhonenumber()|default:'-'|escape}</td>
                                        <td>{$client->getBirthDate()->format('d/m/Y')}</td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                {/if}

                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary">Torna al Pannello di Controllo</a>
                </div>
            </div>

        </div>
    </section><!-- End Manage Clients Section -->

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
