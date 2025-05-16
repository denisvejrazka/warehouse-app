<?php
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../public/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['customer_name'];
    $date = $_POST['order_date'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("INSERT INTO orders (customer_name, order_date, status) VALUES (?, ?, ?)");
    $stmt->execute([$name, $date, $status]);
    header("Location: orders.php");
    exit();
}
?>

<div class="container mt-4">
    <h2>Přidat objednávku</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="customer_name" class="form-label">Zákazník</label>
            <input type="text" class="form-control" name="customer_name" required>
        </div>
        <div class="mb-3">
            <label for="order_date" class="form-label">Datum</label>
            <input type="date" class="form-control" name="order_date" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Stav</label>
            <select name="status" class="form-select">
                <option value="nová">Nová</option>
                <option value="zpracovává se">Zpracovává se</option>
                <option value="vyřízená">Vyřízená</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Uložit</button>
    </form>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
