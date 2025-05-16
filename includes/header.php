<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Skladový systém</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <script src="js/script.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Sklad</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="products.php">Produkty</a></li>
        <li class="nav-item"><a class="nav-link" href="orders.php">Objednávky</a></li>
        <li class="nav-item"><a class="nav-link" href="stock.php">Zásoby</a></li>
        <li class="nav-item"><a href="logout.php">Domů</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                | <a href="logout.php">Odhlásit se</a>
            <?php endif; ?></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
