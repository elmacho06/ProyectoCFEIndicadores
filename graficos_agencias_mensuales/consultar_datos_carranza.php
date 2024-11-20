<?php
// Configuración de la conexión a la base de datos
include '../conexion/db_conect.php';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);


// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar solicitud AJAX
if (isset($_GET['month'])) {
    $month = strtolower($_GET['month']);
    
    // Consulta SQL dependiendo del mes
    if ($month === 'enero') {
        $sql = "SELECT indice, meta, tolerancia, reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'febrero') {
        $sql = "SELECT indice, meta1 AS meta, tolerancia1 AS tolerancia, reales1 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'marzo') {
        $sql = "SELECT indice, meta2 AS meta, tolerancia2 AS tolerancia, reales2 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'abril') {
        $sql = "SELECT indice, meta3 AS meta, tolerancia3 AS tolerancia, reales3 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'mayo') {
        $sql = "SELECT indice, meta4 AS meta, tolerancia4 AS tolerancia, reales4 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'junio') {
        $sql = "SELECT indice, meta5 AS meta, tolerancia5 AS tolerancia, reales5 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'julio') {
        $sql = "SELECT indice, meta6 AS meta, tolerancia6 AS tolerancia, reales6 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'agosto') {
        $sql = "SELECT indice, meta7 AS meta, tolerancia7 AS tolerancia, reales7 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'septiembre') {
        $sql = "SELECT indice, meta8 AS meta, tolerancia8 AS tolerancia, reales8 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'octubre') {
        $sql = "SELECT indice, meta9 AS meta, tolerancia9 AS tolerancia, reales9 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'noviembre') {
        $sql = "SELECT indice, meta10 AS meta, tolerancia10 AS tolerancia, reales10 AS reales FROM vcarranza LIMIT 12";
    } 
    elseif ($month === 'diciembre') {
        $sql = "SELECT indice, meta11 AS meta, tolerancia11 AS tolerancia, reales11 AS reales FROM vcarranza LIMIT 12";
    } 
    // Agregar aquí los otros casos de meses
    else {
        echo json_encode([]);
        exit;
    }

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
    <title>Gráficos de Datos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        #chartContainer { width: 90%; height: 500px; margin: 20px auto; }
        select, button, input { margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; }
        button { background-color: #28a745; color: white; cursor: pointer; }
        button:hover { background-color: #218838; }
        .chart-panel { width: 90%; margin: 20px auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #333; }
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
    <button type="button" onclick="searchMonth()">generar grafica</button>

    <button type="button" onclick="generateReport()">Generar Reporte Excel</button>
    <button type="button" onclick="downloadImage()">Descargar Imagen del Gráfico</button>
</form>

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
        const month=document.getElementById('monthSearch').value;
        console.log(month)
        const monthLower = month.toLowerCase();
        console.log(monthLower)
        fetch(`?month=${monthLower}`)
            .then(response => response.json())
            .then(newData => {
                data = newData;
                renderChart();
            })
            .catch(error => console.error('Error al buscar datos:', error));
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
                labels: data.map(item => item.indice),
                datasets: [{
                    label: 'Valores Reales',
                    data: data.map(item => parseFloat(item.reales)),
                    backgroundColor: generateColors(data.length),
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