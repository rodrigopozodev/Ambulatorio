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

        // Mensaje de éxito con estilos y un icono
        echo "
            <!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Conexión a la Base de Datos</title>
                <style>
                    body {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-direction: column; /* Añadido para alinear en columna */
                        height: 100vh;
                        margin: 0;
                        background-color: #f0f0f0;
                    }

                    .success-message {
                        text-align: center;
                        color: #28a745; /* Color verde */
                        font-size: 24px;
                        font-weight: bold;
                        margin-bottom: 20px;
                    }

                    .icon-thumb-up {
                        font-size: 120px; /* Aumentado el tamaño del icono */
                        animation: pulse 1s infinite alternate; /* Ajustado la velocidad y tamaño de la animación */
                    }

                    @keyframes pulse {
                        0% {
                            transform: scale(1); /* Tamaño original */
                        }
                        100% {
                            transform: scale(1.5); /* Tamaño aumentado */
                        }
                    }

                    .redirection-message {
                        margin-top: 20px; /* Añadido margen superior */
                    }
                </style>
            </head>
            <body>
                <div class='success-message'>
                    Base de datos Ambulatorio creada con éxito.
                </div>
                <div class='icon-thumb-up'>
                    👍
                </div>

                <script>
                    var tiempoRestante = 3; // 3 segundos

                    function actualizarCuentaAtras() {
                        document.getElementById('cuentaAtras').innerText = 'Redirigiendo en ' + tiempoRestante + ' segundos...';
                        tiempoRestante--;

                        if (tiempoRestante < 0) {
                            window.location.href = 'http://localhost/Proyectos/AmbulatorioAPP/php/crea_tablas.php';
                        } else {
                            setTimeout(actualizarCuentaAtras, 1000); // Actualizar cada segundo
                        }
                    }

                    setTimeout(actualizarCuentaAtras, 0); // Iniciar cuenta atrás
                </script>
                <div id='cuentaAtras' class='redirection-message'></div>
            </body>
            </html>
        ";
    }

    return $conexion;
}

// Obtener la conexión
$conexion = getConexion();

// Cerrar la conexión al finalizar el script
$conexion->close();
?>
