<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambulatorio - Bienvenida</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilos adicionales aquí si es necesario */
    </style>
</head>
<body>
    <div class="bienvenida">
        <h1>Ambulatorio XYZ</h1>
        <p>Bienvenido al Ambulatorio XYZ. Accede a tu cuenta para continuar.</p>
        <button class="boton-login" onclick="mostrarLogin()">Iniciar Sesión</button>
    </div>

    <div id="modal" class="modal">
        <div class="login">
            <span class="close" onclick="cerrarLogin()">&times;</span>
            <h2>Iniciar Sesión</h2>
            <form id="loginForm" action="procesar_login.php" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <br>
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
                <br>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>

    <div id="modalLogin" class="modal">
        <div class="login">
            <span class="close" onclick="cerrarLogin()">&times;</span>
            <form action="procesar_login.php" method="post" onsubmit="return validarFormulario()">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>

                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>

                <label for="tipoUsuario">Selecciona tu tipo de usuario:</label>
                <select id="tipoUsuario" name="tipoUsuario">
                    <option value="medico">Médico</option>
                    <option value="paciente">Paciente</option>
                </select>

                <button type="submit">Iniciar Sesión</button>

                <div id="mensajeError" class="mensaje-error"></div>
            </form>
        </div>
    </div>

    <div class="footer">
        &copy; 2023 Ambulatorio XYZ. Todos los derechos reservados.
    </div>

    <script src="script.js"></script>
    <script>
        function mostrarLogin() {
            var modal = document.getElementById('modal');
            modal.style.display = 'flex';
        }

        function cerrarLogin() {
            var modal = document.getElementById('modal');
            modal.style.display = 'none';
        }

        function validarFormulario() {
            var usuario = document.getElementById('usuario').value;
            var contrasena = document.getElementById('contrasena').value;

            if (usuario.trim() === '' || contrasena.trim() === '') {
                document.getElementById('mensajeError').innerText = 'Todos los campos son obligatorios';
                return false;
            } else {
                document.getElementById('mensajeError').innerText = '';
                return true;
            }
        }
    </script>
</body>
</html>
