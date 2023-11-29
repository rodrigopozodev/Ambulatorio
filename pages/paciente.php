<?php
include '../php/conecta.php';

// Obtener el ID del paciente (ajusta la forma de obtenerlo según tus necesidades)
$id_paciente = 1; // Ejemplo, ajusta según tus necesidades

// Consulta SQL para obtener información del paciente
$query_paciente = "SELECT * FROM paciente WHERE id_paciente = $id_paciente";

// Ejecutar la consulta
$resultado_paciente = mysqli_query($conexion, $query_paciente);

// Verificar si se obtuvieron resultados
if ($resultado_paciente) {
    // Obtener los datos del paciente
    $datos_paciente = mysqli_fetch_assoc($resultado_paciente);
} else {
    // Manejar el caso de que no se encuentren datos
    die("Error en la consulta: " . mysqli_error($conexion));
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Paciente</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/paciente.js" defer></script>
</head>
<body class="paciente-body">
    <h1>Información del Paciente</h1>

    <?php if ($resultado_paciente): ?>
        <p>Nombre: <?php echo $datos_paciente['nombre']; ?></p>
        <p>Apellidos: <?php echo $datos_paciente['apellidos']; ?></p>
        <p>DNI: <?php echo $datos_paciente['dni']; ?></p>
        <p>Género: <?php echo $datos_paciente['genero']; ?></p>
        <p>Fecha de Nacimiento: <?php echo $datos_paciente['fecha_nac']; ?></p>
    <?php else: ?>
        <p>No se pudo obtener la información del paciente.</p>
    <?php endif; ?>
</body>
</html>
