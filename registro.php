<?php
// Incluir la conexión a la base de datos
require_once './BD/conexion.php';

// Variable para el mensaje del modal
$modalMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

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

            $modalMessage = "Usuario registrado exitosamente.";
        } catch (PDOException $e) {
            $modalMessage = "Error al registrar el usuario: " . $e->getMessage();
        }
    } else {
        $modalMessage = "Por favor, llena todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="./style/style.css">
    <style>
        /* Estilos del modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            text-align: center;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
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

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <p><?php echo htmlspecialchars($modalMessage); ?></p>
        </div>
    </div>

    <script>
        // Mostrar el modal si hay un mensaje
        const modalMessage = "<?php echo $modalMessage; ?>";
        if (modalMessage) {
            const modal = document.getElementById("modal");
            modal.style.display = "block";

            // Cerrar el modal al hacer clic en la 'x'
            document.getElementById("closeModal").onclick = function() {
                modal.style.display = "none";
            };

            // Cerrar el modal al hacer clic fuera del contenido
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };
        }
    </script>
</body>
</html>
