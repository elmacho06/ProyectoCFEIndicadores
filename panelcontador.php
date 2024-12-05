<?php
// Configuración de la base de datos
$host = "localhost"; // o el host de tu servidor de base de datos
$username = "root";  // tu usuario de MySQL
$password = "";      // tu contraseña de MySQL
$dbname = "ejemplo"; // nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $username, $password, $dbname);

// Comprobar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL
$sql = "SELECT 
            a.indice, 
            a.meta AS acala_meta, 
            a.tolerancia AS acala_tolerancia, 
            a.reales AS acala_reales,
            (a.reales - a.meta) AS diferencia
        FROM acala a
        LIMIT 1 OFFSET 0";

// Ejecutar la consulta
$result = $conn->query($sql);

// Comprobar si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en una tabla HTML
    echo "<table border='1'>
            <tr>
                <th>Índice</th>
                <th>Meta</th>
                <th>Tolerancia</th>
                <th>Reales</th>
                <th>Diferencia (Reales - Meta)</th>
            </tr>";
    
    // Mostrar cada fila
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["indice"] . "</td>
                <td>" . $row["acala_meta"] . "</td>
                <td>" . $row["acala_tolerancia"] . "</td>
                <td>" . $row["acala_reales"] . "</td>
                <td>" . $row["diferencia"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}

// Cerrar la conexión
$conn->close();
?>
