<?php


// en funciones.php
include __DIR__ . '/../connections/conecta.php';
include __DIR__ . '/Medico.php';
include __DIR__ . '/Paciente.php';
include __DIR__ . '/Consulta.php';

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
