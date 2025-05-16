<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../public/db.php'; ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<h2>Seznam produktů</h2>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Název</th>
      <th>Popis</th>
      <th>Cena</th>
      <th>Sklad</th>
      <th>Akce</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $stmt = $pdo->query("SELECT * FROM products");
    while ($row = $stmt->fetch()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['description']}</td>
                <td>{$row['price']} Kč</td>
                <td>" . $row["stock"] . "</td>
                <td>
                  <a href='edit_product.php?id={$row['id']}' class='btn btn-sm btn-warning'>Upravit</a>
                  <a href='delete_product.php?id={$row['id']}' class='btn btn-sm btn-danger'>Smazat</a>
                </td>
              </tr>";
    }
    ?>
  </tbody>
</table>

<h3>Přidat nový produkt</h3>
<form method="POST" action="add_product.php">
  <div class="mb-3">
    <label for="name" class="form-label">Název</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Popis</label>
    <textarea class="form-control" id="description" name="description"></textarea>
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Cena</label>
    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
  </div>
  <div class="mb-3">
    <label for="stock_quantity" class="form-label">Sklad (kusy)</label>
    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
  </div>
  <button type="submit" class="btn btn-primary">Přidat produkt</button>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
