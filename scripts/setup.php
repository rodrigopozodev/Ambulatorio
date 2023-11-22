<?php
$conexion = new mysqli('localhost', 'root', '', 'Ambulatorio');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

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

// Cerrar la conexión
$conexion->close();
?>
