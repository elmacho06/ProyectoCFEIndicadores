<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ejemplo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar solicitud AJAX
if (isset($_GET['month'])) {
    $month = strtolower($_GET['month']);
    
    // Consulta SQL para traer los datos de todos los meses
    $sql = "SELECT c.indice,
                   c.reales AS enero,
                   c.reales1 AS febrero,
                   c.reales2 AS marzo,
                   c.reales3 AS abril,
                   c.reales4 AS mayo,
                   c.reales5 AS junio,
                   c.reales6 AS julio,
                   c.reales7 AS agosto,
                   c.reales8 AS septiembre,
                   c.reales9 AS octubre,
                   c.reales10 AS noviembre,
                   c.reales11 AS diciembre
            FROM comitam c
            LIMIT 1";

    $result = $conn->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        echo json_encode([]);
        exit;
    }

    // Devolver los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data);
    $conn->close();
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos y Tabla de Desempeño Mensual</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        #chartContainer { width: 90%; height: 500px; margin: 20px auto; }
        select, button, input { margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; }
        button { background-color: #28a745; color: white; cursor: pointer; }
        button:hover { background-color: #218838; }
        .chart-panel, .table-container { width: 90%; margin: 20px auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: center; border: 1px solid #ddd; }
        th { background-color: #4CAF50; color: white; }
    </style>
</head>
<body>

<!-- Formulario para buscar mes y seleccionar tipo de gráfico -->
<form id="chartForm">
    <label for="monthSearch">Buscar mes:</label>
    <input type="text" id="monthSearch" placeholder="Ejemplo: enero o febrero" />
    <label for="chartType">Selecciona tipo de gráfico:</label>
    <select id="chartType" name="chartType">
        <option value="bar">Gráfico de Barras</option>
        <option value="line">Gráfico de Líneas</option>
        <option value="pie">Gráfico de Pastel</option>
        <option value="doughnut">Gráfico de Dona</option>
        <option value="radar">Gráfico Radar</option>
        <option value="polarArea">Gráfico de Área Polar</option>
    </select>
    <button type="button" onclick="searchMonth()">Generar Gráfica</button>
    <button type="button" onclick="generateReport()">Generar Reporte Excel</button>
    <button type="button" onclick="downloadImage()">Descargar Imagen del Gráfico</button>
</form>

<div class="table-container">
    <h2>Desempeño Mensual</h2>
    <table id="dataTable">
        <thead>
            <tr>
                <th>Índice</th>
                <th>Enero</th>
                <th>Febrero</th>
                <th>Marzo</th>
                <th>Abril</th>
                <th>Mayo</th>
                <th>Junio</th>
                <th>Julio</th>
                <th>Agosto</th>
                <th>Septiembre</th>
                <th>Octubre</th>
                <th>Noviembre</th>
                <th>Diciembre</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="chart-panel">
    <h2>Gráfico de Datos</h2>
    <div id="chartContainer">
        <canvas id="myChart"></canvas>
    </div>
</div>

<script>
    let data = [];
    let myChart;

    function searchMonth() {
        const month = document.getElementById('monthSearch').value.toLowerCase();
        
        fetch(`?month=${month}`)
            .then(response => response.json())
            .then(newData => {
                data = newData;
                updateTable();
                renderChart();
            })
            .catch(error => console.error('Error al buscar datos:', error));
    }

    function updateTable() {
    const tbody = document.querySelector("#dataTable tbody");
    tbody.innerHTML = ""; // Limpiar tabla

    // Encontrar el valor mínimo en todos los datos
    let minValue = Infinity;
    let minCells = [];

    data.forEach(row => {
        for (const key in row) {
            if (key !== 'indice') {  // No considerar la columna 'Índice' para el valor mínimo
                const value = row[key];
                if (value < minValue) {
                    minValue = value;
                    minCells = [key]; // Si encontramos un nuevo valor mínimo, reiniciamos el array
                } else if (value === minValue) {
                    minCells.push(key); // Si encontramos otro valor mínimo, lo agregamos al array
                }
            }
        }
    });

    // Construir la tabla
    data.forEach(row => {
        const tr = document.createElement("tr");

        for (const key in row) {
            const td = document.createElement("td");
            td.textContent = row[key];

            // Si el valor de la celda es uno de los valores mínimos, agregar la medalla
            if (minCells.includes(key) && row[key] === minValue) {
                const medal = document.createElement("span");
                medal.innerHTML = "🏅"; // Agregar medalla
                td.appendChild(medal);
                td.style.fontWeight = "bold"; // Resaltar la celda con la medalla
            }

            tr.appendChild(td);
        }
        tbody.appendChild(tr);
    });
}


    function renderChart() {
        const chartType = document.getElementById('chartType').value;
        const ctx = document.getElementById('myChart').getContext('2d');

        if (myChart) {
            myChart.destroy();
        }

        myChart = new Chart(ctx, {
            type: chartType,
            data: {
                labels: Object.keys(data[0]).slice(1),
                datasets: [{
                    label: 'Valores Mensuales',
                    data: Object.values(data[0]).slice(1),
                    backgroundColor: generateColors(12),
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 2
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    function generateColors(count) {
        const colors = ['#FF5733', '#33FF57', '#3357FF', '#FF33A6', '#FFB833', '#B833FF', '#33FFF8', '#F8FF33'];
        return Array.from({ length: count }, (_, i) => colors[i % colors.length]);
    }

    function generateReport() {
        const worksheet = XLSX.utils.json_to_sheet(data);
        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Reporte");
        XLSX.writeFile(workbook, "reporte.xlsx");
    }

    function downloadImage() {
        const link = document.createElement('a');
        link.href = document.getElementById('myChart').toDataURL('image/png');
        link.download = 'grafico.png';
        link.click();
    }
</script>

</body>
</html>
