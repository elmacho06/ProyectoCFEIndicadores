<?php
// update_data.php

// Incluir el archivo de conexión
include 'db_conect.php';

// Obtener los datos del POST
$indice = $_POST['indice'];
$campo = $_POST['campo'];
$valor = $_POST['valor'];

// Sanitizar la entrada
$indice = $conn->real_escape_string($indice);
$campo = $conn->real_escape_string($campo);
$valor = strval($valor);

// Generar la consulta SQL
$sql = "UPDATE comalapa SET $campo = ? WHERE indice = ?";

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $valor, $indice);

if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();



// Cerrar conexión
$conn->close();

?>
