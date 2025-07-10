{* File: templates/edit_product.tpl (RIADATTATO CON NUOVO style.css Yummy) *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Prodotto - {$product->getName()|escape}</title>

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
            <h1>Modifica Prodotto</h1>
        </div>
    </section><!-- End Page Title Section -->

    <!-- ======= Edit Product Section ======= -->
    <section class="contact">
        <div class="container">

            <div class="php-email-form bg-white p-4 shadow-sm mx-auto" style="max-width: 600px;">
                <form action="/Pancia_mia_fatti_capanna/Product/update" method="POST">
                    <input type="hidden" name="product_id" value="{$product->getId()}">

                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nome Prodotto</label>
                        <input type="text" id="name" name="name" value="{$product->getName()|escape}" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required>{$product->getDescription()|escape}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="price" class="form-label">Prezzo (€)</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" value="{$product->getPrice()|escape}" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-get-started w-100">Salva Modifiche</button>
                </form>

                <div class="text-center mt-3">
                    <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary">Annulla e torna al Menù</a>
                </div>
            </div>

        </div>
    </section><!-- End Edit Product Section -->

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
