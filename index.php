<?php
// Incluir el archivo de funciones
include 'classes/funciones.php';

// Comprobar si se ha enviado el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aquí puedes agregar la lógica para procesar el formulario de inicio de sesión
    // y determinar si el usuario es paciente o médico.
    // Luego, puedes redirigir al usuario a la página correspondiente.
    $usuario = $_POST['usuario'];  // Supongamos que tienes un campo "usuario" en el formulario

    if ($usuario === 'paciente') {
        header('Location: paciente/index.html');
        exit;
    } elseif ($usuario === 'medico') {
        header('Location: medico/index.html');
        exit;
    } else {
        $error = "Usuario no reconocido";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
    <h1>Inicio de Sesión</h1>

    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="usuario">Tipo de usuario:</label>
        <select name="usuario" id="usuario">
            <option value="paciente">Paciente</option>
            <option value="medico">Médico</option>
        </select>
        <br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
