<?php

function getConexion() {
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $bd = "Ambulatorio";

    // Crear una conexión
    $conexion = new mysqli($servidor, $usuario, $contrasena, $bd);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    return $conexion;
}

// Obtener la conexión
$conexion = getConexion();

// Cerrar la conexión al finalizar el script (no es necesario si estás usando este archivo solo para la conexión)
// $conexion->close();

?>
