<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - APrint</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container">
        <h2>Inicio de Sesión</h2>
        <form action="home.php" method="POST">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" maxlength="20" required>

            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave" maxlength="32" required>

            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>
