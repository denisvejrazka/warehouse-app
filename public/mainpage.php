<?php
session_start();

// kontrola, jestli je uživatel přihlášený
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

echo "<h1>Vítejte, " . htmlspecialchars($_SESSION['username']) . "!</h1>";
echo "<p>Vaše role: " . htmlspecialchars($_SESSION['role']) . "</p>";

if ($_SESSION['role'] === 'admin') {
    echo '<p><a href="orders.php">Správa objednávek (včetně mazání)</a></p>';
    echo '<p><a href="add_product.php">Přidat produkt</a></p>';
} elseif ($_SESSION['role'] === 'worker') {
    echo '<p><a href="orders.php">Vytvořit objednávku</a></p>';
    echo '<p><a href="add_product.php">Přidat/odebrat produkt</a></p>';
}

echo '<p><a href="logout.php">Odhlásit se</a></p>';
