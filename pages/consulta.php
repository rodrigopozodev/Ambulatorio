<?php
include '../php/conecta.php';
include '../php/consultas.php';

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos de medicación del formulario (ajusta según tus campos de formulario)
    $medicacion = $_POST["medicacion"];

    // Realizar la inserción en la base de datos utilizando $medicacion
    // Aquí debes agregar la lógica para insertar los datos en la base de datos
    // ...
    // Puedes usar la función que tengas para registrar la consulta, por ejemplo:
    // registrarConsulta($conexion, $idConsulta, $sintomatologia, $diagnostico, $medicacion, $pdf);
    // ...

    // Puedes enviar una respuesta JSON al cliente si es necesario
    $respuesta = ["mensaje" => "Datos de medicación recibidos y registrados correctamente"];
    echo json_encode($respuesta);
    exit;
}

// Asegúrate de tener las funciones necesarias en consultas.php

$id_consulta = $_GET['id_consulta'] ?? 1; // Cambia 'id_consulta' según tu estructura de URL

// Obtener información de la consulta (por ejemplo, paciente, médico, fecha)
$informacionConsulta = obtenerInformacionConsulta($conexion, $id_consulta);

// Obtener información editable de la consulta
$informacionEditable = obtenerInformacionEditable($conexion, $id_consulta);

// Obtener lista de medicamentos
$medicamentos = obtenerMedicamentos($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Médica</title>
    <link rel="stylesheet" href="../css/.css">
    <!-- Agrega cualquier otro enlace a archivos CSS que necesites -->
</head>
<body class="consulta-body">
<a href="../index.html" class="boton-volver">Volver al Inicio</a>
    <div class="container">
        <h1>Consulta Médica</h1>

        <!-- Información no editable -->
        <?php if ($informacionConsulta): ?>
            <div class="info-no-editable">
                <p>Médico: <?php echo htmlspecialchars($informacionConsulta['nombre_medico']); ?></p>
                <p>Paciente: <?php echo htmlspecialchars($informacionConsulta['nombre_paciente']); ?></p>
                <p>Fecha: <?php echo htmlspecialchars($informacionConsulta['fecha']); ?></p>
            </div>
        <?php else: ?>
            <p class="error-message">No se pudo obtener la información de la consulta.</p>
        <?php endif; ?>

        <!-- Información editable -->
        <?php if ($informacionEditable): ?>
            <div class="info-editable">
                <?php while ($filaEditable = mysqli_fetch_assoc($informacionEditable)): ?>
                    <label for="sintomas">Sintomatología:</label>
                    <textarea id="sintomas" name="sintomas"><?php echo htmlspecialchars($filaEditable['sintomatologia']); ?></textarea>

                    <label for="diagnostico">Diagnóstico:</label>
                    <textarea id="diagnostico" name="diagnostico"><?php echo htmlspecialchars($filaEditable['diagnostico']); ?></textarea>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="error-message">No se pudo obtener la información editable de la consulta.</p>
        <?php endif; ?>

        <!-- Sección de medicación -->
        <div class="medicacion-container">
            <h2>Medicación</h2>
            <!-- Lista de medicamentos -->
            <label for="medicamento">Medicamento:</label>
            <select id="medicamento" name="medicamento">
                <?php
                // Asegúrate de haber obtenido los resultados de la consulta de medicamentos
                if (mysqli_num_rows($medicamentos) > 0) {
                    while ($medicamento = mysqli_fetch_assoc($medicamentos)) {
                        echo "<option value='" . htmlspecialchars($medicamento['id_medicamento']) . "'>" . htmlspecialchars($medicamento['nombre']) . "</option>";
                    }

                    // Restablecer el puntero del conjunto de resultados
                    mysqli_data_seek($medicamentos, 0);
                } else {
                    echo "<option value='' disabled>No hay medicamentos disponibles</option>";
                }
                ?>
            </select>

            <!-- Campos de información de medicación -->
            <label for="cantidad">Cantidad:</label>
            <input type="text" id="cantidad" name="cantidad">

            <label for="frecuencia">Frecuencia:</label>
            <input type="text" id="frecuencia" name="frecuencia">

            <label for="dias">Número de días:</label>
            <input type="text" id="dias" name="dias">

            <label for="cronica">Medicación crónica:</label>
            <input type="checkbox" id="cronica" name="cronica">

            <!-- Botón para añadir medicación -->
            <button id="btnAnadirMedicacion" onclick="anadirMedicacion()">Añadir medicación</button>

            <!-- Lista de medicación añadida -->
            <ul id="listaMedicacion"></ul>
        </div>

        <!-- Resto de tu formulario y secciones -->

        <!-- Botón de registrar consulta -->
        <input type="submit" name="registrarConsulta" value="Registrar consulta" class="submit-button" onclick="registrarConsulta()">
    </div>

    <script src="../js/consulta.js"></script>
    <!-- Agrega cualquier otro enlace a archivos JavaScript que necesites -->
</body>
</html>
