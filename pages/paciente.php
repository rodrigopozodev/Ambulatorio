<?php
include '../php/conecta.php';

// Obtener la conexión
$conexion = getConexion();

// Consulta SQL para obtener información del paciente (ajusta la consulta según tu estructura de base de datos)
$query = "SELECT * FROM paciente WHERE id_paciente = 1"; // Aquí asumí que el ID del paciente es 1, ajusta según tus necesidades

$resultado = $conexion->query($query);

// Verificar si la consulta fue exitosa
if ($resultado) {
    // Obtener los datos del paciente como un array asociativo
    $paciente = $resultado->fetch_assoc();

    // Mostrar la información del paciente
    echo "Nombre: " . $paciente['nombre'] . "<br>";
    echo "Apellidos: " . $paciente['apellidos'] . "<br>";
    echo "DNI: " . $paciente['dni'] . "<br>";
    echo "Género: " . $paciente['genero'] . "<br>";
    echo "Fecha de Nacimiento: " . $paciente['fecha_nac'] . "<br>";
} else {
    // Mostrar un mensaje de error si la consulta falla
    echo "Error en la consulta: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>
