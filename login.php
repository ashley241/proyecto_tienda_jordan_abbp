<?php
// Inicia o reanuda la sesión del usuario para poder guardar variables globales como $_SESSION['nombre']
session_start();

// Incluye el archivo de conexión a la base de datos MySQL
include("conexion.php");

// Variable global para almacenar y mostrar mensajes de error o alerta al usuario
$mensaje = "";

// Verifica si el formulario fue enviado a través del método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Escapa caracteres especiales en el correo para evitar inyecciones SQL
    $email = $conexion->real_escape_string($_POST['email']);
    
    // Obtiene la contraseña enviada desde el formulario en texto plano
    $password = $_POST['password'];

    // Consulta SQL para buscar al usuario por su correo electrónico
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    
    // Ejecuta la consulta en la base de datos
    $resultado = $conexion->query($sql);

    // Valida que la consulta haya sido exitosa y que exista al menos un usuario registrado con ese correo
    if ($resultado && $resultado->num_rows > 0) {
        
        // Obtiene los datos del usuario en forma de arreglo asociativo
        $usuario = $resultado->fetch_assoc();
        
        // Verifica si la contraseña ingresada coincide con la contraseña encriptada en la base de datos
        if (password_verify($password, $usuario['password'])) {
            
            // Guarda el nombre del usuario en la sesión
            $_SESSION['nombre'] = $usuario['nombre'];
            
            // Redirige directamente a la página principal index.html
            header("Location: index.html");
            
            // Detiene la ejecución del script después de la redirección
            exit();
        } else {
            // Mensaje de error si la contraseña no coincide
            $mensaje = "<p style='color: #ff4444;'>Contraseña incorrecta.</p>";
        }
    } else {
        // Mensaje de error si el correo no existe en la base de datos
        $mensaje = "<p style='color: #ff4444;'>El correo no existe en la base de datos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Definición de caracteres UTF-8 para admitir acentos y caracteres especiales -->
    <meta charset="UTF-8">
    <title>Login - Jordan Store</title>
    
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

    <!-- Contenedor principal del formulario de inicio de sesión -->
    <div class="box">
        <h2>Iniciar Sesión</h2>
        
        <!-- Muestra el mensaje de error si existió alguna falla en la validación PHP -->
        <?php echo $mensaje; ?>
        
        <!-- Formulario que envía los datos mediante el método POST al mismo archivo login.php -->
        <form method="POST" action="login.php">
            <!-- Campo para ingresar el correo electrónico -->
            <input type="email" name="email" placeholder="Correo electrónico" required><br>
            
            <!-- Campo para ingresar la contraseña -->
            <input type="password" name="password" placeholder="Contraseña" required><br>
            
            <!-- Botón para enviar el formulario -->
            <button type="submit">Entrar</button>
        </form>
        
        <!-- Enlaces directos a las páginas de registro y de inicio -->
        <p style="margin-top: 15px;"><a href="registro.php">Crear cuenta nueva</a> | <a href="index.html">Volver al inicio</a></p>
    </div>

</body>
</html>
