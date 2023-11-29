<?php

include 'conecta.php';

$idConsulta = $_GET['idConsulta'];
error_log("ID de la consulta recibido: $idConsulta");

function obtenerDatosConsulta($idConsulta) {
    $conexion = getConexion();
    $query = "SELECT * FROM consulta WHERE id_consulta = $idConsulta";
    $resultado = $conexion->query($query);

    if ($resultado->num_rows > 0) {
        $consulta = $resultado->fetch_assoc();
        return json_encode($consulta);
    } else {
        return json_encode(["error" => "Consulta no encontrada"]);
    }

    $conexion->close();
}

// Otras funciones según sea necesario (insertar, actualizar, etc.)

?>
