<?php

// Función para obtener información del paciente
function obtener_paciente($conexion, $id_paciente) {
    $query_paciente = "SELECT * FROM paciente WHERE id_paciente = ?";
    $stmt_paciente = mysqli_prepare($conexion, $query_paciente);
    mysqli_stmt_bind_param($stmt_paciente, "i", $id_paciente);
    mysqli_stmt_execute($stmt_paciente);
    return mysqli_stmt_get_result($stmt_paciente);
}

// Función para obtener la próxima consulta del paciente
function obtener_consulta($conexion, $id_paciente) {
    $query_consulta = "SELECT id_consulta, id_medico, fecha_consulta FROM consulta WHERE id_paciente = ? AND fecha_consulta > NOW() ORDER BY fecha_consulta ASC LIMIT 1";
    $stmt_consulta = mysqli_prepare($conexion, $query_consulta);
    mysqli_stmt_bind_param($stmt_consulta, "i", $id_paciente);
    mysqli_stmt_execute($stmt_consulta);
    return mysqli_stmt_get_result($stmt_consulta);
}

// Función para obtener la medicación actual del paciente
function obtener_medicacion_actual($conexion, $id_paciente) {
    $hoy = date('Y-m-d');
    $query = "SELECT r.id_medicamento, r.posologia, r.fecha_fin 
              FROM receta r
              JOIN consulta c ON r.id_consulta = c.id_consulta
              WHERE c.id_paciente = ? AND r.fecha_fin >= '$hoy'";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_paciente);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function obtener_detalles_medico($conexion, $id_medico)
{
    $consulta = "SELECT * FROM medico WHERE id_medico = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, 'i', $id_medico);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

// Función para obtener los médicos asignados a un paciente
function obtener_medicos_asignados($conexion, $id_paciente) {
    $query = "SELECT m.id_medico, m.nombre, m.apellidos, m.especialidad
                 FROM medico m
                 WHERE m.id_medico IN (
                     SELECT id_medico FROM consulta WHERE id_paciente = ?
                 )";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id_paciente);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

// Función para obtener la lista de pacientes
function obtener_pacientes($conexion) {
    $query_pacientes = "SELECT id_paciente, nombre FROM paciente";
    return mysqli_query($conexion, $query_pacientes);
}

// Función para obtener las próximas citas del paciente con detalles
function obtener_proximas_citas_detalles($conexion, $id_paciente) {
    $query_proximas_citas = "SELECT id_consulta, fecha_consulta, diagnostico, sintomatologia
                             FROM consulta
                             WHERE id_paciente = ? AND fecha_consulta >= NOW()";
    $stmt_proximas_citas = mysqli_prepare($conexion, $query_proximas_citas);
    mysqli_stmt_bind_param($stmt_proximas_citas, "i", $id_paciente);
    mysqli_stmt_execute($stmt_proximas_citas);
    return mysqli_stmt_get_result($stmt_proximas_citas);
}

// Función para obtener todas las consultas pasadas del paciente con detalles
function obtener_consultas_pasadas_detalles($conexion, $id_paciente) {
    $query_consultas_pasadas = "SELECT id_consulta, fecha_consulta, diagnostico, sintomatologia 
                                FROM consulta
                                WHERE id_paciente = ? AND fecha_consulta < NOW()";
    $stmt_consultas_pasadas = mysqli_prepare($conexion, $query_consultas_pasadas);
    mysqli_stmt_bind_param($stmt_consultas_pasadas, "i", $id_paciente);
    mysqli_stmt_execute($stmt_consultas_pasadas);
    return mysqli_stmt_get_result($stmt_consultas_pasadas);
}

// Función para obtener las próximas citas del paciente con un médico específico
function obtener_proximas_citas($conexion, $id_paciente, $id_medico = null) {
    $hoy = date('Y-m-d');
    $query = "SELECT id_consulta, fecha_consulta, diagnostico, sintomatologia
              FROM consulta
              WHERE id_paciente = ?";

    // Agregar condición para filtrar por médico si está presente
    if ($id_medico !== null) {
        $query .= " AND id_medico = ?";
    }

    // Continuar construyendo la consulta
    $query .= " AND fecha_consulta >= ?";

    $stmt_proximas_citas = mysqli_prepare($conexion, $query);

    if ($id_medico !== null) {
        mysqli_stmt_bind_param($stmt_proximas_citas, "is", $id_paciente, $id_medico, $hoy);
    } else {
        mysqli_stmt_bind_param($stmt_proximas_citas, "s", $id_paciente, $hoy);
    }

    mysqli_stmt_execute($stmt_proximas_citas);
    return mysqli_stmt_get_result($stmt_proximas_citas);
}

?>
