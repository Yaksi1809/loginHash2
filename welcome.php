<?php
require './BD/conexion.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Obtener la contraseña del usuario actual desde la base de datos
$username = $_SESSION['username'];
$sql = "SELECT password FROM users WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$passwordHash = $user['password'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <center>
    <div class="container">
        <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2><br>
        <p>Has iniciado sesión correctamente.</p><br>
        
        <!-- Mostrar la contraseña (hash) del usuario -->
        <p>Tu contraseña es: <strong><?php echo htmlspecialchars($passwordHash); ?></strong></p><br>
        
        <a class="forgot-password" href="logout.php">Cerrar sesión</a>
    </div>
    </center>
</body>
</html>
