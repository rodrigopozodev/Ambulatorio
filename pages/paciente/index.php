<?php
// Conectar a la base de datos (Asegúrate de tener la información correcta)
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "Ambulatorio";

$conexion = new mysqli($servidor, $usuario, $contrasena, $bd);

// Verificar la conexión
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener la información del paciente (Reemplaza 'id_paciente' con el ID del paciente deseado)
$id_paciente = 1; // Cambia esto con el ID del paciente que deseas mostrar
$sql = "SELECT * FROM paciente WHERE id_paciente = ?";
$stmt = $conexion->prepare($sql);

// Verificar si la preparación fue exitosa
if ($stmt) {
    $stmt->bind_param("i", $id_paciente);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página del Paciente</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <header>
    <h1>Información del Paciente</h1>
  </header>

  <section id="informacion-paciente">
    <?php
    if (!empty($row)) {
      echo "<h2>Nombre e información del paciente</h2>";
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
    ?>
  </section>
  <section id="proximas-citas">
    <h2>Próximas citas</h2>
    <!-- Aquí irá la lista de próximas citas -->
  </section>

  <section id="medicacion-actual">
    <h2>Medicación actual</h2>
    <!-- Aquí irá la lista de medicación actual -->
  </section>

  <section id="consultas-pasadas">
    <h2>Consultas pasadas</h2>
    <!-- Aquí irá la lista de consultas pasadas -->
  </section>

  <section id="pedir-cita">
    <h2>Pedir cita</h2>
    <label for="medico">Seleccionar médico:</label>
    <select id="medico">
      <!-- Opciones de médicos -->
    </select>

    <label for="fecha">Seleccionar fecha:</label>
    <input type="date" id="fecha">

    <label for="sintomas">Sintomatología (opcional):</label>
    <textarea id="sintomas" rows="4"></textarea>

    <button onclick="pedirCita()">Pedir Cita</button>
  </section>

  <script src="scripts.js"></script>
</body>
</html>


<?php
    } else {
        echo "No se encontró información del paciente.";
    }

    $stmt->close();
} else {
    echo "Error en la preparación de la consulta.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
