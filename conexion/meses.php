<?php
// Configuración de la conexión a la base de datos
$host = 'localhost'; // Cambia esto si es necesario
$db = 'ejemplo'; // Nombre de la base de datos
$user = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña de la base de datos (si aplica)

// Crear conexión
$conn = new mysqli($host, $user, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para insertar datos desde la tabla empleado a prueba_insercion
$sql = "INSERT INTO pruebainsercion (indice, meta, tolerancia, reales)
        SELECT indice, meta, tolerancia, reales FROM empleado";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Datos transferidos correctamente a la tabla prueba_insercion.";
} else {
    echo "Error al transferir datos: " . $conn->error;
}

// Consulta SQL para actualizar datos en prueba_insercion basados en empleado
$sql = "UPDATE pruebainsercion AS p
        INNER JOIN empleado AS e ON p.indice = e.indice
        SET p.meta = e.meta,
            p.tolerancia = e.tolerancia,
            p.reales = e.reales";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Datos actualizados correctamente en la tabla prueba_insercion.";
} else {
    echo "Error al actualizar datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
