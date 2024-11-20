<?php
// db_conect.php

$servername = "localhost"; // o el servidor de tu base de datos
$username = "root"; // o el usuario de tu base de datos
$password = ""; // o la contraseña de tu base de datos
$dbname = "ejemplo"; // cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}



?>
