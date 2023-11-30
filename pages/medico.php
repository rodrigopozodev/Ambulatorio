<?php
include '../php/conecta.php';
include '../php/consultas.php';

$id_medico_seleccionado = $_POST['id_medico'] ?? 1;

$resultado_medicos = obtener_medicos($conexion);
$resultado_medico = obtener_info_medico($conexion, $id_medico_seleccionado);
$num_consultas_proximos_7_dias = obtener_num_consultas_proximos_7_dias($conexion, $id_medico_seleccionado);
$consultas_hoy = obtener_consultas_hoy($conexion, $id_medico_seleccionado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Médico</title>
    <link rel="stylesheet" href="../css/paginas.css">
</head>
<body class="paciente-body">
    <div class="container">
        <h1>Información del Médico</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-container">
            <label for="medico">Selecciona un médico:</label>
            <select name="id_medico" id="id_medico" class="select-medico">
                <?php while ($fila = mysqli_fetch_assoc($resultado_medicos)): ?>
                    <option value="<?php echo htmlspecialchars($fila['id_medico']); ?>" <?php echo ($fila['id_medico'] == $id_medico_seleccionado) ? 'selected' : ''; ?>><?php echo htmlspecialchars($fila['nombre'] . ' (' . $fila['especialidad'] . ')'); ?></option>
                <?php endwhile; ?>
            </select>
            <input type="submit" value="Seleccionar médico" class="submit-button">
        </form>

        <?php if ($resultado_medico && mysqli_num_rows($resultado_medico) > 0): ?>
            <div class="info-container">
                <h2>Perfil Médico</h2>
                <?php $datos_medico = mysqli_fetch_assoc($resultado_medico); ?>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($datos_medico['nombre']); ?></p>
                <p><strong>Especialidad:</strong> <?php echo htmlspecialchars($datos_medico['especialidad']); ?></p>
            </div>

            <div class="num-consultas-container">
                <h2>Consultas Próximos 7 Días</h2>
                <p><?php echo htmlspecialchars($num_consultas_proximos_7_dias); ?> consultas</p>
            </div>

            <?php if ($consultas_hoy && mysqli_num_rows($consultas_hoy) > 0): ?>
                <div class="consultas-hoy-container">
                    <h2>Consultas de Hoy</h2>
                    <ul>
                        <?php while ($consulta_hoy = mysqli_fetch_assoc($consultas_hoy)): ?>
                            <li>
                                <p><strong>ID Consulta:</strong> <?php echo htmlspecialchars($consulta_hoy['id_consulta']); ?></p>
                                <p><strong>ID Paciente:</strong> <?php echo htmlspecialchars($consulta_hoy['id_paciente']); ?></p>
                                <p><strong>Extracto Síntomas:</strong> <?php echo htmlspecialchars($consulta_hoy['extracto_sintomas']); ?></p>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php else: ?>
                <p class="no-data-message">No hay consultas hoy.</p>
            <?php endif; ?>

        <?php else: ?>
            <p class="error-message">No se pudo obtener la información del médico.</p>
        <?php endif; ?>
    </div>
</body>
</html>
