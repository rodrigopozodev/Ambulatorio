<?php
// Conectar a la base de datos
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "Ambulatorio";

$conexion = new mysqli($servidor, $usuario, $contrasena, $bd);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener la lista de pacientes para el desplegable
$sql_pacientes = "SELECT id_paciente, nombre FROM paciente";
$result_pacientes = $conexion->query($sql_pacientes);

// Verificar si la consulta fue exitosa
if ($result_pacientes) {
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página del Paciente</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>

<header>
    <h1>Información del Paciente</h1>
</header>

<section id="seleccionar-paciente">
    <label for="select-paciente">Seleccionar paciente:</label>
    <select id="select-paciente" onchange="cambiarPaciente()">
        <?php
        while ($row_paciente = $result_pacientes->fetch_assoc()) {
            $selected = isset($_GET['id_paciente']) && $_GET['id_paciente'] == $row_paciente['id_paciente'] ? 'selected' : '';
            echo "<option value='{$row_paciente['id_paciente']}' $selected>{$row_paciente['nombre']}</option>";
        }
        ?>
    </select>
</section>

<section id="informacion-paciente">
    <?php
    // Obtener el ID del paciente seleccionado del desplegable
    $id_paciente_seleccionado = isset($_GET['id_paciente']) ? $_GET['id_paciente'] : 1;

    // Consulta para obtener la información del paciente
    $sql = "SELECT * FROM paciente WHERE id_paciente = ?";
    $stmt = $conexion->prepare($sql);

    // Verificar si la preparación fue exitosa
    if ($stmt) {
        $stmt->bind_param("i", $id_paciente_seleccionado);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h2>Información del paciente</h2>";
            echo "<ul>";
            echo "<li><strong>Nombre:</strong> {$row['nombre']}</li>";
            echo "<li><strong>Apellidos:</strong> {$row['apellidos']}</li>";
            echo "<li><strong>DNI:</strong> {$row['dni']}</li>";
            echo "<li><strong>Género:</strong> {$row['genero']}</li>";
            echo "<li><strong>Fecha de Nacimiento:</strong> {$row['fecha_nac']}</li>";
            echo "</ul>";
        } else {
            echo "No se encontró información del paciente.";
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta.";
    }
    ?>
</section>

<section id="proximas-citas">
    <h2>Próximas citas</h2>
    <?php
    // Consulta para obtener las próximas citas
    $sql_citas = "SELECT c.id_cita, m.nombre as nombre_medico, c.fecha_cita
              FROM citas c
              JOIN medico m ON c.id_medico = m.id_medico
              WHERE c.id_paciente = ? AND c.fecha_cita >= CURDATE()
              ORDER BY c.fecha_cita ASC";

    // Verificar si la preparación fue exitosa
    if ($stmt_citas) {
        $stmt_citas->bind_param("i", $id_paciente_seleccionado);
        $stmt_citas->execute();
        $result_citas = $stmt_citas->get_result();

        if ($result_citas->num_rows > 0) {
            echo "<ul>";
            while ($row_cita = $result_citas->fetch_assoc()) {
                echo "<li>ID Cita: {$row_cita['id_cita']}, Médico: {$row_cita['nombre_medico']}, Fecha: {$row_cita['fecha_cita']}</li>";
            }
            echo "</ul>";
        } else {
            echo "No hay próximas citas programadas.";
        }

        $stmt_citas->close();
    } else {
        echo "Error en la preparación de la consulta de citas.";
    }
    ?>
  </section>

  <section id="medicacion-actual">
    <h2>Medicación actual</h2>
    <?php
    // Consulta para obtener la medicación actual del paciente
    $sql_medicacion = "SELECT r.posologia, r.fecha_fin, m.nombre as nombre_medicamento
                       FROM receta r
                       JOIN medicamento m ON r.id_medicamento = m.id_medicamento
                       JOIN consulta c ON r.id_consulta = c.id_consulta
                       WHERE c.id_paciente = ?";
    $stmt_medicacion = $conexion->prepare($sql_medicacion);

    // Verificar si la preparación fue exitosa
    if ($stmt_medicacion) {
        $stmt_medicacion->bind_param("i", $id_paciente_seleccionado);
        $stmt_medicacion->execute();
        $result_medicacion = $stmt_medicacion->get_result();

        if ($result_medicacion->num_rows > 0) {
            echo "<ul>";
            while ($row_medicacion = $result_medicacion->fetch_assoc()) {
                echo "<li>Medicamento: {$row_medicacion['nombre_medicamento']}, Posología: {$row_medicacion['posologia']}, Fecha Fin: {$row_medicacion['fecha_fin']}</li>";
            }
            echo "</ul>";
        } else {
            echo "No hay medicación actual registrada.";
        }

        $stmt_medicacion->close();
    } else {
        echo "Error en la preparación de la consulta de medicación.";
    }
    ?>
  </section>

  <section id="consultas-pasadas">
    <h2>Consultas pasadas</h2>

    <?php
    // Consulta para obtener las consultas pasadas del paciente seleccionado
    $sql_consultas = "SELECT c.id_consulta, m.nombre as nombre_medico, c.fecha_consulta
                      FROM consulta c
                      JOIN medico m ON c.id_medico = m.id_medico
                      WHERE c.id_paciente = ?
                      ORDER BY c.fecha_consulta DESC, c.id_consulta DESC"; // Cambiando el orden de la fecha y el ID
    $stmt_consultas = $conexion->prepare($sql_consultas);

    // Verificar si la preparación fue exitosa
    if ($stmt_consultas) {
        $stmt_consultas->bind_param("i", $id_paciente_seleccionado);
        $stmt_consultas->execute();
        $result_consultas = $stmt_consultas->get_result();

        if ($result_consultas->num_rows > 0) {
            echo "<ul>";
            while ($row_consulta = $result_consultas->fetch_assoc()) {
                echo "<li><a href='javascript:void(0);' onclick='mostrarConsulta({$row_consulta['id_consulta']})'>Médico: {$row_consulta['nombre_medico']}, Fecha: {$row_consulta['fecha_consulta']}</a></li>";
            }
            echo "</ul>";
        } else {
            echo "No hay consultas pasadas registradas para este paciente.";
        }

        $stmt_consultas->close();
    } else {
        echo "Error en la preparación de la consulta de consultas pasadas.";
    }
    ?>

</section>

</section>

<<section id="pedir-cita">
    <h2>Pedir cita</h2>
    <form method="post" action="">
        <label for="selectMedico">Seleccionar médico:</label>
        <select id="selectMedico" name="selectMedico">
            <?php
            // Consulta para obtener la lista de médicos
            $sql_medicos = "SELECT id_medico, nombre, especialidad FROM medico";
            $result_medicos = $conexion->query($sql_medicos);

            if ($result_medicos->num_rows > 0) {
                while ($row_medico = $result_medicos->fetch_assoc()) {
                    echo "<option value='{$row_medico['id_medico']}'>{$row_medico['nombre']} - {$row_medico['especialidad']}</option>";
                }
            }
            ?>
        </select>

        <label for="fecha">Seleccionar fecha:</label>
        <input type="date" id="fecha" name="fecha">

        <label for="sintomas">Sintomatología (opcional):</label>
        <textarea id="sintomas" name="sintomas" rows="4"></textarea>

        <button type="submit">Pedir Cita</button>
    </form>
</section>

<div id="info-consulta">
    <!-- Aquí se mostrará la información de la consulta seleccionada -->
</div>

<script src="script.js"></script>
</body>
</html>

<?php
} else {
    echo "Error al obtener la lista de pacientes.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
