<?php
session_start();
include_once __DIR__ . '/../includes/require_login.php'; // zkontroluje, že uživatel je přihlášen

// Jen admin smí mazat objednávky
if ($_SESSION['role'] !== 'admin') {
    die("Přístup zamítnut.");
}

// Připojení k DB
include_once __DIR__ . '/../public/db.php';

if (!isset($_GET['id'])) {
    die('ID objednávky není zadáno.');
}

$orderId = intval($_GET['id']);

try {
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = :id");
    $stmt->execute(['id' => $orderId]);

    header('Location: orders.php');
    exit;
} catch (PDOException $e) {
    die("Chyba při mazání objednávky: " . $e->getMessage());
}
