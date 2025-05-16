<?php
session_start();
include 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role']; // 'admin' nebo 'worker'

    if (!$username || !$password || !in_array($role, ['admin', 'worker'])) {
        $error = "Vyplňte všechna pole správně.";
    } else {
        // Zkontroluj, zda už uživatel existuje
        $checkStmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $checkStmt->execute([$username]);
        if ($checkStmt->fetch()) {
            $error = "Uživatel s tímto jménem již existuje.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            try {
                $stmt->execute([$username, $hashedPassword, $role]);
                $_SESSION['message'] = "Registrace proběhla úspěšně. Přihlaste se.";
                header('Location: login.php');
                exit;
            } catch (PDOException $e) {
                $error = "Chyba při registraci: " . $e->getMessage();
            }
        }
    }
}
?>

<h2>Registrace</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">
    Uživatelské jméno: <input type="text" name="username" required><br>
    Heslo: <input type="password" name="password" required><br>
    Role:
    <select name="role" required>
        <option value="worker">Skladník</option>
        <option value="admin">Admin</option>
    </select><br>
    <input type="submit" value="Registrovat">
</form>

<p><a href="login.php">Již máte účet? Přihlaste se.</a></p>
