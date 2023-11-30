<?php

function crearTablas() {
    $conexion = new mysqli('localhost', 'root', '', 'Ambulatorio');

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Crear tabla medico
    $crearTablaMedico = "CREATE TABLE IF NOT EXISTS medico (
        id_medico INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50),
        apellidos VARCHAR(50),
        especialidad VARCHAR(50)
    )";
    $conexion->query($crearTablaMedico);

    // Crear tabla paciente
    $crearTablaPaciente = "CREATE TABLE IF NOT EXISTS paciente (
        id_paciente INT AUTO_INCREMENT PRIMARY KEY,
        dni VARCHAR(10),
        nombre VARCHAR(50),
        apellidos VARCHAR(50),
        genero CHAR(1),
        fecha_nac DATE,
        id_medicos_asignados TEXT
    )";
    $conexion->query($crearTablaPaciente);

    // Crear tabla consulta
    $crearTablaConsulta = "CREATE TABLE IF NOT EXISTS consulta (
        id_consulta INT AUTO_INCREMENT PRIMARY KEY,
        id_medico INT,
        id_paciente INT,
        fecha_consulta DATE,
        diagnostico TEXT,
        sintomatologia TEXT,
        FOREIGN KEY (id_medico) REFERENCES medico(id_medico),
        FOREIGN KEY (id_paciente) REFERENCES paciente(id_paciente)
    )";
    $conexion->query($crearTablaConsulta);

    // Crear tabla medicamento
    $crearTablaMedicamento = "CREATE TABLE IF NOT EXISTS medicamento (
        id_medicamento INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50)
    )";
    $conexion->query($crearTablaMedicamento);

    // Crear tabla receta
    $crearTablaReceta = "CREATE TABLE IF NOT EXISTS receta (
        id_medicamento INT,
        id_consulta INT,
        posologia VARCHAR(50),
        fecha_fin DATE,
        FOREIGN KEY (id_medicamento) REFERENCES medicamento(id_medicamento),
        FOREIGN KEY (id_consulta) REFERENCES consulta(id_consulta)
    )";
    $conexion->query($crearTablaReceta);

    // Inserción de datos
    $insertarDatos = "
        INSERT INTO medico (nombre, apellidos, especialidad) VALUES
            ('Dr. José', 'Martínez Gómez', 'Cardiología'),
            ('Dra. Laura', 'Sánchez Rodríguez', 'Pediatría'),
            ('Dr. Juan', 'López Pérez', 'Dermatología'),
            ('Dra. Carmen', 'Fernández López', 'Neurología');

        INSERT INTO paciente (dni, nombre, apellidos, genero, fecha_nac, id_medicos_asignados) VALUES
            ('12345678A', 'Laura', 'Gómez Rodríguez', 'F', '1990-05-15', '1,2,3,4'),
            ('87654321B', 'Carlos', 'Pérez Gutiérrez', 'M', '1985-10-20', '1,2,3,4'),
            ('23456789C', 'Sofía', 'García Martínez', 'F', '2000-03-08', '1,2,3,4'),
            ('98765432D', 'Pedro', 'Rodríguez Sánchez', 'M', '1972-12-03', '1,2,3,4');

        INSERT INTO consulta (id_medico, id_paciente, fecha_consulta, diagnostico, sintomatologia) VALUES
            (1, 1, '2023-03-01', 'Presión arterial alta', 'Dolor de cabeza y mareos'),
            (1, 2, '2023-02-15', 'Alergia en la piel', 'Picazón y enrojecimiento'),
            (1, 3, '2023-01-20', 'Eczema', 'Piel seca y escamosa'),
            (1, 4, '2023-03-05', 'Vacunación infantil', 'Control de rutina'),
            (2, 1, '2023-04-10', 'Dolor de espalda', 'Molestias en la zona lumbar'),
            (2, 2, '2023-02-28', 'Resfriado común', 'Congestión nasal y estornudos'),
            (2, 3, '2023-01-15', 'Gastritis', 'Malestar estomacal y acidez'),
            (2, 4, '2023-03-20', 'Hipertensión', 'Presión arterial elevada'),
            (3, 1, '2023-04-05', 'Migraña', 'Dolor intenso en la cabeza y sensibilidad a la luz'),
            (3, 2, '2023-02-10', 'Infección ocular', 'Enrojecimiento y secreción en los ojos'),
            (3, 3, '2023-01-25', 'Problemas de sueño', 'Insomnio y cansancio constante'),
            (3, 4, '2023-03-15', 'Problemas respiratorios', 'Dificultad para respirar y tos persistente'),
            (4, 1, '2023-04-01', 'Aumento de peso', 'Cambios en el hábito alimenticio y sed constante'),
            (4, 2, '2023-02-20', 'Dolor muscular', 'Molestias en diferentes áreas del cuerpo'),
            (4, 3, '2023-01-05', 'Problemas de tiroides', 'Fatiga y cambios en el peso corporal'),
            (4, 4, '2023-03-25', 'Estrés', 'Dificultad para relajarse y tensión muscular');


        INSERT INTO medicamento (nombre) VALUES
            ('Paracetamol'),
            ('Ibuprofeno'),
            ('Aspirina'),
            ('Amoxicilina');

        INSERT INTO receta (id_medicamento, id_consulta, posologia, fecha_fin) VALUES
            (1, 1, '1 tableta cada 8 horas', '2024-03-10'),
            (2, 2, '1 tableta cada 12 horas', '2024-02-25'),
            (3, 3, '1 tableta cada 24 horas', '2023-02-10'),
            (4, 4, '1 cucharadita cada 12 horas', '2023-03-15');
    ";

    if ($conexion->multi_query($insertarDatos)) {
        do {
            // store first result set
            if ($result = $conexion->store_result()) {
                while ($row = $result->fetch_row()) {
                    printf("%s\n", $row[0]);
                }
                $result->free();
            }
            // print divider
            if ($conexion->more_results()) {
            }
        } while ($conexion->next_result());

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
    }

    // Cerrar la conexión
    $conexion->close();
}

// Llamar a la función para crear tablas e insertar datos
crearTablas();
?>
