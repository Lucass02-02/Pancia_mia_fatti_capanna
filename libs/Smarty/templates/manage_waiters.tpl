<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Camerieri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
</head>
<body>

    <header id="header" class="header d-flex align-items-center">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1><a href="/Pancia_mia_fatti_capanna/Home/index">Pancia mia <span>fatti capanna</span></a></h1>
            </div>
        </div>
    </header>

    <section class="page-title">
        <div class="container">
            <h1>Gestione Camerieri</h1>
        </div>
    </section>

    <section class="contact">
        <div class="container" style="max-width: 1400px;">

            {if isset($error) && $error}
                <div class="alert alert-danger text-center" role="alert">
                    {$error|escape}
                </div>
            {/if}
            {if isset($success) && $success}
                <div class="alert alert-success text-center" role="alert">
                    {$success|escape}
                </div>
            {/if}

            <div class="php-email-form bg-white p-4 shadow-sm mb-5">
                <h4 class="mb-4 text-center">Registra Nuovo Cameriere</h4>
                
                <form action="/Pancia_mia_fatti_capanna/waiter/register" method="post" role="form">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" placeholder="Nome" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="text" name="surname" class="form-control" placeholder="Cognome" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>

                     <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <input type="text" name="serialNumber" class="form-control" placeholder="Matricola" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                             <input type="tel" name="phoneNumber" class="form-control" placeholder="Telefono" pattern="[0-9]+" title="Il numero può contenere solo cifre." inputmode="numeric">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label for="birthDate" class="form-label">Data di Nascita</label>
                            <input type="date" id="birthDate" class="form-control" name="birthDate" required>
                        </div>
                         <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label for="hall_id" class="form-label">Sala Assegnata</label>
                            <select name="hall_id" id="hall_id" class="form-control" required>
                                <option value="">-- Seleziona Sala --</option>
                                {foreach $halls as $hall}
                                    <option value="{$hall->getIdHall()}">{$hall->getName()|escape}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Registra Cameriere</button>
                    </div>
                </form>
            </div>

            <div class="php-email-form bg-white p-4 shadow-sm">
                 <h4 class="mb-4 text-center">Elenco Camerieri</h4>
                {if empty($waiters)}
                    <p class="text-center text-muted">Non ci sono camerieri registrati al momento.</p>
                {else}
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Matricola</th>
                                    <th>Nome Completo</th>
                                    <th>Email</th>
                                    <th>Sala Assegnata</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $waiters as $waiter}
                                    <tr>
                                        <td>{$waiter->getSerialNumber()|escape}</td>
                                        <td>{$waiter->getName()|escape} {$waiter->getSurname()|escape}</td>
                                        <td>{$waiter->getEmail()|escape}</td>
                                        <td>{$waiter->getRestaurantHall()->getName()|escape}</td>
                                        <td>
                                            <a href="/Pancia_mia_fatti_capanna/waiter/edit/{$waiter->getId()}" class="btn btn-sm btn-warning">Modifica</a>
                                            <a href="/Pancia_mia_fatti_capanna/waiter/delete/{$waiter->getId()}" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo cameriere?');">Elimina</a>
                                        </td>
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
    </section>
    
    <footer id="footer" class="footer">
        <div class="container text-center">
            <p>&copy; Copyright <strong>Pancia mia fatti capanna</strong>. All Rights Reserved</p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>