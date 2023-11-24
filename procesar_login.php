<?php
include('usuarios.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $tipoUsuario = $_POST['tipoUsuario'];

    // Verificar las credenciales
    if (isset($usuarios[$usuario]) && $usuarios[$usuario]['contrasena'] === $contrasena && $usuarios[$usuario]['tipo'] === $tipoUsuario) {
        // Credenciales correctas, redireccionar según el tipo de usuario
        if ($tipoUsuario === 'medico') {
            header('Location: pages/medico/index.html');
            exit;
        } elseif ($tipoUsuario === 'paciente') {
            header('Location: pages/paciente/index.html');
            exit;
        }
    } else {
        // Credenciales incorrectas, redireccionar a la página de inicio de sesión con un mensaje de error
        header('Location: index.php?error=1');
        exit;
    }
}
?>
