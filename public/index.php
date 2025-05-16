<?php include __DIR__ . '/../includes/header.php'; 
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

?>
<h1>Vítejte ve skladovém systému</h1>
<p>Pomocí menu nahoře můžete spravovat produkty, objednávky a zásoby.</p>
<?php include __DIR__ . '/../includes/footer.php'; ?>
