<?php
$host = "localhost";
$usuario = "root";
$password = ""; // En XAMPP la contraseña por defecto es vacía
$bd = "tienda_jordan";

// Crear conexión
$conexion = new mysqli($host, $usuario, $password, $bd);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error . 
        "<br><b>Consejo:</b> Revisa que MySQL esté encendido en XAMPP y que la base de datos 'tienda_jordan' exista.");
}
?>