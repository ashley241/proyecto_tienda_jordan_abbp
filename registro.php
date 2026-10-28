<?php
include("conexion.php");
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $email = $conexion->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "<p style='color: #00ff00;'>¡Usuario registrado con éxito en la BD!</p>";
    } else {
        $mensaje = "<p style='color: #ff4444;'>Error en SQL: " . $conexion->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Jordan Store</title>
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
        <h2>Registro Jordan</h2>
        <?php echo $mensaje; ?>
        <form method="POST" action="registro.php">
            <input type="text" name="nombre" placeholder="Nombre completo" required><br>
            <input type="email" name="email" placeholder="Correo electrónico" required><br>
            <input type="password" name="password" placeholder="Contraseña" required><br>
            <button type="submit">Guardar en BD</button>
        </form>
        <p style="margin-top: 15px;"><a href="login.php">Ir a Iniciar Sesión</a> | <a href="index.html">Volver al inicio</a></p>
    </div>

</body>
</html>