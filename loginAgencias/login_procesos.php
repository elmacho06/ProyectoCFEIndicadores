<?php
session_start(); // Iniciar sesión

// Conectar a la base de datos
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "ejemplo";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el usuario y contraseña enviados por el formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consultar el usuario en la base de datos
$sql = "SELECT * FROM usuarios WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['password'];
    $rol = $row['rol'];

    // Verificar la contraseña ingresada con la encriptada en la base de datos
    if (password_verify($password, $storedPassword)) {
        // Contraseña correcta, iniciar sesión
        $_SESSION['username'] = $username;
        $_SESSION['rol'] = $rol;
        $_SESSION['welcome_message'] = "¡Bienvenido, $username!"; // Mensaje de bienvenida

        // Redirigir según el rol
        if ($rol === 'administrador') {
            header('Location: ../loginAgencias/home.php');
        } elseif ($rol === 'agencia') {
            // Redirigir según la agencia correspondiente
            switch ($username) {
                case 'comitan':
                    header('Location: ../VMensualComitan/HomeComitan.php');
                    break;
                case 'margaritas':
                    header('Location: ../VMensualMargaritas/HomeMargaritas.php');
                    break;
                case 'ocosingo':
                    header('Location: ../VMensualOcosingo/HomeOcosingo.php');
                    break;
                case 'comalapa':
                    header('Location: ../VMensualComalapa/HomeComalapa.php');
                    break;
                case 'teopisca':
                    header('Location: ../VMensualTeopisca/HomeTeopisca.php');
                    break;
                case 'chenalho':
                    header('Location: ../VMensualChenalho/HomeChenalho.php');
                    break;
                case 'yajalon':
                    header('Location: ../VMensualYajalon/HomeYajalon.php');
                    break;
                case 'acala':
                    header('Location: ../VMensualAcala/HomeAcala.php');
                    break;
                case 'zonaSC':
                    header('Location: ../VMensualSanCristobal/HomeSC.php');
                    break;
                case 'carranza':
                    header('Location: ../VMensualCarranza/HomeCarranza.php');
                    break;
            }
        }
        exit();
    } else {
        // Contraseña incorrecta
        echo "<p>Contraseña incorrecta. Serás redirigido en 3 segundos...</p>";
        echo "<meta http-equiv='refresh' content='3;url=login.html'>";
    }
} else {
    // Usuario no encontrado
    echo "<p>Usuario no encontrado. Serás redirigido en 3 segundos...</p>";
    echo "<meta http-equiv='refresh' content='3;url=login.html'>";
}

$conn->close();
?>
