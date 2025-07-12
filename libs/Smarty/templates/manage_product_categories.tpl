{* File: templates/manage_categories.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Categorie Prodotti - Pancia mia fatti capanna</title>

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
            <h1>Gestione Categorie Prodotti</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Manage Categories Section ======= -->
    <section class="contact">
        <div class="container" style="max-width: 800px;">

            <!-- Aggiungi nuova categoria -->
            <div class="php-email-form bg-white p-4 shadow-sm mb-5">
                <h3 class="text-secondary mb-3">Aggiungi Nuova Categoria</h3>
                <form action="/Pancia_mia_fatti_capanna/Product/createCategory" method="POST" class="d-flex gap-2 flex-wrap">
                    <input type="text" class="form-control" name="name" placeholder="Nome nuova categoria" required>
                    <button class="btn btn-get-started" type="submit">Aggiungi Categoria</button>
                </form>
            </div>

            <!-- Elenco categorie esistenti -->
            <div class="php-email-form bg-white p-4 shadow-sm">
                <h3 class="text-secondary mb-3">Categorie Esistenti</h3>
                {if empty($categories)}
                    <p class="text-center text-muted">Nessuna categoria trovata.</p>
                {else}
                    <ul class="list-group">
                        {foreach from=$categories item=category}
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <!-- Form modifica categoria -->
                                <form action="/Pancia_mia_fatti_capanna/Product/updateCategory" method="POST" class="d-flex flex-grow-1 gap-2 align-items-center">
                                    <input type="hidden" name="category_id" value="{$category->getId()}">
                                    <input type="text" class="form-control" name="name" value="{$category->getName()|escape}" required>
                                    <button class="btn btn-warning btn-sm" type="submit">Modifica</button>
                                </form>

                                <!-- Form elimina categoria -->
                                <form action="/Pancia_mia_fatti_capanna/Product/deleteCategory/{$category->getId()}" method="POST" class="ms-2">
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Sei sicuro di voler eliminare questa categoria? Tutti i prodotti associati a questa categoria potrebbero perdere il loro riferimento alla categoria.');">Elimina</button>
                                </form>
                            </li>
                        {/foreach}
                    </ul>
                {/if}
            </div>

            <!-- Pulsante torna al menu -->
            <div class="text-center mt-4">
                <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary">Torna al Menu</a>
            </div>

        </div>
    </section><!-- End Manage Categories Section -->

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
