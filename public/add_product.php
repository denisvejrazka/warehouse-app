<?php
session_start();
include_once __DIR__ . '/../public/db.php';

// Kontrola přihlášení
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Povolit přístup jen admin a worker/skladník (přizpůsob si role)
if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'worker') {
    die("Přístup zamítnut.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $stock_quantity = intval($_POST['stock_quantity']);

    if ($name === '' || $price < 0 || $stock_quantity < 0) {
        die("Neplatné údaje.");
    }

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, stock) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $stock_quantity]);

    // Přesměrování zpět na seznam produktů
    header('Location: products.php');
    exit;
} else {
    // Pokud někdo přímo přistoupí bez POST, přesměruj ho
    header('Location: products.php');
    exit;
}
