<?php

function getConexion() {
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $bd = "Ambulatorio";

    // Crear una conexión
    $conexion = new mysqli($servidor, $usuario, $contrasena);

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
    } else {
        // La base de datos ya existe
        $conexion->select_db("Ambulatorio");
        echo "Conexión a la base de datos Ambulatorio existente.";
    }

    return $conexion;
}

// Obtener la conexión
$conexion = getConexion();

// Cerrar la conexión al finalizar el script
$conexion->close();

?>
