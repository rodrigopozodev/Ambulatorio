<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    // Verificar las credenciales (solo como ejemplo, debes hacer esto de manera segura)
    if ($nombre === 'medico' && $contrasena === '1234') {
        // Redireccionar al index de medico si las credenciales son correctas
        header('Location: medico/index.html');
        exit;
    } else {
        // Credenciales incorrectas, puedes mostrar un mensaje de error o redirigir a otra página
        echo 'Credenciales incorrectas';
    }
}
?>
