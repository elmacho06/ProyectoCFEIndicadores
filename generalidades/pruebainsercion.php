<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Cambia si tienes un password para tu base de datos
$dbname = "ejemplo"; // Cambia por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializar mensaje
$message = "";

// Actualizar contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_password'])) {
    $user_id = $_POST['user_id'];
    $new_password = $_POST['new_password'];

    // Validar que se haya seleccionado un usuario y proporcionado una contraseña
    if (!empty($user_id) && !empty($new_password)) {
        // Encriptar la nueva contraseña
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Consulta para actualizar la contraseña
        $update_sql = "UPDATE usuarios SET password='$hashed_password' WHERE id=$user_id";
        if ($conn->query($update_sql) === TRUE) {
            $message = "Contraseña actualizada exitosamente.";
        } else {
            $message = "Error al actualizar: " . $conn->error;
        }
    } else {
        $message = "Por favor, selecciona un usuario y proporciona una nueva contraseña.";
    }
}
    
// Consulta para obtener todos los usuarios
$sql = "SELECT id, username, password FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Contraseña</title>

    <!-- Incluir Font Awesome para los íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        /* Estilo del fondo */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../imagenes/loginl.jpeg'); /* Fondo de imagen */
            background-size: cover; /* Asegura que la imagen cubra toda la pantalla */
            background-position: center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que el fondo permanezca fijo al desplazarse */
        }

        h1 {
            text-align: center;
            color: white; /* Cambié el color a blanco para hacerlo más visible */
            background-color: rgba(0, 123, 255, 0.7); /* Fondo semi-transparente azul */
            padding: 15px 0;
            border-radius: 8px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6); /* Sombra de texto para resaltar */
            margin-top: 20px;
            font-size: 2rem; /* Aumenté el tamaño de la fuente */
        }

        form {
            width: 450px;
            margin: 50px auto;
            background: linear-gradient(135deg, #ff7e5f, #feb47b, #6a11cb, #2575fc); /* Degradado colorido en el panel */
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-out; /* Animación al cargar */
        }

        select, input, button {
            width: 100%;
            padding: 12px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            color: green;
            font-weight: bold;
        }

        /* Estilos para la animación de carga */
        .spinner {
            display: none;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #007BFF;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
            margin: 0 auto;
        }

        .success-icon {
            display: none;
            font-size: 50px;
            color: #28a745;
            text-align: center;
            margin-top: 20px;
        }

        /* Animación de giro */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Animación para fade in del formulario */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Estilo para el campo de contraseña con ícono */
        .password-container {
            position: relative;
            width: 100%;
        }

        .password-container input {
            padding-left: 35px; /* Espacio para el ícono */
        }

        .password-container i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #ccc;
            cursor: pointer;
        }

        /* Estilo para el ícono de ojo */
        .password-container i:hover {
            color: #007BFF;
        }
    </style>
</head>
<body>

<h1>Actualizar Contraseña</h1>

<!-- Mensaje de resultado -->
<?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

<form method="POST" action="" onsubmit="showLoading()">
    <label for="user_id">Selecciona un usuario:</label>
    <select name="user_id" id="user_id" required>
        <option value="">-- Seleccionar --</option>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['username']) . "</option>";
            }
        }
        ?>
    </select>

    <label for="new_password">Nueva Contraseña:</label>
    <div class="password-container">
        <i class="fas fa-eye" id="togglePassword" onclick="togglePassword()"></i> <!-- Ícono de ojo -->
        <input type="password" name="new_password" id="new_password" placeholder="Nueva contraseña" required>
    </div>

    <button type="submit" name="update_password">Actualizar Contraseña</button>
</form>

<!-- Animación de carga y éxito -->
<div id="spinner" class="spinner"></div>
<div id="successIcon" class="success-icon">&#10004;</div>

<script>
    // Función para mostrar la animación de carga
    function showLoading() {
        document.getElementById("spinner").style.display = "block";  // Muestra el spinner
        document.getElementById("successIcon").style.display = "none";  // Asegura que la palomita no se muestre
    }

    // Función para mostrar la palomita de éxito
    function showSuccess() {
        document.getElementById("spinner").style.display = "none";  // Oculta el spinner
        document.getElementById("successIcon").style.display = "block";  // Muestra la palomita
    }

    // Mostrar la palomita si la contraseña se actualizó exitosamente
    <?php if ($message == "Contraseña actualizada exitosamente."): ?>
        showSuccess();
    <?php endif; ?>

    // Función para alternar entre mostrar y ocultar la contraseña
    function togglePassword() {
        var passwordField = document.getElementById("new_password");
        var eyeIcon = document.getElementById("togglePassword");

        if (passwordField.type === "password") {
            passwordField.type = "text"; // Mostrar contraseña
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash"); // Cambiar ícono a ojo tachado
        } else {
            passwordField.type = "password"; // Ocultar contraseña
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye"); // Cambiar ícono a ojo normal
        }
    }
</script>

</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>
