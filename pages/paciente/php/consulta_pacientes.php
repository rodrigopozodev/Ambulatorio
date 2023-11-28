<?php
include 'connections/conecta.php';

// Consulta para obtener la información del paciente y sus citas
$consultaPaciente = "SELECT p.nombre, p.apellidos, c.id_consulta, m.nombre AS medico, c.fecha_consulta
                     FROM paciente p
                     JOIN consulta c ON p.id_paciente = c.id_paciente
                     JOIN medico m ON c.id_medico = m.id_medico";

$resultado = $conexion->query($consultaPaciente);

$datosPaciente = array();

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $datosPaciente[] = $fila;
    }
}

// Consulta para obtener la medicación actual del paciente
$consultaMedicacion = "SELECT m.nombre AS medicamento, r.posologia, r.fecha_fin
                      FROM receta r
                      JOIN medicamento m ON r.id_medicamento = m.id_medicamento
                      WHERE r.id_consulta IN (SELECT id_consulta FROM consulta WHERE id_paciente = 1)";

$resultadoMedicacion = $conexion->query($consultaMedicacion);

$datosMedicacion = array();

if ($resultadoMedicacion->num_rows > 0) {
    while ($fila = $resultadoMedicacion->fetch_assoc()) {
        $datosMedicacion[] = $fila;
    }
}

// Consulta para obtener las consultas pasadas del paciente
$consultaConsultasPasadas = "SELECT c.id_consulta, m.nombre AS medico, c.fecha_consulta
                            FROM consulta c
                            JOIN medico m ON c.id_medico = m.id_medico
                            WHERE c.id_paciente = 1 AND c.fecha_consulta < CURRENT_DATE";

$resultadoConsultasPasadas = $conexion->query($consultaConsultasPasadas);

$consultasPasadas = array();

if ($resultadoConsultasPasadas->num_rows > 0) {
    while ($fila = $resultadoConsultasPasadas->fetch_assoc()) {
        $consultasPasadas[] = $fila;
    }
}

// Combina los datos del paciente, la medicación y las consultas pasadas en un solo array
$datosCombinados = array("paciente" => $datosPaciente, "medicacion" => $datosMedicacion, "consultasPasadas" => $consultasPasadas);

echo json_encode($datosCombinados);

// Cerrar la conexión
$conexion->close();
?>
