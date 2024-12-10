

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body >
    <form class="container" method="POST">
        <h1 class="login-title">Nuevo usuario</h1>

        <section class="input-box">
            <input type="text" name="username" placeholder="Username">
            <i class='bx bxs-lock-alt'></i>
        </section>
        <section class="input-box">
            <input type="password" name="password" placeholder="Password">
            <i class='bx bxs-lock-alt'></i>
        </section>

        <input type="submit" value="Registrar" class="login-button"></input>
        <br>
        
        <a href="welcome.php">Inicio de sesión</a>
    </form>
</body>
</html>
