<?php
$conexion = new mysqli('localhost', 'root', '', '');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Crear la base de datos
$crearBD = $conexion->query("CREATE DATABASE IF NOT EXISTS Ambulatorio");

if (!$crearBD) {
    die("Error al crear la base de datos: " . $conexion->error);
}

// Luego, seleccionamos la base de datos recién creada
$conexion->select_db("Ambulatorio");

// Aquí puedes incluir la lógica para crear tablas e insertar datos
// ...

echo "Base de datos Ambulatorio creada con éxito.";

// Cerrar la conexión
$conexion->close();
?>
