
<?php
// Iniciar sesión
session_start();

// Obtener el mensaje de la sesión
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';

// Limpiar el mensaje después de mostrarlo
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Mensajes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .message {
            text-align: center;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>Panel de Mensajes</h1>

<!-- Mostrar mensaje si está disponible -->
<?php if (!empty($message)): ?>
    <p class="message"><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<a href="pruebainsercion.php">Volver a actualizar contraseña</a>

</body>
</html>
