<?php
require './BD/conexion.php';
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar el usuario en la base de datos.
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username; // Almacenar los datos.
        header("Location: welcome.php"); 
        exit();
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Login</title>
</head>
<body>
    <form class="container" method="POST">
        <h1 class="login-title">Login</h1>

        <section class="input-box">
            <input type="text" name="username" placeholder="Username" required>
            <i class='bx bxs-lock-alt'></i>
        </section>
        <section class="input-box">
            <input type="password" name="password" placeholder="Password" required>
            <i class='bx bxs-lock-alt'></i>
        </section>

        <section class="remember-forgot-box">
            <div class="remember-me">
                <input type="checkbox" name="remember-me" id="remember-me">
                <label for="remember-me">
                    <h5>Remember me</h5>
                </label>
            </div>
            <a class="forgot-password" href="#">
                <h5>Forgot password?</h5>
            </a>
        </section>

        <input type="submit" value="Login" class="login-button"></input>

        <h5 class="dont-have-an-account">
            Don't have an account?
            <a href="registro.php"><b>Register</b></a>
        </h5>
    </form>
</body>
</html>