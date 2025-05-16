<?php
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../public/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

?>

<div class="container mt-4">
    <h2>Objednávky</h2>
    <a href="add_order.php" class="btn btn-success mb-3">Přidat objednávku</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Zákazník</th>
                <th>Datum objednávky</th>
                <th>Stav</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM orders ORDER BY order_date DESC");
            while ($order = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>{$order['id']}</td>";
                echo "<td>{$order['customer_name']}</td>";
                echo "<td>{$order['order_date']}</td>";
                echo "<td>{$order['status']}</td>";
                echo "<td>
                        <a href='edit_order.php?id={$order['id']}' class='btn btn-sm btn-primary'>Upravit</a>
                        <a href='delete_order.php?id=" . $order['id'] . "' onclick=\"return confirm('Opravdu smazat objednávku?');\">Smazat</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
