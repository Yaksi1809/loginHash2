<?php
require './BD/conexion.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Obtener la contraseña original desde la base de datos
$username = $_SESSION['username'];
$sql = "SELECT password_plain FROM users WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$passwordPlain = $user['password_plain'];
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
        
        <!-- Mostrar la contraseña original del usuario -->
        <p>Tu contraseña es: <strong><?php echo htmlspecialchars($passwordPlain); ?></strong></p><br>
        
        <a class="forgot-password" href="logout.php">Cerrar sesión</a>
    </div>
    </center>
</body>
</html>
