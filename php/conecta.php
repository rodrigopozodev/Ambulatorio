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
        } else {
            echo"
            <!DOCTYPE html>
                <html lang='es'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Conexión a la Base de Datos</title>
                    <link rel='stylesheet' href='../css/conecta.css'>
                    <script src='../js/script.js' defer></script>
                </head>
                <body class='conecta-php'>
                    <div class='success-message'>
                        Base de datos Ambulatorio creada con éxito.
                    </div>
                    <div class='icon-thumb-up'>
                        👍
                    </div>
                    <div id='cuentaAtras' class='redirection-message'></div>
                </body>
                </html>
            ";
        }
    }

    // Seleccionamos la base de datos
    $conexion->select_db("Ambulatorio");

    return $conexion;
}

// Obtener la conexión
$conexion = getConexion();

// No cerramos la conexión explícitamente
// $conexion->close();

?>
