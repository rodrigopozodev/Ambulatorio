<?php

require_once './classes/medico.php';
require_once './classes/Paciente.php';
require_once './classes/Consulta.php';

// Crear instancias de las clases
$medico = new Medico("Dr. Juan", "Pérez", "Cardiología");
$paciente = new Paciente("123456789", "Laura", "Gómez", "F", "1990-05-15", [1, 2]);
$consulta = new Consulta(1, 1, "2023-01-01", "Consulta de prueba", "Síntomas leves");

// Ejemplo de uso
echo "Médico: " . $medico->getNombre() . " - Especialidad: " . $medico->getEspecialidad() . "\n";
echo "Paciente: " . $paciente->getNombre() . " - Género: " . $paciente->getGenero() . "\n";
echo "Consulta: " . $consulta->getFechaConsulta() . " - Diagnóstico: " . $consulta->getDiagnostico() . "\n";

?>
