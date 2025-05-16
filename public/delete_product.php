<?php
session_start();
include_once 'db.php';

// Kontrola, jestli je uživatel přihlášen
if (!isset($_SESSION['user_id'])) {
    die("Přístup zamítnut. Nejprve se přihlaste.");
}

// Kontrola role - můžeš upravit podle potřeby (např. admin a skladník mají přístup)
if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'skladnik') {
    die("Nemáte oprávnění mazat produkty.");
}

if (!isset($_GET['id'])) {
    die("ID produktu není zadáno.");
}

$productId = intval($_GET['id']);

try {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
    $stmt->execute(['id' => $productId]);

    // Po úspěšném smazání přesměruj na seznam produktů
    header('Location: products.php');
    exit;
} catch (PDOException $e) {
    die("Chyba při mazání produktu: " . $e->getMessage());
}
