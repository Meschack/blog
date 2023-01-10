<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/styles/style.css">
  <title><?= $title ?? "Mon site" ?></title>
</head>

<body class="d-flex flex-column h-100">

  <nav class="navbar navbar-expend-lg navbar-dark bg-primary px-5">
    <a href="#" class="navbar-brand">Mon site</a>
  </nav>

  <div class="container mt-4">

    <?= $content ?>

  </div>

  <footer class="bg-light py-4 footer mt-auto">
    <div class="container">
      <?php if (defined('DEBUG_TIME')) : ?>
        Page générée en <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?> ms
      <?php endif ?>
    </div>
  </footer>
  <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>