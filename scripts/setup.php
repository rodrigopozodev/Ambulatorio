<?php
require_once('conecta.php');

$conexion = getConexion();

// Verificar si la base de datos existe
$resultado = $conexion->query("SHOW DATABASES LIKE 'Ambulatorio'");

// Si no existe, la creamos
if ($resultado->num_rows === 0) {
    $crearBD = $conexion->query("CREATE DATABASE Ambulatorio");

    if (!$crearBD) {
        die("Error al crear la base de datos: " . $conexion->error);
    }

    // Luego, seleccionamos la base de datos recién creada
    $conexion->select_db("Ambulatorio");

    // Aquí puedes incluir la lógica para crear tablas e insertar datos
    // ...

    echo "Base de datos Ambulatorio creada con éxito.";
}

// No necesitas cerrar la conexión aquí, ya que getConexion devuelve la conexión lista para usar.
?>
