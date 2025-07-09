<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>{$titolo|default:'Pancia Mia Fatti Capanna'|escape}</title>

  <!-- Favicons -->
  <link href="/Pancia_mia_fatti_capanna/assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Inter&family=Roboto&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/Pancia_mia_fatti_capanna/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/Pancia_mia_fatti_capanna/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/Pancia_mia_fatti_capanna/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/Pancia_mia_fatti_capanna/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/Pancia_mia_fatti_capanna/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/Pancia_mia_fatti_capanna/assets/css/style.css" rel="stylesheet">
</head>
<body>

  <!-- ======= Header ======= -->
  {include file="header.tpl"}

  <!-- ======= Hero Section ======= -->
  {block name="hero"}{/block}

  <!-- ======= Main Content ======= -->
  <main id="main">
    {block name="content"}{/block}
  </main>

  <!-- ======= Footer ======= -->
  {include file="footer.tpl"}

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS Files -->
  <script src="/Pancia_mia_fatti_capanna/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/Pancia_mia_fatti_capanna/assets/vendor/aos/aos.js"></script>
  <script src="/Pancia_mia_fatti_capanna/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/Pancia_mia_fatti_capanna/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="/Pancia_mia_fatti_capanna/assets/js/main.js"></script>

</body>
</html>
