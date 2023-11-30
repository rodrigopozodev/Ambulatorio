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
function obtener_medicacion($conexion, $id_paciente) {
    $query_medicacion = "SELECT id_medicamento, posologia, fecha_fin FROM receta WHERE id_consulta = ? AND fecha_fin > NOW()";
    $stmt_medicacion = mysqli_prepare($conexion, $query_medicacion);
    mysqli_stmt_bind_param($stmt_medicacion, "i", $id_paciente);
    mysqli_stmt_execute($stmt_medicacion);
    return mysqli_stmt_get_result($stmt_medicacion);
}

function obtener_detalles_medico($conexion, $id_medico)
{
    $consulta = "SELECT * FROM medico WHERE id_medico = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, 'i', $id_medico);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}



// Función para obtener todas las consultas pasadas del paciente
function obtener_consultas_pasadas($conexion, $id_paciente) {
    $query_consultas_pasadas = "SELECT id_consulta, fecha_consulta FROM consulta WHERE id_paciente = ? AND fecha_consulta < NOW()";
    $stmt_consultas_pasadas = mysqli_prepare($conexion, $query_consultas_pasadas);
    mysqli_stmt_bind_param($stmt_consultas_pasadas, "i", $id_paciente);
    mysqli_stmt_execute($stmt_consultas_pasadas);
    return mysqli_stmt_get_result($stmt_consultas_pasadas);
}


// Función para obtener la lista de médicos
function obtener_medicos($conexion) {
    $query_medicos = "SELECT id_medico, nombre, apellidos, especialidad FROM medico";
    return mysqli_query($conexion, $query_medicos);
}

// Función para obtener la lista de pacientes
function obtener_pacientes($conexion) {
    $query_pacientes = "SELECT id_paciente, nombre FROM paciente";
    return mysqli_query($conexion, $query_pacientes);
}
?>
