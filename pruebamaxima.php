<?php
// Configuración de la conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor es diferente
$username = "root"; // Cambia esto si tu usuario es diferente
$password = ""; // Cambia esto si tu contraseña es diferente
$dbname = "ejemplo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL
$sql = "
    SELECT a.indice, a.reales, c.reales AS chenalho_reales, o.reales AS comalapa_reales, 
           b.reales AS comitam_reales, d.reales AS empleado_reales, 
           e.reales AS margaritas_reales, f.reales AS ocosingo_reales, 
           z.reales AS teopisca_reales, j.reales AS vcarranza_reales, 
           l.reales AS yajalon_reales
    FROM acala a 
    INNER JOIN chenalho c ON a.id = c.id
    INNER JOIN comalapa o ON a.id = o.id
    INNER JOIN comitam b ON a.id = b.id
    INNER JOIN empleado d ON a.id = d.id
    INNER JOIN margaritas e ON a.id = e.id
    INNER JOIN ocosingo f ON a.id = f.id
    INNER JOIN teopisca z ON a.id = z.id
    INNER JOIN vcarranza j ON a.id = j.id
    INNER JOIN yajalon l ON a.id = l.id
    LIMIT 1 OFFSET 0
";

$result = $conn->query($sql);

// Inicializa variables para encontrar el mínimo
$realValues = []; // Inicializar arreglo para los valores reales
$maxValue = PHP_FLOAT_MIN; // Inicializa el valor máximo a un número muy bajo
$maxIndexes = []; // Inicializa un arreglo para los índices de los valores máximos
$row = null; // Inicializa $row fuera del bucle

if ($result->num_rows > 0) {
    // Obtener los valores reales
    $row = $result->fetch_assoc(); // Obtener la primera fila
    $realValues[] = $row['reales'];
    $realValues[] = $row['chenalho_reales'];
    $realValues[] = $row['comalapa_reales'];
    $realValues[] = $row['comitam_reales'];
    $realValues[] = $row['empleado_reales'];
    $realValues[] = $row['margaritas_reales'];
    $realValues[] = $row['ocosingo_reales'];
    $realValues[] = $row['teopisca_reales'];
    $realValues[] = $row['vcarranza_reales'];
    $realValues[] = $row['yajalon_reales'];

    // Encontrar el mayor valor y sus índices
    foreach ($realValues as $index => $value) {
        if ($value > $maxValue) {
            $maxValue = $value;
            $maxIndexes = [$index]; // Reiniciar el índice del mayor valor
        } elseif ($value === $maxValue) {
            $maxIndexes[] = $index; // Agregar el índice si es igual al máximo
        }
    }
} else {
    echo "0 resultados";
}

// Cerrar conexión
$conn->close();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos de Datos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        #chartContainer {
            width: 80%;
            margin: 20px auto;
        }
        select, button {
            margin: 10px;
            padding: 10px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        th, td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .medal {
            color: gold;
            font-weight: bold;
        }
        .chart-panel {
            width: 80%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .chart-container {
            margin-bottom: 40px;
        }.titulo-enero {
  font-family: 'Arial', sans-serif;
  font-size: 28px;
  color: #4a4a4a;
  text-transform: uppercase;
  letter-spacing: 2px;
  border-bottom: 2px solid #4a4a4a;
  padding-bottom: 10px;
  margin-top: 20px;
}

    </style>
    
</head>
<body>


<!-- Mostrar la tabla -->
<table>
<center><h1 class="titulo-enero">Valores de Enero</h1></center>

    <tr>
        <th>Indice</th>
        <th>Reales (Acala)</th>
        <th>Reales (Chenalho)</th>
        <th>Reales (Comalapa)</th>
        <th>Reales (Comitam)</th>
        <th>Reales (Empleado)</th>
        <th>Reales (Margaritas)</th>
        <th>Reales (Ocosingo)</th>
        <th>Reales (Teopisca)</th>
        <th>Reales (VCarranza)</th>
        <th>Reales (Yajalon)</th>
    </tr>
    <tr>
    <td><?php echo isset($row) ? $row['indice'] : ''; ?></td>
    <td><?php echo isset($row) ? $row['reales'] : ''; ?> <?php if (in_array(0, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['chenalho_reales'] : ''; ?> <?php if (in_array(1, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['comalapa_reales'] : ''; ?> <?php if (in_array(2, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['comitam_reales'] : ''; ?> <?php if (in_array(3, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['empleado_reales'] : ''; ?> <?php if (in_array(4, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['margaritas_reales'] : ''; ?> <?php if (in_array(5, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['ocosingo_reales'] : ''; ?> <?php if (in_array(6, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['teopisca_reales'] : ''; ?> <?php if (in_array(7, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['vcarranza_reales'] : ''; ?> <?php if (in_array(8, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['yajalon_reales'] : ''; ?> <?php if (in_array(9, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
</tr>

</table>

<!-- Formulario para seleccionar tipo de gráfico -->
<form id="chartForm">
    <label for="chartType">Selecciona tipo de gráfico:</label>
    <select id="chartType" name="chartType">
        <option value="bar">Gráfico de Barras</option>
        <option value="line">Gráfico de Líneas</option>
        <option value="pie">Gráfico de Pastel</option>
        <option value="doughnut">Gráfico de Dona</option>
        <option value="radar">Gráfico Radar</option>
        <option value="polarArea">Gráfico de Área Polar</option>
    </select>
    <button type="button" onclick="renderChart()">Actualizar Gráfico</button>
</form>

<div class="chart-panel">
    <h2>Gráfico de Datos</h2>
    <div id="chartContainer" class="chart-container">
        <canvas id="myChart"></canvas>
    </div>
</div>

<script>
    const realValues = <?php echo json_encode($realValues); ?>;
    const labels = ['Acala', 'Chenalho', 'Comalapa', 'Comitam', 'Empleado', 'Margaritas', 'Ocosingo', 'Teopisca', 'VCarranza', 'Yajalon'];
    let myChart; // Variable para almacenar la instancia del gráfico

    function renderChart() {
        const chartType = document.getElementById('chartType').value;
        const ctx = document.getElementById('myChart').getContext('2d');

        // Verificar si ya existe un gráfico y destruirlo
        if (myChart) {
            myChart.destroy(); // Destruir el gráfico existente
        }

        // Crear un nuevo gráfico
        myChart = new Chart(ctx, {
            type: chartType,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Valores Reales',
                    data: realValues,
                    backgroundColor: generateColors(realValues.length),
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 2,
                    hoverBorderColor: 'rgba(0, 0, 0, 1)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'black',
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        ticks: {
                            color: 'black',
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'black'
                        }
                    }
                }
            }
        });
    }

    function generateColors(count) {
        const colors = [];
        for (let i = 0; i < count; i++) {
            colors.push(`hsl(${Math.random() * 360}, 100%, 50%)`);
        }
        return colors;
    }

    // Renderizar el gráfico inicial
    renderChart();
    
</script>

</body>



















<?php
// Configuración de la conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor es diferente
$username = "root"; // Cambia esto si tu usuario es diferente
$password = ""; // Cambia esto si tu contraseña es diferente
$dbname = "ejemplo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL
$sql1 = "
    SELECT a.indice, a.reales, c.reales AS chenalho_reales, o.reales AS comalapa_reales, 
           b.reales AS comitam_reales, d.reales AS empleado_reales, 
           e.reales AS margaritas_reales, f.reales AS ocosingo_reales, 
           z.reales AS teopisca_reales, j.reales AS vcarranza_reales, 
           l.reales AS yajalon_reales
    FROM acala a 
    INNER JOIN chenalho c ON a.id = c.id
    INNER JOIN comalapa o ON a.id = o.id
    INNER JOIN comitam b ON a.id = b.id
    INNER JOIN empleado d ON a.id = d.id
    INNER JOIN margaritas e ON a.id = e.id
    INNER JOIN ocosingo f ON a.id = f.id
    INNER JOIN teopisca z ON a.id = z.id
    INNER JOIN vcarranza j ON a.id = j.id
    INNER JOIN yajalon l ON a.id = l.id
    LIMIT 1 OFFSET 0
";

$result1 = $conn->query($sql1);

// Inicializa variables para encontrar el mínimo
$realValues = []; // Inicializar arreglo para los valores reales
$maxValue = PHP_FLOAT_MIN; // Inicializa el valor máximo a un número muy bajo
$maxIndexes = []; // Inicializa un arreglo para los índices de los valores máximos
$row = null; // Inicializa $row fuera del bucle

if ($result1->num_rows > 0) {
    // Obtener los valores reales
    $row = $result->fetch_assoc(); // Obtener la primera fila
    $realValues1[] = $row['reales'];
    $realValues1[] = $row['chenalho_reales'];
    $realValues1[] = $row['comalapa_reales'];
    $realValues1[] = $row['comitam_reales'];
    $realValues1[] = $row['empleado_reales'];
    $realValues1[] = $row['margaritas_reales'];
    $realValues1[] = $row['ocosingo_reales'];
    $realValues1[] = $row['teopisca_reales'];
    $realValues1[] = $row['vcarranza_reales'];
    $realValues1[] = $row['yajalon_reales'];

    // Encontrar el mayor valor y sus índices
    foreach ($realValues as $index1 => $value) {
        if ($value > $maxValue) {
            $maxValue = $value;
            $maxIndexes = [$index1]; // Reiniciar el índice del mayor valor
        } elseif ($value === $maxValue) {
            $maxIndexes[] = $index1; // Agregar el índice si es igual al máximo
        }
    }
} else {
    echo "0 resultados";
}

// Cerrar conexión
$conn->close();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos de Datos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        #chartContainer {
            width: 80%;
            margin: 20px auto;
        }
        select, button {
            margin: 10px;
            padding: 10px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        th, td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .medal {
            color: gold;
            font-weight: bold;
        }
        .chart-panel {
            width: 80%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .chart-container {
            margin-bottom: 40px;
        }.titulo-enero {
  font-family: 'Arial', sans-serif;
  font-size: 28px;
  color: #4a4a4a;
  text-transform: uppercase;
  letter-spacing: 2px;
  border-bottom: 2px solid #4a4a4a;
  padding-bottom: 10px;
  margin-top: 20px;
}

    </style>
    
</head>
<body>


<!-- Mostrar la tabla -->
<table>
<center><h1 class="titulo-enero">Valores de Enero</h1></center>

    <tr>
        <th>Indice</th>
        <th>Reales (Acala)</th>
        <th>Reales (Chenalho)</th>
        <th>Reales (Comalapa)</th>
        <th>Reales (Comitam)</th>
        <th>Reales (Empleado)</th>
        <th>Reales (Margaritas)</th>
        <th>Reales (Ocosingo)</th>
        <th>Reales (Teopisca)</th>
        <th>Reales (VCarranza)</th>
        <th>Reales (Yajalon)</th>
    </tr>
    <tr>
    <td><?php echo isset($row) ? $row['indice'] : ''; ?></td>
    <td><?php echo isset($row) ? $row['reales'] : ''; ?> <?php if (in_array(0, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['chenalho_reales'] : ''; ?> <?php if (in_array(1, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['comalapa_reales'] : ''; ?> <?php if (in_array(2, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['comitam_reales'] : ''; ?> <?php if (in_array(3, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['empleado_reales'] : ''; ?> <?php if (in_array(4, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['margaritas_reales'] : ''; ?> <?php if (in_array(5, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['ocosingo_reales'] : ''; ?> <?php if (in_array(6, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['teopisca_reales'] : ''; ?> <?php if (in_array(7, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['vcarranza_reales'] : ''; ?> <?php if (in_array(8, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
    <td><?php echo isset($row) ? $row['yajalon_reales'] : ''; ?> <?php if (in_array(9, $maxIndexes)) echo '<span class="medal">🏅</span>'; ?></td>
</tr>

</table>

<!-- Formulario para seleccionar tipo de gráfico -->
<form id="chartForm">
    <label for="chartType">Selecciona tipo de gráfico:</label>
    <select id="chartType" name="chartType">
        <option value="bar1">Gráfico de Barras</option>
        <option value="line">Gráfico de Líneas</option>
        <option value="pie">Gráfico de Pastel</option>
        <option value="doughnut">Gráfico de Dona</option>
        <option value="radar">Gráfico Radar</option>
        <option value="polarArea">Gráfico de Área Polar</option>
    </select>
    <button type="button" onclick="renderChart()">Actualizar Gráfico</button>
</form>

<div class="chart-panel">
    <h2>Gráfico de Datos</h2>
    <div id="chartContainer" class="chart-container">
        <canvas id="myChart"></canvas>
    </div>
</div>

<script>
    const realValues = <?php echo json_encode($realValues1); ?>;
    const labels = ['Acala', 'Chenalho', 'Comalapa', 'Comitam', 'Empleado', 'Margaritas', 'Ocosingo', 'Teopisca', 'VCarranza', 'Yajalon'];
    let myChart; // Variable para almacenar la instancia del gráfico

    function renderChart() {
        const chartType = document.getElementById('chartType').value;
        const ctx = document.getElementById('myChart').getContext('2d');

        // Verificar si ya existe un gráfico y destruirlo
        if (myChart) {
            myChart.destroy(); // Destruir el gráfico existente
        }

        // Crear un nuevo gráfico
        myChart = new Chart(ctx, {
            type: chartType,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Valores Reales',
                    data: realValues,
                    backgroundColor: generateColors(realValues.length),
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 2,
                    hoverBorderColor: 'rgba(0, 0, 0, 1)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'black',
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        ticks: {
                            color: 'black',
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'black'
                        }
                    }
                }
            }
        });
    }

    function generateColors(count) {
        const colors = [];
        for (let i = 0; i < count; i++) {
            colors.push(`hsl(${Math.random() * 360}, 100%, 50%)`);
        }
        return colors;
    }

    // Renderizar el gráfico inicial
    renderChart();
    
</script>

</body>
</html>
</html>