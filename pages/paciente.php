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

// Consulta SQL para obtener la próxima consulta del paciente
$query_consulta = "SELECT id_consulta, id_medico, fecha_consulta FROM consulta WHERE id_paciente = $id_paciente ORDER BY fecha_consulta ASC LIMIT 1";

// Ejecutar la consulta
$resultado_consulta = mysqli_query($conexion, $query_consulta);

// Verificar si se obtuvieron resultados
if ($resultado_consulta) {
    // Obtener los datos de la consulta
    $datos_consulta = mysqli_fetch_assoc($resultado_consulta);
} else {
    // Manejar el caso de que no se encuentren datos
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Consulta SQL para obtener la medicación actual del paciente
$query_medicacion = "SELECT id_medicamento, posologia, fecha_fin FROM receta WHERE id_consulta = $id_paciente AND fecha_fin > NOW()";

// Ejecutar la consulta
$resultado_medicacion = mysqli_query($conexion, $query_medicacion);

// Verificar si se obtuvieron resultados
if ($resultado_medicacion) {
    // Obtener los datos de la medicación
    $datos_medicacion = mysqli_fetch_assoc($resultado_medicacion);
} else {
    // Manejar el caso de que no se encuentren datos
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Consulta SQL para obtener las consultas pasadas del paciente
$query_consultas_pasadas = "SELECT id_consulta, fecha_consulta FROM consulta WHERE id_paciente = $id_paciente AND fecha_consulta < NOW()";

// Ejecutar la consulta
$resultado_consultas_pasadas = mysqli_query($conexion, $query_consultas_pasadas);

// Verificar si se obtuvieron resultados
if ($resultado_consultas_pasadas) {
    // Obtener los datos de las consultas pasadas
    $datos_consultas_pasadas = mysqli_fetch_all($resultado_consultas_pasadas, MYSQLI_ASSOC);
} else {
    // Manejar el caso de que no se encuentren datos
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Consulta SQL para obtener los médicos que tratan al paciente
$query_medicos = "SELECT id_medico, nombre, apellidos, especialidad FROM medico WHERE id_medico = $id_paciente";

// Ejecutar la consulta
$resultado_medicos = mysqli_query($conexion, $query_medicos);

// Verificar si se obtuvieron resultados
if ($resultado_medicos) {
    // Obtener los datos de los médicos
    $datos_medicos = mysqli_fetch_all($resultado_medicos, MYSQLI_ASSOC);
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

    <?php if ($resultado_consulta): ?>
        <h2>Próxima consulta</h2>
        <p>ID de consulta: <?php echo $datos_consulta['id_consulta']; ?></p>
        <p>Médico: <?php echo $datos_consulta['id_medico']; ?></p>
        <p>Fecha: <?php echo $datos_consulta['fecha_consulta']; ?></p>
    <?php else: ?>
        <p>No se pudo obtener la información de la próxima consulta.</p>
    <?php endif; ?>

    <?php if ($resultado_medicacion && $datos_medicacion): ?>
    <h2>Medicación actual</h2>
    <p>Medicación: <?php echo isset($datos_medicacion['medicacion']) ? $datos_medicacion['medicacion'] : 'N/A'; ?></p>
    <p>Posología: <?php echo isset($datos_medicacion['posologia']) ? $datos_medicacion['posologia'] : 'N/A'; ?></p>
    <p>Fecha de fin: <?php echo isset($datos_medicacion['fecha_fin']) ? $datos_medicacion['fecha_fin'] : 'N/A'; ?></p>
<?php else: ?>
    <p>No se pudo obtener la información de la medicación actual.</p>
<?php endif; ?>


    <?php if ($resultado_consultas_pasadas): ?>
        <h2>Consultas pasadas</h2>
        <ul>
            <?php foreach ($datos_consultas_pasadas as $consulta): ?>
                <li>ID de consulta: <?php echo $consulta['id_consulta']; ?>, Fecha: <?php echo $consulta['fecha_consulta']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No se pudo obtener la información de las consultas pasadas.</p>
    <?php endif; ?>

    <?php if ($resultado_medicos): ?>
        <h2>Pedir una cita</h2>
        <form action="pedir_cita.php" method="post">
            <label for="medico">Médico:</label>
            <select name="medico" id="medico">
                <?php foreach ($datos_medicos as $medico): ?>
                    <option value="<?php echo $medico['id_medico']; ?>"><?php echo $medico['nombre']; ?> (<?php echo $medico['especialidad']; ?>)</option>
                <?php endforeach; ?>
            </select>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha">
            <label for="sintomas">Síntomas:</label>
            <textarea id="sintomas" name="sintomas"></textarea>
            <input type="submit" value="Pedir cita">
        </form>
    <?php else: ?>
        <p>No se pudo obtener la información de los médicos.</p>
    <?php endif; ?>
</body>
</html>
