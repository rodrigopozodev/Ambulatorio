<?php
// Asegúrate de que estás incluyendo el archivo de conexión

// Verifica si la conexión es exitosa
if (!$conexion) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

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


/* ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */


/* medico.php */


function obtener_info_medico($conexion, $id_medico) {
    $query = "SELECT nombre, especialidad FROM medico WHERE id_medico = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_medico);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function obtener_num_consultas_proximos_7_dias($conexion, $id_medico) {
    $query = "SELECT COUNT(*) as num_consultas FROM consulta WHERE id_medico = ? AND fecha_consulta BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_medico);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);
    return $fila['num_consultas'];
}

function obtener_consultas_hoy($conexion, $id_medico) {
    $query = "SELECT id_consulta, id_paciente, LEFT(sintomatologia, 100) as extracto_sintomas FROM consulta WHERE id_medico = ? AND DATE(fecha_consulta) = CURDATE()";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_medico);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function obtener_medicos($conexion) {
    $query = "SELECT id_medico, nombre, especialidad FROM medico";
    $resultado = mysqli_query($conexion, $query);
    return $resultado;
}




/* ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */



/* consultas.php */

function obtenerInformacionEditable($conexion, $id_consulta) {
    $query = "SELECT sintomatologia, diagnostico FROM consulta WHERE id_consulta = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_consulta);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Verificar si hay resultados y devolver un array asociativo
    return $result ? mysqli_fetch_assoc($result) : null;
}



// Función para obtener la información de la consulta
function obtenerInformacionConsulta($conexion, $idConsulta) {
    $query = "SELECT c.id_consulta, c.fecha_consulta, m.nombre AS nombre_medico, p.nombre AS nombre_paciente
              FROM consulta c
              JOIN medico m ON c.id_medico = m.id_medico
              JOIN paciente p ON c.id_paciente = p.id_paciente
              WHERE c.id_consulta = ?";
    
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $idConsulta);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}

function obtenerMedicamentos($conexion) {
    $query = "SELECT id_medicamento, nombre FROM medicamento";
    
    $resultado = mysqli_query($conexion, $query);

    return $resultado;
}

// Nueva función para obtener la medicación de la consulta
function obtenerMedicacionConsulta($conexion, $idConsulta) {
    $query = "SELECT medicacion FROM consulta WHERE id_consulta = ?";
    
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $idConsulta);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}

// Nueva función para obtener la información de la medicación
function obtenerDetallesMedicacion($conexion, $idMedicacion) {
    $query = "SELECT * FROM medicacion WHERE id_medicacion = ?";
    
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $idMedicacion);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}

// ... Otras funciones ...

// Nueva función para registrar la medicación
function registrarMedicacion($conexion, $idConsulta, $idMedicamento, $cantidad, $frecuencia, $duracion, $cronica) {
    $query = "INSERT INTO medicacion (id_consulta, id_medicamento, cantidad, frecuencia, duracion, cronica) VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "iiisii", $idConsulta, $idMedicamento, $cantidad, $frecuencia, $duracion, $cronica);

    return mysqli_stmt_execute($stmt);
}

?>
