<?php

function creaTablas() {
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

    // Seleccionar la base de datos
    $conexion->select_db($bd);

    // Código para crear y poblar las tablas
    // ...

    // Mensaje de éxito con estilos y un icono
    echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Creación de Tablas</title>
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
                Tablas creadas con éxito.
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
                        window.location.href = 'http://localhost/Proyectos/AmbulatorioAPP/index.html';
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

    $conexion->close();
}

// Crear las tablas
creaTablas();
?>
