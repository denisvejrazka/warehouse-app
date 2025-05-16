<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../public/db.php';

// Načteme produkty a zjistíme, jestli máme nízké zásoby
try {
    $stmt = $pdo->query("SELECT id, name, description, price, stock, stock_threshold FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Chyba při načítání dat: " . $e->getMessage();
    exit;
}

// Zkontrolujeme, jestli je nějaký produkt pod limitem
$low_stock_products = array_filter($products, function($p) {
    return $p['stock'] <= $p['stock_threshold'];
});
?>

<h1>Stav zásob</h1>

<?php if (count($low_stock_products) > 0): ?>
    <div style="padding:10px; background-color: #f8d7da; color:#842029; margin-bottom:20px; border-radius:5px;">
        <strong>Upozornění:</strong> Některé produkty mají nízký stav zásob!
    </div>
<?php endif; ?>

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color:#eee;">
            <th>Název</th>
            <th>Popis</th>
            <th>Cena</th>
            <th>Skladová zásoba</th>
            <th>Minimální limit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): 
            $is_low = $product['stock'] <= $product['stock_threshold'];
        ?>
        <tr <?php if ($is_low) echo "style='background-color:#f8d7da;'"; ?>>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['description']) ?></td>
            <td><?= number_format($product['price'], 2, ',', ' ') ?> Kč</td>
            <td><?= (int)$product['stock'] ?></td>
            <td><?= (int)$product['stock_threshold'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
