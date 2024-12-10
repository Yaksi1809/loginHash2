<?php
// Incluir la conexión a la base de datos
require_once './BD/conexion.php';

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validar que los campos no estén vacíos
    if (!empty($username) && !empty($password)) {
        // Encriptar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Preparar la consulta para insertar el usuario
            $query = "INSERT INTO users (username, password, password_plain) VALUES (:username, :password, :password_plain)";
            $stmt = $pdo->prepare($query);
            
            // Ejecutar la consulta con los valores
            $stmt->execute([
                ':username' => $username,
                ':password' => $hashedPassword,
                ':password_plain' => $password // Guardar la contraseña sin cifrar
            ]);

            echo "<p>Usuario registrado exitosamente.</p>";
        } catch (PDOException $e) {
            echo "<p>Error al registrar el usuario: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Por favor, llena todos los campos.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <form class="container" method="POST">
        <h1 class="login-title">Nuevo usuario</h1>

        <section class="input-box">
            <input type="text" name="username" placeholder="Username" required>
        </section>
        <section class="input-box">
            <input type="password" name="password" placeholder="Password" required>
        </section>

        <input type="submit" value="Registrar" class="login-button">
        <br>
        <a href="welcome.php">Inicio de sesión</a>
    </form>
</body>
</html>
