<?php
session_start();
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, role, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Přihlášení OK, uložíme info do session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        // Přesměrování na hlavní stránku
        header('Location: index.php');
        exit;
    } else {
        echo "<p style='color:red;'>Neplatné přihlašovací údaje.</p>";
    }
}
?>

<h2>Přihlášení</h2>

<form method="POST">
    Uživatelské jméno: <input type="text" name="username" required><br>
    Heslo: <input type="password" name="password" required><br>
    <input type="submit" value="Přihlásit se">
</form>

<p>Nemáte účet? <a href="register.php">Zaregistrujte se zde</a></p>
