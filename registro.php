<?php
// Incluye el archivo de conexión a la base de datos MySQL
include("conexion.php");

// Variable global para almacenar y mostrar mensajes de éxito o error al usuario
$mensaje = "";

// Verifica si el formulario fue enviado a través del método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Escapa caracteres especiales en el nombre para evitar inyecciones SQL
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    
    // Escapa caracteres especiales en el correo electrónico
    $email = $conexion->real_escape_string($_POST['email']);
    
    // Encripta la contraseña enviada mediante un algoritmo de hash seguro por defecto (BCrypt)
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Consulta SQL para insertar el nuevo usuario en la tabla 'usuarios'
    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";

    // Ejecuta la consulta y verifica si el registro fue exitoso
    if ($conexion->query($sql) === TRUE) {
        // Mensaje de éxito si el usuario se guardó en la base de datos
        $mensaje = "<p style='color: #00ff00;'>¡Usuario registrado con éxito en la BD!</p>";
    } else {
        // Mensaje de error detallado si la consulta SQL falla
        $mensaje = "<p style='color: #ff4444;'>Error en SQL: " . $conexion->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Definición de caracteres UTF-8 para admitir acentos y caracteres especiales -->
    <meta charset="UTF-8">
    <title>Registro - Jordan Store</title>
    
    <!-- Estilos CSS integrados para la interfaz del formulario -->
    <style>
        body { font-family: Arial, sans-serif; background-color: #111; color: #fff; text-align: center; }
        .box { background: #222; padding: 25px; width: 320px; margin: 60px auto; border-radius: 8px; border: 1px solid #e21b23; }
        input { width: 90%; padding: 10px; margin: 8px 0; border-radius: 4px; border: none; }
        button { background: #e21b23; color: white; padding: 10px; border: none; width: 95%; font-weight: bold; cursor: pointer; margin-top: 10px; }
        a { color: #e21b23; text-decoration: none; }
    </style>
</head>
<body>

    <!-- Contenedor principal del formulario de registro -->
    <div class="box">
        <h2>Registro Jordan</h2>
        
        <!-- Muestra el mensaje de éxito o error tras procesar el formulario -->
        <?php echo $mensaje; ?>
        
        <!-- Formulario que envía los datos mediante el método POST al mismo archivo registro.php -->
        <form method="POST" action="registro.php">
            <!-- Campo para ingresar el nombre completo -->
            <input type="text" name="nombre" placeholder="Nombre completo" required><br>
            
            <!-- Campo para ingresar el correo electrónico -->
            <input type="email" name="email" placeholder="Correo electrónico" required><br>
            
            <!-- Campo para ingresar la contraseña -->
            <input type="password" name="password" placeholder="Contraseña" required><br>
            
            <!-- Botón para enviar el formulario y procesar el registro -->
            <button type="submit">Guardar en BD</button>
        </form>
        
        <!-- Enlaces directos a las páginas de login y de inicio -->
        <p style="margin-top: 15px;"><a href="login.php">Ir a Iniciar Sesión</a> | <a href="index.html">Volver al inicio</a></p>
    </div>

</body>
</html>
