<?php
session_start();
include("conexion.php");
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conexion->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = $conexion->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($password, $usuario['password'])) {
            $_SESSION['nombre'] = $usuario['nombre'];
            // Redirige directamente a index.html
            header("Location: index.html");
            exit();
        } else {
            $mensaje = "<p style='color: #ff4444;'>Contraseña incorrecta.</p>";
        }
    } else {
        $mensaje = "<p style='color: #ff4444;'>El correo no existe en la base de datos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Jordan Store</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #111; color: #fff; text-align: center; }
        .box { background: #222; padding: 25px; width: 320px; margin: 60px auto; border-radius: 8px; border: 1px solid #e21b23; }
        input { width: 90%; padding: 10px; margin: 8px 0; border-radius: 4px; border: none; }
        button { background: #e21b23; color: white; padding: 10px; border: none; width: 95%; font-weight: bold; cursor: pointer; margin-top: 10px; }
        a { color: #e21b23; text-decoration: none; }
    </style>
</head>
<body>

    <div class="box">
        <h2>Iniciar Sesión</h2>
        <?php echo $mensaje; ?>
        <form method="POST" action="login.php">
            <input type="email" name="email" placeholder="Correo electrónico" required><br>
            <input type="password" name="password" placeholder="Contraseña" required><br>
            <button type="submit">Entrar</button>
        </form>
        <p style="margin-top: 15px;"><a href="registro.php">Crear cuenta nueva</a> | <a href="index.html">Volver al inicio</a></p>
    </div>

</body>
</html>