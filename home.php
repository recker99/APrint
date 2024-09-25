<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexion = new mysqli('localhost', 'root', '', 'aprint');

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Verificar que las claves 'usuario' y 'clave' existen en el POST
    // la credenciales para ingresar son: usuario: fcarvalho, password: password123
    if (isset($_POST['usuario']) && isset($_POST['clave'])) {
        $usuario = $_POST['usuario'];
        $clave = md5($_POST['clave']); // Cifrado MD5 de la contraseña

        // Consulta segura utilizando sentencias preparadas para evitar SQL Injection
        $stmt = $conexion->prepare("SELECT * FROM trabajador WHERE usuario = ? AND clave = ?");
        $stmt->bind_param('ss', $usuario, $clave);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            session_start();
            $fila = $resultado->fetch_assoc();
            $_SESSION['nombre'] = $fila['nombre'];
        } else {
            $error = "Usuario no existe.";
        }
            $stmt->close();
        } else {
            $error = "Error: No se enviaron los datos correctamente.";
        }
            $conexion->close();
        } else {
            $error = "Acceso no permitido.";
        }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - APrint</title>
    <link rel="stylesheet" href="./css/estilos.css">
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['nombre'])): ?>
            <h2 class="center-text">Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</h2>
            <p class="center-text">Estamos contentos de verte nuevamente.</p>
            <a href="logout.php" class="btn">Cerrar Sesión</a>
        <?php else: ?>
            <h2 class="center-text">Error</h2>
            <p class="center-text"><?php echo isset($error) ? htmlspecialchars($error) : 'Ha ocurrido un error inesperado.'; ?></p>
            <a href="login.php" class="btn">Volver</a>
        <?php endif; ?>
    </div>
</body>
</html>