<?php
include '../php/conecta.php'; // Incluye el archivo de conexión
include '../php/consultas.php';

$id_paciente_seleccionado = $_POST['id_paciente'] ?? 1; // Por defecto, elige el primer paciente

// Obtener la lista de pacientes
$resultado_pacientes = obtener_pacientes($conexion);

// Obtener otros datos del paciente
$resultado_paciente = obtener_paciente($conexion, $id_paciente_seleccionado);
$resultado_consulta = obtener_consulta($conexion, $id_paciente_seleccionado);
$resultado_medicacion = obtener_medicacion($conexion, $id_paciente_seleccionado);
$resultado_consultas_pasadas = obtener_consultas_pasadas($conexion, $id_paciente_seleccionado);
$resultado_medicos = obtener_medicos($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Paciente</title>

    <script src="../js/paciente.js" defer></script>
</head>
<body class="paciente-body">
    <h1>Información del Paciente</h1>

    <!-- Desplegable para elegir el paciente -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="paciente">Selecciona un paciente:</label>
        <select name="id_paciente" id="id_paciente">
            <?php while ($fila = mysqli_fetch_assoc($resultado_pacientes)): ?>
                <option value="<?php echo htmlspecialchars($fila['id_paciente']); ?>"><?php echo htmlspecialchars($fila['nombre']); ?></option>
            <?php endwhile; ?>
        </select>
        <input type="submit" value="Seleccionar paciente">
    </form>

    <?php
    // Obtener el ID del paciente seleccionado (puedes modificar esto según tus necesidades)
    $id_paciente_seleccionado = $_POST['id_paciente'] ?? 1; // Por defecto, elige el primer paciente
    $resultado_paciente = obtener_paciente($conexion, $id_paciente_seleccionado);
    ?>

    <?php if ($resultado_paciente && mysqli_num_rows($resultado_paciente) > 0): ?>
        <h2>Perfil Paciente</h2>
        <?php $datos_paciente = mysqli_fetch_assoc($resultado_paciente); ?>
        <p>Nombre: <?php echo htmlspecialchars($datos_paciente['nombre']); ?></p>
        <p>Apellidos: <?php echo htmlspecialchars($datos_paciente['apellidos']); ?></p>
        <p>DNI: <?php echo htmlspecialchars($datos_paciente['dni']); ?></p>
        <p>Género: <?php echo htmlspecialchars($datos_paciente['genero']); ?></p>
        <p>Fecha de Nacimiento: <?php echo htmlspecialchars($datos_paciente['fecha_nac']); ?></p>
    <?php else: ?>
        <p>No se pudo obtener la información del paciente.</p>
    <?php endif; ?>

    <?php if ($resultado_consultas_pasadas && mysqli_num_rows($resultado_consultas_pasadas) > 0): ?>
    <h2>Consultas Pasadas</h2>
    <ul>
        <?php while ($consulta_pasada = mysqli_fetch_assoc($resultado_consultas_pasadas)): ?>
            <li>
                <?php
                $id_medico = isset($consulta_pasada['id_medico']) ? $consulta_pasada['id_medico'] : null;

                // Obtener detalles del médico si se proporciona el ID del médico
                $detalles_medico = obtener_detalles_medico($conexion, $id_medico);
                $info_medico = mysqli_fetch_assoc($detalles_medico);

                echo 'Fecha: ' . (isset($consulta_pasada['fecha_consulta']) ? htmlspecialchars($consulta_pasada['fecha_consulta']) : 'No disponible') . '<br>';
                echo 'Diagnóstico: ' . (isset($consulta_pasada['diagnostico']) ? htmlspecialchars($consulta_pasada['diagnostico']) : 'No disponible') . '<br>';
                echo 'Sintomatología: ' . (isset($consulta_pasada['sintomatologia']) ? htmlspecialchars($consulta_pasada['sintomatologia']) : 'No disponible') . '<br>';
                echo 'Médico: ' . ($info_medico ? htmlspecialchars($info_medico['nombre'] . ' ' . $info_medico['apellidos']) : 'No disponible') . '<br>';
                ?>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>No se pudo obtener la información de las consultas pasadas.</p>
<?php endif; ?>

    <?php if ($resultado_medicos && mysqli_num_rows($resultado_medicos) > 0): ?>
        <h2>Pedir una cita</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="medico">Médico:</label>
            <select name="medico" id="medico">
                <?php while ($medico = mysqli_fetch_assoc($resultado_medicos)): ?>
                    <option value="<?php echo htmlspecialchars($medico['id_medico']); ?>"><?php echo htmlspecialchars($medico['nombre'] . ' (' . $medico['especialidad'] . ')'); ?></option>
                <?php endwhile; ?>
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
