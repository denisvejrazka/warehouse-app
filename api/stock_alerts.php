<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../public/db.php';

$threshold = 5; // nízký stav

try {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE stock <= ?");
    $stmt->execute([$threshold]);
    $lowStockProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($lowStockProducts);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
