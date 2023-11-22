<?php

include 'conecta.php';
include 'classes/Medico.php';
include 'classes/Paciente.php';
include 'classes/Consulta.php';

// Funciones relacionadas con médicos
function obtenerMedicos() {
    $conexion = getConexion();
    $medico = new Medico($conexion);
    return $medico->obtenerTodos();
}

function obtenerInfoMedico($idMedico) {
    $conexion = getConexion();
    $medico = new Medico($conexion);
    return $medico->obtenerInfo($idMedico);
}

// Funciones relacionadas con pacientes
function obtenerPacientes() {
    $conexion = getConexion();
    $paciente = new Paciente($conexion);
    return $paciente->obtenerTodos();
}

function obtenerInfoPaciente($idPaciente) {
    $conexion = getConexion();
    $paciente = new Paciente($conexion);
    return $paciente->obtenerInfo($idPaciente);
}

// Funciones relacionadas con consultas
function obtenerConsultas() {
    $conexion = getConexion();
    $consulta = new Consulta($conexion);
    return $consulta->obtenerTodas();
}

function obtenerInfoConsulta($idConsulta) {
    $conexion = getConexion();
    $consulta = new Consulta($conexion);
    return $consulta->obtenerInfo($idConsulta);
}

?>
