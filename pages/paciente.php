<?php
include '../php/conecta.php';
include '../php/consultas.php';

$id_paciente_seleccionado = $_POST['id_paciente'] ?? 1;

$resultado_pacientes = obtener_pacientes($conexion);
$resultado_paciente = obtener_paciente($conexion, $id_paciente_seleccionado);
$resultado_consultas_pasadas = obtener_consultas_pasadas_detalles($conexion, $id_paciente_seleccionado);
$resultado_proximas_citas = obtener_proximas_citas_detalles($conexion, $id_paciente_seleccionado);
$resultado_medicacion = obtener_medicacion_actual($conexion, $id_paciente_seleccionado);
$resultado_medicos_asignados = obtener_medicos_asignados($conexion, $id_paciente_seleccionado);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pedir_cita'])) {
    $id_paciente = $_POST['id_paciente'];
    $id_medico = $_POST['medico'];
    $fecha = $_POST['fecha'];
    $sintomas = $_POST['sintomas'];

    // Validar la fecha
    $hoy = date('Y-m-d');
    $limite_dias = date('Y-m-d', strtotime($hoy . ' + 30 days'));

    if ($fecha < $hoy) {
        $mensaje_error = "Fecha no válida. Debe ser igual o posterior a hoy.";
    } elseif (date('N', strtotime($fecha)) >= 6) {
        $mensaje_error = "Por favor, elija un día laborable.";
    } elseif ($fecha > $limite_dias) {
        $mensaje_error = "Tan malo no estarás. Pide una fecha como máximo 30 días en el futuro.";
    } else {
        // Procesar la cita en la base de datos
        $query_insertar_cita = "INSERT INTO consulta (id_paciente, id_medico, fecha_consulta, sintomatologia, diagnostico) VALUES (?, ?, ?, ?, 'Aún no dictaminado')";
        $stmt_insertar_cita = mysqli_prepare($conexion, $query_insertar_cita);
        mysqli_stmt_bind_param($stmt_insertar_cita, "isss", $id_paciente, $id_medico, $fecha, $sintomas);

        if (mysqli_stmt_execute($stmt_insertar_cita)) {
            // Éxito al insertar la cita, redirigir a la misma página para actualizar la información
            header("Location: $_SERVER[PHP_SELF]");
            exit();
        } else {
            $mensaje_error = "Error al procesar la cita. Por favor, inténtalo de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Paciente</title>
    <link rel="stylesheet" href="../css/paginas.css">
    <style>
        #detalles-consulta {
            display: none;
        }

        .error-message {
            color: #e74c3c; /* Color rojo */
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .error-icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }
    </style>
    <script src="../js/paciente.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body class="paciente-body">
    <div class="container">
        <h1>Información del Paciente</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-container">
            <label for="paciente">Selecciona un paciente:</label>
            <select name="id_paciente" id="id_paciente" class="select-paciente">
                <?php while ($fila = mysqli_fetch_assoc($resultado_pacientes)): ?>
                    <option value="<?php echo htmlspecialchars($fila['id_paciente']); ?>" <?php echo ($fila['id_paciente'] == $id_paciente_seleccionado) ? 'selected' : ''; ?>><?php echo htmlspecialchars($fila['nombre']); ?></option>
                <?php endwhile; ?>
            </select>
            <input type="submit" value="Seleccionar paciente" class="submit-button">
        </form>

        <?php
        $resultado_paciente = obtener_paciente($conexion, $id_paciente_seleccionado);
        ?>

        <?php if ($resultado_paciente && mysqli_num_rows($resultado_paciente) > 0): ?>
            <div class="profile-container">
                <h2>Perfil Paciente</h2>
                <?php $datos_paciente = mysqli_fetch_assoc($resultado_paciente); ?>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($datos_paciente['nombre']); ?></p>
                <p><strong>Apellidos:</strong> <?php echo htmlspecialchars($datos_paciente['apellidos']); ?></p>
                <p><strong>DNI:</strong> <?php echo htmlspecialchars($datos_paciente['dni']); ?></p>
                <p><strong>Género:</strong> <?php echo htmlspecialchars($datos_paciente['genero']); ?></p>
                <p><strong>Fecha de Nacimiento:</strong> <?php echo htmlspecialchars($datos_paciente['fecha_nac']); ?></p>
            </div>
        <?php else: ?>
            <p class="error-message">No se pudo obtener la información del paciente.</p>
        <?php endif; ?>

        <?php if ($resultado_consultas_pasadas && mysqli_num_rows($resultado_consultas_pasadas) > 0): ?>
            <div class="consultas-container">
                <h2>Consultas Pasadas</h2>
                <?php while ($consulta_pasada = mysqli_fetch_assoc($resultado_consultas_pasadas)): ?>
                    <button class="consulta-button" data-diagnostico="<?php echo htmlspecialchars($consulta_pasada['diagnostico']); ?>" data-sintomatologia="<?php echo htmlspecialchars($consulta_pasada['sintomatologia']); ?>">
                        <?php echo htmlspecialchars($consulta_pasada['id_consulta'] . ' - ' . $consulta_pasada['fecha_consulta']); ?>
                    </button>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="no-data-message">No hay consultas pasadas.</p>
        <?php endif; ?>

        <?php if ($resultado_proximas_citas && mysqli_num_rows($resultado_proximas_citas) > 0): ?>
            <div class="citas-container">
                <h2>Próximas Citas</h2>
                <?php while ($proxima_cita = mysqli_fetch_assoc($resultado_proximas_citas)): ?>
                    <button class="consulta-button" data-diagnostico="<?php echo htmlspecialchars($proxima_cita['diagnostico']); ?>" data-sintomatologia="<?php echo htmlspecialchars($proxima_cita['sintomatologia']); ?>">
                        <?php echo htmlspecialchars($proxima_cita['id_consulta'] . ' - ' . $proxima_cita['fecha_consulta']); ?>
                    </button>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="no-data-message">No hay próximas citas.</p>
        <?php endif; ?>

        <?php if ($resultado_medicacion && mysqli_num_rows($resultado_medicacion) > 0): ?>
            <div class="medicacion-container">
                <h2>Medicación Actual</h2>
                <ul>
                    <?php while ($medicacion = mysqli_fetch_assoc($resultado_medicacion)): ?>
                        <li>
                            <p><strong>Medicamento:</strong> <?php echo htmlspecialchars($medicacion['id_medicamento']); ?></p>
                            <p><strong>Posología:</strong> <?php echo htmlspecialchars($medicacion['posologia']); ?></p>
                            <p><strong>Fecha Fin:</strong> <?php echo htmlspecialchars($medicacion['fecha_fin']); ?></p>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        <?php else: ?>
            <p class="no-data-message">No hay medicación actual.</p>
        <?php endif; ?>

        <?php if ($resultado_medicos_asignados && mysqli_num_rows($resultado_medicos_asignados) > 0): ?>
            <div class="cita-form-container">
                <h2>Pedir una Cita</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-container">
                    <input type="hidden" name="id_paciente" value="<?php echo htmlspecialchars($id_paciente_seleccionado); ?>">
                    <label for="medico">Médico:</label>
                    <select name="medico" id="medicos" class="select-medico">
                        <?php while ($medico = mysqli_fetch_assoc($resultado_medicos_asignados)): ?>
                            <option value="<?php echo htmlspecialchars($medico['id_medico']); ?>"><?php echo htmlspecialchars($medico['nombre'] . ' (' . $medico['especialidad'] . ')'); ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" required class="date-input">
                    <label for="sintomas">Síntomas:</label>
                    <textarea id="sintomas" name="sintomas" class="sintomas-input"></textarea>
                    <input type="submit" name="pedir_cita" value="Pedir cita" class="submit-button">
                </form>
                <?php if (isset($mensaje_error)): ?>
                    <div class="error-message">
                        <img src="../images/advertencia.png" alt="Error Icon" class="error-icon">
                        <p><?php echo htmlspecialchars($mensaje_error); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p class="error-message">No se pudo obtener la información de los médicos asignados.</p>
        <?php endif; ?>
    </div>
</body>
</html>
