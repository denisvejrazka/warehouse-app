<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../public/db.php';

try {
    $stmt = $pdo->query("SELECT * FROM orders");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($orders);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
