<?php
// Configuración de la conexión
$servername = "localhost";
$username = "root";
$password = ""; // Cambia si tienes otra contraseña
$dbname = "ejemplo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos de varias tablas
$sql = "SELECT a.indice, a.meta, a.tolerancia, a.reales, 
               c.meta AS meta_chenalho, c.tolerancia AS tolerancia_chenalho, c.reales AS reales_chenalho, 
               o.meta AS meta_comalapa, o.tolerancia AS tolerancia_comalapa, o.reales AS reales_comalapa, 
               b.meta AS meta_comitam, b.tolerancia AS tolerancia_comitam, b.reales AS reales_comitam, 
               d.meta AS meta_empleado, d.tolerancia AS tolerancia_empleado, d.reales AS reales_empleado, 
               e.meta AS meta_margaritas, e.tolerancia AS tolerancia_margaritas, e.reales AS reales_margaritas, 
               f.meta AS meta_ocosingo, f.tolerancia AS tolerancia_ocosingo, f.reales AS reales_ocosingo, 
               g.meta AS meta_teopisca, g.tolerancia AS tolerancia_teopisca, g.reales AS reales_teopisca, 
               h.meta AS meta_vcarranza, h.tolerancia AS tolerancia_vcarranza, h.reales AS reales_vcarranza, 
               i.meta AS meta_yajalon, i.tolerancia AS tolerancia_yajalon, i.reales AS reales_yajalon
        FROM acala a 
        INNER JOIN chenalho c ON a.id = c.id
        INNER JOIN comalapa o ON a.id = o.id
        INNER JOIN comitam b ON a.id = b.id
        INNER JOIN empleado d ON a.id = d.id
        INNER JOIN margaritas e ON a.id = e.id
        INNER JOIN ocosingo f ON a.id = f.id
        INNER JOIN teopisca g ON a.id = g.id
        INNER JOIN vcarranza h ON a.id = h.id
        INNER JOIN yajalon i ON a.id = i.id";

// Ejecutar la consulta
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los datos de cada fila
    echo "<table border='1'>
            <tr>
                <th>Indice</th>
                <th>Meta Acala</th>
                <th>Tolerancia Acala</th>
                <th>Reales Acala</th>
                <th>Meta Chenalho</th>
                <th>Tolerancia Chenalho</th>
                <th>Reales Chenalho</th>
                <th>Meta Comalapa</th>
                <th>Tolerancia Comalapa</th>
                <th>Reales Comalapa</th>
                <th>Meta Comitam</th>
                <th>Tolerancia Comitam</th>
                <th>Reales Comitam</th>
                <th>Meta Empleado</th>
                <th>Tolerancia Empleado</th>
                <th>Reales Empleado</th>
                <th>Meta Margaritas</th>
                <th>Tolerancia Margaritas</th>
                <th>Reales Margaritas</th>
                <th>Meta Ocosingo</th>
                <th>Tolerancia Ocosingo</th>
                <th>Reales Ocosingo</th>
                <th>Meta Teopisca</th>
                <th>Tolerancia Teopisca</th>
                <th>Reales Teopisca</th>
                <th>Meta VCarranza</th>
                <th>Tolerancia VCarranza</th>
                <th>Reales VCarranza</th>
                <th>Meta Yajalon</th>
                <th>Tolerancia Yajalon</th>
                <th>Reales Yajalon</th>
            </tr>";

    // Recorrer y mostrar los datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["indice"] . "</td>
                <td>" . $row["meta"] . "</td>
                <td>" . $row["tolerancia"] . "</td>
                <td>" . $row["reales"] . "</td>
                <td>" . $row["meta_chenalho"] . "</td>
                <td>" . $row["tolerancia_chenalho"] . "</td>
                <td>" . $row["reales_chenalho"] . "</td>
                <td>" . $row["meta_comalapa"] . "</td>
                <td>" . $row["tolerancia_comalapa"] . "</td>
                <td>" . $row["reales_comalapa"] . "</td>
                <td>" . $row["meta_comitam"] . "</td>
                <td>" . $row["tolerancia_comitam"] . "</td>
                <td>" . $row["reales_comitam"] . "</td>
                <td>" . $row["meta_empleado"] . "</td>
                <td>" . $row["tolerancia_empleado"] . "</td>
                <td>" . $row["reales_empleado"] . "</td>
                <td>" . $row["meta_margaritas"] . "</td>
                <td>" . $row["tolerancia_margaritas"] . "</td>
                <td>" . $row["reales_margaritas"] . "</td>
                <td>" . $row["meta_ocosingo"] . "</td>
                <td>" . $row["tolerancia_ocosingo"] . "</td>
                <td>" . $row["reales_ocosingo"] . "</td>
                <td>" . $row["meta_teopisca"] . "</td>
                <td>" . $row["tolerancia_teopisca"] . "</td>
                <td>" . $row["reales_teopisca"] . "</td>
                <td>" . $row["meta_vcarranza"] . "</td>
                <td>" . $row["tolerancia_vcarranza"] . "</td>
                <td>" . $row["reales_vcarranza"] . "</td>
                <td>" . $row["meta_yajalon"] . "</td>
                <td>" . $row["tolerancia_yajalon"] . "</td>
                <td>" . $row["reales_yajalon"] . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

// Cerrar conexión
$conn->close();
?>
