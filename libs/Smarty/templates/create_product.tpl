{* File: templates/create_product.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Crea Nuovo Prodotto</title>

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
            <h1>Crea Nuovo Prodotto</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Create Product Section ======= -->
    <section class="contact">
        <div class="container">

            <div class="php-email-form bg-white p-4 shadow-sm mx-auto" style="max-width: 600px;">
                <form action="/Pancia_mia_fatti_capanna/Product/create" method="POST">
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nome Prodotto</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="price" class="form-label">Prezzo (€)</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="category_id" class="form-label">Categoria</label>
                        <select id="category_id" name="category_id" class="form-select" required>
                            <option value="">Seleziona una categoria</option>
                            {foreach $categories as $category}
                                <option value="{$category->getId()}">{$category->getName()|escape}</option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Allergeni Presenti nel Piatto</label>
                        <div class="border rounded p-3">
                            <div class="row">
                                {foreach $allAllergens as $allergen}
                                    <div class="col-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="allergens[]" value="{$allergen->getId()}" id="allergen{$allergen->getId()}">
                                            <label class="form-check-label" for="allergen{$allergen->getId()}">
                                                {$allergen->getAllergenType()|escape}
                                            </label>
                                        </div>
                                    </div>
                                {/foreach}
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-get-started w-100">Crea Prodotto</button>
                </form>

                <div class="text-center mt-3">
                    <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary">Annulla</a>
                </div>
            </div>

        </div>
    </section><!-- End Create Product Section -->

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
