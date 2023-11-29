<?php
include 'conecta.php';

function obtenerMedicoPorId($id) {
    $conexion = getConexion();
    $query = "SELECT * FROM medico WHERE id_medico = $id";
    $resultado = $conexion->query($query);
    $medico = $resultado->fetch_assoc();
    $conexion->close();
    return $medico;
}

function obtenerConsultasProximasMedico($idMedico) {
    $conexion = getConexion();
    $fechaHoy = date("Y-m-d");
    $query = "SELECT * FROM consulta WHERE id_medico = $idMedico AND fecha_consulta >= '$fechaHoy'";
    $resultado = $conexion->query($query);
    $consultas = [];
    while ($consulta = $resultado->fetch_assoc()) {
        $consultas[] = $consulta;
    }
    $conexion->close();
    return $consultas;
}

function cargarConsultaInfo($idConsulta) {
    $conexion = getConexion();
    $query = "SELECT * FROM consulta WHERE id_consulta = $idConsulta";
    $resultado = $conexion->query($query);
    $consulta = $resultado->fetch_assoc();
    $conexion->close();
    return $consulta;
}

function agregarMedicacion($idConsulta, $medicacion) {
    // Lógica para agregar medicación a la consulta en la base de datos
    // Aquí puedes implementar la lógica según tus necesidades
    return ['mensaje' => 'Medicación agregada con éxito'];
}

function registrarConsulta($idConsulta, $diagnostico) {
    // Lógica para registrar la consulta en la base de datos
    // Aquí puedes implementar la lógica según tus necesidades
    return ['mensaje' => 'Consulta registrada con éxito'];
}

// Manejar las solicitudes desde los archivos JavaScript
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['idMedico'])) {
        // Solicitud para obtener información del médico
        $idMedico = $_GET['idMedico'];
        $infoMedico = obtenerMedicoPorId($idMedico);
        echo json_encode($infoMedico);
    } elseif (isset($_GET['idConsulta'])) {
        // Solicitud para cargar información de la consulta
        $idConsulta = $_GET['idConsulta'];
        $infoConsulta = cargarConsultaInfo($idConsulta);
        echo json_encode($infoConsulta);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Manejar solicitudes POST
    $tipoSolicitud = $_POST['tipo'] ?? '';

    if ($tipoSolicitud === 'agregarMedicacion') {
        // Solicitud para agregar medicación
        $idConsulta = $_POST['idConsulta'];
        $medicacion = $_POST['medicacion'];
        $respuesta = agregarMedicacion($idConsulta, $medicacion);
        echo json_encode($respuesta);
    } elseif ($tipoSolicitud === 'registrarConsulta') {
        // Solicitud para registrar la consulta
        $idConsulta = $_POST['idConsulta'];
        $diagnostico = $_POST['diagnostico'];
        $respuesta = registrarConsulta($idConsulta, $diagnostico);
        echo json_encode($respuesta);
    }
}
?>
