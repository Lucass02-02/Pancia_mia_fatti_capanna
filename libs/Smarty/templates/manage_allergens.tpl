{* File: templates/manage_allergens.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Allergeni</title>

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
            <h1>Gestione Allergeni</h1>
        </div>
    </section><!-- End Page Title Section -->
    <section class="container" style="background: url('/Pancia_mia_fatti_capanna/images/allergeni.jpg') center center / cover no-repeat; height: 400px; width: 800px"></section>
    <!-- ======= Manage Allergens Section ======= -->
    <section class="contact">
        <div class="container" style="max-width: 800px;">

            <!-- Form Aggiungi Allergene -->
            <div class="php-email-form bg-white p-4 shadow-sm mb-4">
                <h2 class="h4 text-secondary mb-3">Aggiungi Nuovo Allergene</h2>
                <form action="/Pancia_mia_fatti_capanna/Allergen/create" method="POST" class="d-flex gap-2 flex-wrap">
                    <input type="text" name="name" class="form-control" placeholder="Nome Allergene (es. Glutine)" required>
                    <button type="submit" class="btn btn-get-started">Aggiungi</button>
                </form>
            </div>

            <!-- Elenco Allergeni -->
            <div class="php-email-form bg-white p-4 shadow-sm">
                <h2 class="h4 text-secondary mb-3">Elenco Allergeni Esistenti</h2>
                {if count($allergens) > 0}
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome Allergene</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$allergens item=allergen}
                                    <tr>
                                        <td>{$allergen->getId()|escape}</td>
                                        <td>{$allergen->getAllergenType()|escape}</td>
                                        <td>
                                            <div class="btn-group">
                                                {* Se avrai una pagina di modifica per allergeni, aggiungi qui il link *}
                                                {* <a href="/Pancia_mia_fatti_capanna/Allergen/edit/{$allergen->getId()}" class="btn btn-warning btn-sm">Modifica</a> *}
                                                <form action="/Pancia_mia_fatti_capanna/Allergen/delete/{$allergen->getId()}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare l\'allergene {$allergen->getAllergenType()|escape}?');">
                                                    <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                {else}
                    <p>Nessun allergene trovato. Aggiungine uno nuovo!</p>
                {/if}
            </div>

            <div class="text-center mt-4">
                <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary">Torna al Menu</a>
            </div>

        </div>
    </section><!-- End Manage Allergens Section -->

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
