<?php
// Inicia o reanuda la sesión actual para acceder a las variables de sesión ($_SESSION)
session_start();

// Establece el encabezado de la respuesta HTTP indicando que el contenido devuelto será de tipo JSON
header('Content-Type: application/json');

// Comprueba si la variable de sesión 'nombre' está definida y no es nula
if (isset($_SESSION['nombre'])) {
    // Si el usuario ha iniciado sesión, devuelve un JSON con 'logged_in' en true y su 'nombre'
    echo json_encode(['logged_in' => true, 'nombre' => $_SESSION['nombre']]);
} else {
    // Si no existe la variable de sesión, devuelve un JSON indicando que 'logged_in' es false
    echo json_encode(['logged_in' => false]);
}
?>
