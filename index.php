<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambulatorio - Bienvenida</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .bienvenida {
            text-align: center;
            padding: 50px;
            background-color: #f2f2f2;
        }

        .login {
            display: none;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="bienvenida">
        <h1>Bienvenido al Ambulatorio</h1>
        <p>Accede a tu cuenta para continuar.</p>
        <button onclick="mostrarLogin()">Iniciar Sesión</button>
    </div>

    <div id="login" class="login">
        <!-- Contenido del formulario de login -->
        <form action="procesar_login.php" method="post">
            <!-- Agrega aquí tus campos de usuario y contraseña -->
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>

    <script>
        function mostrarLogin() {
            var loginDiv = document.getElementById('login');
            loginDiv.style.display = 'block';
        }
    </script>
</body>
</html>
