<?php

require_once('../connections/conecta.php');

function crearTablas() {
    $conexion = getConexion();

    // Crear tabla medico
    $crearTablaMedico = "CREATE TABLE IF NOT EXISTS medico (
        id_medico INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50),
        apellidos VARCHAR(50),
        especialidad VARCHAR(50)
    )";
    //  ejecuta la consulta SQL para crear la tabla
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
    //  ejecuta la consulta SQL para crear la tabla
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
    //  ejecuta la consulta SQL para crear la tabla
    $conexion->query($crearTablaConsulta);

    // Crear tabla medicamento
    $crearTablaMedicamento = "CREATE TABLE IF NOT EXISTS medicamento (
        id_medicamento INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50)
    )";
    //  ejecuta la consulta SQL para crear la tabla
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
    //  ejecuta la consulta SQL para crear la tabla
    $conexion->query($crearTablaReceta);

    // Cerrar conexión
    $conexion->close();
}

// Llamamos a la función para crear las tablas
crearTablas();
?>
