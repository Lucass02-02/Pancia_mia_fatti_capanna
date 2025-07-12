{* File: templates/view_reservations.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Le Tue Prenotazioni</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Yummy style -->
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>

<body class="bg-light">

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/home">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header>

    <!-- ======= Page Title ======= -->
    <section class="page-title text-center mb-4">
        <div class="container">
            <h1>Le Tue Prenotazioni</h1>
        </div>
    </section>

    <!-- ======= Reservations List ======= -->
    <main>
        <div class="container" style="max-width: 1000px;">
            <div class="bg-white p-4 rounded shadow-sm">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Data</th>
                                <th>Orario</th>
                                <th>Durata</th>
                                <th>Persone</th>
                                <th>Note</th>
                                <th>Nome</th>
                                <th>Stato</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$reservations item=reservation}
                                <tr>
                                    <td>{$reservation->getDate()->format('d/m/Y')}</td>
                                    <td>{$reservation->getHours()->format('H:i')}</td>
                                    <td>{$reservation->getDuration()} min</td>
                                    <td>{$reservation->getPeopleNum()}</td>
                                    <td>{$reservation->getNote()|default:'-'|escape}</td>
                                    <td>{$reservation->getNameReservation()|escape}</td>
                                    <td>
                                        <span class="fw-bold" style="color:
                                                    {if $reservation->getStatus()->value == 'created'}var(--accent-color)
                                                    {elseif $reservation->getStatus()->value == 'approved'}var(--accent-color)
                                                    {elseif $reservation->getStatus()->value == 'order_in_progress'}#FFA500
                                                    {elseif $reservation->getStatus()->value == 'ended'}var(--nav-hover-color)
                                                    {elseif $reservation->getStatus()->value == 'canceled'}#D9534F
                                                    {/if};
                                                ">
                                                    {$reservation->getStatus()->value|upper}
                                                </span>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
                </div>
            </div>
        </div>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer mt-5">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>