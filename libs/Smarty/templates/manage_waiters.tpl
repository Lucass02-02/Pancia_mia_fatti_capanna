{* File: templates/manage_waiters.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Camerieri</title>

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

    <!-- ======= Page Title Section ======= -->
    <section class="page-title">
        <div class="container">
            <h1>Gestione Camerieri</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Manage Waiters Section ======= -->
    <section class="contact">
        <div class="container" style="max-width: 1200px;">

            

            <!-- Registra nuovo cameriere -->
            <div class="php-email-form bg-white p-4 shadow-sm mb-5">
                <h2 class="h4 text-secondary mb-3">Registra Nuovo Cameriere</h2>
                <form action="/Pancia_mia_fatti_capanna/Waiter/register" method="POST" class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" id="name" name="name" placeholder="Mario" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" id="surname" name="surname" placeholder="Rossi" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="m.rossi@ristorante.it" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="birthDate" class="form-label">Data di Nascita</label>
                        <input type="date" id="birthDate" name="birthDate" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="serialNumber" class="form-label">Matricola</label>
                        <input type="text" id="serialNumber" name="serialNumber" placeholder="ID Univoco" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label for="hall_id" class="form-label">Assegna a un banchetto</label>
                        <select id="hall_id" name="hall_id" class="form-select" required>
                            <option value="">Seleziona un banchetto...</option>
                            {foreach $halls as $hall}
                                <option value="{$hall->getIdHall()}">{$hall->getName()|escape}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-get-started w-100">Registra Cameriere</button>
                    </div>
                </form>
            </div>

            <!-- Camerieri registrati -->
            <div class="php-email-form bg-white p-4 shadow-sm mb-5">
                <h2 class="h4 text-secondary mb-3">Camerieri Registrati</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nome Completo</th>
                                <th>Matricola</th>
                                <th>Banchetto Assegnato</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {if empty($waiters)}
                                <tr><td colspan="4" class="text-center">Non ci sono camerieri registrati.</td></tr>
                            {else}
                                {foreach $waiters as $waiter}
                                <tr>
                                    <td>{$waiter->getName()|escape} {$waiter->getSurname()|escape}</td>
                                    <td>{$waiter->getSerialNumber()|escape}</td>
                                    <td>
                                        <form action="/Pancia_mia_fatti_capanna/Waiter/updateHall" method="POST" class="d-flex align-items-center gap-2">
                                            <input type="hidden" name="waiter_id" value="{$waiter->getId()}">
                                            <select name="hall_id" class="form-select">
                                                {foreach $halls as $hall}
                                                    <option value="{$hall->getIdHall()}" {if $waiter->getRestaurantHall() && $waiter->getRestaurantHall()->getIdHall() == $hall->getIdHall()}selected{/if}>
                                                        {$hall->getName()|escape}
                                                    </option>
                                                {/foreach}
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="/Pancia_mia_fatti_capanna/Waiter/edit/{$waiter->getId()}" class="btn btn-warning btn-sm">Modifica</a>
                                            <a href="/Pancia_mia_fatti_capanna/Waiter/delete/{$waiter->getId()}" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo cameriere?');">Elimina</a>
                                        </div>
                                    </td>
                                </tr>
                                {/foreach}
                            {/if}
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pulsante torna al pannello di controllo -->
            <div class="text-center mt-4">
                <a href="/Pancia_mia_fatti_capanna/Admin/profile" class="btn btn-secondary">Torna al Pannello di Controllo</a>
            </div>

        </div>
    </section><!-- End Manage Waiters Section -->

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
