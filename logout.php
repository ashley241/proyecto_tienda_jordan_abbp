<?php
// Inicia o reanuda la sesión actual para poder acceder a sus datos
session_start();

// Destruye toda la información registrada en la sesión activa (cierra la sesión)
session_destroy();

// Redirige al usuario a la página de inicio (index.html)
header("Location: index.html");

// Detiene inmediatamente la ejecución del script para asegurar que no se procese más código
exit();
?>
